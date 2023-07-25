<?php

namespace app\store\service;

use think\admin\Service;
use app\store\model\Order;
use app\project\model\BrowseHistory;
use app\data\model\DataUserAddress;
use app\store\model\Store;
use app\store\model\Refund;
use app\store\model\Track;


class OrderService extends Service
{
    
    private static function setOrderStatus($orderid,$newStatus){
        $user_id = Order::where(['id'=>$orderid])->value('uuid');
        BrowseHistory::updateHistoryStatus($user_id,$newStatus,$orderid,'store_order');
    }
    
    public static function updateInStock($orderid)
    {
        Order::where(['id'=>$orderid])->update(['status'=>2]);
        self::setOrderStatus($orderid,2);
    }
    
    
    public static function back($orderData)
    {
        Order::where(['id'=>$orderData['id']])->update(['status'=>4,'refund_status'=>$orderData['refund_status'],'take_status'=>$orderData['take_status']]);
        self::setOrderStatus($orderData['id'],4);
    }
    
    public static function updateWashing($orderid)
    {
        Order::where(['id'=>$orderid])->update(['status'=>3]);
        self::setOrderStatus($orderid,3);
    }
    
     public static function updateTransport($orderid)
    {
        Order::where(['id'=>$orderid])->update(['status'=>4]);
        self::setOrderStatus($orderid,4);
    }
    
    
    //计算运费
    public static function cuDeliveryFee(&$data)
    {
        
        $data['visit_fee'] = 0;
        $data['delivery_fee'] = 0;
        $store =  Store::where(['id'=>$data['store_id']])->field('status,lat,lng')->find()->toArray();
        if($data['take_type'] == 2){
           self::_cuDeliveryFee($data,$data['take_address_id'],$store['lat'],$store['lng']);
        }
        
        if($data['return_type'] == 2){
            self::_cuDeliveryFee($data,$data['send_address_id'],$store['lat'],$store['lng']);
        }
      
    }
    
    
    
    //计算运费
    private static function _cuDeliveryFee(&$data,$address_id,$store_lat,$store_lng)
    {
        $address =  DataUserAddress::where(['id'=>$address_id])->field('lat,lng')->find()->toArray();
        $fee = self::getDeliveryFee($address['lat'],$address['lng'],$store_lat,$store_lng);
        if($fee > 3){
            $data['delivery_fee'] += $fee;
        }else{
            $data['visit_fee'] += $fee;
        }
        
    }
    
    
    
    //获取运费
    public static function getDeliveryFee($lat1,$lng1,$lat2,$lng2)
    {
        $fee = sysdata("market_config")['market_config'];
        $delivery_fee = $fee['visit_price'];
        $distance = getDistance($lat1, $lng1, $lat2, $lng2);
        
        //1 ，1000公里
        if($distance >2){
           $delivery_fee = $fee['delivery_price'];
        }
        return $delivery_fee;
    }
    
    
    //获取退款记录
    public static function getRefundRecord($orderId)
    {
         $RefundRecord = [];
         $data = Refund::where(['order_id'=>$orderId])->order('id desc')->select()->toArray();
         foreach ($data as $key => $item){
             $arr1 = ['title'=>'退款申请提交,等待商家处理','remark'=>$item['remark'],'files'=>$item['datas'],'create_at'=>$item['create_at'],'status'=>0];
             
             if($item['status'] == 1){
                  $arr2 = ['title'=>'商家同意退款','remark'=> $item['feedback_text'],'files' => [],'create_at' => $item['check_at'],'status'=>1];
                  $RefundRecord[] = $arr2;
             }else if($item['status'] == 2){
                  $arr2 = ['title'=>'商家拒绝退款','remark'=> $item['feedback_text'],'files' => [],'create_at' => $item['check_at'],'status'=>2];
                  $RefundRecord[] = $arr2;
             }
             $RefundRecord[] = $arr1;
         }
         return $RefundRecord;
    }
 
 
 
    
    
}