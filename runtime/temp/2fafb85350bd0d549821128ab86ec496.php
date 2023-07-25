<?php /*a:3:{s:68:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/admin/view/oplog/index.html";i:1670552399;s:62:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/admin/view/table.html";i:1670552399;s:75:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/admin/view/oplog/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("remove")): ?>--><button data-table-id="OplogTable" data-action='<?php echo url("remove"); ?>' data-rule="id#{id}" data-confirm="确定要删除选中的日志吗？" class='layui-btn layui-btn-sm layui-btn-primary'>批量删除</button><!--<?php endif; ?>--><!--<?php if(auth("clear")): ?>--><button data-table-id="OplogTable" data-load='<?php echo url("clear"); ?>' data-confirm="确定要清空所有日志吗？" class='layui-btn layui-btn-sm layui-btn-primary'>清空日志</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-table"><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form class="layui-form layui-form-pane form-search" action="<?php echo sysuri(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label">操作账号</label><div class="layui-input-inline"><select name='username' lay-search class="layui-select"><option value=''>-- 全部账号 --</option><?php foreach($users as $user): if($user == input('get.username')): ?><option selected value="<?php echo htmlentities($user,ENT_QUOTES); ?>"><?php echo htmlentities($user,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($user,ENT_QUOTES); ?>"><?php echo htmlentities($user,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">操作行为</label><div class="layui-input-inline"><select name="action" lay-search class="layui-select"><option value=''>-- 全部行为 --</option><?php foreach($actions as $action): if($action == input('get.action')): ?><option selected value="<?php echo htmlentities($action,ENT_QUOTES); ?>"><?php echo htmlentities($action,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($action,ENT_QUOTES); ?>"><?php echo htmlentities($action,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">操作节点</label><label class="layui-input-inline"><input name="node" value="<?php echo htmlentities((isset($get['node']) && ($get['node'] !== '')?$get['node']:''),ENT_QUOTES); ?>" placeholder="请输入操作内容" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">操作描述</label><label class="layui-input-inline"><input name="content" value="<?php echo htmlentities((isset($get['content']) && ($get['content'] !== '')?$get['content']:''),ENT_QUOTES); ?>" placeholder="请输入操作内容" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">访问地址</label><label class="layui-input-inline"><input name="geoip" value="<?php echo htmlentities((isset($get['geoip']) && ($get['geoip'] !== '')?$get['geoip']:''),ENT_QUOTES); ?>" placeholder="请输入访问地址" class="layui-input"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">操作时间</label><label class="layui-input-inline"><input data-date-range name="create_at" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>" placeholder="请选择操作时间" class="layui-input"></label></div><div class="layui-form-item layui-inline"><button type="submit" class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button><button type="button" data-form-export="<?php echo url('index'); ?>?type=<?php echo htmlentities((isset($type) && ($type !== '')?$type:''),ENT_QUOTES); ?>" class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-export"></i> 导 出
            </button></div></form></fieldset><script>
    require(['excel'], function (excel) {
        excel.bind(function (data) {

            // 设置表格内容
            data.forEach(function (item, index) {
                data[index] = [item.id, item.username, item.node, item.geoip, item.geoisp, item.action, item.content, item.create_at];
            });

            // 设置表头内容
            data.unshift(['ID', '操作账号', '访问节点', '访问IP地址', '访问地理区域', '访问操作', '操作内容', '操作时间']);

            // 自动计算列序号
            var lastCol = layui.excel.numToTitle(data[0].length || 0);

            // 设置表头样式
            layui.excel.setExportCellStyle(data, 'A1:' + lastCol + '1', {
                s: {
                    font: {sz: 12, bold: true, color: {rgb: "FFFFFF"}, name: '微软雅黑', shadow: true},
                    fill: {bgColor: {indexed: 64}, fgColor: {rgb: "5FB878"}},
                    alignment: {vertical: 'center', horizontal: 'center'}
                }
            });

            // 设置内容样式
            var style1 = {
                font: {sz: 10, shadow: true, name: '微软雅黑'},
                fill: {bgColor: {indexed: 64}, fgColor: {rgb: "EAEAEA"}},
                alignment: {vertical: 'center', horizontal: 'center'}
            }, style2 = {
                font: {sz: 10, shadow: true, name: '微软雅黑'},
                fill: {bgColor: {indexed: 64}, fgColor: {rgb: "FFFFFF"}},
                alignment: {vertical: 'center', horizontal: 'center'}
            };
            // 动态应用样式
            layui.excel.setExportCellStyle(data, 'A2:' + lastCol + data.length, {s: style1}, function (raw, cell, list, conf, rows, cols) {
                // @var raw  原有单元格数据
                // @var cell 新的单元格数据
                // @var list 所在行数据列表
                // @var conf 当前样式配置
                // @var rows 当前行的标号
                // @var cols 当前列的标号
                return (rows % 2 === 0) ? cell : (Object.assign({}, cell, {s: style2}));
            });

            // 设置表格行宽高，需要设置最后的行或列宽高，否则部分不生效 ？？？
            var rowsC = {1: 33}, colsC = {A: 60, B: 80, C: 99, E: 80, G: 120};
            rowsC[data.length] = 28, colsC[lastCol] = 160;
            this.options.extend = {
                '!rows': layui.excel.makeRowConfig(rowsC, 28), // 设置每行高度，默认 33
                '!cols': layui.excel.makeColConfig(colsC, 99), // 设置每行宽度，默认 99
            };

            // 其他更多样式，可以配置 this.options.extend 参数，每次执行 bind 会被重置
            // 在线文档：http://excel.wj2015.com/_book/docs/%E5%87%BD%E6%95%B0%E5%88%97%E8%A1%A8/%E6%A0%B7%E5%BC%8F%E8%AE%BE%E7%BD%AE%E7%9B%B8%E5%85%B3%E5%87%BD%E6%95%B0.html

            return data;
        }, '操作日志' + layui.util.toDateString(Date.now(), '_yyyyMMdd_HHmmss'));
    });
</script><table id="OplogTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        $('#OplogTable').layTable({
            even: true, height: 'full',
            sort: {field: 'id', type: 'desc'},
            cols: [[
                {checkbox: true},
                {field: 'id', title: 'ID', width: 80, sort: true, align: 'center'},
                {field: 'username', title: '操作账号', minWidth: 100, sort: true, align: 'center'},
                {field: 'node', title: '操作节点', minWidth: 120},
                {field: 'action', title: '操作行为', minWidth: 120},
                {field: 'content', title: '操作描述', minWidth: 150},
                {field: 'geoip', title: '访问地址', minWidth: 100},
                {field: 'geoisp', title: '网络服务商', minWidth: 100},
                {field: 'create_at', title: '操作时间', minWidth: 170, align: 'center', sort: true},
                {toolbar: '#toolbar', title: '操作面板', align: 'center', minWidth: 80, fixed: 'right'}
            ]]
        });
    });
</script><script type="text/html" id="toolbar"><!--<?php if(auth('remove')): ?>--><a data-action='<?php echo url("remove"); ?>' data-value="id#{{d.id}}" data-confirm="确认要删除这条记录吗？" class="layui-btn layui-btn-sm layui-btn-danger">删 除</a><!--<?php endif; ?>--></script></div>