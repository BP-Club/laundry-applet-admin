<?php
namespace app\data\command;

use think\admin\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\facade\Db;
use think\facade\Cache;
use app\project\model\Order as OrderModel;
use app\data\model\DataUserAddress;
use think\admin\service\QueueService;
use app\wechat\service\SubscribeService;
use app\data\model\DataUser; 
use app\project\model\Project as ProjectModel;

/**
 * 服务订单推送
 * Class Pulish
 * @package app\data\command
 */
class Pulish extends Command
{
    protected function configure()
    {
        $this->setName('xdata:Pulish');
        $this->setDescription('开始发布新服务订单给附近的服务人员');
    }


    /**
     * @param Input $input
     * @param Output $output
     * @throws \WeChat\Exceptions\InvalidResponseException
     * @throws \WeChat\Exceptions\LocalCacheException
     * @throws \think\admin\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function execute(Input $input, Output $output)
    {
        //$this->setQueueSuccess($this->doExecute());
        $this->doExecute();
    }
    
    
    
  
     /**
     * 任务执行处理
     * @param string $next
     * @param integer $done
     * @return string
     * @throws \WeChat\Exceptions\InvalidResponseException
     * @throws \WeChat\Exceptions\LocalCacheException
     * @throws \think\admin\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function doExecute(string $next = '', int $done = 0)
    {
        $redis = Cache::store('redis')->handler();
        $orderId = $redis->rPop('orderIdQueque');
        $defaultDistance = 10;//附近服务公里
        if($orderId){
            $order = OrderModel::where(['id'=>$orderId])->field('project_id,address_id,reserve_date,discount_price')->find();
            if($order){
                $this->output->comment('订单:'.$order['order_no'].'开始匹配附近服务员');
                $address = DataUserAddress::where(['id'=>$order['address_id']])->field('lat,lng,address')->find();
                $projectTitle = ProjectModel::where(['id'=>$order['project_id']])->value('name');
                $geodatas = $redis->georadius("servicerCoordinates", $address['lng'], $address['lat'], $defaultDistance, 'km', ['WITHDIST','ASC']);
                if(!$geodatas){
                    $this->output->comment('此订单不在服务范围！');
                    return;
                }
                foreach ($geodatas as $key => $geodata){
                    $servicerId = $geodata[0];
                    $distance = $geodata[1]; //单位km
                    if($key == 0){
                        $this->output->comment("获取服务员编号{$servicerId}成功！");
                        //推送消息给服务人员
                        SubscribeService::pushMessageNewOrder($order['order_no'],$servicerId,$projectTitle,$address['address'],
                                                              $order['reserve_date'],$order['discount_price'],$distance,'developer');
                        $this->output->comment("给服务员编号{$servicerId}推送最新订单消息");
                        
                    }else{
                        $data = ['order_no'=>$order['order_no'],
                                 'uid'=>$servicerId,
                                 'title'=>$projectTitle,
                                 'address'=>$address['address'],
                                 'reserve_date'=>$order['reserve_date'],
                                 'discount_price'=>$order['discount_price'],
                                 'distance'=>$distance
                                 ];
                        $redis->lPush("order-{$orderId}-Queque",json_encode($data));
                    }
                    
                }
            }
        }else{
             $this->output->comment("没有可推送订单");
        }
                
    }
}