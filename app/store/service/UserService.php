<?php

namespace app\store\service;

use think\facade\Cache;
use think\admin\Service;
use app\data\model\DataUserAddress;

class UserService extends Service
{
    public static function getAddress($addressId){
         $addrFields = 'name,phone,address,number,sex';
         $address = DataUserAddress::where(['id'=>$addressId])
                        ->field($addrFields)->append(['sex_text'])
                        ->findOrEmpty();
         if($address->isEmpty()){
             return [];
         }                
         return $address;
        
    }
    
}