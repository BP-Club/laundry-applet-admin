<?php

namespace app\project\controller;


use think\admin\Controller;
use think\admin\helper\QueryHelper;
use app\project\model\Project as ProjectModel;
use app\project\model\ProjectAdditem;
/**
 * 服务项目
 * Class Coupon
 * @package app\data\controller\news
 */
class Project extends Controller
{
    
     /**
     * 项目管理
     * @auth true
     * @menu true
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function index()
    {
        ProjectModel::mQuery()->layTable(function () {
            $this->title = '项目管理';
        }, function (QueryHelper $query) {
            $query->equal('status,distance_charge,charge_mode');
            $query->where(['deleted' => 0]);
        });
        
    }
    
    
    
    /**
     * 添加优惠卷
     * @auth true
     */
    public function add()
    {
        
        $this->mode = 'add';
        $this->title = '添加项目';
        ProjectModel::mForm('form');
    }
    
    
    
     /**
     * 编辑优惠卷
     * @auth true
     */
    public function edit()
    {
        $this->mode = 'edit';
        $this->title = '编辑项目';
        ProjectModel::mForm('form');
    }

    
    /**
     * 表单数据处理
     * @param array $data
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    protected function _form_filter(array &$data)
    {
        $this->addititems = ProjectAdditem::select();
       
    }

    /**
     * 表单结果处理
     * @param boolean $state
     */
    protected function _form_result(bool $state)
    {
        if ($state) {
            $this->success('保存成功！', 'javascript:history.back()');
        }
    }
    
    
    /**
     * 删除优惠卷
     * @auth true
     */
    public function remove()
    {
        ProjectModel::mDelete();
    }

    
}