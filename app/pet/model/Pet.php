<?php

namespace app\pet\model;

use think\admin\Model;

/**
 * 服务项目
 * Class MarketCoupon
 * @package app\market\model
 */
class Pet extends Model
{
    protected $append = ['sex_text','shape_text','pettype_text','vaccin_text','avatar'];
     /**
     * 格式化性别
     * @param mixed $value
     * @return mixed
     */
    public function getSexTextAttr()
    {
        $texts = [1 =>'男',2 =>'女'];
        return $texts[$this->sex];
    }
    
    
    
     /**
     * 格式化体型
     * @param mixed $value
     * @return mixed
     */
    public function getShapeTextAttr()
    {
        $texts = [1 =>'小型',2 =>'中型',3=>'大型'];
        return $texts[$this->shape];
    }
    
  
  
  

     /**
     * 格式化种类
     * @param mixed $value
     * @return mixed
     */
    public function getPettypeTextAttr()
    {
        $texts = [1 =>'猫',2 =>'狗'];
        return $texts[$this->pettype];
    }
    
    
  
    
    
      /**
     * 格式化是否打疫苗
     * @param mixed $value
     * @return mixed
     */
    public function getVaccinTextAttr()
    {
        $texts = [0 =>'未打',1 =>'已打'];
        return $texts[$this->is_vaccin];
    }
    
    
      /**
     * 格式化图片
     * @param mixed $value
     * @return mixed
     */
    public function getImagesAttr($value)
    {
        $images = [];
        $arr = explode('|',$value);
        foreach ($arr as $item){
            $images[] = ['url' => $item];
        }
        return $images;
    }
    
    /* 头像
     * @param mixed $value
     * @return mixed
     */
    public function getAvatarAttr($value,$data)
    {
        $images = explode('|',$data['images']);
        return $images[0];
    }
    
    
     
}