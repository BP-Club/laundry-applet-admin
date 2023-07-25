<?php /*a:3:{s:73:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/base/message/index.html";i:1670552399;s:77:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/table.html";i:1670552399;s:80:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/base/message/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="MessageTable" data-open='<?php echo url("add"); ?>'>添加通知</button><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="MessageTable" data-action='<?php echo url("remove"); ?>' data-rule="id#{id}" data-confirm="确定要删除这些通知吗？">删除通知</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form action="<?php echo sysuri(); ?>" autocomplete="off" class="layui-form layui-form-pane form-search" method="get" onsubmit="return false"><div class="layui-form-item layui-inline"><label class="layui-form-label">通知标题</label><label class="layui-input-inline"><input class="layui-input" name="name" placeholder="请输入通知标题" value="<?php echo htmlentities((isset($get['name']) && ($get['name'] !== '')?$get['name']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">使用状态</label><div class="layui-input-inline"><select class="layui-select" name="status"><option value=''>-- 全部 --</option><?php foreach(['显示禁止的通知', '显示正常的通知'] as $k=>$v): if(isset($get['status']) and $get['status'] == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">创建时间</label><label class="layui-input-inline"><input class="layui-input" data-date-range name="create_at" placeholder="请选择创建时间" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form></fieldset><table id="MessageTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        // 初始化表格组件
        $('#MessageTable').layTable({
            even: true, height: 'full',
            sort: {field: 'sort desc,id', type: 'desc'},
            cols: [[
                {checkbox: true, fixed: true},
                {field: 'sort', title: '排序权重', align: 'center', width: 100, sort: true, templet: '#SortInputTpl'},
                {field: 'name', title: '通知标题', align: 'left', minWidth: 140},
                {field: 'num_read', title: '阅读次数', align: 'center', minWidth: 110},
                {field: 'status', title: '通知状态', align: 'center', minWidth: 110, templet: '#StatusSwitchTpl'},
                {field: 'create_at', title: '创建时间', align: 'center', minWidth: 170, sort: true},
                {toolbar: '#toolbar', title: '操作面板', align: 'center', minWidth: 140, fixed: 'right'},
            ]]
        });

        // 数据状态切换操作
        layui.form.on('switch(StatusSwitch)', function (obj) {
            var data = {id: obj.value, status: obj.elem.checked > 0 ? 1 : 0};
            $.form.load("<?php echo url('state'); ?>", data, 'post', function (ret) {
                if (ret.code < 1) $.msg.error(ret.info, 3, function () {
                    $('#MessageTable').trigger('reload');
                });
                return false;
            }, false);
        });
    });

</script><!-- 列表排序权重模板 --><script type="text/html" id="SortInputTpl"><input type="number" min="0" data-blur-number="0" data-action-blur="<?php echo sysuri(); ?>" data-value="id#{{d.id}};action#sort;sort#{value}" data-loading="false" value="{{d.sort}}" class="layui-input text-center"></script><!-- 数据状态切换模板 --><script type="text/html" id="StatusSwitchTpl"><!--<?php if(auth("state")): ?>--><input type="checkbox" value="{{d.id}}" lay-skin="switch" lay-text="已激活|已禁用" lay-filter="StatusSwitch" {{-d.status>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-green">已启用</b>' : '<b class="color-red">已禁用</b>'}}
    <!--<?php endif; ?>--></script><!-- 数据操作工具条模板 --><script type="text/html" id="toolbar"><!--<?php if(auth('edit')): ?>--><a class="layui-btn layui-btn-primary layui-btn-sm" data-open='<?php echo url("edit"); ?>?id={{d.id}}'>编 辑</a><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><a class="layui-btn layui-btn-danger layui-btn-sm" data-confirm="确定要删除问题吗?" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}">删 除</a><!--<?php endif; ?>--></script></div>