<?php

namespace app\market\model;

use think\admin\Model;
use app\data\model\DataUser;
/**
 * 优惠卷用户模型
 * Class MarketCoupon
 * @package app\market\model
 */
class MarketDirectUser extends Model
{
    
 
    
     /**
     * 格式化创建时间
     * @param string $value
     * @return string
     */
    public function getCreateAtAttr(string $value): string
    {
        return format_datetime($value);
    }
   
   
 
     
}