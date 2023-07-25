<?php

namespace app\store\controller;


use think\admin\Controller;
use think\admin\helper\QueryHelper;
use app\store\model\Store as StoreModel;
use think\admin\model\SystemUser;
use think\facade\Cache;
use app\store\model\Order as StoreOrder;

/**
 * 门店管理
 * Class Coupon
 * @package app\data\controller\news
 */
class Store extends Controller
{
    
     /**
     * 门店管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
     
   
        StoreModel::mQuery()->layTable(function () {
            $this->title = '门店列表';
        }, function (QueryHelper $query) {
            $query->equal('name,status');
            $query->where(['deleted' => 0]);
        });
        
    }
    
    
    
    /**
     * 添加门店
     * @auth true
     */
    public function add()
    {
        
        $this->mode = 'add';
        $this->title = '添加门店';
        StoreModel::mForm('form');
    }
    
    
    
     /**
     * 编辑门店
     * @auth true
     */
    public function edit()
    {
        $this->mode = 'edit';
        $this->title = '编辑门店';
        StoreModel::mForm('form');
    }

    
    /**
     * 表单数据处理
     * @param array $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function _form_filter(array &$data)
    {
        
        $this->sysUsers = SystemUser::mk()->where(['is_bind'=>0])->whereFindInSet('authorize',155)
             ->field('username as name,id')->select()->toArray();
       
        if(array_key_exists('id',$data)){
             $this->bindUsers = [];
            $bindUsers = explode(',',$data['sys_users']);       
            foreach($bindUsers as $uid){
                 $this->bindUsers[] = SystemUser::mk()->where(['id'=>$uid])->value('username');
            }     
        }
        if ($this->request->isPost()) {
            $url = 'https://apis.map.qq.com/ws/geocoder/v1/';
            $param = ["key"=>"ZZ7BZ-N7MW4-EPDUG-XHX2L-SGDQV-JDFLY",
                      "address"=>$data['address']
                     ];
            $result = http_get($url,$param);
            $result = json_decode($result,true);
            $data['lat'] = $result['result']['location']['lat'];
            $data['lng'] = $result['result']['location']['lng'];
            
            if($result['status'] == 347){
                $this->error('地址有误，无法定位！');
            }
            $sys_users = explode(',',$data['sys_users']);
            foreach ($sys_users as $sys_user){
               $result = StoreModel::whereFindInSet('sys_users',$sys_user)->findOrEmpty();
               if ($result->isEmpty()){
                   //执行绑定操作
                   $sys_users[] = $sys_user;
               } 
            }
            $data['sys_users'] = implode(',',$sys_users);
        }
    }

    /**
     * 表单结果处理
     * @param boolean $state
     */
    protected function _form_result(bool $state,array $data)
    {
        
       
        if ($state) {
            $sys_users = explode(',',$data['sys_users']);
            foreach ($sys_users as $sys_user){
                SystemUser::mk()->where(['id'=>$sys_user])->update(['is_bind'=>1]);
            }
            $redis = Cache::store('redis')->handler();
            $redis->geoadd("storesCoordinates", $data['lng'],$data['lat'], $data['id']);
            $this->success('保存成功！', 'javascript:history.back()');
        }
    }
    
    
    /**
     * 删除门店
     * @auth true
     */
    public function remove()
    {
        
    }
    
    
   
    
}