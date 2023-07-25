<?php

namespace app\project\controller;


use think\admin\Controller;
use think\admin\helper\QueryHelper;
use app\project\model\ProjectAdditem;

/**
 * 附加项目
 * Class Coupon
 * @package app\data\controller\news
 */
class Additem extends Controller
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
        ProjectAdditem::mQuery()->layTable(function () {
           $this->title = '附加项目管理';
        }, function (QueryHelper $query) {
            
        });
    }
    
    
    
    /**
     * 添加附加项目
     * @auth true
     */
    public function add()
    {
        $this->mode = 'add';
        $this->title = '添加附加项目';
        ProjectAdditem::mForm('form');
    }
    
    
    
     /**
     * 编辑附加项目
     * @auth true
     */
    public function edit()
    {
        $this->mode = 'edit';
        $this->title = '编辑附加项目';
        ProjectAdditem::mForm('form');
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
        ProjectAdditem::mDelete();
    }

    
}