<?php

namespace app\store\controller\api\auth;


use app\store\model\Order as OrderModel;
use app\data\controller\api\Auth;
use app\store\model\Store;
use think\facade\Cache;
use think\admin\extend\CodeExtend;
use app\project\model\BrowseHistory;

use app\data\model\BaseUserPayment;
use app\data\service\PaymentService;
use app\data\service\UserAdminService;
use think\exception\HttpResponseException;
use app\data\model\DataUserAddress;
use app\store\service\BasketService;
use app\store\service\OrderService;
use app\store\model\Store as StoreModel;
use app\store\service\StoreService;
use app\store\service\UserService;
use app\store\model\Refund as RefundModel;
use app\store\service\Commission;
use app\market\model\MarketCoupon;
/**
 * 订单类
 * Class Order
 * @package app\pet\controller\api\auth
 */
class Order extends Auth
{
   
    
     /**
     * 获取当前最近的店
     */
    public function add()
    {
        $data = $this->_vali([
                'uuid.default'   =>$this->uuid,
                'take_type.in:1,2'   => '取件方式必须是1,2！',
                'take_type.require'   => '取件方式不能为空！',
                'take_date.default' =>  '',
                'return_type.in:1,2'   => '归还方式必须是1,2！',
                'return_type.require'   => '归还方式不能为空！',
                'return_date.default' => '',
                'take_address_id.number'   => '上门取件地址id必须为整数！',
                'send_address_id.number'   => '上门取件地址id必须为整数！',
                'basket_ids.default'=>'',
                'remark.default'   => '',
                'store_id.number' =>  '合作店id必须为整数！',
                'store_id.require' =>  '合作店id不能为空！',
                'coupon_ids.default' => ''
                ]);
     
         $data['order_no'] = CodeExtend::uniqidDate(18, 'S');
         $basket_totals =  BasketService::getBasketTotalData($this->uuid);
         $basket_totals['goods'] = [];
         $basket_ids = [];
         if(empty($input['basket_ids'])){
            $basket_ids = BasketService::getBasketIds($this->uuid);
         }else{
            $basket_ids =  json_decode($input['basket_ids'],true);
            
         }
        
         //获取洗衣篮数据
         if(empty($basket_ids)){
            $this->success('洗衣篮数据为空');
         }
         foreach ($basket_ids as $basket_id){
            $basket_name = BasketService::getBasketName($this->uuid,$basket_id); 
            BasketService::makeUpBasket($basket_name,$basket_totals['goods']);
         }
        
         $config =  sysdata("market_config")['market_config'];
         $days = $config['finsh_days'];
         $data['return_date'] = "大约{$days}天后送回";
         $data['goods_data'] = json_encode($basket_totals);
         $data['regular_price'] = $basket_totals['total_amount'];
         
 
         
         
         
         //如果存在优惠卷
         if($data['coupon_ids']){
            $data['coupon_ids'] = json_decode($data['coupon_ids'],true);
            $coupons  = MarketCoupon::whereIn('id',$data['coupon_ids'])
                                    ->field('id,name,amount,intro,begin_date,end_date,discount_type,min_consume_amount,status')
                                    ->hidden(['status'])
                                    ->select()
                                    ->toArray();
            $reduce_price = 0;
            foreach ($coupons as $coupon){
                if($coupon['discount_type'] == 2){
                     $discount_price = $basket_totals['total_amount'] * $coupon['amount'];
                     $discount_price = $basket_totals['total_amount'] -$discount_price;
                     $reduce_price += $discount_price;
                }else{
                     $reduce_price += $coupon['amount']; 
                }
            }
            $data['discount_price'] =  $data['regular_price'] - $reduce_price;
         }else{
            $data['discount_price'] =  $data['regular_price'];
         }
         
         $data['reduce_price'] = $reduce_price;
        
         OrderService::cuDeliveryFee($data);
         $data['store_id'] = $data['store_id'];
         
         if($data['take_type'] == 2){
            $data['take_address']  = json_encode(UserService::getAddress($data['take_address_id']));
         }
        
        
         if($data['return_type'] == 2){
            $data['send_address'] = json_encode(UserService::getAddress($data['send_address_id']));
         }
         
         
         $order = OrderModel::create($data);
         BrowseHistory::addHistory($this->uuid,0,$order->id,'store_order');
        
        
        
         BasketService::removeCache($this->uuid);
         
         $data =  OrderModel::where(['order_no'=>$data['order_no']])
                                    ->append(['store_name','return_type_text','take_type_text','status_text'])
                                    ->find()
                                    ->toArray();  
                                    
         $data['store'] =  StoreModel::mk()->field('id,name,lat,lng,address,work_time,status')->find($data['store_id']);  
         $data['goods_data']['goods'] = BasketService::rebuildArrToList($data['goods_data']['goods']);
         
         $this->success('下单成功',['code'=>$data['order_no'],'order_detail' => $data]);
    }
    
    
     /**
     * 获取订单列表
     */
    public function list()
    {
  
        $map = $this->_vali([
                'uuid.default'   =>$this->uuid,
                'status.in:0,1,2,3,4,5,6,7'   => '状态必须是0,1,2,3,4,5,6,7！',
                'page.default' => 1,
                'page.number' => '分页数必须为整数',
                'keyword.default' => '',
                ]);
    
        $page = $map['page'];//1
        $pageCount = 6;
        $pageIndex = $page - 1;
        if($page > 1){
            $pageIndex = $pageIndex * $pageCount;
        }
         
        
        
        $query = OrderModel::where(['uuid'=>$this->uuid]);
        if(is_numeric($map['status'])){
         
            if($map['status']== 6){
                
                $query = $query->whereIn('status',[1,2,4,6])->where('refund_status','>',0);
            }else{
               
                $query = $query->where(['status'=>$map['status']])->where('refund_status','=',0);
            }
            
        }
        
        
        if($map['keyword']){
           
            $query = $query->where('order_no','like','%'.$map['keyword'].'%')
                           ->whereOr('goods_data','like','%'.$map['keyword'].'%')
                           ->whereOr('remark','like','%'.$map['keyword'].'%');
        }         
        
        
        
        $count = $query->count();
        
        
        
        
        
        $data = $query->field('id,store_id,order_no,return_type,take_type,status,payment_at,discount_price,goods_data,create_at,refund_status')
                      ->append(['store_name','return_type_text','take_type_text','status_text','refund_btn','process_intro'])
                      ->order('id desc')
                      ->limit($pageIndex,$pageCount)
                      ->select()
                      ->toArray();
                  
        foreach($data as &$good){
            $good['goods_data']['goods'] = BasketService::rebuildArrToList($good['goods_data']['goods']);
        }              
        $this->success('读取成功',['page'=>(int)$page,
                                  'pages'=>round($count/$pageCount),
                                  'list' =>$data]);            
        
        
    }
    
    
    
