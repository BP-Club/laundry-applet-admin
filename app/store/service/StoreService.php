<?php

namespace app\store\service;

use think\facade\Cache;
use think\admin\Service;
use app\store\model\Store as StoreModel;

class StoreService extends Service
{
    private  $redis;
    
    protected function initialize()
    {
        $this->redis = Cache::store('redis')->handler();
    }
    
    
    //获取门店具体消息
    public function getInfo($storeId){
       return StoreModel::mk()->field('id,name,lat,lng,address,work_time,status')->find($storeId);
    }
    
    
    
    
    //获取最近的一家
    public function getLatelyOne($lat,$lng){
        $geodata = $this->redis->georadius("storesCoordinates", $lng, $lat, 10000, 'km', ['WITHDIST','ASC']);
        if(!$geodata){
            return false;
        }
        return $geodata;
    }
    
    
    
    //获取最近的一家
    public function getStoreById($storeId,$lat,$lng){
        $geodatas = $this->redis->georadius("storesCoordinates", $lng, $lat, 10000, 'km', ['WITHDIST','ASC']);
        if(!$geodatas){
            return false;
        }
        foreach ($geodatas as $geodata){
             if($storeId == $geodata[0]){
                 return $geodata;
             }
        };
    }
    
    
    
      /**
     * 转换距离
     */
    public function toKilometer($value)
    {
       $num = $this->getFloatLen($value);
       if($num >1){
            $value = sprintf("%.1f", $value);
       }
       if($value >= 1){
          $value = $value.'km';
       }else{
          $value = $value * 1000;
          $value = $value.'m';
       }
       return $value;
    }
    
    
    
    //判断几位小数    
    public  function getFloatLen($num)
    {
        $pos = strrpos($num, '.');
        $ext = substr($num, $pos+1);
        $len=strlen($ext);
        return $len;
    
    }
    
}