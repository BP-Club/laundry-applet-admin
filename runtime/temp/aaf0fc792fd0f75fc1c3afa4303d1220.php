<?php /*a:3:{s:70:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/news/item/index.html";i:1670552399;s:77:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/table.html";i:1670552399;s:77:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/news/item/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add")): ?>--><button data-open='<?php echo url("add"); ?>' class='layui-btn layui-btn-sm layui-btn-primary'>添加文章</button><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><button data-action='<?php echo url("remove"); ?>' data-table-id="NewsTable" data-rule="id#{id}" data-confirm="确定要批量删除文章吗？" class='layui-btn layui-btn-sm layui-btn-primary'>批量删除</button><!--<?php endif; ?>--><!--<?php if(auth("news.mark/index")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-modal='<?php echo url("news.mark/index"); ?>' data-title="标签管理" data-width="920px">标签管理</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="layui-tab layui-tab-card"><ul class="layui-tab-title"><?php foreach(['index'=>'文章管理','recycle'=>'回 收 站'] as $k=>$v): if(isset($type) and $type == $k): ?><li data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>" class="layui-this"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php else: ?><li data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php endif; ?><?php endforeach; ?></ul><div class="layui-tab-content"><form action="<?php echo sysuri(); ?>" autocomplete="off" class="layui-form layui-form-pane form-search" method="get" onsubmit="return false"><!-- <?php if(!(empty($marks) || (($marks instanceof \think\Collection || $marks instanceof \think\Paginator ) && $marks->isEmpty()))): ?> --><div class="layui-form-item layui-inline"><label class="layui-form-label">文章标签</label><div class="layui-input-inline"><select name="mark" lay-search class="layui-select"><option value=''>-- 文章标签 --</option><?php foreach($marks as $mark): if(isset($get['mark']) and $mark['name'] == $get['mark']): ?><option selected value="<?php echo htmlentities($mark['name'],ENT_QUOTES); ?>"><?php echo htmlentities($mark['name'],ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($mark['name'],ENT_QUOTES); ?>"><?php echo htmlentities($mark['name'],ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><!-- <?php endif; ?> --><div class="layui-form-item layui-inline"><label class="layui-form-label">文章标题</label><label class="layui-input-inline"><input class="layui-input" name="name" placeholder="请输入文章标题" value="<?php echo htmlentities((isset($get['name']) && ($get['name'] !== '')?$get['name']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">创建时间</label><label class="layui-input-inline"><input class="layui-input" data-date-range name="create_at" placeholder="请选择创建时间" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form><table id="NewsTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div></div><script>
    $(function () {
        // 初始化表格组件
        $('#NewsTable').layTable({
            even: true, height: 'full',
            sort: {field: 'sort desc,code', type: 'desc'},
            where: {type: '<?php echo htmlentities((isset($type) && ($type !== '')?$type:"index"),ENT_QUOTES); ?>'},
            cols: [[
                {checkbox: true, fixed: true},
                {field: 'sort', title: '排序权重', align: 'center', width: 100, sort: true, templet: '#SortInputTpl'},
                {field: 'id', title: 'ID', align: "center", width: 80},
                /* {notempty name='marks'} */
                {
                    field: 'mark', title: '文章标签', align: 'left', minWidth: 100, templet: function (d) {
                        return (d.html = ''), d.mark.forEach(function (val) {
                            d.html += '<span class="layui-badge layui-bg-blue">' + val + '</span>';
                        }), d.html;
                    }
                },
                /* {/marks} */
                {
                    field: 'cover', title: '图片', width: 60, align: 'center', templet: function (d) {
                        if (!d.cover) return '';
                        return layui.laytpl('<div data-tips-image data-tips-hover class="headimg headimg-xs headimg-no margin-0" data-lazy-src="{{d.cover}}"></div>').render(d);
                    }
                },
                {field: 'name', title: '文章标题', align: 'left', minWidth: 140},
                {field: 'num_read', title: '阅读数', align: 'center', minWidth: 80, sort: true, style: 'color:blue;font-size:16px'},
                {field: 'status', title: '状态', align: 'center', minWidth: 110, templet: '#StatusSwitchTpl'},
                {field: 'create_at', title: '创建时间', align: 'center', minWidth: 170, sort: true},
                {toolbar: '#toolbar', title: '操作面板', align: 'center', minWidth: 80, fixed: 'right'},
            ]]
        });

        // 数据状态切换操作
        layui.form.on('switch(StatusSwitch)', function (obj) {
            var data = {id: obj.value, status: obj.elem.checked > 0 ? 1 : 0};
            $.form.load("<?php echo url('state'); ?>", data, 'post', function (ret) {
                if (ret.code < 1) $.msg.error(ret.info, 3, function () {
                    $('#NewsTable').trigger('reload');
                }); else {
                    $('#NewsTable').trigger('reload');
                }
                return false;
            }, false);
        });
    });

</script><!-- 列表排序权重模板 --><script type="text/html" id="SortInputTpl"><input type="number" min="0" data-blur-number="0" data-action-blur="<?php echo sysuri(); ?>" data-value="id#{{d.id}};action#sort;sort#{value}" data-loading="false" value="{{d.sort}}" class="layui-input text-center"></script><!-- 数据状态切换模板 --><script type="text/html" id="StatusSwitchTpl"><!--<?php if(auth("state")): ?>--><input type="checkbox" value="{{d.id}}" lay-skin="switch" lay-text="已激活|已禁用" lay-filter="StatusSwitch" {{-d.status>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-green">已启用</b>' : '<b class="color-red">已禁用</b>'}}
    <!--<?php endif; ?>--></script><!-- 数据操作工具条模板 --><script type="text/html" id="toolbar"><!--<?php if(auth("edit") and isset($type) and $type == 'index'): ?>--><a class="layui-btn layui-btn-primary layui-btn-sm" data-open='<?php echo url("edit"); ?>?id={{d.id}}'>编 辑</a><!--<?php endif; ?>--><!--<?php if(auth("remove") and isset($type) and $type != 'index'): ?>--><a class="layui-btn layui-btn-danger layui-btn-sm" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}" data-confirm="确定要删除文章吗?">删 除</a><!--<?php endif; ?>--></script></div>