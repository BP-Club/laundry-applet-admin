<?php
namespace app\wechat\service;
use think\admin\Service;
use app\data\model\DataUser; 

class SubscribeService extends Service
{
    
    public static function pushMessageNewOrder($order_no,$userId,$projectTitle,$address,$reserve_date,$discount_price,$distance,$state = 'formal'){
        $page = 'pages/usercenter/orderinfo/orderinfo?order_no='.$order_no;
        $template_id = 'ECFeeSpD0VJa8yd2hLTYz4BWEobjjYbiJhP6ZPKh0Mk';
        $pushData = [
            "thing1"=>[
                'value' => $projectTitle
            ],
            "thing2"=>[
                'value' => $address
            ],
            "time3"=>[
                'value' => $reserve_date
            ],
            'amount4'=>[
                'value'=>$discount_price
            ],
            'character_string5'=>[
                'value'=>$distance
            ]
        ];
        self:: pushMessage($userId,$template_id,$page,$pushData,$state);
    }
    
    public static function pushMessage($userId,$template_id,$page,$pushData,$state = 'formal'){
        $openid = DataUser::where(['id'=>$userId])->value('openid1');
        $wxapp = sysdata('wxapp');
        $config = [
          'appid'     => $wxapp['appid'],
          'appsecret' => $wxapp['appkey'],
        ];

        // 实例SDK
        $mini = new \WeMini\Template($config);
        //发送内容
        $data = [] ;
 
        //接收者（用户）的 openid 
        $data['touser'] = $openid;
 
        //所需下发的订阅模板id
        $data['template_id'] = $template_id;
 
        //点击模板卡片后的跳转页面，仅限本小程序内的页面。支持带参数,（示例index?foo=bar）。该字段不填则模板无跳转。
        $data['page'] = $page;
 
        //模板内容，格式形如 { "key1": { "value": any }, "key2": { "value": any } }
        // $data['data'] = [
        //     "character_string1"=>[
        //         'value' => '-----'
        //     ],
        //     "thing2"=>[
        //         'value' => '公证处摇号'
        //     ],
        //     "time3"=>[
        //         'value' => date("Y-m-d H:i:s")
        //     ],
        //     'phrase4'=>[
        //         'value'=>'摇号结束'
        //     ],
        //     'thing5'=>[
        //         'value'=>'摇号结束,进小程序查看'
        //     ]
        // ];
        $data['data'] = $pushData;
        //跳转小程序类型：developer为开发版；trial为体验版；formal为正式版；默认为正式版
        $data['miniprogram_state'] = $state ;
        $mini->send($data);
        
    }
}