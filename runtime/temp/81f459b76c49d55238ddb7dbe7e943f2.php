<?php /*a:3:{s:68:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/wechat/view/auto/index.html";i:1670552399;s:80:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/wechat/view/../../admin/view/table.html";i:1670552399;s:75:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/wechat/view/auto/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add") and $type == 'index'): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="AutoTable" data-width="950px" data-modal='<?php echo url("add"); ?>'>添加规则</button><!--<?php endif; ?>--><!--<?php if(auth("state") and $type == 'index'): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="AutoTable" data-action='<?php echo url("state"); ?>' data-rule="id#{id};status#0">批量禁用</button><!--<?php endif; ?>--><!--<?php if(auth("state") and $type != 'index'): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="AutoTable" data-action='<?php echo url("state"); ?>' data-rule="id#{id};status#1">批量启用</button><!--<?php endif; ?>--><!--<?php if(auth("remove") and $type != 'index'): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-table-id="AutoTable" data-action='<?php echo url("remove"); ?>' data-rule="id#{id}">批量删除</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="think-box-notify"><b>特别注意：</b>关注自动回复使用微信客服消息接口发送，因此多图文只能发送每组图文的第一篇文章，另外还需要开启系统任务功能。
</div><div class="layui-tab layui-tab-card think-bg-white"><ul class="layui-tab-title"><?php foreach(['index'=>'回复规则','recycle'=>'回 收 站'] as $k=>$v): if(isset($type) and $type == $k): ?><li class="layui-this" data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php else: ?><li data-open="<?php echo url('index'); ?>?type=<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></li><?php endif; ?><?php endforeach; ?></ul><div class="layui-tab-content"><form class="layui-form layui-form-pane form-search" action="<?php echo request()->url(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label">消息编号</label><div class="layui-input-inline"><input name="code" value="<?php echo htmlentities((isset($get['code']) && ($get['code'] !== '')?$get['code']:''),ENT_QUOTES); ?>" placeholder="请输入消息编号" class="layui-input"></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">消息类型</label><div class="layui-input-inline"><select class="layui-select" name="mtype"><option value="">-- 全部 --</option><?php foreach($types as $k => $v): if($k.'' == input('mtype')): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">使用状态</label><div class="layui-input-inline"><select class="layui-select" name="status"><option value="">-- 全部 --</option><?php foreach(['显示已禁止的消息','显示已激活的消息'] as $k=>$v): if(isset($get['status']) and $get['status'] == $k.""): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">添加时间</label><div class="layui-input-inline"><input data-date-range name="create_at" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>" placeholder="请选择添加时间" class="layui-input"></div></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form><table id="AutoTable" data-url="<?php echo htmlentities($request->url(),ENT_QUOTES); ?>" data-target-search="form.form-search"></table></div></div></div></div><script>
    $(function () {
        $('#AutoTable').layTable({
            even: true, height: 'full',
            sort: {field: 'time', type: 'asc'},
            where: {type: '<?php echo htmlentities((isset($type) && ($type !== '')?$type:"index"),ENT_QUOTES); ?>'},
            cols: [[
                {checkbox: true},
                {field: 'code', title: '消息编号', align: "center", minWidth: 100},
                {field: 'time', title: '延迟时间', align: "center", minWidth: 100},
                {field: 'type', title: '消息类型', align: "center", minWidth: 100},
                {field: 'code', title: '在线预览', align: "center", minWidth: 100, templet: '#PreViewTpl'},
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
                    $('#AutoTable').trigger('reload');
                }); else {
                    $('#AutoTable').trigger('reload');
                }
                return false;
            }, false);
        });
    });
</script><script type="text/html" id="PreViewTpl">
    {{# if(d.type==='音乐'){ }}
    <a data-phone-view='<?php echo url("@wechat/api.view/music"); ?>?title={{d.music_title}}&desc={{d.music_desc}}'>预览</a>
    {{# }else if(d.type==='图片'){ }}
    <a data-phone-view='<?php echo url("@wechat/api.view/image"); ?>?content={{d.image_url}}'>预览</a>
    {{# }else if(d.type==='图文'){ }}
    <a data-phone-view='<?php echo url("@wechat/api.view/news"); ?>?id={{d.news_id}}'>预览</a>
    {{# }else if(d.type==='视频'){ }}
    <a data-phone-view='<?php echo url("@wechat/api.view/video"); ?>?title={{d.video_title}}&desc={{d.video_desc}}&url={{d.video_url}}'>预览</a>
    {{# }else if(d.type==='语音'){ }}
    <a data-phone-view='<?php echo url("@wechat/api.view/voice"); ?>?content={{d.voice_url}}'>预览</a>
    {{# }else if(d.type==='文字'||d.type==='转客服'){ }}
    <a data-phone-view='<?php echo url("@wechat/api.view/text"); ?>?content={{d.content}}'>预览</a>
    {{# }else{ }}
    {{d.content}}
    {{# } }}
</script><!-- 状态切换模板 --><script type="text/html" id="StatusSwitchTpl"><!--<?php if(auth("state")): ?>--><input type="checkbox" value="{{d.id}}" lay-skin="switch" lay-text="已激活|已禁用" lay-filter="StatusSwitch" {{-d.status>0?'checked':''}}><!--<?php else: ?>-->
    {{-d.status ? '<b class="color-red">已激活</b>' : '<b class="color-green">已禁用</b>'}}
    <!--<?php endif; ?>--></script><!-- 操作面板模板 --><script type="text/html" id="toolbar"><!--<?php if(auth("edit") and isset($type) and $type == 'index'): ?>--><a class="layui-btn layui-btn-sm" data-width="950px" data-modal="<?php echo url('edit'); ?>?id={{d.id}}" data-title="编辑回复规则">编 辑</a><!--<?php endif; ?>--><!--<?php if(auth("remove") and isset($type) and $type != 'index'): ?>--><a class="layui-btn layui-btn-sm layui-btn-danger" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}" data-confirm="确定要删除该用户吗？">删 除</a><!--<?php endif; ?>--></script></div>