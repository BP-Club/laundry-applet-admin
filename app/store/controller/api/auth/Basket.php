<?php

namespace app\store\controller\api\auth;


use app\store\model\Order as OrderModel;
use app\data\controller\api\Auth;
use think\facade\Cache;
use app\data\model\ShopGoodsCate;
use app\data\model\DataUserAddress;
use app\data\model\ShopGoods;
use app\data\model\ShopGoodsItem;
use app\store\service\BasketService;
use app\market\service\CouponService;

/**
 * 购物篮子类
 * Class Order
 * @package app\pet\controller\api\auth
 */
class Basket extends Auth
{
   
   
   
      /**
     * 读取洗衣篮数据
     */
    public function getData()
    {
        $input = $this->_vali([
                'uuid.default'=>$this->uuid,
                'basket_id.default' => '',
        ]);
        $basket_id = $input['basket_id'];
        $basket_totals =  BasketService::getBasketTotalData($this->uuid);
        $goods = [];

        if(empty($input['basket_id'])){
            $basket_ids = BasketService::getBasketIds($this->uuid); 
            if(!$basket_ids){
               $this->success('洗衣篮为空');
            }
            foreach ($basket_ids as $basket_id){
                $basket_name = BasketService::getBasketName($this->uuid,$basket_id);
                BasketService::makeUpBasket($basket_name,$goods,$basket_id);
            }
        }else{
            $basket_name = BasketService::getBasketName($this->uuid,$basket_id); 
            BasketService::makeUpBasket($basket_name,$goods,$basket_id);
        }
      
        if(empty($goods)){
            $this->success('洗衣篮为空');
        }
       
        $goods = BasketService::rebuildArr($goods);
        $basket_totals['goods'] = $goods;
        $this->success('读取成功',$basket_totals);
    }
   
    
      /**
     * 加入购物篮子
     */
    public function opSet()
    {
        $input = $this->_vali([
            'action.require'=>"action不能为空",
        ]);
        if($input['action'] == 'add'){
            $this->incOneNum();
        }else if($input['action'] == 'reduce'){
            $this->redOneNum();
        }else if($input['action'] == 'remove'){
            $this->remove();
        }
        
    }
  
  
  
  
  
  
       /**
     * 加入购物篮子
     */
    public function setCart()
    {
        $input = $this->_vali([
                'uuid.default'=>$this->uuid,
                'goods.require'=>'商品json数据为空',
        ]);
        
        
        $goodData = json_decode(input('goods'),true);
      
     
        if(empty($goodData)){
            $this->success('洗衣篮不能为空');
        }
        $goods = [];
        //格式化成购物车数组
        $total_num = 0; $total_amount = 0;
        //对前端传输的商品数据转换成购物车格式
        BasketService::advanceToFormat($goodData,$goods);
        
        
        $basket_totals = ['total_num' => $total_num,
                          'total_amount' => $total_amount];
        $current_basket_id  = ''; 
        $basket_ids = BasketService::getBasketIds($this->uuid);   
        if($basket_ids){
            $basket_totals =  BasketService::getBasketTotalData($this->uuid);
            foreach ($basket_ids as $basket_id){
                $basket_name = BasketService::getBasketName($this->uuid,$basket_id);
                $baskets_origin = BasketService::getBasket($basket_name);
                $fristKey = array_key_first($goods);
                $fristKey_origin = array_key_first($baskets_origin);
                if($fristKey == $fristKey_origin){
                    $baskets_origin[$fristKey]['good_num'] += $goods[$fristKey]['good_num'];
                    $baskets_origin[$fristKey]['amount'] += $goods[$fristKey]['amount'];
                    $basket_totals['total_amount'] += $goods[$fristKey]['amount'];
                    $basket_totals['total_num'] += $goods[$fristKey]['good_num'];
                    BasketService::setBasket($basket_name,$baskets_origin);
                    $current_basket_id = $basket_id;
                    break;
                }
            }
        }

        if(empty($current_basket_id)){
             $current_basket_id = uniqid();
             $basket_name = BasketService::getBasketName($this->uuid,$current_basket_id);
             BasketService::setBasketId($current_basket_id,$this->uuid);
             BasketService::setBasket($basket_name,$goods);
             $basket_totals['total_num'] += 1;
             $fristKey = array_key_first($goods);
             $basket_totals['total_amount'] += $goods[$fristKey]['amount'];
        }
        
        BasketService::setBasketTotalData($this->uuid,$basket_totals);
       // $baskets['goods'] = BasketService::rebuildArr($baskets['goods']);
        $this->success('成功加入洗衣篮',['basket_id'=>$current_basket_id,'data'=>[]]);
    }
    
    
      /**
     * 商品数量增加1
     */
    private function incOneNum()
    {
        $input = $this->_vali([
            'uuid.default'=>$this->uuid,
            'basket_id.require'=>'basket_id不能为空',
        ]);
        
        $basket_id = $input['basket_id'];
        $basket_name = BasketService::getBasketName($this->uuid,$basket_id);  

        $baskets = BasketService::getBasket($basket_name);
        if(!$baskets){
            $this->success('洗衣篮为空');
        }
        
        $basket_totals =  BasketService::getBasketTotalData($this->uuid);
        $code = array_key_first($baskets);
        $baskets[$code]['good_num'] += 1;
        $baskets[$code]['amount'] += $baskets[$code]['price_selling'];
        $basket_totals['total_num'] += 1;
        $basket_totals['total_amount'] += $baskets[$code]['price_selling'];
        $basket_totals['total_amount'] = sprintf("%.2f", $basket_totals['total_amount']);
        BasketService::setBasket($basket_name,$baskets);
        $baskets[$code]['basket_id'] = $basket_id;
        BasketService::setBasketTotalData($this->uuid,$basket_totals);
        //$baskets['goods'] = $this->rebuildArr($baskets['goods']);
        $this->success('操作成功',["goods"=>$baskets[$code]]);
        
        
        
    }
    
