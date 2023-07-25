<?php

namespace app\store\model;
use think\admin\Model;
use app\store\model\Store;
use think\admin\model\SystemUser;


class Refund extends Model
{
    protected $table = 'store_order_refund';
    protected $append = ['adminer','status_text'];
    
    
     
    
    
    public function getAdminerAttr()
    {
        return SystemUser::where(['id'=>$this->admin_id])->value('username');
    }
    
    
    public function getDatasAttr( $value)
    {
        if(!empty($value)){
           return explode('|',$value);
        }else{
          return [];
        }
    }
    
    
    
     
     public function getStatusTextAttr()
    {
        $texts = ['申请','同意','不同意'];
        return $texts[$this->status];
    }
    
    
    
}