<?php

namespace app\store\controller\api;


use app\store\model\Store as StoreModel;
use app\store\service\StoreService;
use think\admin\Controller;
use think\facade\Cache;

/**
 * 门店类
 * Class Store
 * @package app\pet\controller\api\auth
 */
class Store extends Controller
{
   
    
     /**
     * 获取当前最近的店
     */
    public function getLately()
    {
        
       
    
        
        
        $input = $this->_vali([
                'lat.require'   =>'lat不能为空',
                'lng.require'   => 'lng不能为空',
                'lat.float'   =>'lat必须为浮点数',
                'lng.float'   => 'lng必须为浮点数',
        ]);
        
      
        $data = StoreService::instance()->getLatelyOne($input['lat'],$input['lng']);
        $storeId = $data[0][0];
        $distance = $data[0][1];
        if(!$data){
          $this->success('没有门店', []);
        }
        
        $stores = StoreService::instance()->getInfo($storeId);
        $stores['distance'] = StoreService::instance()->toKilometer($distance);
        $this->success('获取成功', $stores);
    }
    
    
 
    
    
    
    
    
    
     /**
     * 获取当前最近的店
     */
    public function getNear()
    {
        $input = $this->_vali([
                'lat.require'   =>'lat不能为空',
                'lng.require'   => 'lng不能为空',
                'lat.float'   =>'lat必须为浮点数',
                'lng.float'   => 'lng必须为浮点数',
                'page.default' => 1,
                'page.number' => '分页数必须为整数',
                'keyword.default'=>'',
                'selected_store_id.default' => 0,
                'selected_store_id.number' => 'selected_store_id必须为整数',
        ]);
        
        
        $page = $input['page'];//1
        $pageCount = 6;
        $pageIndex = $page - 1;
        if($page > 1){
            $pageIndex = $pageIndex * $pageCount;
        }
        
        
        $datas = StoreService::instance()->getLatelyOne($input['lat'],$input['lng']);
        
        $result = [];
        if(!$datas){
            $this->success('没有门店',[]);
        }
      
        if($input['keyword']){
            $storeIds =  StoreModel::where('name','like','%'.$input['keyword'].'%')
                                    ->whereOr('address','like','%'.$input['keyword'].'%')
                                    ->column('id');
            $storeData = [];   
            foreach ($storeIds as $storeId){
                foreach ($datas as $key => $data){
                    if($data[0] == $storeId){
                        $storeData[] = $data;
                    }
                }
            }
            $datas = $storeData;
        }
        
        $count = count($datas);
        $datas = array_slice($datas, $pageIndex, $pageCount);
        $selected_store_id = $input['selected_store_id'];
        
       
        foreach ($datas as $key => $data){
            $storeId = $data[0];
            $stores = StoreService::instance()->getInfo($storeId);
            $stores['distance'] = StoreService::instance()->toKilometer($data[1]);
            $stores['selected'] = false;
            if($key   ==  $selected_store_id && $selected_store_id == 0){
                $stores['selected'] = true;
            }else if($selected_store_id == $storeId){
                $stores['selected'] = true;
            }
            $result[] = $stores;
        }
     
        $this->success('获取成功', ['page'=>(int)$page,
                                  'pages'=>round($count/$pageCount),
                                  'list' =>$result]);
    }
    
    
   

    
   
    
    
    
    
}