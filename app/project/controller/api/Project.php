<?php

namespace app\project\controller\api;


use app\data\service\GoodsService;
use think\admin\Controller;
use app\project\model\Project as ProjectModel;
use app\project\model\ProjectAdditem;
use app\project\model\DataUserAddress;
/**
 * 服务项目数据接口
 * Class Project
 * @package app\project\controller\api
 */
class Project extends Controller
{
    /**
     * 获取项目详情
     */
    public function detail()
    {
        $map = $this->_vali(['id.require' => 'id不能为空！','id.number' => 'id必须整数！']);
        $data = ProjectModel::mk()->where(['status'=>1])->find($map['id']);
        $data['additems'] = ProjectAdditem::whereIn('id',$data['addit_item_ids'])->select()->toArray();
        $this->success('获取详情成功', $data);
    }
    
    
    /**
     * 获取用户协议
     */
    public function serviveAccord()
    {
        $data = sysdata('serviveAccord');
        $this->success('获取成功', $data);
    }
    
     /**
     * 获取关于我们
     */
    public function about()
    {
        $data = sysdata('about');
        $this->success('获取成功', $data);
    }
   
}