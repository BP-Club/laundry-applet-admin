<?php /*a:3:{s:67:"/www/wwwroot/uexwash.com/ThinkAdmin/app/admin/view/queue/index.html";i:1670552399;s:61:"/www/wwwroot/uexwash.com/ThinkAdmin/app/admin/view/table.html";i:1670552399;s:74:"/www/wwwroot/uexwash.com/ThinkAdmin/app/admin/view/queue/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(isset($super) and $super): ?>--><a data-table-id="QueueTable" class="layui-btn layui-btn-sm layui-btn-primary" data-queue="<?php echo url('admin/api.plugs/optimize'); ?>">优化数据库</a><!--<?php endif; ?>--><!--<?php if(isset($super) and $super and $iswin): ?>--><button data-load='<?php echo url("admin/api.queue/start"); ?>' class='layui-btn layui-btn-sm layui-btn-primary'>开启服务</button><button data-load='<?php echo url("admin/api.queue/stop"); ?>' class='layui-btn layui-btn-sm layui-btn-primary'>关闭服务</button><!--<?php endif; ?>--><!--<?php if(auth("clean")): ?>--><button data-table-id="QueueTable" data-queue='<?php echo url("clean"); ?>' class='layui-btn layui-btn-sm layui-btn-primary'>定时清理</button><!--<?php endif; ?>--><!--<?php if(auth("remove")): ?>--><button data-table-id="QueueTable" data-action='<?php echo url("remove"); ?>' data-rule="id#{id}" data-confirm="确定批量删除记录吗？" class='layui-btn layui-btn-sm layui-btn-primary'>批量删除</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="think-box-notify"><!--<?php if(isset($super) and $super): ?>--><b>服务状态：</b><b class="margin-right-5" data-queue-message><span class="color-desc">检查中</span></b><b data-tips-text="点击可复制【服务启动指令】" class="layui-icon pointer margin-right-20" data-copy="<?php echo htmlentities((isset($command) && ($command !== '')?$command:''),ENT_QUOTES); ?>">&#xe60e;</b><script>$('[data-queue-message]').load('<?php echo sysuri("admin/api.queue/status"); ?>');</script><!--<?php endif; ?>--><b>任务统计：</b>待处理 <b class="color-text" data-extra="pre"><?php echo htmlentities((isset($total['pre']) && ($total['pre'] !== '')?$total['pre']:0),ENT_QUOTES); ?></b> 个任务，处理中 <b class="color-blue" data-extra="dos"><?php echo htmlentities((isset($total['dos']) && ($total['dos'] !== '')?$total['dos']:0),ENT_QUOTES); ?></b> 个任务，已完成 <b class="color-green" data-extra="oks"><?php echo htmlentities((isset($total['oks']) && ($total['oks'] !== '')?$total['oks']:0),ENT_QUOTES); ?></b> 个任务，已失败 <b class="color-red" data-extra="ers"><?php echo htmlentities((isset($total['ers']) && ($total['ers'] !== '')?$total['ers']:0),ENT_QUOTES); ?></b> 个任务。
</div><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form class="layui-form layui-form-pane form-search" action="<?php echo sysuri(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label">编号名称</label><label class="layui-input-inline"><input name="title" value="<?php echo htmlentities((isset($get['title']) && ($get['title'] !== '')?$get['title']:''),ENT_QUOTES); ?>" placeholder="请输入名称或编号" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">任务指令</label><label class="layui-input-inline"><input name="command" value="<?php echo htmlentities((isset($get['command']) && ($get['command'] !== '')?$get['command']:''),ENT_QUOTES); ?>" placeholder="请输入任务指令" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">任务状态</label><label class="layui-input-inline"><select name="status" class="layui-select"><option value=''>-- 全部任务 --</option><?php foreach(['1'=>'等待处理','2'=>'正在处理','3'=>'处理完成','4'=>'处理失败'] as $k=>$v): if(isset($get['status']) and $get['status'] == $k): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">计划时间</label><label class="layui-input-inline"><input data-date-range name="exec_time" value="<?php echo htmlentities((isset($get['exec_time']) && ($get['exec_time'] !== '')?$get['exec_time']:''),ENT_QUOTES); ?>" placeholder="请选择计划时间" class="layui-input"></label></div><div class="layui-form-item layui-inline layui-hide"><label class="layui-form-label">执行时间</label><label class="layui-input-inline"><input data-date-range name="enter_time" value="<?php echo htmlentities((isset($get['enter_time']) && ($get['enter_time'] !== '')?$get['enter_time']:''),ENT_QUOTES); ?>" placeholder="请选择执行时间" class="layui-input"></label></div><div class="layui-form-item layui-inline layui-hide"><label class="layui-form-label">创建时间</label><label class="layui-input-inline"><input data-date-range name="create_at" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>" placeholder="请选择创建时间" class="layui-input"></label></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form></fieldset><table id="QueueTable" data-line="2" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        $('#QueueTable').layTable({
            even: true, height: 'full',
            sort: {field: 'loops_time desc,id', type: 'desc'},
            // 扩展数据处理，需要返回原 items 数据
            filter: function (items, result) {
                return result && result.extra && $('[data-extra]').map(function () {
                    this.innerHTML = result.extra[this.dataset.extra] || 0;
                }), items;
            },
            cols: [[
                {checkbox: true, fixed: 'left'},
                {
                    field: 'id', title: '任务名称', width: '25%', sort: true, templet: function (d) {
                        if (d.loops_time > 0) {
                            d.one = '<span class="layui-badge think-bg-blue">循</span>';
                        } else {
                            d.one = '<span class="layui-badge think-bg-red">次</span>';
                        }
                        if (d.rscript === 1) {
                            d.two = '<span class="layui-badge layui-bg-green">复</span>';
                        } else {
                            d.two = '<span class="layui-badge think-bg-violet">单</span>';
                        }
                        return laytpl('{{-d.one}}任务编号：<b>{{d.code}}</b><br>{{-d.two}}任务名称：{{d.title}}').render(d);
                    }
                },
                {
                    field: 'exec_time', title: '任务计划', width: '25%', templet: function (d) {
                        d.html = '执行指令：' + d.command + '<br>计划执行：' + d.exec_time;
                        if (d.loops_time > 0) {
                            return d.html + ' ( 每 <b class="color-blue">' + d.loops_time + '</b> 秒 ) ';
                        } else {
                            return d.html + ' <span class="color-desc">( 单次任务 )</span> ';
                        }
                    }
                },
                {
                    field: 'loops_time', title: '执行状态', width: '30%', templet: function (d) {
                        d.html = ([
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-gray">未知</span>',
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-black">等待</span>',
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-blue">执行</span>',
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-green">完成</span>',
                            '<span class="pull-left layui-badge layui-badge-middle layui-bg-red">失败</span>',
                        ][d.status] || '') + '执行时间：';
                        d.enter_time = d.enter_time || '', d.outer_time = d.outer_time || '0.0000';
                        if (d.enter_time.length > 12) {
                            d.html += d.enter_time.substring(12) + '<span class="color-desc"> ( 耗时 ' + d.outer_time + ' ) </span>';
                            d.html += ' 已执行 <b class="color-blue">' + (d.attempts || 0) + '</b> 次';
                        } else {
                            d.html += '<span class="color-desc">任务未执行</span>'
                        }
                        return d.html + '<br>执行结果：<span class="color-blue">' + (d.exec_desc || '<span class="color-desc">未获取到执行结果</span>') + '</span>';
                    }
                },
                {toolbar: '#toolbar', title: '操作面板', align: 'center', minWidth: 210, fixed: 'right'}
            ]]
        });
    });
</script><script type="text/html" id="toolbar"><!--<?php if(auth('redo')): ?>-->
    {{# if(d.status===4||d.status===3){ }}
    <a class="layui-btn layui-btn-sm" data-confirm="确定要重置该任务吗？" data-queue="<?php echo url('redo'); ?>?code={{d.code}}">重 置</a>
    {{# }else{ }}
    <a class="layui-btn layui-btn-sm layui-btn-disabled">重 置</a>
    {{# } }}
    <!--<?php endif; ?>--><!--<?php if(auth('remove')): ?>--><a class='layui-btn layui-btn-sm layui-btn-danger' data-confirm="确定要删除该任务吗？" data-action='<?php echo url("remove"); ?>' data-value="id#{{d.id}}">删 除</a><!--<?php endif; ?>--><a class='layui-btn layui-btn-sm layui-btn-normal' onclick="$.loadQueue('{{d.code}}',false,this)">日 志</a></script></div>