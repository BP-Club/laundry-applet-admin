<?php

namespace app\market\model;

use think\admin\Model;

/**
 * 优惠卷模型
 * Class MarketCoupon
 * @package app\market\model
 */
class MarketCoupon extends Model
{
    
    
   // protected $append = ['status_text','use_scene_text','grant_type_text','is_blend_text'];
    
    
    
    
    
      
       /**
     * 格式化价格
     * @param mixed $value
     * @return mixed
     */
    public function getMinConsumeAmountAttr($value)
    {
        return floatval($value);
    }
    
    
         /**
     * 格式化价格
     * @param mixed $value
     * @return mixed
     */
    public function getAmountAttr($value)
    {
        return floatval($value);
    }
    
    
    
    
    
    
     /**
     * 格式化期限状态
     * @param mixed $value
     * @return mixed
     */
    public function getStatusTextAttr()
    {
        $texts = [1 =>'未过期',0 =>'已过期'];
        return $texts[$this->status];
    }
    
    
    
     /**
     * 格式化使用场景
     * @param mixed $value
     * @return mixed
     */
    public function getUseSceneTextAttr()
    {
        $texts = [1 =>'全平台',2 =>'指定项目'];
        return $texts[$this->use_scene];
    }
    
  
    
    
    /**
     * 格式化指定项目
     * @param mixed $value
     * @return mixed
     */
    public function getProjectSetsAttr($value)
    {
        return empty($value) ? $value : json_decode($value, true);
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
    
    
    
    
      /**
     * 格式化发放方式
     * @param mixed $value
     * @return mixed
     */
    public function getGrantTypeTextAttr()
    {
        $texts = [1 =>'手动领取',2 =>'人工发放',3=>'系统发放'];
        return $texts[$this->grant_type];
    }
    
    
    
    
 
    
      /**
     * 格式化混合其他卷使用
     * @param mixed $value
     * @return mixed
     */
    public function getIsBlendTextAttr()
    {
        $texts = ['不能混合使用','可以混合使用'];
        return $texts[$this->is_blend];
    }
    
    
    
    
       /**
     * 格式化获得优惠卷条件
     * @param mixed $value
     * @return mixed
     */
    public function getGainConditionsAttr($value)
    {
        return empty($value) ? $value : json_decode($value, true);
    }
    
    
      /**
     * 格式化使用后触发的钩子
     * @param mixed $value
     * @return mixed
     */
    public function getAfterHooksAttr($value)
    {
        return empty($value) ? $value : json_decode($value, true);
    }
    
     
}