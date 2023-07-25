<?php

namespace app\store\model;
use think\admin\Model;
use app\store\model\Store;
use think\admin\model\SystemUser;


class Commission extends Model
{
    protected $table = 'store_commission';
    protected $append = ['store_name','status_text'];
    
    
     
    public function  getStoreNameAttr()
    {
       $name = Store::where(['id'=>$this->store_id])->value('name');
       return $name;
    }
    
  
    
     /**
     * 格式化是否结算
     * @param mixed $value
     * @return mixed
     */
    public function getStatusTextAttr()
    {
        $texts = [0 =>'否',1 =>'是'];
        return $texts[$this->status];
    }
    
    
  
  

    /**
     * 格式化创建时间
     * @param string $value
     * @return string
     */
    public function getCreateAtAttr($value)
    {
        return format_datetime($value);
    }
    
    
 
    
    /**
     * 格式化结算时间
     * @param string $value
     * @return string
     */
    public function getSettleAtAttr($value)
    {
        if($value){
           return format_datetime($value);
        }else{
           return "未产生";
        }
    }
    
    
   
    
    
    
}