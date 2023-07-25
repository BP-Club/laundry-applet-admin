<?php

namespace app\project\controller\api\auth;

use app\data\controller\api\Auth;
use app\project\model\Order as OrderModel;
use app\project\model\Project;
use app\pet\model\Pet;
use app\data\model\DataUserAddress;
use app\project\model\BrowseHistory;
use think\admin\extend\CodeExtend;
use app\data\model\BaseUserPayment;

use app\data\service\PaymentService;
use app\data\service\UserAdminService;
use think\exception\HttpResponseException;

use app\project\service\OrderService;
/**
 * 用户订单
 * Class Order
 * @package app\project\controller\api\auth
 */
class Order extends Auth
{
    /**
     * 下单发起支付
     */
    public function createOrder()
    {
         $data = $this->_vali([
                'user_id.default'   =>$this->uuid,
                'project_id.integer'   => 'projectid必须为整数！',
                'reserve_date.date'   => 'reserve_date必须为日期格式！',
                'pro_additem_jsons.require'   => 'pro_additem_jsons不能为空！',
                'origin_price.number'   => 'origin_price必须为金额！',
                'discount_price.number'   => 'discount_price必须为金额！',
                'service_remark_jsons.default'   => '',
                'pet_ids.require' =>  'pet_ids不能为空！',
                'address_id.number' =>  'address_id必须为整数！',
         ]);
         $data['order_no'] = CodeExtend::uniqidDate(18, 'S');
         $order = OrderModel::create($data);
         BrowseHistory::addHistory($this->uuid,0,$order->id,'project_order');
         $this->success('下单成功',['code'=>$data['order_no']]);
    }
    
    
    /*
    *获取支付参数
    */
    public function getPaymentParam(){
        // 读取支付通道配置
        $code = 'M7726511418908751680';
        $data = $this->_vali([
                'user_id.default'   =>$this->uuid,
                'code.require'   => 'code不能为空！',
        ]);
        
         // 自动处理用户字段
        $openid = '';
        if (in_array($this->type, [UserAdminService::API_TYPE_WXAPP, UserAdminService::API_TYPE_WECHAT])) {
            $openid = $this->user[UserAdminService::TYPES[$this->type]['auth']] ?? '';
            if (empty($openid)) $this->error("发起支付失败");
        }
        
        try {
            // 返回订单数据及支付发起参数
            $order = OrderModel::where(['order_no'=>$data['code'],'user_id'=>$this->uuid])->find();
            //$order['discount_price']
            $param = PaymentService::instance($code)->create($openid, $order['order_no'], 0.01, '宠蜗订单支付', '', '', '');
            $this->success('获取支付参数',  $param);
        } catch (HttpResponseException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            $this->error($exception->getMessage());
        }
    }
    
    
     /*
    *获取订单列表
    */
    public function list(){
        
        $data = $this->_vali([
                'user_id.default'   =>$this->uuid,
                'user_type.default'   =>1,
                'status.number'   => 'status只能为整数！',
                'status.require'   => 'status不能为空！',
                
        ]);
        $query = OrderModel::where(['status'=>$data['status']]);
        if($data['user_type'] == 2){
           $query = $query->where(['service_uid'=>$this->uuid]); 
        }else{
           $query = $query->where(['user_id'=>$this->uuid]);  
        }
        $orders = $query->field('id,order_no,create_at,reserve_date,
                                              discount_price,status,project_id,
                                              refund_status,do_status')
                                    ->select()
                                    ->toArray();
        //var_dump($orders);die;                       
        foreach($orders as &$order){
           $project = Project::where(['id'=>$order['project_id']])
                           ->field('name,cover')
                           ->find();
           $order['title'] = $project['name'];
           $order['cover'] = $project['cover'];
           
           $order['order_no'] = "订单号:".$order['order_no'];
           $order['create_at'] = "下单时间:".$order['create_at'];
           $order['reserve_date'] = "服务日期:".$order['reserve_date'];
           $order['discount_price'] = "总价:¥".$order['discount_price'];
           
           //修改浏览记录为已读
           $history = BrowseHistory::where(['userid'=>$this->uuid,
                                            'status'=>$data['status'],
                                            'order_id'=>$order['id'],
                                            'model'=>'project_order'
                                           ])->find();
                                     
           if ($history && $history['is_read'] == 0){
               $history['is_read'] = 1;
               $history->save();
           }
        }      
        $this->success('获取成功',  $orders);
    }
    
    
    
    
    
    /**
     * 获取订单详情
     */
    public function detail()
    {
        
        $data = $this->_vali([
                'user_id.default'   =>$this->uuid,
                'order_no.require'   => 'order_no不能为空！',
        ]);
        $order = OrderModel::where(['order_no'=>$data['order_no']])->find()->toArray();
        $address = DataUserAddress::where(['id'=>$order['address_id']])
                                  ->field('name as contact_people,phone,address,number')
                                  ->find()->toArray();
        $order = array_merge($order,$address);        
        
        $order['pets'] =  Pet::whereIn('id',$order['pet_ids'])->column('name');   
        foreach ($order['pets'] as $key => &$pet){
            if($key < count($order['pets']) - 1 ){
                $pet .= ','; 
            }
        }
        
        $order['project_name'] = Project::where(['id'=>$order['project_id']])->value('name');
        $order['project_name'] = $order['project_name'].'(默认)';
        
        $order['is_my'] = 0;
        $order['is_part'] = 1;//暂时
        if($order['user_id'] == $this->uuid){
            $order['is_my'] = 1;
        }else{
            $order['is_part'] = 0;
            if($order['service_uid'] == 0 && strtotime() < strtotime($order['reserve_date']) && $order['refund_status'] == 0){
                 $order['is_part'] = 1;
            }
        }
        
        $order['pet_ids'] = explode(',',$order['pet_ids']);
        $order['service_remark_jsons'] = json_decode($order['service_remark_jsons'],true);
        
        $order['keyJoinTexts'] = '';
        OrderService::getServiceRemarkJsonText('keyJoinDatas',$order['service_remark_jsons'],$order['keyJoinTexts']);
       
        $order['keyReturnTexts'] = '';
        OrderService::getServiceRemarkJsonText('keyReturnDatas',$order['service_remark_jsons'],$order['keyReturnTexts']); 
         
        
        $order['serviceTimeTexts'] = '';
        OrderService::getServiceRemarkJsonText('serviceTimeDatas',$order['service_remark_jsons'],$order['serviceTimeTexts']); 
        
        
        $this->success('获取成功',  $order);
    }
  
  
   /*
    *退款
    */
    public function refund(){
        $data = $this->_vali([
                'user_id.default'   =>$this->uuid,
                'order_no.require'   => 'order_no不能为空！',
        ]);
        $order = OrderModel::where($data)->find();
        if($order['refund_status'] > 0){
            $this->error('不能重复申请');
        }else{
            $order['refund_status'] = 1;
            $order->save();
            $this->success('申请成功,请等待到账!',  $order);
        }
        
    }
  
    
    

}