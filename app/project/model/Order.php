<?php

namespace app\project\model;

use think\admin\Model;

/**
 * 服务项目
 * Class MarketCoupon
 * @package app\market\model
 */
class Order extends Model
{
    protected $table = 'store_order';
    protected $append = ['do_status_text','status_text','refund_status_text'];
     /**
     * 格式化使用状态
     * @param mixed $value
     * @return mixed
     */
    public function getStatusTextAttr()
    {
        $texts = [0 =>'待支付',1 =>'进行中',2 =>'已完成',3 =>'已取消/退款'];
        return $texts[$this->status];
    }
    
    
    
     /**
     * 格式化计费模式
     * @param mixed $value
     * @return mixed
     */
    public function getRefundStatusTextAttr()
    {
        $texts = [0 =>'没有退款',1 =>'申请退款中',2=>'退款成功'];
        return $texts[$this->refund_status];
    }
    
    
    
    
   /**
     * 格式进行状态
     * @param mixed $value
     * @return mixed
     */
    public function getDoStatusTextAttr()
    {
        $texts = [0 =>'没有状态',1 =>'等待分配',2=>'预约中',3=>'空闲中',4=>'进行中'];
        return $texts[$this->do_status];
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