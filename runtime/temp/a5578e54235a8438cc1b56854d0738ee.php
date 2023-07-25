<?php /*a:2:{s:70:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/shop/cate/index.html";i:1670552399;s:77:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/table.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-modal='<?php echo url("add"); ?>' data-title="添加分类">添加分类</button><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-action='<?php echo url("remove"); ?>' data-rule="id#{sps}">删除分类</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="think-box-notify"><b>注意：</b>商品分类需要在上传商品前添加，当商品分类关联有商品时不建议进行 <b class="color-blue">移动</b> 或 <b class="color-blue">删除</b> 操作!
</div><div class="think-box-shadow"><table id="FormTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div><script>
    $(function () {
        $('#FormTable').layTable({
            even: true, height: 'full', page: false,
            sort: {field: 'sort desc,id', type: 'asc'},
            where: {type: '<?php echo htmlentities((isset($type) && ($type !== '')?$type:"index"),ENT_QUOTES); ?>'},
            cols: [[
                {checkbox: true, field: 'sps'},
                {field: 'sort', title: '排序权重', width: 100, align: 'center', sort: true, templet: '#SortInputTpl'},
                {
                    field: 'name', title: '分类名称', minWidth: 220, templet: function (d) {
                        return layui.laytpl('<span class="color-desc">{{d.spl}}</span>{{d.name}}').render(d);
                    }
                },
                {field: 'status', title: '分类状态', minWidth: 120, align: 'center', templet: '#StatusSwitchTpl'},
                {field: 'create_at', title: '创建时间', minWidth: 170, align: 'center'},
                {toolbar: '#toolbar', title: '操作面板', minWidth: 200, align: 'center', fixed: 'right'},
            ]]
        });

        // 数据状态切换操作
        layui.form.on('switch(StatusSwitch)', function (object) {
            object.data = {status: object.elem.checked > 0 ? 1 : 0};
            object.data.id = object.value.split('|')[object.data.status] || object.value;
            $.form.load("<?php echo url('state'); ?>", object.data, 'post', function (ret) {
                if (ret.code < 1) $.msg.error(ret.info, 3, function () {
                    $('#FormTable').trigger('reload');
                }); else {
                    $('#FormTable').trigger('reload');
                }
                return false;
            }, false);
        });
    });
</script><!-- 数据状态切换模板 --><script type="text/html" id="StatusSwitchTpl"><!--<?php if(auth("state")): ?>--><input type="checkbox" value="{{d.sps}}|{{d.spp}}" lay-text="已激活|已禁用" lay-filter="StatusSwitch" lay-skin="switch" {{-d.status>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-green">已激活</b>' : '<b class="color-red">已禁用</b>'}}
    <!--<?php endif; ?>--></script><!-- 列表排序权重模板 --><script type="text/html" id="SortInputTpl"><input type="number" min="0" data-blur-number="0" data-action-blur="<?php echo sysuri(); ?>" data-value="id#{{d.id}};action#sort;sort#{value}" data-loading="false" value="{{d.sort}}" class="layui-input text-center"></script><!-- 操控面板的模板 --><script type="text/html" id="toolbar"><!--<?php if(auth('add')): ?>-->
    {{# if(d.spt<'<?php echo htmlentities($maxLevel-1,ENT_QUOTES); ?>'){ }}
    <a class="layui-btn layui-btn-sm layui-btn-primary" data-title="添加商品分类" data-modal='<?php echo url("add"); ?>?pid={{d.id}}'>添 加</a>
    {{# }else{ }}
    <a class="layui-btn layui-btn-sm layui-btn-disabled">添 加</a>
    {{# } }}
    <!--<?php endif; ?>--><!--<?php if(auth('edit')): ?>--><a class="layui-btn layui-btn-sm" data-title="编辑商品分类" data-modal='<?php echo url("edit"); ?>?id={{d.id}}'>编 辑</a><!--<?php endif; ?>--><!--<?php if(auth('remove')): ?>--><a class="layui-btn layui-btn-sm layui-btn-danger" data-confirm="确定要删除此分类吗？" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.sps}}">删 除</a><!--<?php endif; ?>--></script></div></div></div>