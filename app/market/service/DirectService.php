<?php

namespace app\market\service;


use think\admin\Service;
use app\data\model\DataUser;
use app\data\service\UserAdminService;
use think\facade\Cache;
use app\market\model\MarketDirectUser;
/**
 * 直服服务
 * Class DirectService
 * @package app\market\service
 */
class DirectService extends Service
{
    public static function insertRecord($uuid,$direct_name,$direct_uid){
        MarketDirectUser::insert(['uuid'=>$uuid,
                                  'direct_name'=>$direct_name,
                                  'direct_uid'=>$direct_uid]);
    }
    
    
    
}