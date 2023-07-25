<?php
namespace app\store\command;

use think\admin\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use think\facade\Db;
use think\facade\Cache;
use app\store\model\Store as StoreModel;
use app\store\service\Commission as CommissionService;
use app\data\command\Coupon;
/**
 * 利润结算
 * Class Settle
 * @package app\store\command
 */
class Settle extends Command
{
    protected function configure()
    {
        $this->setName('xdata:Settle');
        $this->setDescription('给合作店结算');
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
        $storeIds = StoreModel::column('id');
        foreach ($storeIds as $storeId){
            CommissionService::settle($storeId);
        }        
    }
}