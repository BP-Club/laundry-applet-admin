<?php

namespace app\market\service;


use think\admin\Service;
use app\data\service\EventService;
use app\market\model\MarketCouponUsers;
use app\market\model\MarketCoupon;
/**
 * 优惠卷服务
 * Class CouponService
 * @package app\data\service
 */
class CouponService extends Service
{
     public static function gain($eventName,$data){
        $flag =  EventService::run("ShareNewUser",$data);
        if($flag){
            $coupon = EventService::$eventBindObj;
            $result =  MarketCouponUsers::where(['coupon_id'=>$coupon['id'],'user_id' => $data['id']])->findOrEmpty();
            if($result->isEmpty()){
                MarketCouponUsers::insert(['coupon_id'=>$coupon['id'],'user_id' => $data['id']]);
            }
        }   
     }
     
     
     //获取可用优惠款
     public static function getCanUse($goods)
     {
        
        $goodIds = [];
        foreach ($goods as $key => $good){
            if(!in_array($good['id'],$goodIds) ){
                $goodIds[] = $good['id'];
            }
        }
        
        $couponIds = MarketCoupon::where(['use_scene'=>1,'status'=>1])->column('id');
        $couponIds = empty($couponIds) ? [] : $couponIds;
        foreach ($goodIds as $goodId){
             $limitUseCids = MarketCoupon::where(['use_scene'=>2,'status'=>1])
                                    ->whereFindInSet('project_ids',$goodId)
                                    ->column('id');
             $couponIds = array_merge($couponIds,$limitUseCids);
        }
        
        $couponIds = array_unique($couponIds);
        if(empty($couponIds)){
            return ['use_count'=>0];
        }
        
        return ['use_count'=>count($couponIds),'coupon_ids'=>$couponIds];
     }
     
}