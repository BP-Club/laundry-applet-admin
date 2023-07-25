<?php

namespace app\data\controller\api;

use app\data\model\ShopGoods;
use app\data\model\ShopGoodsCate;
use app\data\model\ShopGoodsMark;
use app\data\service\ExpressService;
use app\data\service\GoodsService;
use think\admin\Controller;

/**
 * 商品数据接口
 * Class Goods
 * @package app\data\controller\api
 */
class Goods extends Controller
{
    
    
    
     /**
     * 获取首页分类
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getIndexCate()
    {
        $list = ShopGoodsCate::where(['pid'=>0])->field('id,name,cover,remark,status')->select()->toArray();
        $this->success('获取分类成功', $list);
    }
    
    
    
    
    /**
     * 获取分类数据
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getCate()
    {
        $data = $this->_vali(['top_id.require' => '顶级分类id不能为空！',
                              'top_id.number' => '顶级分类id必须为整数！',
                             ]);
        
        
        //$this->success('获取分类成功', ShopGoodsCate::treeData());
        $list = ShopGoodsCate::where(['pid'=>$data['top_id'],'status'=>1])->field('id,name,cover,remark,status')->select()->toArray();
        $this->success('获取分类成功', $list);
    }

    /**
     * 获取标签数据
     */
    public function getMark()
    {
        $this->success('获取标签成功', ShopGoodsMark::items());
    }

    /**
     * 获取商品数据
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getGoods()
    {
        
        //更新访问统计
        $map = $this->_vali(['code.default' => '',
                             'page.default' => 1,
                             'page.number' => '分页数必须为整数',
                             'cateid.default'    => '',
                             'cateid.number' => 'cateid必须为整数',
                            ]);
        $page = $map['page'];//1
        $pageCount = 10;
        $pageIndex = $page-1;
        if($page > 1){
            $pageIndex = $pageIndex * $pageCount;
        }
        //                     
        if ($map['code']) ShopGoods::mk()->where(['code'=>$map['code']])->inc('num_read')->update([]);
        // 商品数据处理
        $query = ShopGoods::mQuery()->db();
       
        $where = ['deleted'=> 0, 'status'=> 1];
        if(!empty($map['cateid'])){
          
          $query = $query->whereFindInSet('cateids',$map['cateid']);
        }
        $count = $query->where($where)->count();
        $result = $query->where($where)->order('sort desc,id desc')
                        ->limit($pageIndex,$pageCount)
                        ->select()
                        ->toArray();
        if (count($result) > 0) GoodsService::bindData($result);
        //处理sku属性格式，给前端
        //GoodsService::cuSpecArr($result);
        $this->success('获取商品数据', ['page'=>(int)$page,
                                        'pages'=>round($count/$pageCount),
                                        'list' =>$result
                                       ]);
    }
    
    
     /**
     * 获取商品详情
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public function getDetail()
    {
        // 更新访问统计
        $map = $this->_vali(['code.default' => '']);
        if ($map['code']) ShopGoods::mk()->where($map)->inc('num_read')->update([]);
        // 商品数据处理
        $result = ShopGoods::where(['code'=>$map['code'],'deleted' => 0, 'status' => 1])->select()->toArray();
        if (count($result) > 0) GoodsService::bindData($result);
        $result[0]['remark_short'] =  trim($result[0]['remark']);
        //计算长度，1个中文字符X3
        if(strlen($result[0]['remark_short']) > 15){
            $result[0]['remark_short'] = substr($result[0]['remark_short'],0,15).'...';
        }
        $this->success('获取成功', $result[0]);
    }
    
    
    

    /**
     *  获取配送区域
     */
    public function getRegion()
    {
        $this->success('获取区域成功', ExpressService::region(3, 1));
    }
}