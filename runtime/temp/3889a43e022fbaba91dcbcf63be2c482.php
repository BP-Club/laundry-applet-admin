<?php /*a:1:{s:70:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/shop/mark/index.html";i:1670552399;}*/ ?>
<div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form action="<?php echo sysuri(); ?>" id="TagsDataSearch" autocomplete="off" class="layui-form layui-form-pane nowrap form-search" method="get" onsubmit="return false"><div class="layui-form-item layui-inline"><label class="layui-form-label">标签名称</label><label class="layui-input-inline"><input class="layui-input" name="name" placeholder="请输入标签名称" value="<?php echo htmlentities((isset($get['name']) && ($get['name'] !== '')?$get['name']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">使用状态</label><div class="layui-input-inline"><select class="layui-select" name="status"><option value=''>-- 全部 --</option><?php foreach(['已禁用的记录','已激活的记录'] as $k=>$v): if(isset($get['status']) and $get['status'] == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">创建时间</label><label class="layui-input-inline"><input class="layui-input" data-date-range name="create_at" placeholder="请选择创建时间" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button><!-- <?php if(auth('add')): ?> --><button class="layui-btn" data-title="添加素材标签" data-modal="<?php echo url('add'); ?>" type="button"><i class="layui-icon">&#xe61f;</i> 添 加
                </button><!-- <?php endif; ?> --></div></form></fieldset><table id="TagsData" data-url="<?php echo sysuri(); ?>" data-target-search="#TagsDataSearch"></table></div><script>
    $(function () {
        $('#TagsData').layTable({
            even: true, height: 'full',
            sort: {field: 'sort desc,id', type: 'desc'},
            cols: [[
                {field: 'id', title: 'ID', width: 80, align: 'center', sort: true},
                {field: 'sort', title: '排序权重', width: 100, align: 'center', sort: true, templet: '#SortInputTagsDataTplModal'},
                {field: 'name', title: '标签名称', minWidth: 100},
                {field: 'status', title: '状态', width: 110, align: 'center', templet: '#StatusSwitchTagsDataTpl'},
                {field: 'create_at', title: '创建时间', minWidth: 170, align: 'center'},
                {toolbar: '#ToolbarTagsData', title: '操作面板', minWidth: 100, align: 'center', fixed: 'right'},
            ]]
        });

        // 数据状态切换操作
        layui.form.on('switch(StatusSwitchTagsData)', function (obj) {
            var data = {id: obj.value, status: obj.elem.checked > 0 ? 1 : 0};
            $.form.load("<?php echo url('state'); ?>", data, 'post', function (ret) {
                if (ret.code < 1) $.msg.error(ret.info, 3, function () {
                    $('#TagsData').trigger('reload');
                });
                return false;
            }, false);
        });
    });
</script><!-- 数据状态切换模板 --><script type="text/html" id="StatusSwitchTagsDataTpl"><!--<?php if(auth("state")): ?>--><input type="checkbox" value="{{d.id}}" lay-skin="switch" lay-text="已激活|已禁用" lay-filter="StatusSwitchTagsData" {{-d.status>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-green">已激活</b>' : '<b class="color-red">已禁用</b>'}}
    <!--<?php endif; ?>--></script><!-- 列表排序权重模板 --><script type="text/html" id="SortInputTagsDataTplModal"><input type="number" min="0" data-blur-number="0" data-action-blur="<?php echo sysuri(); ?>" data-value="id#{{d.id}};action#sort;sort#{value}" data-loading="false" value="{{d.sort}}" class="layui-input text-center"></script><!-- 操控面板的模板 --><script type="text/html" id="ToolbarTagsData"><!--<?php if(auth("edit")): ?>--><a class="layui-btn layui-btn-sm" data-title="编辑标签数据" data-modal='<?php echo url("edit"); ?>?id={{d.id}}'>编 辑</a><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><a class="layui-btn layui-btn-sm layui-btn-danger" data-confirm="确定要删除此标签吗？" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}">删 除</a><!--<?php endif; ?>--></script>