<?php /*a:3:{s:72:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/data/view/shop/goods/index.html";i:1670552399;s:77:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;s:79:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/data/view/shop/goods/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-open='<?php echo url("add"); ?>'>添加商品</button><!--<?php endif; ?>--><?php if(isset($type) and $type == 'index'): ?><!--<?php if(auth("remove")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-action='<?php echo url("remove"); ?>' data-rule="code#{key};deleted#1">删除商品</button><!--<?php endif; ?>--><?php else: ?><!--<?php if(auth("remove")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-action='<?php echo url("remove"); ?>' data-confirm="确定要恢复这些数据吗？" data-rule="code#{key};deleted#0">恢复商品</button><!--<?php endif; ?>--><?php endif; ?><!--<?php if(auth("goods.mark/index")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-modal='<?php echo url("shop.mark/index"); ?>' data-title="标签管理" data-width="920px">标签管理</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="layui-tab layui-tab-card think-bg-white"><ul class="layui-tab-title"><?php foreach(['index'=>'商品管理','recycle'=>'回 收 站'] as $k=>$v): if(isset($type) and $type == $k): ?><li class="layui-this" data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php else: ?><li data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php endif; ?><?php endforeach; ?></ul><div class="layui-tab-content"><form action="<?php echo sysuri(); ?>" autocomplete="off" class="layui-form layui-form-pane form-search" method="get" onsubmit="return false"><div class="layui-form-item layui-inline"><label class="layui-form-label">商品名称</label><label class="layui-input-inline"><input class="layui-input" name="name" placeholder="请输入编号或名称" value="<?php echo htmlentities((isset($get['name']) && ($get['name'] !== '')?$get['name']:''),ENT_QUOTES); ?>"></label></div><!--<?php if(!(empty($marks) || (($marks instanceof \think\Collection || $marks instanceof \think\Paginator ) && $marks->isEmpty()))): ?>--><div class="layui-form-item layui-inline"><label class="layui-form-label">商品标签</label><label class="layui-input-inline"><select class="layui-select" lay-search name="marks"><option value="">-- 全部标签 --</option><?php foreach($marks as $mark): if(input('marks','') == $mark): ?><option selected value="<?php echo htmlentities($mark,ENT_QUOTES); ?>"><?php echo htmlentities($mark,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($mark,ENT_QUOTES); ?>"><?php echo htmlentities($mark,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><!--<?php endif; ?>--><!--<?php if(!(empty($cates) || (($cates instanceof \think\Collection || $cates instanceof \think\Paginator ) && $cates->isEmpty()))): ?>--><div class="layui-form-item layui-inline"><label class="layui-form-label">商品分类</label><div class="layui-input-inline"><label class="layui-input-inline"><select class="layui-select" lay-search name="cateids"><option value="">-- 全部分类 --</option><?php foreach($cates as $cate): if(input('cateids') == $cate['id']): ?><option selected value="<?php echo htmlentities($cate['id'],ENT_QUOTES); ?>"><?php echo htmlentities($cate['spl'],ENT_QUOTES); ?><?php echo htmlentities((isset($cate['name']) && ($cate['name'] !== '')?$cate['name']:''),ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($cate['id'],ENT_QUOTES); ?>"><?php echo htmlentities($cate['spl'],ENT_QUOTES); ?><?php echo htmlentities((isset($cate['name']) && ($cate['name'] !== '')?$cate['name']:''),ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div></div><!--<?php endif; ?>--><div class="layui-form-item layui-inline"><label class="layui-form-label">销售状态</label><label class="layui-input-inline"><select class="layui-select" name="status"><option value=''>-- 全部状态 --</option><?php foreach(['已下架的商品','销售中的商品'] as $k=>$v): if(input('status','-') == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">返利状态</label><label class="layui-input-inline"><select class="layui-select" name="rebate_type"><option value=''>-- 全部状态 --</option><?php foreach(['非返利的商品','是返利的商品'] as $k=>$v): if(input('rebate_type','-') == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">入会礼包</label><label class="layui-input-inline"><select class="layui-select" name="vip_entry"><option value=''>-- 全部状态 --</option><?php foreach(['非入会礼包','是入会礼包'] as $k=>$v): if(input('vip_entry','-') == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">物流配送</label><label class="layui-input-inline"><select class="layui-select" name="truck_type"><option value=''>-- 全部状态 --</option><?php foreach(['无需物流配送', '需要物流配送'] as $k=>$v): if(input('truck_type','-') == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form><table class="layui-table margin-top-10" lay-skin="line"><?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?><thead><tr><th class='list-table-check-td think-checkbox'><label><input data-auto-none data-check-target='.list-check-box' type='checkbox'></label></th><th class='list-table-sort-td'><button class="layui-btn layui-btn-xs" data-reload type="button">刷 新</button></th><th class='text-left nowrap'>商品信息</th><th class='text-left nowrap'></th><th class='text-left nowrap'>商品状态</th><th></th></tr></thead><?php endif; ?><tbody><?php foreach($list as $key=>$vo): ?><tr><td class='list-table-check-td think-checkbox'><label><input class="list-check-box" type='checkbox' value='<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>'></label></td><td class='list-table-sort-td'><label><input class="list-sort-input" data-action-blur="<?php echo sysuri(); ?>" data-loading="false" data-value="id#<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>;action#sort;sort#{value}" value="<?php echo htmlentities($vo['sort'],ENT_QUOTES); ?>"></label></td><td class='nowrap'><?php if(!(empty($vo['cover']) || (($vo['cover'] instanceof \think\Collection || $vo['cover'] instanceof \think\Paginator ) && $vo['cover']->isEmpty()))): ?><div class="headimg headimg-no" data-tips-hover data-tips-image data-lazy-src="<?php echo htmlentities($vo['cover'],ENT_QUOTES); ?>"></div><?php endif; ?><div class="inline-block sub-span-blue"><div>商品名称：<span><?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:'--'),ENT_QUOTES); ?></span></div><div>商品编号：<span><?php echo htmlentities((isset($vo['code']) && ($vo['code'] !== '')?$vo['code']:'--'),ENT_QUOTES); ?></span></div></div></td><td><div><?php if(!(empty($vo['marks']) || (($vo['marks'] instanceof \think\Collection || $vo['marks'] instanceof \think\Paginator ) && $vo['marks']->isEmpty()))): foreach($vo['marks'] as $mark): ?><span class="notselect nowrap layui-badge layui-bg-cyan"><?php echo htmlentities($mark,ENT_QUOTES); ?></span><?php endforeach; ?><?php endif; ?></div><div class="nowrap"><?php if(!(empty($vo['cateinfo']) || (($vo['cateinfo'] instanceof \think\Collection || $vo['cateinfo'] instanceof \think\Paginator ) && $vo['cateinfo']->isEmpty()))): ?><?php echo join('<span class="layui-icon layui-icon-right font-s10 color-blue"></span>', $vo['cateinfo']['names']); ?><?php endif; ?></div></td><td class='nowrap'>
                    累计库存 <b><?php echo htmlentities($vo['stock_total'],ENT_QUOTES); ?></b> 件，剩余库存 <b><?php echo htmlentities($vo['stock_total']-$vo['stock_sales'],ENT_QUOTES); ?></b> 件 ( 已销售 <b><?php echo htmlentities($vo['stock_sales'],ENT_QUOTES); ?></b> 件 )
                    <div class="notselect margin-top-5"><?php if($vo['status'] == '0'): ?><span class="layui-badge layui-bg-gray layui-border-red">已下架</span><?php else: ?><span class="layui-badge layui-bg-gray layui-border-green">销售中</span><?php endif; if($vo['vip_entry'] == '0'): ?><span class="layui-badge layui-bg-gray layui-border-blue">非入会礼包</span><?php else: ?><span class="layui-badge layui-bg-gray layui-border-green">是入会礼包</span><?php endif; if($vo['truck_type'] == '0'): ?><span class="layui-badge layui-bg-gray layui-border-blue">无需发货</span><?php else: ?><span class="layui-badge layui-bg-gray layui-border-green">需要发货</span><?php endif; if($vo['rebate_type'] == '0'): ?><span class="layui-badge layui-bg-gray layui-border-blue">非返利商品</span><?php else: ?><span class="layui-badge layui-bg-gray layui-border-green">是返利商品</span><?php endif; ?></div></td><td class='nowrap sub-strong-blue'><!--<?php if(auth('copy')): ?>--><a class="layui-btn layui-btn-xs layui-btn-normal" data-open='<?php echo url("copy"); ?>?code=<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>'>复 制</a><!--<?php endif; ?>--><!--<?php if(auth("edit")): ?>--><a class="layui-btn layui-btn-xs" data-open='<?php echo url("edit"); ?>?code=<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>'>编 辑</a><!--<?php else: ?>--><a class="layui-btn layui-btn-xs layui-btn-primary layui-disabled" data-tips-text="您没有编辑商品的权限哦！">编 辑</a><!--<?php endif; ?>--><?php if(isset($type) and $type == 'index'): if(isset($vo['status']) and $vo['status'] == 1): ?><!--<?php if(auth("state")): ?>--><a class="layui-btn layui-btn-xs layui-btn-warm" data-action="<?php echo url('state'); ?>" data-value="code#<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>;status#0">下 架</a><!--<?php else: ?>--><a class="layui-btn layui-btn-xs layui-btn-primary layui-disabled" data-tips-text="您没有下架商品的权限哦！">下 架</a><!--<?php endif; ?>--><?php else: ?><!--<?php if(auth("state")): ?>--><a class="layui-btn layui-btn-xs layui-btn-warm" data-action="<?php echo url('state'); ?>" data-value="code#<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>;status#1">上 架</a><!--<?php else: ?>--><a class="layui-btn layui-btn-xs layui-btn-primary layui-disabled" data-tips-text="您没有上架商品的权限哦！">上 架</a><!--<?php endif; ?>--><?php endif; ?><!--<?php if(auth("stock")): ?>--><a class="layui-btn layui-btn-xs layui-btn-normal" data-modal='<?php echo url("stock"); ?>?code=<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>' data-title="商品入库">入 库</a><!--<?php else: ?>--><a class="layui-btn layui-btn-xs layui-btn-primary layui-disabled" data-tips-text="您没有商品入库的权限哦！">入 库</a><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><a class="layui-btn layui-btn-xs layui-btn-danger" data-action="<?php echo url('remove'); ?>" data-confirm="确定要移入回收站吗？" data-value="code#<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>;deleted#1">删 除</a><!--<?php endif; ?>--><?php else: ?><!--<?php if(auth("remove")): ?>--><a class="layui-btn layui-btn-xs layui-btn-normal" data-action="<?php echo url('remove'); ?>" data-value="code#<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>;deleted#0">恢 复</a><!--<?php endif; ?>--><?php endif; ?></td></tr><?php endforeach; ?></tbody></table><?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?><span class="notdata">没有记录哦</span><?php else: ?><?php echo (isset($pagehtml) && ($pagehtml !== '')?$pagehtml:''); ?><?php endif; ?></div></div></div></div></div>