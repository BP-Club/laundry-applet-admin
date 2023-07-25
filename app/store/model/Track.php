<?php

namespace app\store\model;

use think\admin\Model;
use think\admin\model\SystemUser;
use app\store\model\Store;
use app\store\model\Order;
class Track extends Model
{
    protected $table = 'store_order_track';
    protected $append = ['status_text','adminer','return_typetext','store_address'];
    /**
     * 格式化创建时间
     * @param string $value
     * @return string
     */
    public function getCreateAtAttr(string $value): string
    {
        return format_datetime($value);
    }
    
    
  
    public function getDatasAttr( $value)
    {
        if($this->process_status == 2 && !empty($value)){
           return explode('|',$value);
        }
        
        if($this->process_status == 4){
           return json_decode($value,true);
        }
        
        if(empty($this->datas)){
            return [];
        }
    }
    
    
     public function getStatusTextAttr()
    {
        $texts = [0 =>'待支付',1 =>'待取货',2 =>'入库中',3 =>'清洗中',4 =>'送货中',5 =>'已完成',6 =>'退款'];
        $order  = Order::where(['id'=>$this->order_id])->field('refund_status,take_status')->find();
        if($order['refund_status'] == 2 && $this->process_status == 4 && $order['take_status'] == 1){
            $texts[$this->process_status] = '送货中(退货)';
        }
        return $texts[$this->process_status];
    }
    
    
    public function getAdminerAttr()
    {
        return SystemUser::where(['id'=>$this->admin_id])->value('username');
    }
    
    public function getReturnTypetextAttr()
    {
        $texts = [1 =>'自提',2 =>'配送'];
        if(is_array($this->datas) && array_key_exists('return_type',$this->datas)){
           return $texts[$this->datas['return_type']];
        }else if($this->take_status == 0){
           return '未收客户衣物';
        }else{
           return '已收客户衣物'; 
        }

    }
    
    
    public function getStoreAddressAttr()
    {
        $address = Store::where(['id'=>$this->store_id])->value('address');
        return $address;

    }
     
     
  
}