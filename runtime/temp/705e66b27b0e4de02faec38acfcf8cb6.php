<?php /*a:3:{s:78:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/store/view/commission/index.html";i:1677831443;s:83:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/store/view/../../admin/view/main.html";i:1670552399;s:85:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/store/view/commission/index_search.html";i:1677829568;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form class="layui-form layui-form-pane form-search" action="<?php echo sysuri(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label">合作店</label><label class="layui-input-inline"><select class="layui-select" name="store_id"><option value=''>-- 全部 --</option><?php foreach($stores as $k=>$v): if(input('store_id') == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v['name'],ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v['name'],ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">状态</label><div class="layui-input-inline"><select name='status' lay-search class="layui-select"><option value=''>-- 全部 --</option><?php foreach(['未结算','已结算'] as $key=>$value): if($key == input('get.status')): ?><option selected value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form></fieldset><script></script><table id="CommissionTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        $('#CommissionTable').layTable({
            even: true, height: 'full',
            sort: {field: 'id', type: 'desc'},
            cols: [[
                {checkbox: true},
                {field: 'id', title: 'ID', width: 80, sort: true, align: 'center'},
                {field: 'order_no', title: '对应订单', minWidth: 20, align: 'center'},
                {field: 'store_name', title: '门店名', minWidth: 20, align: 'center'},
                {field: 'amount', title: '收益', minWidth: 20, sort: true, align: 'center'},
                {field: 'status_text', title: '结算情况', minWidth: 30},
                {field: 'create_at', title: '产生时间', minWidth: 30, sort: true},
                {field: 'settle_at', title: '结算时间', minWidth: 150, sort: true},
            ]]
        });
    });
</script></div>