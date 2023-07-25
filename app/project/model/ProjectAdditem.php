<?php

namespace app\project\model;

use think\admin\Model;

/**
 * 服务项目
 * Class MarketCoupon
 * @package app\market\model
 */
class ProjectAdditem extends Model
{
   
     
      /**
     * 格式化价格
     * @param mixed $value
     * @return mixed
     */
    public function getPriceAttr($value)
    {
        return floatval($value);
    }
     
}