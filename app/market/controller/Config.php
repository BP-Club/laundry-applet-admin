<?php

namespace app\market\controller;


use think\admin\Controller;
use think\admin\helper\QueryHelper;


/**
 * 优惠卷发放
 * Class Config
 * @package app\data\controller\news
 */
class Config extends Controller
{
    /**
     * 营销参数配置
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function info()
    {
        $this->skey = 'market_config';
        $this->title = '营销参数配置';
        $this->__sysdata('config');
    }

    /**
     * 显示并保存数据
     * @param string $template 模板文件
     * @param string $history 跳转处理
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    private function __sysdata(string $template, string $history = '')
    {
        if ($this->request->isGet()) {
            $this->data = sysdata($this->skey);
            $this->fetch($template);
        }
        if ($this->request->isPost()) {
            if (is_string(input('market_config'))) {
                $data = json_decode(input('market_config'), true) ?: [];
            } else {
                $data = $this->request->post();
            }
            if (sysdata($this->skey, $data) !== false) {
                $this->success('内容保存成功！', $history);
            } else {
                $this->error('内容保存失败，请稍候再试!');
            }
        }
    }
}
?>