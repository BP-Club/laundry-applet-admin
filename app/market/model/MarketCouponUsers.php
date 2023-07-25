<?php

namespace app\market\model;

use think\admin\Model;
use app\data\model\DataUser;
/**
 * 优惠卷用户模型
 * Class MarketCoupon
 * @package app\market\model
 */
class MarketCouponUsers extends Model
{
    
    
    protected $append = ['status_text','coupon_name','coupon_amount','user_name'];
    
    
    
    public function coupon()
    {
    	return $this->belongsTo(MarketCoupon::class,'coupon_id','id');
    }
    
    public function user()
    {
    	return $this->belongsTo(DataUser::class,'user_id','id');
    }
    
    
     /**
     * 格式化期限状态
     * @param mixed $value
     * @return mixed
     */
    public function getStatusTextAttr()
    {
        $texts = [1 =>'未使用',2 =>'已使用',3 =>'已过期'];
        return $texts[$this->status];
    }
    
    
     /**
     * 格式化创建时间
     * @param string $value
     * @return string
     */
    public function getCreateAtAttr(string $value): string
    {
        return format_datetime($value);
    }
   
   
    
    public function getCouponNameAttr()
    {
        
         return $this->coupon['name'];
    }
    
    
    public function getCouponAmountAttr()
    {
         return $this->coupon['amount'];
    }
    
    
    public function getUserNameAttr()
    {
         return $this->user['nickname'];
    }
    
     
}