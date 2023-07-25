<?php

namespace app\store\controller;


use think\admin\Controller;
use think\admin\helper\QueryHelper;
use app\store\model\Order as OrderModel;
use app\store\model\Store;
use think\admin\model\SystemUser;
use app\data\model\DataUser;
use app\data\model\BaseUserPayment;
use app\store\model\Track as TrackModel;
use app\store\model\Store as StoreModel;
use app\store\model\Refund as RefundModel;
use app\store\service\UserService;
/**
 * 订单管理
 * Class Coupon
 * @package app\data\controller\news
 */
class Order extends Controller
{
    /**
     * 订单管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        
   
        $admin = $this->app->session->get('user');
        if($admin['is_bind'] == 1){
           $this->store_id = StoreModel::whereFindInSet('sys_users',$admin['id'])->value('id');
        }
        $this->title = '订单数据管理';
        // 状态数据统计
        $this->total = ['t0' => 0, 't1' => 0, 't2' => 0, 't3' => 0, 't4' => 0, 't5' => 0, 't6' => 0,'ta' => 0];
        $OrderQuery = OrderModel::mk();
        $query = OrderModel::mQuery();
        if(isset($this->store_id)){
            $OrderQuery = $OrderQuery->where(['store_id'=>$this->store_id]);
            $query = OrderModel::mQuery()->where(['store_id'=>$this->store_id]);
        }
        foreach ($OrderQuery->field('status,count(1) total')->group('status')->cursor() as $vo) {
            [$this->total["t{$vo['status']}"] = $vo['total'], $this->total["ta"] += $vo['total']];
        }
        $this->payments = BaseUserPayment::field('id,name')->where(['status'=>1])->select()->toArray();
        $this->stores =  Store::where(['status'=>1])->field('id,name,status')->select()->toArray();
        
        
        
        $query->like('order_no,truck_send_number');
        $query->equal('pay_type,pay_status,store_id,take_type,return_type,refund_status')->dateBetween('create_at,payment_at');
        
            // 列表选项卡
        if (is_numeric($this->status = trim(input('status', 'ta'), 't'))) {
            if($this->status == 6){
                 $query = $query->whereIn('status',[1,2,4,6])->where('refund_status','>',0);
            }else{
                 $query = $query->where(['status' => $this->status]);
            }
            
        }
        
        if(input('user_keys')){
            $uuid = DataUser::where('nickname', 'like', '%'.input('user_keys').'%')
                            ->whereOr('phone', 'like', '%'.input('user_keys').'%')
                            ->value('id');
            $query = $query->where('uuid', '=', $uuid);
        }
        
        $result = $query->with(['user'])->order('id desc')->page(); 
      
        
    }
    
    
    
     /**
     * 入库
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function inStock()
    {
        $this->title = '入库操作';
        if($this->request->isPost()){
            $user = $this->app->session->get('user');
            $data = input();
            $data['admin_id'] = $user['id'];
            unset($data['spm']);
            $flag = TrackModel::create($data);
            if($flag){
               $this->app->event->trigger('StoreOrderInStock', $data['order_id']);
               $this->success('操作成功'); 
            }
        }else{
            $this->order_id = input('order_id');
        }
        TrackModel::mForm('in_stock');
    }
    
    
    /**
     * 退回
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
     public function back(){
        $this->title = '退回操作';
        if($this->request->isPost()){
            $user = $this->app->session->get('user');
            $data = input();
            $data['admin_id'] = $user['id'];
            unset($data['spm']);
            $data['datas'] = [
                "return_type"=>$data['return_type']
            ];
            $data['datas']['address'] = $data['address'];
            $data['datas']['contacts'] = $data['contacts'];
            $data['datas']['phone'] = $data['phone'];
            $data['datas'] = json_encode($data['datas']);
            $flag = TrackModel::create($data);
            $orderData = OrderModel::where(['id'=> input('order_id')])->find()->toArray();
            $orderData['id'] = $data['order_id'];
            if($orderData["refund_status"] == 0){
                $orderData["refund_status"] = 2;
                
            }
            $orderData['take_status'] = 1; 
            if($flag){
               $this->app->event->trigger('StoreOrderBack',$orderData);
               $this->success('操作成功'); 
            }
            
        }else{
            $this->order_id = input('order_id');
            $this->order = OrderModel::where(['id'=>$this->order_id])->find()
            ->toArray();
            $this->storeAddr = StoreModel::where(['id'=>$this->order['store_id']])->field('id,name,contacts,mobile,address,status')->find()
            ->toArray();
            
        }
        TrackModel::mForm('back');
            
     }
     
     
     /**
     * 清洗
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
     public function washing(){
        if($this->request->isPost()){
            $user = $this->app->session->get('user');
            $data = input();
            unset($data['spm']);
            $data['admin_id'] = $user['id'];
            $data['process_status'] = 3;
            $flag = TrackModel::create($data);
            if($flag){
               $this->app->event->trigger('StoreOrderWashing', $data['order_id']);
               $this->success('操作成功'); 
            }
            
        }
    
     }
    
    
    
      /**
     * 运输中
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
     public function transport(){
        $this->title = '运输中';
        if($this->request->isPost()){
            $user = $this->app->session->get('user');
            $data = input();
            unset($data['spm']);
            $data['admin_id'] = $user['id'];
            $flag = TrackModel::create($data);
            if($flag){
               $this->app->event->trigger('StoreOrderTransport', $data['order_id']);
               $this->success('操作成功'); 
            }
        }
        $this->order_id = input('order_id');
        TrackModel::mForm('transport');
     }
     
     
     
     
      /**
     * 操作记录
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
     public function track(){
         $this->title = '操作记录';
         $this->tracks = TrackModel::where(['order_id'=>input('order_id')])
                     ->order('id desc')->append(['status_text','adminer','return_typetext','store_address'])->select()->toArray();
         TrackModel::mForm('track');
     }
     
     
     
     
      /**
     * 操作记录
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
     public function refunds(){
         $this->title = '退款记录';
         if($this->request->isPost()){
                $data = input();
                $lastRefundId =  input('lastRefundId');
                $orderId =  input('orderId');
                unset($data['spm']);
                unset($data['lastRefundId']);
                unset($data['orderId']);
                $admin = $this->app->session->get('user');
                $data['check_at'] = date('Y-m-d h:i:s');
                $data['admin_id'] = $admin['id'];
                RefundModel::where(['id'=>$lastRefundId])->update($data);
                if($data['status'] == 2){
                    //打款给客户
                }
                $texts = [1 => '同意退款', 2 => '拒绝退款'];
                TrackModel::create(['order_id'=>$orderId,'remark'=>$texts[$data['status']],'process_status'=>6,'admin_id'=>$admin['id']]);
                $order = OrderModel::where(['id'=>$orderId])->find();
                $order['refund_status'] = $order['refund_status'] + $data['status'];
                if($order['status'] == 1){
                    $order['status'] = 6;
                }
                $order->save();
                $this->success('操作成功'); 
          }else{
              $this->refunds = RefundModel::where(['order_id'=>input('order_id')])
                     ->order('id desc')->append(['adminer','status_text'])->select()->toArray();
              $this->lastRefundId =  $this->refunds[0]['id'];
              $this->lastRefundStatus = $this->refunds[0]['status'];
              $this->orderId =  input('order_id');
              
          }
         RefundModel::mForm('refunds');
     }
     
     
     
     
     
      /**
     * 修改取件方式
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
     public function editTake(){
         $this->title = '洗前取件方式';
         $this->order_id =  input('order_id');
         $fields = ['take_type','take_address'];
         $this->texts = [1=>'自带',2=>'上门'];
         if(input('type') == 'return'){
            $this->title = '洗后归还方式';
            $fields = ['return_type','send_address'];
            $this->texts = [1=>'自提',2=>'配送'];
         }
         $order = OrderModel::where(['id'=> $this->order_id])->find();
         if($this->request->isPost()){
             $order[$fields[0]] = input('processType');
             if(input('processType') == 2){
                 //var_dump($order[$fields[1]]);die;
                 $data = $order[$fields[1]];
                 $data['address'] = input('address');
                 $data['name'] = input('contacts');
                 $data['phone'] = input('phone');
                 $order[$fields[1]] = json_encode($data);
             }
             $order->save();
             $this->success('操作成功'); 
             
         }else{
            $this->type =  input('type') ;
            $this->processType =  $order[$fields[0]];
            $this->orderAddr = $order[$fields[1]];
            $this->storeAddr = StoreModel::where(['id'=>$order['store_id']])->field('id,name,contacts,mobile,address,status')->find()->toArray();
         }
         OrderModel::mForm('edit_take');
     }
    
}