<?php

namespace app\store\model;

use think\admin\Model;


class Store extends Model
{
    protected $table = 'store_baseinfo';
    protected $append = ['status_text'];
     /**
     * 格式化使用状态
     * @param mixed $value
     * @return mixed
     */
    public function getStatusTextAttr()
    {
        $texts = [0 =>'关闭',1 =>'开放'];
        return $texts[$this->status];
    }
    
    
  
  

    
}