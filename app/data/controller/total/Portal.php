<?php

namespace app\data\controller\total;

use app\data\model\BaseUserUpgrade;
use app\data\model\DataUser;
use app\data\model\DataUserBalance;
use app\data\model\DataUserRebate;
use app\data\model\ShopGoods;
use app\data\model\ShopOrder;
use think\admin\Controller;
use app\store\model\Order;
use app\store\model\Commission;
use app\store\model\Store as StoreModel;

/**
 * 商城数据报表
 * Class Portal
 * @package app\data\controller\total
 */
class Portal extends Controller
{
    
    
    
    
    
    public function index(){
        $admin = $this->app->session->get('user');
        if($admin['is_bind'] == 1){
           $this->store_id = StoreModel::whereFindInSet('sys_users',$admin['id'])->value('id');
           $this->storeIndex();
        }else{
           $this->mainIndex();
        }
    }
    /**
     * 商城数据报表
     * @auth true
     * @menu true
     */
    private function mainIndex()
    {
        $this->usersTotal = DataUser::mk()->cache(true, 60)->count();
        $this->goodsTotal = ShopGoods::mk()->cache(true, 60)->where(['deleted' => 0])->count();
        $this->orderTotal = Order::mk()->cache(true, 60)->whereRaw('status > 0 and status < 6')->count();
        $this->amountTotal = Order::mk()->cache(true, 60)->whereRaw('status > 0 and status < 6')->sum('discount_price');
        // 近十天的用户及交易趋势
        $this->days = $this->app->cache->get('portals', []);
        if (empty($this->days)) {
            for ($i = 15; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-{$i}days"));
                $this->days[] = [
                    '当天日期' => date('m-d', strtotime("-{$i}days")),
                    '增加用户' => DataUser::mk()->whereLike('create_at', "{$date}%")->count(),
                    '订单数量' => Order::mk()->whereLike('create_at', "{$date}%")->whereRaw('status > 0 and status < 6')->count(),
                    '订单金额' => Order::mk()->whereLike('create_at', "{$date}%")->whereRaw('status > 0 and status < 6')->sum('discount_price'),
                    '代理收益' => Commission::mk()->whereLike('create_at', "{$date}%")->sum('amount'),
                    '平台收益' => Order::mk()->whereLike('create_at', "{$date}%")->whereRaw('status = 5')->sum('discount_price'),
                ];
            }
            $this->app->cache->set('portals', $this->days, 60);
        }
        // 会员级别分布统计
        /*$levels = BaseUserUpgrade::mk()->where(['status' => 1])->order('number asc')->column('number code,name,0 count', 'number');
        foreach (DataUser::mk()->field('count(1) count,vip_code level')->group('vip_code')->cursor() as $vo) {
            $levels[$vo['level']]['count'] = isset($levels[$vo['level']]) ? $vo['count'] : 0;
        }
        $this->levels = array_values($levels);*/
        $this->fetch();
    }
    
    
    
    
   private function storeIndex()
    {
       
 
        $this->orderTotal = Order::mk()->cache(true, 60)
                                       ->whereRaw('status > 0 and status < 6')
                                       ->where(["store_id"=>$this->store_id])
                                       ->count();
        $this->amountTotal = Order::mk()->cache(true, 60)
                                        ->whereRaw('status > 0 and status < 6')
                                        ->where(["store_id"=>$this->store_id])
                                        ->sum('discount_price');
        $this->settleTotal = Commission::where(['status'=>1,"store_id"=>$this->store_id])->sum('amount');
        $this->unSettleTotal = Commission::where(['status'=>0,"store_id"=>$this->store_id])->sum('amount');
        // 近十天的用户及交易趋势
        $this->days = $this->app->cache->get('portals', []);
        if (empty($this->days)) {
            for ($i = 15; $i >= 0; $i--) {
                $date = date('Y-m-d', strtotime("-{$i}days"));
                $this->days[] = [
                    '当天日期' => date('m-d', strtotime("-{$i}days")),

                    '订单数量' => Order::mk()->whereLike('create_at', "{$date}%")
                                             ->where(["store_id"=>$this->store_id])
                                             ->whereRaw('status > 0')
                                             ->count(),
                    '订单金额' => Order::mk()->whereLike('create_at', "{$date}%")
                                             ->where(["store_id"=>$this->store_id])
                                             ->whereRaw('status > 0 and status < 6')
                                             ->sum('discount_price'),
                
                ];
            }
            $this->app->cache->set('portals', $this->days, 60);
        }
        $this->fetch('store_index');
    }
    
    
}