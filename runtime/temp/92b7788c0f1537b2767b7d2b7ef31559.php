<?php /*a:3:{s:67:"/www/wwwroot/uexwash.com/ThinkAdmin/app/wechat/view/fans/index.html";i:1670552399;s:79:"/www/wwwroot/uexwash.com/ThinkAdmin/app/wechat/view/../../admin/view/table.html";i:1670552399;s:74:"/www/wwwroot/uexwash.com/ThinkAdmin/app/wechat/view/fans/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("black")): ?>--><button data-action='<?php echo url("black"); ?>' data-table-id="UserData" data-rule="openid#{openid};black#1" class='layui-btn layui-btn-sm layui-btn-primary'>拉入黑名单</button><button data-action='<?php echo url("black"); ?>' data-table-id="UserData" data-rule="openid#{openid};black#0" class='layui-btn layui-btn-sm layui-btn-primary'>移出黑名单</button><!--<?php endif; ?>--><!--<?php if(auth("truncate")): ?>--><button data-load='<?php echo url("truncate"); ?>' data-confirm="确定要清空所有用户数据吗？" class='layui-btn layui-btn-sm layui-btn-primary'>清空用户数据</button><!--<?php endif; ?>--><!--<?php if(auth("sync")): ?>--><button data-queue='<?php echo url("sync"); ?>' data-table-id="UserData" data-confirm="确定要创建同步用户数据的后台任务？" class='layui-btn layui-btn-sm layui-btn-primary'>同步用户数据</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form class="layui-form layui-form-pane form-search" action="<?php echo request()->url(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label">微信昵称</label><label class="layui-input-inline"><input name="nickname" value="<?php echo htmlentities((isset($get['nickname']) && ($get['nickname'] !== '')?$get['nickname']:''),ENT_QUOTES); ?>" placeholder="请输入微信昵称" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">订阅状态</label><label class="layui-input-inline"><select class="layui-select" name="subscribe"><option value=''>-- 全部 --</option><?php foreach(['显示未订阅的粉丝','显示已订阅的粉丝'] as $k=>$v): if(isset($get['subscribe']) and $get['subscribe'] == $k.""): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">拉黑状态</label><label class="layui-input-inline"><select class="layui-select" name="is_black"><option value=''>-- 全部 --</option><?php foreach(['显示未拉黑的粉丝','显示已拉黑的粉丝'] as $k=>$v): if(isset($get['is_black']) and $get['is_black'] == $k.""): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">订阅时间</label><label class="layui-input-inline"><input data-date-range name="subscribe_at" value="<?php echo htmlentities((isset($get['subscribe_at']) && ($get['subscribe_at'] !== '')?$get['subscribe_at']:''),ENT_QUOTES); ?>" placeholder="请选择订阅时间" class="layui-input"></label></div><div class="layui-form-item layui-inline"><button type="submit" class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button><button type="button" data-form-export="<?php echo url('index'); ?>?type=<?php echo htmlentities((isset($type) && ($type !== '')?$type:''),ENT_QUOTES); ?>" class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-export"></i> 导 出
            </button></div></form></fieldset><script>
    require(['excel'], function (excel) {
        excel.bind(function (data, sexs) {
            sexs = {1: '男', 2: '女'};
            data.forEach(function (item, index) {
                data[index] = [
                    item.openid || '',
                    item.nickname || '',
                    item.country || '',
                    item.province || '',
                    item.city || '',
                    sexs[item.sex] || '未知',
                    item.subscribe ? '已订阅' : '未订阅',
                    item.subscribe_at || '',
                    item.is_black ? '已拉黑' : '未拉黑',
                ];
            });
            data.unshift(['OPENID', '微信昵称', '所在国家', '所在省份', '所在城市', '性别', '订阅状态', '订阅时间', '是否拉黑']);
            return data;
        }, '微信粉丝数据');
    });
</script><table id="UserData" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        $('#UserData').layTable({
            even: true, height: 'full',
            sort: {field: 'subscribe_time', type: 'desc'},
            cols: [[
                {checkbox: true},
                {
                    field: 'headimg', title: '头像', width: 65, align: "center", templet: function (d) {
                        d.headimgurl = d.headimgurl || '';
                        return d.headimgurl ? '<div class="headimg headimg-xs margin-0" data-tips-image data-tips-hover data-lazy-src="' + d.headimgurl + '" style="background-image:url(' + d.headimgurl + ')"></div>' : '';
                    }
                },
                {field: 'nickname', title: '微信昵称', align: "center", minWidth: 100},
                {field: 'province', title: '所在区域', align: "center", minWidth: 120, templet: '<div>{{d.country}} {{d.province}} {{d.city}}</div>'},
                {field: 'sex', title: '性别', align: 'center', minWidth: 80, templet: '<div>{{d.sex==1 ? "男" : (d.sex==2 ? "女" : "未知")}}</div>'},
                {field: 'language', title: '使用语言', align: 'center', minWidth: 100, templet: '<div>{{d.language}}</div>'},
                {
                    field: 'subscribe', title: '订阅状态', align: "center", templet: function (d) {
                        if (d.subscribe > 0) return '<span class="layui-badge layui-bg-green">已订阅</span>';
                        else return '<span class="layui-badge">未订阅</span>';
                    }
                },
                {field: 'subscribe_time', title: '订阅时间', minWidth: 170, align: 'center', sort: true, templet: '<div>{{d.subscribe_at}}</div>'},
                {field: 'is_black', title: '是否黑名单', align: 'center', minWidth: 110, templet: '#StatusSwitchTpl'},
                {toolbar: '#toolbar', title: '操作面板', align: 'center', fixed: 'right'}
            ]]
        });

        // 数据状态切换操作
        layui.form.on('switch(StatusSwitch)', function (obj) {
            var data = {openid: obj.value, black: obj.elem.checked > 0 ? 1 : 0};
            $.form.load("<?php echo url('black'); ?>", data, 'post', function (ret) {
                if (ret.code < 1) $.msg.error(ret.info, 3, function () {
                    $('#UserData').trigger('reload'); // 操作异常时重载数据
                });
                return false;
            }, false);
        });
    });
</script><!-- 数据状态切换模板 --><script type="text/html" id="StatusSwitchTpl"><!--<?php if(auth("black")): ?>--><input type="checkbox" value="{{d.openid}}" lay-skin="switch" lay-text="已拉黑|未拉黑" lay-filter="StatusSwitch" {{d.is_black>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-red">已拉黑</b>' : '<b class="color-green">未拉黑</b>'}}
    <!--<?php endif; ?>--></script><script type="text/html" id="toolbar"><!--<?php if(auth("remove")): ?>--><a class="layui-btn layui-btn-sm layui-btn-danger" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}" data-confirm="确定要删除该用户吗？">删 除</a><!--<?php endif; ?>--></script></div>