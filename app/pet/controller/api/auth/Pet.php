<?php

namespace app\pet\controller\api\auth;

use app\data\controller\api\Auth;
use app\pet\model\Pet as PetModel;


/**
 * 用户宠物
 * Class Pet
 * @package app\pet\controller\api\auth
 */
class Pet extends Auth
{
    /**
     * 新增宠物
     */
    public function add()
    {
        $input = $this->_vali([
                'uid.default'   =>$this->uuid,
                'name.require'        => 'name不能为空！',
                'images.require'        => '图片不能为空！',
                'age.require'        => 'age不能为空！',
                'pettype.in:1,2'      => 'pettype必须为1,2之间！',
                'is_vaccin.in:1,0' => 'is_vaccin必须为1,2之间！',
                'sex.in:1,2' => 'sex必须为1,2之间！',
                'shape.in:1,2,3' => 'shape必须为1,2,3之间！',
                'intro.default'   => '',
         ]);
        PetModel::create($input);
        $this->success('新增成功');
    }
    
    
    
     /**
     * 获取宠物
     */
    public function detail()
    {
        $input = $this->_vali([
                'uid.default'   =>$this->uuid,
                'id.number'   => 'petid必须为整数！',
         ]);
        $data = PetModel::where($input)->find();
        $this->success('获取成功', $data);
    }
    
    
    
       /**
     * 获取宠物列表
     */
    public function list()
    {
        $data = PetModel::where(['uid'=>$this->uuid])->field('id,name,images')->append(['avatar'])->select();
        $this->success('获取成功', $data);
    }
    
    
    
    
     /**
     * 删除宠物
     */
    public function del()
    {
        $input = $this->_vali([
                'uid.default'   =>$this->uuid,
                'id.number'   => 'petid必须为整数！',
         ]);
        $data = PetModel::where($input)->delete();
        $this->success('删除成功');
    }
    
    
    
    
    
      
     /**
     *  修改宠物
     */
    public function update()
    {
        $input = $this->_vali([
                'id.number'   =>'id必须为整数！',
                'uid.default'   =>$this->uuid,
                'name.require'        => 'name不能为空！',
                'images.require'        => '图片不能为空！',
                'age.require'        => 'age不能为空！',
                'pettype.in:1,2'      => 'pettype必须为1,2之间！',
                'is_vaccin.in:1,0' => 'is_vaccin必须为1,2之间！',
                'sex.in:1,2' => 'sex必须为1,2之间！',
                'shape.in:1,2,3' => 'shape必须为1,2,3之间！',
                'intro.default'   => '',
         ]);
        $id = $input['id'];
        unset($input['id']);
        $data = PetModel::where(['id'=>$id])->update($input);
        $this->success('修改成功', $data);
    }
    
    
}