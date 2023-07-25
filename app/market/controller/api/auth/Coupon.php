<?php

namespace app\market\controller\api\auth;

use app\data\controller\api\Auth;
use app\market\model\MarketCoupon ;
use app\market\model\MarketCouponUsers;
use app\store\service\BasketService;
/**
 * 用户宠物
 * Class Pet
 * @package app\pet\controller\api\auth
 */
class Coupon extends Auth
{
   
    
     /**
     * 获取我的优惠卷列表
     */
    public function list()
    {
        $input = $this->_vali([
                'user_id.default'   =>$this->uuid,
                'coupon_ids.default'   => '',
                'used_coupon_ids.default'   => '',
        ]);
    
    
        $basket_totals =  BasketService::getBasketTotalData($this->uuid);
        
        
        
        $couponIds  = [];
        if($input['coupon_ids']){
           $couponIds = json_decode($input['coupon_ids'],true);
        }
        
        $usedCouponIds  = [];
        if($input['used_coupon_ids']){
           $usedCouponIds = json_decode($input['used_coupon_ids'],true);
        }
        
        //1未使用,2已使用,3已过期(is_old = 1)
        //前端显示：0待使用，1去使用，2已过期,3已选择
        $couponUsers = MarketCouponUsers::whereIn('status',[1,3])->field('status,coupon_id')->append(['status_text'])->select()->toArray();
        $datas = [];
        foreach ($couponUsers as &$couponUser){
            $couponUser['is_old'] = 0; 
            $coupon  = MarketCoupon::where(['id'=>$couponUser['coupon_id']])
                                    ->field('id,name,amount,intro,begin_date,end_date,discount_type,min_consume_amount,status')
                                    ->hidden(['status'])
                                    ->find()->toArray();
           
           
            //最低消费金额
            if($coupon['min_consume_amount']){
                $coupon['min_consume_amount'] = '满'.$coupon['min_consume_amount'].'可用';
            }
            
             
            $coupon['amount_unit'] = '折';
            if($coupon['discount_type'] == 1){
                $coupon['amount_unit'] = '元';
            }
             
            if($couponUser['status'] == 1){
                $couponUser['status_text'] = '待使用';
                $couponUser['status'] = 0; 
                if(in_array($coupon['id'],$couponIds)){
                    $coupon['reduce_price'] = $coupon['amount'];
                    if($coupon['discount_type'] == 2){
                       $coupon['reduce_price'] = $basket_totals['total_amount'] * $coupon['reduce_price'];
                       $coupon['reduce_price'] = $basket_totals['total_amount'] - $coupon['reduce_price'];
                    }
                    
                    $couponUser['status_text'] = '去使用';
                    $couponUser['status'] = 1; 
                    if(in_array($coupon['id'],$usedCouponIds)){
                        $couponUser['status_text'] = '已选择';
                        $couponUser['status'] = 3; 
                    }
                }
            }else{
                $couponUser['status_text'] = '已过期';
                $couponUser['status'] = 2; 
                $couponUser['is_old'] = 1; 
            }
            $coupon['open'] = false; 
            $coupon = array_merge($coupon,$couponUser);
            $datas[] = $coupon;
        }
        $this->success('获取成功', $datas);
    }
    
    
    
  
    
}