<?php /*a:2:{s:80:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/base/discount/index.html";i:1670552399;s:83:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/../../admin/view/table.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="DiscountTable" data-modal="<?php echo url('add'); ?>" data-title="添加折扣">添加折扣</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="layui-tab layui-tab-card"><ul class="layui-tab-title"><?php foreach(['index'=>'折扣管理','recycle'=>'回 收 站'] as $k=>$v): if(isset($type) and $type == $k): ?><li data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>" class="layui-this"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php else: ?><li data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php endif; ?><?php endforeach; ?></ul><div class="layui-tab-content"><table id="DiscountTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div></div><script>
    $(function () {
        // 初始化表格组件
        $('#DiscountTable').layTable({
            even: true, height: 'full',
            sort: {field: 'sort desc,id', type: 'desc'},
            where: {type: '<?php echo htmlentities((isset($type) && ($type !== '')?$type:"index"),ENT_QUOTES); ?>'},
            cols: [[
                {field: 'id', title: 'ID', align: "center", width: 80},
                {field: 'sort', title: '排序权重', align: 'center', width: 100, sort: true, templet: '#SortInputTpl'},
                {field: 'name', title: '折扣名称', align: 'left', minWidth: 140},
                {
                    field: 'items', title: '折扣方案', align: 'left', width: '33%', templet: function (d) {
                        return (d.html = ''), d.items.forEach(function (item) {
                            d.html += laytpl('<span class="layui-badge layui-bg-gray">VIP{{d.level}} 折扣 {{d.discount}}%</span>').render(item);
                        }), d.html;
                    }
                },
                {field: 'status', title: '状态', align: 'center', width: 110, templet: '#StatusSwitchTpl'},
                {field: 'create_at', title: '创建时间', align: 'center', minWidth: 170, sort: true},
                {toolbar: '#toolbar', title: '操作面板', align: 'center', minWidth: 80, fixed: 'right'},
            ]]
        });

        // 数据状态切换操作
        layui.form.on('switch(StatusSwitch)', function (obj) {
            var data = {id: obj.value, status: obj.elem.checked > 0 ? 1 : 0};
            $.form.load("<?php echo url('state'); ?>", data, 'post', function (ret) {
                if (ret.code < 1) $.msg.error(ret.info, 3, function () {
                    $('#DiscountTable').trigger('reload');
                }); else {
                    $('#DiscountTable').trigger('reload');
                }
                return false;
            }, false);
        });
    });

</script><!-- 列表排序权重模板 --><script type="text/html" id="SortInputTpl"><input type="number" min="0" data-blur-number="0" data-action-blur="<?php echo sysuri(); ?>" data-value="id#{{d.id}};action#sort;sort#{value}" data-loading="false" value="{{d.sort}}" class="layui-input text-center"></script><!-- 数据状态切换模板 --><script type="text/html" id="StatusSwitchTpl"><!--<?php if(auth("state")): ?>--><input type="checkbox" value="{{d.id}}" lay-skin="switch" lay-text="已激活|已禁用" lay-filter="StatusSwitch" {{-d.status>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-green">已启用</b>' : '<b class="color-red">已禁用</b>'}}
    <!--<?php endif; ?>--></script><!-- 数据操作工具条模板 --><script type="text/html" id="toolbar"><!--<?php if(auth("edit") and isset($type) and $type == 'index'): ?>--><a class="layui-btn layui-btn-primary layui-btn-sm" data-title="编辑折扣" data-modal='<?php echo url("edit"); ?>?id={{d.id}}'>编 辑</a><!--<?php endif; ?>--><!--<?php if(auth("remove") and isset($type) and $type != 'index'): ?>--><a class="layui-btn layui-btn-danger layui-btn-sm" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}" data-confirm="确定要删除折扣吗?">删 除</a><!--<?php endif; ?>--></script></div>