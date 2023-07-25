<?php

namespace app\market\controller\api\auth;

use app\data\controller\api\Auth;
use think\admin\Controller;
use think\admin\storage\LocalStorage;
use think\facade\Cache;
use WeMini\Qrcode;
use app\data\service\UserAdminService;
use app\market\service\PosterService;
use app\data\model\DataUser;
use app\market\model\MarketDirectUser;
/**
 * 市场活动
 * Class Activity
 * @package app\market\controller\api\auth
 */
class Activity extends Auth
{
   
   
    public function getSharePoster()
    {
      
       // sysqueue("生成分享海报", "xdata:createSharePoster",  0,  [], 0,  0);
        $share_poster = 'share_poster#'.$this->uuid;
        $share_poster = Cache::store('redis')->get($share_poster);
        $share_poster = $share_poster?$share_poster:"";
        $this->success('操作成功',['url'=>$share_poster]);
      
    }
    
    
    
  
    public function getQrcode()
    {
        $url = 'https://www.uexwash.com/upload/af/a10511eebe11d8cdacbf86446f5e62.jpg';
        $this->success('操作成功',['url'=>$url]);
      
    }
    
    
    
     public function getDirectRecords()
    {
       $data = [];
       
       $data['inviteNum'] = DataUser::where(['id'=>$this->uuid])->value('teams_users_direct');
       $data['totalNum'] = 5;
       $data['inviteHistory'] =  MarketDirectUser::where(['uuid'=>$this->uuid])
                                 ->field('direct_name as nickName ,create_at as inviteDate')
                                 ->order('id desc')->select()->toArray();
       foreach ($data['inviteHistory']  as &$item){
           $item['statusText'] = '已助力';
       }            
       $this->success('操作成功',$data);
      
    }
    
    
    
   
}