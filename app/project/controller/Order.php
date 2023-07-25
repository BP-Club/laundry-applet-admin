<?php

namespace app\project\controller;


use think\admin\Controller;
use think\admin\helper\QueryHelper;
use app\project\model\Store as StoreModel;
use app\project\model\Order as OrderModel;
/**
 * 服务项目
 * Class Coupon
 * @package app\data\controller\news
 */
class Order extends Controller
{
    
     /**
     * 项目管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        $this->title = '订单数据管理';
        // 状态数据统计
        $this->total = ['t0' => 0, 't1' => 0, 't2' => 0, 't3' => 0, 't4' => 0, 't5' => 0, 't6' => 0];
        foreach (OrderModel::mk()->field('status,count(1) total')->group('status')->cursor() as $vo) {
            [$this->total["t{$vo['status']}"] = $vo['total'], $this->total["ta"] += $vo['total']];
        }

    }
    
    
    
    /**
     * 添加优惠卷
     * @auth true
     */
    public function add()
    {
        
        $this->mode = 'add';
        $this->title = '添加项目';
        OrderModel::mForm('form');
    }
    
    
    
     /**
     * 编辑优惠卷
     * @auth true
     */
    public function edit()
    {
        $this->mode = 'edit';
        $this->title = '编辑项目';
        ProjectModel::mForm('form');
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
        $this->addititems = OrderModel::select();
       
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
        OrderModel::mDelete();
    }

    
}