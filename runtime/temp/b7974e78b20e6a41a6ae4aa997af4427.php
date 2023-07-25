<?php /*a:3:{s:79:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/base/upgrade/index.html";i:1670552399;s:83:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/../../admin/view/table.html";i:1670552399;s:86:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/base/upgrade/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="UpgradeTable" data-modal="<?php echo url('add'); ?>">添加等级</button><!--<?php endif; ?>--><!--<?php if(auth("sync")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-queue="<?php echo url('sync'); ?>">同步用户</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form action="<?php echo sysuri(); ?>" autocomplete="off" class="layui-form layui-form-pane form-search" method="get" onsubmit="return false"><div class="layui-form-item layui-inline"><label class="layui-form-label">等级名称</label><label class="layui-input-inline"><input class="layui-input" name="name" placeholder="请输入等级名称" value="<?php echo htmlentities((isset($get['name']) && ($get['name'] !== '')?$get['name']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">等级状态</label><div class="layui-input-inline"><select name="status"><option value="">-- 全部 --</option><?php foreach(['已禁用', '已激活'] as $k=>$v): if(input('status') == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">创建时间</label><div class="layui-input-inline"><input class="layui-input" data-date-range name="create_at" placeholder="请选择创建时间" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>"></div></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form></fieldset><table id="UpgradeTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        // 初始化表格组件
        $('#UpgradeTable').layTable({
            even: true, height: 'full',
            sort: {field: 'number', type: 'asc'},
            cols: [[
                {field: 'number', title: '序号', align: "center", width: 80, sort: true},
                {field: 'name', title: '等级名称', align: 'center', minWidth: 100},
                {
                    field: 'upgrade_team', title: '团队计数', align: 'center', width: 80, templet: function (d) {
                        if (!d.upgrade_team || d.upgrade_team < 1) return '-';
                        return '<b class="layui-icon layui-icon-ok-circle color-green"></b>';
                    }
                },
                {
                    field: 'upgrade_type', title: '升级规则', align: 'center', width: 80, templet: function (d) {
                        if (d.upgrade_type === 1) return '<span class="color-green">全部完成</span>';
                        else return '<span class="color-blue">任何条件</span>';
                    }
                },
                {
                    field: 'goods_vip_status', title: '入会礼包', align: 'center', width: 80, templet: function (d) {
                        if (!d.goods_vip_status || d.goods_vip_status < 1) return '-';
                        return '<b class="layui-icon layui-icon-ok-circle color-green"></b>';
                    }
                },
                {
                    field: 'teams_users_status', title: '团队总数', align: 'center', width: 80, templet: function (d) {
                        if (!d.teams_users_status || d.teams_users_status < 1) return '-';
                        return laytpl('<b>{{d.teams_users_number}}</b>').render(d);
                    }
                },
                {
                    field: 'teams_direct_status', title: '直属团队', align: 'center', width: 80, templet: function (d) {
                        if (!d.teams_direct_status || d.teams_direct_status < 1) return '-';
                        return laytpl('<b>{{d.teams_direct_number}}</b>').render(d);
                    }
                },
                {
                    field: 'teams_indirect_status', title: '间接团队', align: 'center', width: 80, templet: function (d) {
                        if (!d.teams_indirect_status || d.teams_indirect_status < 1) return '-';
                        return laytpl('<b>{{d.teams_indirect_number}}</b>').render(d);
                    }
                },
                {
                    field: 'order_amount_status', title: '订单金额', align: 'center', width: 80, templet: function (d) {
                        if (!d.order_amount_status || d.order_amount_status < 1) return '-';
                        return laytpl('<b>{{d.order_amount_number}}</b>').render(d);
                    }
                },
                {
                    field: 'rebate_rule', title: '奖利规则', align: 'left', minWidth: 100, templet: function (d) {
                        return (d.html = ''), layui.each(d.rebate_rule || {}, function (k, rule) {
                            d.html += laytpl('<span class="layui-badge layui-bg-gray">{{d.v}}</span>').render({v: rule});
                        }), d.html || '-';
                    }
                },
                {field: 'status', title: '等级状态', align: 'center', width: 110, templet: '#StatusSwitchTpl'},
                {field: 'create_at', title: '创建时间', align: 'center', width: 170, sort: true},
                {toolbar: '#toolbar', title: '操作面板', align: 'center', minWidth: 160, fixed: 'right'},
            ]]
        });

        // 数据状态切换操作
        layui.form.on('switch(StatusSwitch)', function (obj) {
            var data = {id: obj.value, status: obj.elem.checked > 0 ? 1 : 0};
            $.form.load("<?php echo url('state'); ?>", data, 'post', function (ret) {
                if (ret.code < 1) $.msg.error(ret.info, 3, function () {
                    $('#UpgradeTable').trigger('reload');
                });
                return false;
            }, false);
        });
    });

</script><!-- 列表排序权重模板 --><script type="text/html" id="SortInputTpl"><input type="number" min="0" data-blur-number="0" data-action-blur="<?php echo sysuri(); ?>" data-value="id#{{d.id}};action#sort;sort#{value}" data-loading="false" value="{{d.sort}}" class="layui-input text-center"></script><!-- 数据状态切换模板 --><script type="text/html" id="StatusSwitchTpl"><!--<?php if(auth("state")): ?>--><input type="checkbox" value="{{d.id}}" lay-skin="switch" lay-text="已激活|已禁用" lay-filter="StatusSwitch" {{-d.status>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-green">已启用</b>' : '<b class="color-red">已禁用</b>'}}
    <!--<?php endif; ?>--></script><!-- 数据操作工具条模板 --><script type="text/html" id="toolbar"><!--<?php if(auth('edit')): ?>--><a class="layui-btn layui-btn-primary layui-btn-sm" data-table-id="UpgradeTable" data-title="编辑等级" data-modal='<?php echo url("edit"); ?>?id={{d.id}}'>编 辑</a><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><a class="layui-btn layui-btn-danger layui-btn-sm" data-confirm="确定要删除等级吗?" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}">删 除</a><!--<?php endif; ?>--></script></div>