       /**
     * 商品数量减少1
     */
    private function redOneNum()
    {
         $input = $this->_vali([
            'uuid.default'=>$this->uuid,
            'basket_id.require'=>'basket_id不能为空',
        ]);
        
        $basket_id  = $input['basket_id'];     
        $basket_name = BasketService::getBasketName($this->uuid,$basket_id);  

        $baskets = BasketService::getBasket($basket_name);
        if(!$baskets){
            $this->success('洗衣篮为空');
        }
        $basket_totals =  BasketService::getBasketTotalData($this->uuid);
        $code = array_key_first($baskets);
        if($baskets[$code]['good_num'] > 0){
            $baskets[$code]['good_num'] -= 1;
            $baskets[$code]['amount'] -= $baskets[$code]['price_selling'];
            $basket_totals['total_num'] -= 1;
            $basket_totals['total_amount'] -= $baskets[$code]['price_selling'];
            $basket_totals['total_amount'] = sprintf("%.2f", $basket_totals['total_amount']);
        }
        
        BasketService::setBasket($basket_name,$baskets);
        $baskets[$code]['basket_id'] = $basket_id;
        BasketService::setBasketTotalData($this->uuid,$basket_totals);
        //$baskets['goods'] = $this->rebuildArr($baskets['goods']);
        $this->success('操作成功',["goods"=>$baskets[$code]]);
    }
    
    
    
    /**
     * 移除商品
     */
    private function remove()
    {
         $input = $this->_vali([
            'uuid.default'=>$this->uuid,
            //'good_codes.require'=>'商品编号不能为空',
            'basket_id.require'=>'basket_id不能为空',
        ]);
        
      
        $basket_ids = []; 
        $basket_ids =  json_decode($input['basket_id'],true);
        $basket_totals =  BasketService::getBasketTotalData($this->uuid);
 
        foreach ($basket_ids as $basket_id){
            $basket_name = BasketService::getBasketName($this->uuid,$basket_id);  
            $baskets = BasketService::getBasket($basket_name);
            $code = array_key_first($baskets);
            $basket_totals['total_num'] -= 1;
            $basket_totals['total_amount'] -= $baskets[$code]['amount'];
            
            BasketService::removeBasketAndId($this->uuid,$basket_id);
        }
        BasketService::setBasketTotalData($this->uuid,$basket_totals);
        $this->success('操作成功');
    }
    
    
     /**
     * 提交结算
     */
    public function settle()
    {
        
        $input = $this->_vali([
           // 'good_codes.require'=>'good_codes不能为空',
            'basket_ids.default'=>'',
        ]);
        
       // $good_codes = json_decode($input['good_codes'],true);
        $goods = [];
        $basket_totals =  BasketService::getBasketTotalData($this->uuid);
        
        $basket_ids =  json_decode($input['basket_ids'],true);
        if(empty($basket_ids[0])){
            $basket_ids = BasketService::getBasketIds($this->uuid);
            if(!$basket_ids){
               $this->success('洗衣篮为空');
            }
        }
        
        
        
        if(!$basket_ids){
            $this->success('洗衣篮数据为空');
        }
        foreach ($basket_ids as $basket_id){
            $basket_name = BasketService::getBasketName($this->uuid,$basket_id); 
            BasketService::makeUpBasket($basket_name,$goods);
        }
        $basket_totals['goods'] = $goods;
        
        $basket_totals['coupon'] = CouponService::getCanUse($goods);
        
        //替换一下原来的basket_ids
       // BasketService::setReplaceBasketIds($basket_ids,$this->uuid);
        $this->success('操作成功',$basket_totals);
    }
    
}