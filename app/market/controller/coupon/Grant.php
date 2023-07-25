<?php

namespace app\market\controller\coupon;


use think\admin\Controller;
use think\admin\helper\QueryHelper;
use app\market\model\MarketCoupon;
use app\market\model\MarketCouponUsers;
use app\project\model\Project;
use app\data\model\BaseUserUpgrade;
use think\facade\Cache;
/**
 * 优惠卷发放
 * Class Grant
 * @package app\data\controller\news
 */
class Grant extends Controller
{
    
     /**
     * 优惠卷发放管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $this->title = '发放管理';
        // 加载对应数据
        
        MarketCouponUsers::mQuery()->layTable(function () {
        }, function (QueryHelper $query) {
             $query->with(['coupon','user']);
            if (input('coupon_id')) {
              $query->where(['coupon_id'=>input('coupon_id')]);
            }
        });
    }
    
    
    
    
    /**
     * 发放优惠卷
     * @auth true
     */
    public function form()
    {
        $this->mode = 'grant';
        $this->title = '发放优惠卷';
        $this->upgrades = BaseUserUpgrade::mk()->where(["status"=>1])
                                               ->field("id,name")
                                               ->select();  
        if(input('id')) $this->id = input('id');   
        BaseUserUpgrade::mForm('form');
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
        if($this->request->isPost()){
            if(!$data['upgrade_ids']) $this->error('请选择等级！');
            $data = ['upgrade_ids' => $data['upgrade_ids'],'coupon_id' => $data['id']];
            $taskid =  uniqid();
            $redis = Cache::store('redis')->set($taskid,$data);
            $code = sysqueue("给所属等级用户发放优惠卷", "xdata:Coupon {$taskid}", 0, [], 1, 0);
            $this->success("发放任务提交成功！任务id:{$taskid}");
        }
    }
    
}