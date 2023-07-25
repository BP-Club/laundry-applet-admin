<?php /*a:3:{s:67:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/admin/view/file/index.html";i:1670552399;s:62:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/admin/view/table.html";i:1670552399;s:74:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/admin/view/file/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("distinct")): ?>--><a data-table-id="FileTable" data-load='<?php echo url("distinct"); ?>' class='layui-btn layui-btn-sm layui-btn-primary'>清理重复</a><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><a data-confirm="确定永久删除这些账号吗？" data-table-id="FileTable" data-action='<?php echo url("remove"); ?>' data-rule="id#{id}" class='layui-btn layui-btn-sm layui-btn-primary'>批量删除</a><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form class="layui-form layui-form-pane form-search" action="<?php echo sysuri(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label">文件名称</label><label class="layui-input-inline"><input name="name" value="<?php echo htmlentities((isset($get['name']) && ($get['name'] !== '')?$get['name']:''),ENT_QUOTES); ?>" placeholder="请输入文件名称" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">文件哈希</label><label class="layui-input-inline"><input name="hash" value="<?php echo htmlentities((isset($get['hash']) && ($get['hash'] !== '')?$get['hash']:''),ENT_QUOTES); ?>" placeholder="请输入文件哈希" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">文件后缀</label><div class="layui-input-inline"><select name="xext" lay-search class="layui-select"><option value=''>-- 全部后缀 --</option><?php foreach($xexts as $v): if(isset($get['xext']) and $k == $get['xext']): ?><option selected value="<?php echo htmlentities($v,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($v,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">存储方式</label><div class="layui-input-inline"><select name="type" lay-search class="layui-select"><option value=''>-- 全部方式 --</option><?php foreach($types as $k=>$v): if(isset($get['type']) and $k == $get['type']): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">上传时间</label><div class="layui-input-inline"><input data-date-range name="create_at" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>" placeholder="请选择上传时间" class="layui-input"></div></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form></fieldset><table id="FileTable" data-url="<?php echo sysuri('index'); ?>" data-target-search="form.form-search"></table></div><script>
    $(function () {
        $('#FileTable').layTable({
            even: true, height: 'full',
            sort: {field: 'id', type: 'desc'},
            cols: [[
                {checkbox: true, fixed: true},
                {field: 'id', title: 'ID', width: 80, align: 'center', sort: true},
                {field: 'name', title: '文件名称', width: '12%', align: 'center'},
                {field: 'hash', title: '文件哈希', width: '15%', align: 'center', templet: '<div><code>{{d.hash}}</code></div>'},
                {
                    field: 'size', title: '文件大小', align: 'center', width: '8%', sort: true, templet: function (d) {
                        return $.formatFileSize(d.size)
                    }
                },
                {field: 'xext', title: '文件后缀', align: 'center', width: '8%', sort: true},
                {
                    field: 'xurl', title: '查看文件', width: '8%', align: 'center', templet: function (d) {
                        if (typeof d.mime === 'string' && /^image\//.test(d.mime)) {
                            return laytpl('<div class="headimg headimg-no headimg-ss margin-0" data-tips-hover data-tips-image="{{d.xurl}}" style="background-image:url({{d.xurl}})"></div>').render(d)
                        } else if (typeof d.mime === 'string' && /^(video|audio)\//.test(d.mime)) {
                            return laytpl('<div><a target="_blank" data-iframe="{{d.xurl}}" data-title="查看媒体">查看</a></div>').render(d);
                        } else {
                            return laytpl('<div><a target="_blank" href="{{d.xurl}}">查看</a></div>').render(d);
                        }
                    }
                },
                {
                    field: 'isfast', title: '上传方式', align: 'center', width: '8%', templet: function (d) {
                        return d.isfast ? '<b class="color-green">秒传</b>' : '<b class="color-blue">普通</b>';
                    }
                },
                {field: 'ctype', title: '存储方式', align: 'center', width: '10%'},
                {field: 'create_at', title: '上传时间', align: 'center', width: '15%', sort: true},
                {toolbar: '#toolbar', title: '操作面板', align: 'center', minWidth: 90, fixed: 'right'}
            ]]
        });
    });
</script><script type="text/html" id="toolbar"><!--<?php if(auth("remove")): ?>--><a class="layui-btn layui-btn-sm layui-btn-danger" data-action="<?php echo url('remove'); ?>" data-value="id#{{d.id}}">删 除</a><!--<?php endif; ?>--></script></div></div></div>