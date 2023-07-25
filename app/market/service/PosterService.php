<?php

namespace app\market\service;


use think\admin\Service;
use app\data\model\DataUser;
use app\data\service\UserAdminService;
use think\facade\Cache;
/**
 * 海报服务
 * Class PosterService
 * @package app\market\service
 */
class PosterService extends Service
{
     public static function build($userId){
        $cdata = sysdata("cropper");
        $fileName = pathinfo($cdata['image'],PATHINFO_BASENAME);
        $fileName = explode('.',$fileName);
        $extName = $fileName[1];
        $posterBg = '';
        if($extName == 'png'){
            $posterBg = imagecreatefrompng($cdata['image']);
        }else if($extName == 'jpg'){
            $posterBg =  imagecreatefromstring(file_get_contents($cdata['image']));
        }else if($extName == 'jpeg'){
            $posterBg = imagecreatefromjpeg($cdata['image']);
        }
     
        $qrcodeConig = json_decode($cdata['postion'],true);
        $bgX = (int)$qrcodeConig['x'] ;
        $bgY = (int)$qrcodeConig['y'] ;
        $qrcodeConigWidth = (int)$qrcodeConig['width'] ;
        $qrcodeConigHeight = (int)$qrcodeConig['height'] ;
        $oldQrImg =  UserAdminService::getQrcode($userId);
        $qrcodeName = 'share_poster#'.$userId;
        $qrcodeUrl = 'wechat/share_poster/'.$userId.".png";
        
     
        if($oldQrImg != false && !file_exists(app()->getRootPath().'public/upload/'.$qrcodeUrl)){
            $oldQrImg = imagecreatefromstring($oldQrImg);
            //获取原小程序码高度宽度
            $oldQrImgWidth  = imagesx($oldQrImg); 
            $oldQrImgHeight = imagesy($oldQrImg); 
    
            //原微信生成的qrcode图片尺寸太大，现在根据后台设置的二维码区域生成合适的尺寸
            $newQrImg = imagecreatetruecolor($qrcodeConigWidth, $qrcodeConigHeight);
            // 上色
            $color = imagecolorallocate($newQrImg, 255, 255, 255);
            // 填充透明色
            imagefill($newQrImg, 0, 0, $color);
            
            // 将原图$image按照指定的宽高，复制到$new_image指定的宽高大小中
            imagecopyresized($newQrImg, $oldQrImg, 0, 0, 0, 0, $qrcodeConigWidth, $qrcodeConigHeight, $oldQrImgWidth, $oldQrImgHeight);
      
            //imagecopymerge ( resource $dst_im , resource $src_im , int $dst_x , int $dst_y , int $src_x , int $src_y , int $src_w , int $src_h , int $pct )---拷贝并合并图像的一部分
            //将 src_im 图像中坐标从 src_x，src_y 开始，宽度为 src_w，高度为 src_h 的一部分拷贝到 dst_im 图像中坐标为 dst_x 和 dst_y 的位置上。两图像将根据 pct 来决定合并程度，其值范围从 0 到 100。当 pct = 0 时，实际上什么也没做，当为 100 时对于调色板图像本函数和 imagecopy() 完全一样，它对真彩色图像实现了 alpha 透明。
            imagecopymerge($posterBg, $newQrImg, $bgX, $bgY, 0,0, $qrcodeConigWidth, $qrcodeConigHeight, 100);
          
            imagejpeg($posterBg,app()->getRootPath().'public/upload/'.$qrcodeUrl);
            $qrcodeUrl = 'https://www.uexwash.com/upload/'.$qrcodeUrl;
            Cache::store('redis')->set($qrcodeName,$qrcodeUrl);
        }
     }
    
    
    public static function create(){
        $userIds =  DataUser::where(['deleted' => 0])->column('id');
        foreach ($userIds as $userId){
            self::build($userId);
        }
    }
    
}