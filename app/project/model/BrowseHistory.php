<?php

namespace app\project\model;

use think\admin\Model;

/**
 * 浏览记录
 * Class BrowseHistory
 * @package app\market\model
 */
class BrowseHistory extends Model
{
   
     public static function addHistory($userid,$status,$order_id,$model){
           $data = [];
           $data['userid'] = $userid;
           $data['status'] = $status;
           $data['order_id'] = $order_id;
           $data['model'] = $model;
           self::create($data);
     }
     
     public static function updateHistoryStatus($userid,$newStatus,$order_id,$model){
        
           $map = ['userid'=>$userid,
                   'order_id'=>$order_id,
                   'model'=>$model
                   ];
           $history = self::where($map)->findOrEmpty();
      
           if(!$history->isEmpty()){
                $history['status'] = $newStatus;
                $history['create_at'] = date('Y-m-d h:i:s');
                $history['is_read'] = 0;
                $history->save();
           }
          
           
     }
     
}