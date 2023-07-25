<?php

namespace app\store\controller;


use think\admin\Controller;
use think\admin\helper\QueryHelper;
use app\store\model\Commission as CommissionModel;
use app\store\model\Store as Store;

/**
 * 佣金记录
 * Class Coupon
 * @package app\data\controller\news
 */
class Commission extends Controller
{
    
     /**
     * 佣金记录
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        
        
        
        $admin = $this->app->session->get('user');
        if($admin['is_bind'] == 1){
           $this->store_id = Store::whereFindInSet('sys_users',$admin['id'])->value('id');
        }
        $this->stores =  Store::where(['status'=>1])->field('id,name,status')->select()->toArray();
        CommissionModel::mQuery()->layTable(function () {
            $this->title = '佣金记录';
        }, function (QueryHelper $query) {
            $query->equal('store_id,status');
            //$query->db->append(['store_name']);
        });
        
    }
    
    
    
    
    
   
    
}