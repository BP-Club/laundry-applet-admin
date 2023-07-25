<?php

namespace app\data\controller\api;

use app\data\service\UserAdminService;
use think\admin\Controller;
use think\exception\HttpResponseException;
use think\Response;
use WeMini\Crypt;
use WeMini\Live;
use WeMini\Qrcode;
use think\facade\Cache;
use app\data\model\DataUser;
use app\market\service\PosterService;
use app\market\service\DirectService;
/**
 * 微信小程序入口
 * Class Wxapp
 * @package app\data\controller\api
 */
class Wxapp extends Controller
{
    /**
     * 接口认证类型
     * @var string
     */
    private $type = UserAdminService::API_TYPE_WXAPP;

    /**
     * 唯一绑定字段
     * @var string
     */
    private $field;

    /**
     * 小程序配置参数
     * @var array
     */
    private $cfg;

    /**
     * 接口服务初始化
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function initialize()
    {
        $opt = sysdata('wxapp');
        $this->cfg = [
            'appid'      => $opt['appid'] ?? '',
            'appsecret'  => $opt['appkey'] ?? '',
            'cache_path' => $this->app->getRootPath() . 'runtime' . DIRECTORY_SEPARATOR . 'wechat',
        ];
        if (empty(UserAdminService::TYPES[$this->type]['auth'])) {
            $this->error("接口类型[{$this->type}]没有定义规则");
        } else {
            $this->field = UserAdminService::TYPES[$this->type]['auth'];
        }
    }

    /**
     * 授权Code换取会话信息
     * @throws \think\admin\Exception
     * @throws \think\db\exception\DbException
     */
    public function session()
    {
        
        if(!input('code')){
            $this->error('登录凭证CODE不能为空！', [] , 401);
        }
        //$input = $this->_vali(['code.require' => '登录凭证CODE不能为空！']);
        [$openid, $unionid, $session] = $this->applySessionKey(input('code'));
        $map = UserAdminService::getUserUniMap($this->field, $openid, $unionid);
        
        
        
        $data = [$this->field => $openid, 'session_key' => $session];
        if (!empty($unionid)) $data['unionid'] = $unionid;
        $result = UserAdminService::set($map, $data, $this->type, true);
        $path = 'pages/index/index';
        UserAdminService::createQrcode($result['id'],$path);
        PosterService::build($result['id']);
        if(input('share_uid')){
            $share_uid = input('share_uid');
            $share_uid =  base64_decode(json_decode($share_uid,true));
            if($result['pid1'] == 0){
                DataUser::where(['id'=>$result['id']])->update(['pid1'=>$share_uid]);
                $sharer = DataUser::field('id,teams_users_direct')->find($share_uid);
                $share_data = $sharer->toArray(); 
                $sharer['teams_users_direct'] += 1;
                $sharer->save();
                DirectService::insertRecord($share_uid,$result['nickname'],$result['id']);
                $this->app->event->trigger('ShareNewUser', $share_data);
            }
        }
        
        $this->success('授权换取成功！', ['token' => $result['token'],"server"=>$_SERVER]);
    }
    
    
    
    
    
