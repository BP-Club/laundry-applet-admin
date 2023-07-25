<?php

namespace app\store\model;
use app\data\model\DataUserAddress;
use think\admin\Model;
use app\data\model\DataUser;
use app\store\model\Store;
use app\store\model\Refund as RefundModel;
use app\store\model\Track;

class Order extends Model
{
    protected $table = 'store_order';
    protected $append = ['status_text','amount_reduct','take_type_text','return_type_text','goods','order_status','refund_request','refund_btn','process_intro'];
    
    
    
    public function user()
    {
    	return $this->belongsTo(DataUser::class,'uuid','id');
    }
    
    
    public function getTakeAddressAttr($value)
    {
        $value = json_decode($value,true);
    	if($value){
    	    return $value;
    	}
    	return false;
    }
    
     public function getSendAddressAttr($value)
    {
         $value = json_decode($value,true);
    	if($value){
    	    return $value;
    	}
    	return false;
    }
    
     /**
     * 格式化使用状态
     * @param mixed $value
     * @return mixed
     */
    public function getStatusTextAttr()
    {
        $texts = [0 =>'待支付',1 =>'待取货',2 =>'入库中',3 =>'清洗中',4 =>'送货中',5 =>'已完成',6 =>'已退款',7=>'已取消'];
    
        return $texts[$this->status];
    }
    
    
  
  

   
    
 
    
    
    
    public function getTakeTypeTextAttr()
    {
        $texts = [1 =>'自带',2 =>'上门'];
        return $texts[$this->take_type];
    }
    
    
    
    
     
    public function getReturnTypeTextAttr()
    {
        $texts = [1 =>'自提',2 =>'配送'];
        return $texts[$this->take_type];
    }
    
    
      /**
     * 格式化商品数据
     * @param string $value
     * @return string
     */
    public function getGoodsDataAttr($value)
    {
        return json_decode($value,true);
    }
    
    
        /**
     * 商品差价
     * @param string $value
     * @return string
     */
    public function getAmountReductAttr()
    {
        return $this->regular_price -  $this->discount_price;
    }
    
    
    public function getStoreNameAttr()
    {
        $name = Store::where(["id"=>$this->store_id])->value('name');
        return $name;
    }
    
    
     public function getPaymentAtAttr($value)
    {
        if(empty($value)){
             return '';
        }
        return $value;
    }
    
    
    
     public function getOrderStatusAttr()
    {
        if(in_array($this->status,[1,2,4]) && $this->refund_status > 0){
            return 6;
        }
        return  $this->status;
    }
    
     public function getRefundRequestAttr()
    {
        $count = RefundModel::where(['order_id'=>$this->id])->count();
        $flag = $count > 0 ? true:false;
        return  $flag;
    }
    
    
    public function getRefundBtnAttr()
    {

        if(in_array($this->status,[1,2,4])){
            return true;
        }
        return false;
    }
    
     public function getProcessIntroAttr()
    {
        return Track::where(['order_id'=>$this->id, 'process_status'=>$this->status])->value('remark');
    }
    
    
    
}