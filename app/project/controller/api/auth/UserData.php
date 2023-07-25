<?php

namespace app\project\controller\api\auth;

use app\data\controller\api\Auth;
use app\data\model\DataUserAddress;
use app\pet\model\Pet;
use app\market\model\MarketCoupon;
use app\market\model\MarketCouponUsers;
use app\project\model\BrowseHistory;
use app\project\model\Order as OrderModel;
use think\facade\Cache;
use app\wechat\service\SubscribeService;
/**
 * 获取下单用户数据
 * Class UserData
 * @package app\project\controller\api\auth
 */
class UserData extends Auth
{
    /**
     * 获取我的宠物和地址信息,优惠卷
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function myBuyData()
    {
         $input = $this->_vali([
                'uid.default'   =>$this->uuid,
                'projectid.number'   => 'projectid必须为整数！',
         ]);
         $projectid = $input['projectid'];
         $data = [];
         $data['address'] = DataUserAddress::where(['uuid' => $this->uuid, 'deleted' => 0])
                        ->order('type desc,id desc')
                        ->field('id,address as text,number,name as contactname,phone')
                        ->select();
         $data['pets'] = Pet::where(['uid' => $this->uuid])->field('id,name,images')->append(['avatar'])->select();
         $projectid = 1;
         $couponUserIds = MarketCouponUsers::where(['user_id'=> $this->uuid,'status'=> 1])
                                         ->whereRaw("FIND_IN_SET({$projectid},project_ids)")
                                         ->column('id');
         $data['coupons'] = MarketCoupon::whereIn('id',$couponUserIds)->select()->toArray();                         
         $this->success('获取成功', $data); 
    
    }
    
    
    
      /*
    *获取未浏览红点数
    */
    public function dots(){
        $input = $this->_vali([
                'uid.default'   =>$this->uuid,
                'user_type.default'   =>1,
        ]);
        $orderStatusArrs = ['待支付','已支付','已完成','已取消'];
        $orderIcons = ['rmb','clock','checkmark-circle','close-circle'];
        if($input['user_type'] == 2){
            $orderStatusArrs = ['待服务','已完成','已取消'];
            $orderIcons = ['clock','checkmark-circle','close-circle'];
        }
       
        $orderDatas = [];
        $orderDots = BrowseHistory::where(['userid'=>$this->uuid,
                                     'is_read'=>0,
                                     'model'=>'project_order',
                                   ])->field('count(id) as dotNums,status')
                                     ->group('status')
                                     ->select();
                                     
        foreach ($orderStatusArrs as $key => $value){
            $arr = ['text'=>$value,'icon'=>$orderIcons[$key],'dots'=>0];
            foreach ($orderDots as $orderDot){
                if($key == $orderDot['status']){
                    $arr['dots'] = $orderDot['dotNums'];
                }
            }
            $orderDatas[] = $arr;
            
        }                             
                                     
        $this->success('获取成功', ['project_order'=>$orderDatas]);                             
    }
    
    
     /**
     * 同意接单
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function servicerAccept()
    {
         $input = $this->_vali([
                'uid.default'   =>$this->uuid,
                'orderid.number'   => 'orderid必须为整数！',
         ]);
         $order =OrderModel::where(['id'=>$input['orderid']])->find();
         if($order['service_uid'] > 0){
             $this->error("此订单已被接了");
         }
         $order['service_uid'] =  $this->uuid;
         $order['do_status'] =  2;
         $this->success("接单成功！");
    }
    
    
     /**
     * 拒绝接单
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function servicerReject()
    {
        
         $input = $this->_vali([
                'uid.default'   =>$this->uuid,
                'orderid.number'   => 'orderid必须为整数！',
         ]);
         $orderId = $input['orderid'];
         $redis = Cache::store('redis')->handler();
         $data = $redis->rPop("order-{$orderId}-Queque");
         if($data){
                $data = json_decode($data,true);
               //推送消息给服务人员
                SubscribeService::pushMessageNewOrder($data['order_no'],$data['uid'],$data['title'],$data['address'],
                                                      $data['reserve_date'],$data['discount_price'],$data['distance'],'developer');
         }
         $this->success("拒绝成功！");
        
        
    }

}