     /*
    *获取支付参数
    */
    public function getPayment(){
        // 读取支付通道配置
        $code = 'M7726511418908751680';
        $data = $this->_vali([
                'user_id.default'   =>$this->uuid,
                'code.require'   => 'code不能为空！',
        ]);
        
         // 自动处理用户字段
        $openid = '';
        if (in_array($this->type, [UserAdminService::API_TYPE_WXAPP, UserAdminService::API_TYPE_WECHAT])) {
            $openid = $this->user[UserAdminService::TYPES[$this->type]['auth']] ?? '';
            if (empty($openid)) $this->error("发起支付失败");
        }
        
        try {
            // 返回订单数据及支付发起参数
            $order = OrderModel::where(['order_no'=>$data['code'],'uuid'=>$this->uuid])->find();
            
            if (empty($order)) $this->error("发起支付失败,订单不存在");
            $order['discount_price'] =  $order['discount_price'] + $order['delivery_fee'] + $order['visit_fee'];
            $param = PaymentService::instance($code)->create($openid, $order['order_no'], $order['discount_price'], '订单支付', '', '', '');
            $this->success('获取支付参数',  $param);
        } catch (HttpResponseException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
    
    
    
    
    
     /*
    *获取物流费用
    */
    public function getDeliveryFee(){
        
        $data = $this->_vali([
                'address_id.number'   => '地址ID必须为整数',
                'address_id.require'   => '地址ID必须为整数',
                'store_id.number'=>'合作店id必须为整数',
                'store_id.require'=>'合作店id不能为空',
        ]);
        
        //上门取送
        $delivery_fee = $this-> __getDeliveryFee($data['store_id'],$data['address_id']);
        $this->success('获取成功',['delivery_fee'=>$delivery_fee]);     
    }
    
    
    private function __getDeliveryFee($store_id,$address_id){
        $fee = sysdata("market_config")['market_config'];
        $store =  Store::where(['id'=>$store_id])->field('status,lat,lng')->find()->toArray();
        $address =  DataUserAddress::where(['id'=>$address_id])->field('lat,lng')->find()->toArray();
        $delivery_fee = OrderService::getDeliveryFee($store['lat'], $store['lng'], $address['lat'], $address['lng']);
        return $delivery_fee;
    }
    
    
    
    /*
    *获取订单详情
    */
    public function getDetail(){
        $input = $this->_vali([
                'uuid.default'   =>$this->uuid,
                'order_id.number' =>  '订单id必须为整数！',
                'order_id.require' =>  '订单id不能为空！',
                ]);
                
        $data = OrderModel::where(['id'=>$input['order_id']])
                                    ->append(['store_name','return_type_text','take_type_text','status_text','refund_btn','process_intro'])
                                    ->find()
                                    ->toArray();  
                                    
        
           
        
        $data['store'] =  StoreModel::mk()->field('id,name,lat,lng,address,work_time,status')->find($data['store_id']);  
        $addrFields = 'name,phone,address,number,sex';
        $data['goods_data']['goods'] = BasketService::rebuildArrToList($data['goods_data']['goods']);
        $this->success('获取成功',$data);     
        
    }
    
    
    
    
    
   
    
    /*
    *提交退款申请
    */
    public function applyRefund(){
           $input = $this->_vali([
                'user_id.default'   =>$this->uuid,
                'order_id.number' =>  '订单id必须为整数！',
                'order_id.require' =>  '订单id不能为空！',
                'remark.default'=>'',
                'datas.default'=>'',
            ]);
            RefundModel::create($input);
            OrderModel::where(['id'=>$input['order_id']])
                                    ->update(['refund_status'=>1]);  
            $this->success('提交成功,请等待反馈');     
    }
    
    
    
     /*
    *确认收货
    */
    public function confirm(){
           $input = $this->_vali([
                'uuid.default'   =>$this->uuid,
                'order_id.number' =>  '订单id必须为整数！',
                'order_id.require' =>  '订单id不能为空！',
            ]);
           $order = OrderModel::where(['id'=>$input['order_id']])->find();
           if($order['refund_status'] == 0){
               $order['status'] = 5;
              
               //计算分润
               Commission::produce($order['store_id'],$order['discount_price'],'订单佣金',$order['order_no']);
           }else if($order['refund_status'] > 0){
               $order['status'] = 6;
           }
            $order['take_status'] = 2;
            $order->save();
            $this->success('确认收货成功');     
    }
    
    
     /*
    *获取退款申请流程
    */
    public function getRefundTrack(){
        $input = $this->_vali([
            'uuid.default'   =>$this->uuid,
            'order_id.number' =>  '订单id必须为整数！',
        ]);
        $refund_record =  OrderService:: getRefundRecord($input['order_id']);
        $this->success('获取成功',$refund_record);  
    }
    
    
}