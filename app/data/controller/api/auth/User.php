<?php

namespace app\data\controller\api\auth;

use app\data\controller\api\Auth;
use think\exception\HttpResponseException;
use app\data\model\DataUser;
use QingStor\SDK\Config;
use QingStor\SDK\Service\QingStor;
use think\admin\Controller;
use app\data\service\UserAdminService;
use app\project\model\BrowseHistory;
use think\facade\Cache;
use app\store\service\StoreService;
use think\admin\storage\LocalStorage;
/**
 * 用户接口
 * Class Order
 * @package app\data\controller\api\auth
 */
class User extends Auth
{
    
    
     /**
     * 修改微信资料
     */
    public function getInfo()
    {
        $type = UserAdminService::API_TYPE_WXAPP;
        $result = UserAdminService::get($this->uuid,$type);
        $data['id'] = $this->uuid;
        $data['headimg'] = $result['headimg'];
        $data['nickname'] = $result['nickname'];
        $data['base_sex'] = $result['base_sex'];
        $data['base_birthday'] = $result['base_birthday'];
        $data['phone'] = $result['phone'];
        $this->success('获取成功！', $data);
    }
    
    
    
    
     /**
     * 修改微信资料
     */
    public function updateWxInfo()
    {
      
         $file = request()->file('headimg');
         $data = $this->_vali([
                'headimg.default'   => '',
                'nickname.default'   => '',
                'base_sex.in:1,2'   => '性别必须是1,2',
                'base_birthday.default'   => '',
                'phone.mobile'   => '关联手机格式错误',
                'phone.default'   => '',
         ]);
     
         
         foreach ($data as $key => $value){
             if(empty($value)){
                 unset($data[$key]);
             }
         }
   
         DataUser::mk()->where(['id' => $this->uuid])
                       ->update($data);
        $user =  DataUser::mk()->where(['id' => $this->uuid])
                       ->field('id,headimg,nickname,base_sex,base_birthday,phone')
                       ->find();          
         $this->success('修改成功！',$user);
      
    }
    
    
    
    
    
      /*
    *获取未浏览红点数
    */
    public function orderDots(){
        $input = $this->_vali([
                'uid.default'   =>$this->uuid,
        ]);
        $orderStatusArrs = ["待支付","入库中","清洗中","送货中","已完成"];
        $orderDatas = [];
        $orderDots = BrowseHistory::where(['userid'=>$this->uuid,
                                     'is_read'=>0,
                                     'model'=>'store_order',
                                   ])->field('count(id) as dotNums,status')
                                     ->group('status')
                                     ->select();
                                     
        foreach ($orderStatusArrs as $key => $value){
            foreach ($orderDots as $orderDot){
                if($key == $orderDot['status']){
                     $orderDatas[$value]  = $orderDot['dotNums'];
                }
            }
        }                             
                                     
        $this->success('获取成功',$orderDots);                             
    }
    
    
    
    public function bindSpread(){
        $input = $this->_vali([
                'share_uid.default'   => 'share_uid不能为空',
                'share_uid.number'   => 'share_uid分享者必须整数',
        ]);
         
        if($input['share_uid']){
            $share_uid = $input['share_uid'];
            $pid = DataUser::where(['id'=>$this->uuid])->value('pid1');
            if($pid == 0){
                DataUser::where(['id'=>$this->uuid])->update(['pid1'=>$share_uid]);
                $sharer = DataUser::field('id,teams_users_direct')->find($share_uid);
                $share_data = $sharer->toArray(); 
                $sharer['teams_users_direct'] += 1;
                $sharer->save();
                $this->app->event->trigger('ShareNewUser', $share_data);
            }
        }
        
        $this->success('操作成功');                             
    }
    
    
    
    
    
    public function isSuperior(){
        $input = $this->_vali([
                'share_uid.default'   => 'share_uid不能为空',
                'share_uid.number'   => 'share_uid分享者必须整数',
        ]);
         
        $share_uid = $input['share_uid'];
        $pid = DataUser::where(['id'=>$this->uuid])->value('pid1');
        $flag =  false;
        if($pid == $share_uid){
            $flag = true;
        }
        
        $this->success('读取成功',['is_superior' => $flag]);                             
    }
    
    
    
    
       /**
     * 获取当前最近的店
     */
    public function getSelectedStore()
    {
       
        $uuid = $this->uuid;
        $stores = [];
        if(Cache::store('redis')->has("{$uuid}#store_selected")){
            $storeId = Cache::store('redis')->get("{$uuid}#store_selected");
            $stores = StoreService::instance()->getInfo($storeId);
        }
        $this->success('获取成功', $stores);
    }
    
    
    
      /**
     * 选中当前最近的店
     */
    public function selectedStore()
    {
          $input = $this->_vali([
                'store_id.require'=>'store_id不能为空',
                'store_id.number'=>'store_id必须为整数',
          ]);
          $uuid = $this->uuid;
          Cache::store('redis')->set("{$uuid}#store_selected",$input['store_id']);
          $this->success('操作成功');
        
    }
}
