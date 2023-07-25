<?php

namespace app\store\service;

use think\admin\Service;
use think\facade\Cache;
use app\data\model\ShopGoodsCate;
use app\data\model\DataUserAddress;
use app\data\model\ShopGoods;
use app\data\model\ShopGoodsItem;

class BasketService extends Service
{
    
    
    private static $totalDataName = "@baskets_totals";
    
    
    public static function getBasketTotalData($uuid)
    {
        $result = Cache::store('redis')->get("{$uuid}".self::$totalDataName);
        if(empty($result)){
            return false;
        }
        return $result;
    }
    
    public static function setBasketTotalData($uuid,$basket_totals)
    {
        Cache::store('redis')->set("{$uuid}".self::$totalDataName,$basket_totals);
        
    }
    
    
    
    public static function getBasketName($uuid,$basket_id)
    {
        return "{$uuid}@{$basket_id}#baskets";
    }
    
    public static function getBasket($basket_name)
    {
        $result = Cache::store('redis')->get($basket_name);
        if(empty($result)){
            return false;
        }
        return $result;
    }
    
    
    public static function setBasket($basket_name,$data)
    {
        Cache::store('redis')->set($basket_name,$data);
    }
    
    
    //把前端的购物车数据转换成购物车格式
    public static function advanceToFormat($goodData,&$goods)
    {
        foreach ($goodData as $good){
            $good_code = $good['goods_code'];
            $goodInfo = ShopGoods::where(['code'=>$good['goods_code']])
                                 ->field('id,cateids as cateid,code,cover,name,price_selling,price_market')
                                 ->find()
                                 ->toArray();
                              
            if(array_key_exists('spec_codes',$good) && !empty($good['spec_codes'])){
                
                //$spec_codes = json_encode($good['spec_codes']);
                $spec_codes_str = '';
                foreach ($good['spec_codes'] as $key => $spec_code){
                    $spec_codes_str .= '"'.$spec_code.'"';
                    if($key < count($good['spec_codes'])-1){
                        $spec_codes_str .= ',';
                    }
                }
                $skuInfo =
                //ShopGoodsItem::where(['spec_codes'=>$spec_codes])
                          ShopGoodsItem::where('spec_codes', 'like', "%{$spec_codes_str}%")
                         ->field('goods_sku,price_selling,price_market,goods_spec')
                         ->find()
                         ->toArray();
            
                $goodInfo['price_selling'] = $skuInfo['price_selling'];
                $goodInfo['price_market'] = $skuInfo['price_market'];
                //拆分解决多属性标题拼接
                $goods_specs = explode(';;',$skuInfo['goods_spec']);
                $goods_specs_strs = [];
                foreach ($goods_specs as $goods_spec){
                    $spec_attrs = explode('::',$goods_spec);
                    $goods_specs_strs[] = $spec_attrs[1];
                }
                $goodInfo['name'] .= "(".implode(',',$goods_specs_strs).")";
                $good_code = $skuInfo['goods_sku'];
                $goodInfo['code'] = $good_code;
            }
            $cateids = explode(',',$goodInfo['cateid']);
            $goodInfo['cateid'] = $cateids[count($cateids)-2];
            $goodInfo['good_num'] = $good['good_num'];
            $goodInfo['amount'] = $good['good_num'] * $goodInfo['price_selling'];
            $goods[$good_code] = $goodInfo;
         
        }
    }
    
    
    public static function makeUpBasket($basket_name,&$goods,$basket_id='') {
        $baskets = self::getBasket($basket_name);
        if(!$baskets){
            return;
        }
        $newGoods = $baskets;
        if($basket_id){
            $fristKey = array_key_first($newGoods);
            $newGoods[$fristKey]['basket_id'] = $basket_id;
            $newGoods[$fristKey]['amount'] = sprintf("%.2f",$newGoods[$fristKey]['amount']);
        }
        $goods = array_merge($goods,$newGoods);
    }
    
    
    public static function removeCache($uuid) {
         $basketIds =  self::getBasketIds($uuid);
         if(!$basketIds){
             return;
         }
         foreach ($basketIds as $basketId){
             $name = self::getBasketName($uuid,$basketId);
             Cache::store('redis')->delete($name);
         }
         Cache::store('redis')->delete($uuid.'#basket_ids');
         Cache::store('redis')->delete("{$uuid}".self::$totalDataName);
    }
    
     public static function removeBasketAndId($uuid,$basketId) {
         $name = self::getBasketName($uuid,$basketId);
         Cache::store('redis')->delete($name);
         $basketIds =  self::getBasketIds($uuid);
         if(!$basketIds){
             return;
         }
         $index = array_search($basketId,$basketIds);
         unset($basketIds[$index]);
         self::setReplaceBasketIds($basketIds,$uuid);
    }
    
    
    public static function setReplaceBasketIds($basket_ids,$uuid) {
       Cache::store('redis')->set($uuid.'#basket_ids',$basket_ids);
    }



    
    public static function setBasketId($basketid,$uuid) {
       $basket_ids = [];
       if(Cache::store('redis')->has($uuid.'#basket_ids')){
           $basket_ids = Cache::store('redis')->get($uuid.'#basket_ids');
       }
       $basket_ids[] = $basketid;
       Cache::store('redis')->set($uuid.'#basket_ids',$basket_ids);
    }
    
    
    public static function getBasketIds($uuid) {
       $result = Cache::store('redis')->get($uuid.'#basket_ids');
       if(empty($result)){
           return false;
       }
       return $result;
    }
    
     /**
     * 重信组合洗衣篮数据，用于前端显示
     */
    public static function rebuildArr($goods)
    {
      $data = self::groupBy("cateid", $goods);
      $result = [];
      foreach ($data as $key => $goods){
          $cate_name = ShopGoodsCate::where(['id'=>$key])->value('name');
          $arr['type'] =  $cate_name;
          $arr['list'] = $goods;
          $result[] = $arr;
          
      }  
      return  $result;  
        
    }
    
    
    
      /**
     * 重信组合洗衣篮数据，用于前端显示
     */
    public static function rebuildArrToList($goods)
    {
      $result = [];
      foreach ($goods as $key => $good){
          $result[] = $good;
      }  
      return  $result;  
        
    }
    
    
    
    
     private static function groupBy($key, $data) {
        $result = [];
        foreach($data as $val) {
           if(array_key_exists($key, $val)){
              $result[$val[$key]][] = $val;
           }else{
             $result[""][] = $val;
           }
        }
        return $result;
    }
    
}