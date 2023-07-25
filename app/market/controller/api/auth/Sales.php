<?php

namespace app\market\controller\api\auth;

use app\data\controller\api\Auth;
use app\market\model\MarketCoupon ;
use app\market\model\MarketCouponUsers;
use think\admin\Controller;
/**
 * 市场活动
 * Class Sales
 * @package app\market\controller\api\auth
 */
class Sales extends Controller
{
   
   
    public function getPosterBg()
    {
        $data = sysdata("cropper");
        $result['background'] = $data['image'];
        $result['qrcode'] = json_decode($data['postion'],true);
        $result['qrcode']['x'] = (int)$result['qrcode']['x'] ;
        $result['qrcode']['y'] = (int)$result['qrcode']['y'] ;
        $result['qrcode']['width'] = (int)$result['qrcode']['width'] ;
        $result['qrcode']['height'] = (int)$result['qrcode']['height'] ;
        $this->success('操作成功',$result);
      
    }
    
    
    
  
    public function getQrcode()
    {
        $url = 'https://www.uexwash.com/upload/af/a10511eebe11d8cdacbf86446f5e62.jpg';
        $this->success('操作成功',['url'=>$url]);
      
    }
    
    
    
    
    
   
}