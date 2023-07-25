<?php

namespace app\data\model;

use think\admin\Model;

/**
 * 用户地址模型
 * Class DataUserAddress
 * @package app\data\model
 */
class DataUserAddress extends Model
{

   //protected $append = ['sex_text'];
   /**
     * 格式化创建时间
     * @param string $value
     * @return string
     */
    public function getSexTextAttr()
    {
        $texts = [1 =>'先生',2 =>'女士'];
        return $texts[$this->sex];
    }
}