     /**
     * 手机号登录接口
     * @throws \think\admin\Exception
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function phonelogin()
    {
        $input = $this->_vali([
            'phone.mobile'     => '手机号码格式错误！',
            'phone.require'    => '手机号码不能为空！',
            'code.require' => '登录凭证CODE不能为空！',
            'checkCode.require' => '验证码不能为空！',
        ]);
       
        $data = [];
        [$openid, $unionid, $session] = $this->applySessionKey($input['code']);
        $data[$this->field]  = $openid;
        if (!empty($unionid)) $data['unionid'] = $unionid;
        $map = UserAdminService::getUserUniMap($this->field, $openid, $unionid);
        $data['phone'] = $input['phone'];
        $user = UserAdminService::set($map, $data, $this->type, true);
        if (empty($user['status'])){
            $this->error('该用户账号状态异常！',[],401);
        }
        if($user){
            $this->success('手机登录成功！', ['token' => $user['token']]);
        } else {
            $this->error('账号登录失败，请稍候再试！',[],401);
        }
    }


    
    public function sendMessage(){
        $input = $this->_vali([
            'phone.mobile'     => '手机号码格式错误！',
            'phone.require'    => '手机号码不能为空！',
        ]);
        $code = rand(100000,999999);
        Cache::store('redis')->set($input['phone'],$code,300);
        $url = "http://send.18sms.com/msg/HttpBatchSendSM?account=vd736g&pswd=1DFW3Ren&mobile=". $input['phone']."&msg=%E6%82%A8%E7%9A%84%E9%AA%8C%E8%AF%81%E7%A0%81%E6%98%AF%EF%BC%9A".$code."&needstatus=true&extno=";
        file_get_contents($url); 
        $this->success('发送成功！', ['code' => $code]);
     
    }






    /**
     * 小程序数据解密
     */
    public function decode()
    {
        try {
            $input = $this->_vali([
                'iv.require'        => '解密向量不能为空！',
                'code.require'      => '授权CODE不能为空！',
                'encrypted.require' => '加密内容不能为空！',
            ]);
            [$openid, $unionid, $input['session_key']] = $this->applySessionKey($input['code']);
            $result = Crypt::instance($this->cfg)->decode($input['iv'], $input['session_key'], $input['encrypted']);
            if (is_array($result) && isset($result['avatarUrl']) && isset($result['nickName'])) {
                $data = [$this->field => $openid, 'nickname' => $result['nickName'], 'headimg' => $result['avatarUrl']];
                $data['base_sex'] = ['-', '男', '女'][$result['gender']] ?? '-';
                if (!empty($unionid)) $data['unionid'] = $unionid;
                //$map = UserAdminService::getUserUniMap($this->field, $openid, $unionid);
                $this->success('数据解密成功！',$result);
            } elseif (is_array($result)) {
                $this->success('数据解密成功！', $result);
            } else {
                
                $this->success('数据处理失败，请稍候再试！');
            }
        } catch (HttpResponseException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            trace_file($exception);
            $this->success("数据处理失败，{$exception->getMessage()}");
        }
    }

    /**
     * 授权CODE换取会话信息
     * @param string $code 换取授权CODE
     * @return array [openid, sessionkey]
     */
    private function applySessionKey(string $code): array
    {
        try {
            $cache = $this->app->cache->get($code, []);
            if (isset($cache['openid']) && isset($cache['session_key'])) {
                return [$cache['openid'], $cache['unionid'] ?? '', $cache['session_key']];
            }
            $result = Crypt::instance($this->cfg)->session($code);
            if (isset($result['openid']) && isset($result['session_key'])) {
                $this->app->cache->set($code, $result, 60);
                return [$result['openid'], $result['unionid'] ?? '', $result['session_key']];
            } elseif (isset($result['errmsg'])) {
                $this->error($result['errmsg'],[],401);
            } else {
                $this->error("授权换取失败，请稍候再试！",[],401);
            }
        } catch (HttpResponseException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            trace_file($exception);
            $this->error("授权换取失败，{$exception->getMessage()}",[],401);
        }
    }

    /**
     * 获取小程序码
     */
    public function qrcode(): Response
    {
        try {
            $data = $this->_vali([
                'size.default' => 430,
                'type.default' => 'base64',
                'path.require' => '跳转路径不能为空!',
            ]);
            $result = Qrcode::instance($this->cfg)->createMiniPath($data['path'], $data['size']);
            if ($data['type'] === 'base64') {
                $this->success('生成小程序码成功！', [
                    'base64' => 'data:image/png;base64,' . base64_encode($result),
                ]);
            } else {
                return response($result)->contentType('image/png');
            }
        } catch (HttpResponseException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            trace_file($exception);
            $this->error($exception->getMessage());
        }
    }

    /**
     * 获取直播列表
     */
    public function getLiveList()
    {
        try {
            $data = $this->_vali(['start.default' => 0, 'limit.default' => 10]);
            $list = Live::instance($this->cfg)->getLiveList($data['start'], $data['limit']);
            $this->success('获取直播列表成功！', $list);
        } catch (HttpResponseException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            trace_file($exception);
            $this->error($exception->getMessage());
        }
    }

    /**
     * 获取回放源视频
     */
    public function getLiveInfo()
    {
        try {
            $data = $this->_vali([
                'start.default'   => 0,
                'limit.default'   => 10,
                'action.default'  => 'get_replay',
                'room_id.require' => '直播间不能为空',
            ]);
            $result = Live::instance($this->cfg)->getLiveInfo($data);
            $this->success('获取回放视频成功！', $result);
        } catch (HttpResponseException $exception) {
            throw $exception;
        } catch (\Exception $exception) {
            trace_file($exception);
            $this->error($exception->getMessage());
        }
    }
    
    
   
}