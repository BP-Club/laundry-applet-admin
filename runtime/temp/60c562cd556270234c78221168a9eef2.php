<?php /*a:3:{s:81:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/base/postage/company/index.html";i:1670552399;s:77:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/table.html";i:1670552399;s:88:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/base/postage/company/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("sync") and $type == 'index'): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-confirm="确定要同步快递公司数据吗？" data-load='<?php echo url("sync"); ?>'>同步公司</button><!--<?php endif; ?>--><!--<?php if(auth("add") and $type == 'index'): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-modal='<?php echo url("add"); ?>' data-title="添加快递公司">添加公司</button><!--<?php endif; ?>--><!--<?php if(auth("state") and $type == 'index'): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="DataTable" data-action='<?php echo url("state"); ?>' data-rule="id#{id};status#0">批量禁用</button><!--<?php endif; ?>--><!--<?php if(auth("state") and $type != 'index'): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="DataTable" data-action='<?php echo url("state"); ?>' data-rule="id#{id};status#1">批量启用</button><!--<?php endif; ?>--><!--<?php if(auth("remove") and $type != 'index'): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="DataTable" data-action='<?php echo url("remove"); ?>' data-rule="id#{id}">批量删除</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="layui-tab layui-tab-card think-bg-white"><ul class="layui-tab-title"><?php foreach(['index'=>'快递公司','recycle'=>'回 收 站'] as $k=>$v): if(isset($type) and $type == $k): ?><li class="layui-this" data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php else: ?><li data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php endif; ?><?php endforeach; ?></ul><div class="layui-tab-content"><form action="<?php echo sysuri(); ?>" autocomplete="off" class="layui-form layui-form-pane form-search" method="get" onsubmit="return false"><div class="layui-form-item layui-inline"><label class="layui-form-label">快递名称</label><label class="layui-input-inline"><input class="layui-input" name="name" placeholder="请输入快递名称" value="<?php echo htmlentities((isset($get['name']) && ($get['name'] !== '')?$get['name']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">快递编码</label><label class="layui-input-inline"><input class="layui-input" name="code" placeholder="请输入快递编码" value="<?php echo htmlentities((isset($get['code']) && ($get['code'] !== '')?$get['code']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">添加时间</label><label class="layui-input-inline"><input class="layui-input" data-date-range name="create_at" placeholder="请选择添加时间" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><input name="type" type="hidden" value="<?php echo htmlentities((isset($type) && ($type !== '')?$type:'index'),ENT_QUOTES); ?>"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form><table id="DataTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div></div><script>
    $(function () {
        $('#DataTable').layTable({
            even: true, height: 'full',
            sort: {field: 'sort desc,id', type: 'desc'},
            where: {type: '<?php echo htmlentities((isset($type) && ($type !== '')?$type:"index"),ENT_QUOTES); ?>'},
            cols: [[
                {checkbox: true},
                {field: 'sort', title: '排序权重', width: 100, align: 'center', sort: true, templet: '#SortInputTpl'},
                {field: 'name', title: '公司名称', align: "left", minWidth: 100},
                {field: 'code_1', title: '快递鸟编码', align: "left", minWidth: 100},
                {field: 'code_3', title: '快递100编码', align: "left", minWidth: 100},
                {field: 'status', title: '使用状态', align: 'center', minWidth: 110, templet: '#StatusSwitchTpl'},
                {field: 'create_at', title: '添加时间', align: 'center', minWidth: 170},
                {toolbar: '#toolbar', title: '操作面板', align: 'center', fixed: 'right'}
            ]]
        });

        // 数据状态切换操作
        layui.form.on('switch(StatusSwitch)', function (obj, data) {
            data = {id: obj.value, status: obj.elem.checked > 0 ? 1 : 0};
            $.form.load("<?php echo url('state'); ?>", data, 'post', function (ret) {
                if (ret.code < 1) $.msg.error(ret.info, 3, function () {
                    $('#DataTable').trigger('reload');
                }); else {
                    $('#DataTable').trigger('reload');
                }
                return false;
            }, false);
        });
    });
</script><!-- 排序权重模板 --><script type="text/html" id="SortInputTpl"><input type="number" min="0" data-blur-number="0" data-action-blur="<?php echo sysuri(); ?>" data-value="id#{{d.id}};action#sort;sort#{value}" data-loading="false" value="{{d.sort}}" class="layui-input text-center"></script><!-- 状态切换模板 --><script type="text/html" id="StatusSwitchTpl"><!--<?php if(auth("state")): ?>--><input type="checkbox" value="{{d.id}}" lay-skin="switch" lay-text="已激活|已禁用" lay-filter="StatusSwitch" {{-d.status>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-red">已激活</b>' : '<b class="color-green">已禁用</b>'}}
    <!--<?php endif; ?>--></script><!-- 操作面板模板 --><script type="text/html" id="toolbar"><!--<?php if(auth("edit") and isset($type) and $type == 'index'): ?>--><a class="layui-btn layui-btn-sm" data-modal="<?php echo url('edit'); ?>?id={{d.id}}" data-title="编辑快递公司">编 辑</a><!--<?php endif; ?>--><!--<?php if(auth("remove") and isset($type) and $type != 'index'): ?>--><a class="layui-btn layui-btn-sm layui-btn-danger" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}" data-confirm="确定要删除该用户吗？">删 除</a><!--<?php endif; ?>--></script></div>