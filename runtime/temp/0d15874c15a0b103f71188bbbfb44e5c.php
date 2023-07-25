<?php /*a:2:{s:77:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/project/view/additem/index.html";i:1670661549;s:85:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/project/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-open='<?php echo url("add"); ?>'>添加项目</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="think-box-shadow"><table id="Additem" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        $('#Additem').layTable({
            even: true, height: 'full',
            sort: {field: 'id', type: 'desc'},
            cols: [[
                {checkbox: true},
                {field: 'id', title: 'ID', width: 80, sort: true, align: 'center'},
                {field: 'title', title: '项目', minWidth: 20, sort: true, align: 'center'},
                {field: 'price', title: '起步价', minWidth: 20, sort: true, align: 'center'},
                {toolbar: '#toolbar', title: '操作面板', align: 'center', minWidth: 150, fixed: 'right'}
            ]]
        });
    });
</script><script type="text/html" id="toolbar"><!--<?php if(auth('remove')): ?>--><a data-action='<?php echo url("remove"); ?>' data-value="id#{{d.id}}" data-confirm="确认要删除这条记录吗？" class="layui-btn layui-btn-sm layui-btn-danger">删 除</a><!--<?php endif; ?>--><!--<?php if(auth("edit")): ?>--><a class="layui-btn layui-btn-sm"  data-open='<?php echo url("edit"); ?>?id={{d.id}}'>编 辑</a><!--<?php endif; ?>--></script></div>