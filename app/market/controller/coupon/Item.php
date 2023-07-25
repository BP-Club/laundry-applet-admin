<?php

namespace app\market\controller\coupon;


use think\admin\Controller;
use think\admin\helper\QueryHelper;
use app\market\model\MarketCoupon;
use app\data\model\ShopGoods;
use app\custom\model\CustomEvent;
/**
 * 优惠卷
 * Class Item
 * @package app\data\controller\coupon
 */
class Item extends Controller
{
    
     /**
     * 优惠卷管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        MarketCoupon::mQuery()->layTable(function () {
            $this->title = '优惠卷管理';
            $this->status = [1 => '未过期', 0 => '已过期'];
        }, function (QueryHelper $query) {
            $query->dateBetween('create_at')->equal('status,stock_type,use_scene,use_requirement,is_blend,grant_type');
            $query->where(['deleted' => 0]);
        });
    }
    
    
    
    /**
     * 添加优惠卷
     * @auth true
     */
    public function add()
    {
        $this->mode = 'add';
        $this->title = '添加优惠卷';
        MarketCoupon::mForm('form');
    }
    
    
    
     /**
     * 编辑优惠卷
     * @auth true
     */
    public function edit()
    {
        $this->mode = 'edit';
        $this->title = '编辑优惠卷';
        MarketCoupon::mForm('form');
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
        $this->projects = ShopGoods::where(['status'=>1,'deleted'=>0])->field('id,name')->select();
        $this->gainRequirements = CustomEvent::where(['module'=>'coupon'])->field('id,name')->select()->toArray();
        if ($this->request->isPost()) {
            $data['use_date'] = explode(' - ',$data['use_date']);
            $data['begin_date'] =  $data['use_date'][0];
            $data['end_date'] =  $data['use_date'][1];
        }else if(array_key_exists('id',$data)){
            $data['use_date'] = $data['begin_date']." - ".$data['end_date'];
            
        }
    }

    /**
     * 表单结果处理
     * @param boolean $state
     */
    protected function _form_result(bool $state)
    {
        if ($state) {
            $this->success('保存成功！', 'javascript:history.back()');
        }
    }
    
    
    /**
     * 删除优惠卷
     * @auth true
     */
    public function remove()
    {
        MarketCoupon::mDelete();
    }

    
     
   
}