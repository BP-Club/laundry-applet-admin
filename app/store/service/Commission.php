<?php

namespace app\store\service;

use app\store\model\Commission as CommissionModel;
use app\store\model\Store as StoreModel;
use think\admin\Model;

class Commission extends Model
{
    
    //跑腿佣金
    public static function run($storeId,$orderPrice,$remark='上门跑腿佣金',$orderNo)
    {
       self::insertData(3,$storeId,$orderPrice,$remark,$orderNo);
    }
    
    
    
    //订单佣金
    public static function produce($storeId,$orderPrice,$remark='订单佣金',$orderNo)
    {
       $fee = sysdata("market_config")['market_config'];
       $amount = $orderPrice * $fee['profit'];
       self::insertData($amount,$storeId,$orderPrice,'订单佣金',$orderNo);
    }
    
    
    
    private static function insertData($amount,$storeId,$orderPrice,$remark='订单佣金',$orderNo)
    {
        CommissionModel::create([
           "store_id" => $storeId,
           "amount" => $amount,
           "remark" => $remark,
           "order_no"=>$orderNo,
           "order_price" => $orderPrice,
       ]);
    }
    
    
    
     public static function settle($storeId)
    {
        
       $money = CommissionModel::where(["store_id" => $storeId,"status" => 0])
                      ->whereDay('create_at','yesterday')
                      ->sum('amount');
      
       CommissionModel::where(["store_id" => $storeId,"status" => 0])
                      ->whereDay('create_at','yesterday')
                      ->update(["settle_at" => date('y-m-d h:i:s'),"status" => 1]);
       
       StoreModel::where(['id'=>$storeId])->inc('money', $money)->update();              
    }
    
    
}