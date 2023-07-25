<?php

namespace app\project\model;

use think\admin\Model;

/**
 * 服务项目
 * Class MarketCoupon
 * @package app\market\model
 */
class Project extends Model
{
    protected $append = ['status_text','charge_mode_text','distance_charge_text','slider_data'];
    
    
    
    
    
    
       /**
     * 格式化价格
     * @param mixed $value
     * @return mixed
     */
    public function getPriceBaseAttr($value)
    {
        return floatval($value);
    }
    
    
    
    
     
       /**
     * 格式化价格
     * @param mixed $value
     * @return mixed
     */
    public function getMaxnumAddPriceAttr($value)
    {
        return floatval($value);
    }
    
    
      /**
     * 格式化计费模式
     * @param mixed $value
     * @return mixed
     */
    public function getSliderDataAttr()
    {
       
        return explode('|',$this->slider);
    }
    
     /**
     * 格式化使用状态
     * @param mixed $value
     * @return mixed
     */
    public function getStatusTextAttr()
    {
        $texts = [1 =>'使用',0 =>'禁用'];
        return $texts[$this->status];
    }
    
    
    
     /**
     * 格式化计费模式
     * @param mixed $value
     * @return mixed
     */
    public function getChargeModeTextAttr()
    {
        $texts = [1 =>'单只宠物叠加',2 =>'固定宠物数量叠加',3=>'无宠物数量要求'];
        return $texts[$this->charge_mode];
    }
    
  
  
    /**
     * 格式化超服务距离计费模式
     * @param mixed $value
     * @return mixed
     */
    public function getDistanceChargeTextAttr()
    {
        $texts = [0 =>'关闭',1 =>'开启'];
        return $texts[$this->distance_charge];
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
    
     
     
     
    
}