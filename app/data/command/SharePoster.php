<?php
namespace app\data\command;

use think\admin\Command;
use think\console\Input;
use think\console\input\Argument;
use think\console\Output;
use app\market\service\PosterService;
use think\facade\Cache;
/**
 * 生成分享海报
 * Class Pulish
 * @package app\data\command
 */
class SharePoster extends Command
{
    protected function configure()
    {
        $this->setName('xdata:createSharePoster');
        $this->setDescription('生成分享海报');
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
        PosterService::create();
    }
    
    
}