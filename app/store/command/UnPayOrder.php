<?php
namespace app\store\command;

use think\admin\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\facade\Db;
use think\facade\Cache;
use app\store\model\Order as OrderModel;
/**
 * 清理过期没支付的订单
 * Class Settle
 * @package app\store\command
 */
class UnPayOrder extends Command
{
    protected function configure()
    {
        $this->setName('xdata:unPayOrder');
        $this->setDescription('清理过期没支付的订单');
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
        //$this->output->comment('开始！');
        $orders = OrderModel::where(['pay_status'=>0])->whereDay('create_at')->select()->toArray();
        //如果未支付的订单超过2小时，状态改为取消
        foreach ($orders as $order){
            if((time() - strtotime($order['create_at']))  > 7200 ){
                OrderModel::where(['id'=>$order['id']])->update(['pay_status'=>2,'status'=>7]);
            }
        }
       
    }
}