<?php

namespace app\pet\controller;

use think\facade\Db;
use think\facade\Cache;
use app\project\model\Order as OrderModel;
use app\data\model\DataUserAddress;
use think\admin\service\QueueService;
use app\wechat\service\SubscribeService;
use app\data\model\DataUser; 
use app\project\model\Project as ProjectModel;
use app\custom\Custom;
use think\admin\Controller;
use app\market\service\CouponService;
use app\market\service\DirectService;

class Test extends Controller
{
  
    public function test()
    {
        
        //$redis = Cache::store('redis')->handler();
        //$redis->geoadd("servicerCoordinates", 113.200915,23.391991, 2);
        //$geodatas = $redis->georadius("servicerCoordinates", 113.214106,23.403805,  1000, 'km', ['WITHDIST','ASC']);
        

        // $data = ['id'=>49,'teams_users_direct'=>1]; 
        // $this->app->event->trigger('ShareNewUser', $data);
      
        //var_dump(Custom::initExpress($conditions));
    }
    
   
    
}