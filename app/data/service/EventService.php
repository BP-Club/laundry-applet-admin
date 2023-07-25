<?php

namespace app\data\service;


use think\admin\Service;
use app\custom\Custom;
use app\custom\model\CustomEvent;
use think\Container;
/**
 * 事件触发服务
 * Class EventService
 * @package app\data\service
 */
class EventService extends Service
{
    
    const EVENT_CLASS_MAPS = [
        'ShareNewUser' => \app\market\model\MarketCoupon::class
        
    ];
    
    const EVENT_TABLEFIELD_MAPS = [
        'ShareNewUser' => 'gain_requirement'
        
    ];
 
   
    public static $eventBindObj;

    
    public static function run($eventName,$data){
       
        $class = self::EVENT_CLASS_MAPS[$eventName];
        $event = CustomEvent::where(['event'=>$eventName])->findOrEmpty();
        if(!$event->isEmpty()){
            $conditions = json_decode($event['express'],true);
            foreach($conditions as &$condition){
                $field = $condition[0];
                $condition[0] = $data[$field];
            }
            //判断绑定此条件的表是否存在
            $class = Container::getInstance()->invokeClass($class);
            self::$eventBindObj =  $class->where([self::EVENT_TABLEFIELD_MAPS[$eventName] =>$event['id']])
                                        ->findOrEmpty();
            if(self::$eventBindObj->isEmpty()){
               return false;
            }
            
            $flag = Custom::initExpress($conditions);
            return $flag;
        }
      
       
    }

}