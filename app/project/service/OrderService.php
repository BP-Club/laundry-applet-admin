<?php

namespace app\project\service;


use think\admin\Service;

/**
 * 项目订单服务
 * Class OrderService
 * @package app\data\service
 */
class OrderService extends Service
{
    static function getServiceRemarkJsonText($arrKey,$jsons,&$strs){
        if(array_key_exists($arrKey,$jsons)){
            foreach($jsons[$arrKey] as $key => $item){
                if($item['checked'] == true){
                    $name = $item['text'];
                    $strs  = $name;
                    break;
                }
            }
            
        }
    }

}