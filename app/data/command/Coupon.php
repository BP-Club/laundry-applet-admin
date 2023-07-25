<?php
namespace app\data\command;

use think\admin\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use app\data\model\DataUser; 
use app\market\model\MarketCouponUsers;
use think\facade\Cache;
/**
 * 服务发放优惠卷
 * Class Pulish
 * @package app\data\command
 */
class Coupon extends Command
{
    protected function configure()
    {
        $this->setName('xdata:Coupon');
        $this->addArgument('taskid', Argument::OPTIONAL, "taskid");
        $this->setDescription('给所属等级用户发放优惠卷');
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
        $taskid = $input->getArgument('taskid');
        if(!$taskid){
            $this->setQueueError("没有数据可操作！");  
        }
        $data = Cache::store('redis')->get($taskid);
        if(!$data){
            $this->setQueueError("没有数据可操作！");  
        }
        $upgrade_ids = $data['upgrade_ids'];
        $coupon_id = $data['coupon_id'];
        $upgrade_ids = explode(',',$upgrade_ids);
        $this->setQueueProgress("正在获取需要发送的用户", '0');
        $userids = DataUser::mk()->whereIn('vip_code',$upgrade_ids)->column('id');
        [$total,$count] = [count($userids),0];
        if(empty($userids)){
             $this->setQueueError("没有用户数据可操作！");
        }else{
             foreach ($userids as $userid) {
                $this->setQueueMessage($total, ++$count, "正在给id:{$userid}的用户发放");
                $result = MarketCouponUsers::where(['coupon_id'=>$coupon_id,'user_id'=>$userid])->findOrEmpty();
                if($result->isEmpty()){
                   $result['user_id'] =  $userid;
                   $result['coupon_id'] =  $coupon_id;
                   $result->save();
                   $this->setQueueMessage($total, $count, "完成给id:{$userid}的用户发放", 1);
                }else{
                   $this->setQueueMessage($total, $count, "id:{$userid}的用户已发放过了", 1);
                }
             }
              $this->setQueueSuccess("已完成所有发放操作");
        }
         
    }
    
    
}