<?php /*a:3:{s:66:"/www/wwwroot/uexwash.com/ThinkAdmin/app/admin/view/base/index.html";i:1670552399;s:61:"/www/wwwroot/uexwash.com/ThinkAdmin/app/admin/view/table.html";i:1670552399;s:73:"/www/wwwroot/uexwash.com/ThinkAdmin/app/admin/view/base/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add")): ?>--><button data-table-id="BaseTable" data-modal='<?php echo url("add"); ?>?type=<?php echo htmlentities((isset($type) && ($type !== '')?$type:""),ENT_QUOTES); ?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加数据</button><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><button data-table-id="BaseTable" data-action='<?php echo url("remove"); ?>' data-rule="id#{id}" data-confirm="确定要批量删除数据吗？" class='layui-btn layui-btn-sm layui-btn-primary'>批量删除</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="layui-tab layui-tab-card"><ul class="layui-tab-title"><?php foreach($types as $t): if(isset($type) and $type == $t): ?><li class="layui-this" data-open="<?php echo sysuri(); ?>?type=<?php echo htmlentities($t,ENT_QUOTES); ?>"><?php echo htmlentities($t,ENT_QUOTES); ?></li><?php else: ?><li data-open="<?php echo sysuri(); ?>?type=<?php echo htmlentities($t,ENT_QUOTES); ?>"><?php echo htmlentities($t,ENT_QUOTES); ?></li><?php endif; ?><?php endforeach; ?></ul><div class="layui-tab-content"><form class="layui-form layui-form-pane form-search" action="<?php echo sysuri(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label">数据编码</label><div class="layui-input-inline"><input name="code" value="<?php echo htmlentities((isset($get['code']) && ($get['code'] !== '')?$get['code']:''),ENT_QUOTES); ?>" placeholder="请输入数据编码" class="layui-input"></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">数据名称</label><div class="layui-input-inline"><input name="name" value="<?php echo htmlentities((isset($get['name']) && ($get['name'] !== '')?$get['name']:''),ENT_QUOTES); ?>" placeholder="请输入数据名称" class="layui-input"></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">使用状态</label><div class="layui-input-inline"><select class="layui-select" name="status"><option value=''>-- 状态 --</option><?php foreach(['已禁用的权限','已激活的权限'] as $k=>$v): if(isset($get['status']) and $get['status'] == $k.""): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">创建时间</label><div class="layui-input-inline"><input data-date-range name="create_at" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>" placeholder="请选择创建时间" class="layui-input"></div></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form><table id="BaseTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div></div><script>
    $(function () {
        // 初始化表格组件
        $('#BaseTable').layTable({
            even: true, height: 'full',
            sort: {field: 'sort desc,id', type: 'asc'},
            where: {type: '<?php echo htmlentities((isset($type) && ($type !== '')?$type:""),ENT_QUOTES); ?>'},
            cols: [[
                {checkbox: true, fixed: true},
                {field: 'sort', title: '排序权重', width: 100, align: 'center', sort: true, templet: '#SortInputTpl'},
                // {field: 'type', title: '数据类型', minWidth: 140, align: 'center'},
                {field: 'code', title: '数据编码', width: '20%', align: 'left'},
                {field: 'name', title: '数据名称', width: '30%', align: 'left'},
                {field: 'status', title: '数据状态', minWidth: 110, align: 'center', templet: '#StatusSwitchTpl'},
                {field: 'create_at', title: '创建时间', minWidth: 170, align: 'center', sort: true},
                {toolbar: '#toolbar', align: 'center', minWidth: 150, title: '数据操作', fixed: 'right'},
            ]]
        });

        // 数据状态切换操作
        layui.form.on('switch(StatusSwitch)', function (obj) {
            var data = {id: obj.value, status: obj.elem.checked > 0 ? 1 : 0};
            $.form.load("<?php echo url('state'); ?>", data, 'post', function (ret) {
                if (ret.code < 1) $.msg.error(ret.info, 3, function () {
                    $('#BaseTable').trigger('reload');
                });
                return false;
            }, false);
        });
    });
</script><!-- 列表排序权重模板 --><script type="text/html" id="SortInputTpl"><input type="number" min="0" data-blur-number="0" data-action-blur="<?php echo sysuri(); ?>" data-value="id#{{d.id}};action#sort;sort#{value}" data-loading="false" value="{{d.sort}}" class="layui-input text-center"></script><!-- 数据状态切换模板 --><script type="text/html" id="StatusSwitchTpl"><!--<?php if(auth("state")): ?>--><input type="checkbox" value="{{d.id}}" lay-skin="switch" lay-text="已激活|已禁用" lay-filter="StatusSwitch" {{-d.status>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-green">已启用</b>' : '<b class="color-red">已禁用</b>'}}
    <!--<?php endif; ?>--></script><!-- 数据操作工具条模板 --><script type="text/html" id="toolbar"><!--<?php if(auth('edit')): ?>--><a class="layui-btn layui-btn-primary layui-btn-sm" data-event-dbclick data-title="编辑数据" data-modal='<?php echo url("edit"); ?>?id={{d.id}}'>编 辑</a><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><a class="layui-btn layui-btn-danger layui-btn-sm" data-confirm="确定要删除数据吗?" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}">删 除</a><!--<?php endif; ?>--></script></div>