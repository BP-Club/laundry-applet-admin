<?php
declare (strict_types=1);

namespace app\custom;

use app\custom\Tools;
use app\custom\template\Judge;
abstract class Custom
{
      public  static function callFunc(){
           $args = func_get_args();
           $method = $args[0];
           return call_user_func_array([static::class,$method], $args[1]);
      }
      
      public  static function initExpress($conditions){
           $flag = true;
           foreach($conditions as $condition){
               if(is_array($condition)){
                   $data = Tools::getExpressAndArgs($condition,Judge::DICTIONARY);
                   [$method , $args] = $data;
                   if($method){
                       $flag = Judge::callFunc($method,$args);
                       if(!$flag){
                           break;
                       }
                   }
               }
           }
           return $flag;
      }
}