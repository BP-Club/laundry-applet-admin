<?php   
namespace app\custom;

class Tools {
    public static function getExpressAndArgs($arr,$dict)
    {

        $method;
        $express = '';
        foreach($arr as $key => $value){
            if(array_key_exists($value,$dict)){
                 $method = $dict[$value];
                 unset($arr[$key]);
                 break;
            }
        }
        return [$method,$arr];
        
    }
}