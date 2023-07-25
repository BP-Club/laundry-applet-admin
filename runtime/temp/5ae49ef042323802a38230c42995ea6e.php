<?php /*a:3:{s:81:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/market/view/coupon/grant/index.html";i:1675412431;s:84:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/market/view/../../admin/view/main.html";i:1670552399;s:88:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/market/view/coupon/grant/index_search.html";i:1675396253;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("add")): ?>--><button class='layui-btn layui-btn-sm layui-btn-primary' data-open='<?php echo url("coupon.item/grant"); ?>'>发放管理</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form class="layui-form layui-form-pane form-search" action="<?php echo sysuri(); ?>" onsubmit="return false" method="get" autocomplete="off"><div class="layui-form-item layui-inline"><label class="layui-form-label">优惠卷id</label><label class="layui-input-inline"><input class="layui-input" name="coupon_id" placeholder="请输入优惠卷id" value="<?php echo htmlentities((isset($get['couponid']) && ($get['couponid'] !== '')?$get['couponid']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form></fieldset><script></script><table id="CouponTable" data-url="<?php echo sysuri(); ?>" data-target-search="form.form-search"></table></div></div></div><script>
    $(function () {
        $('#CouponTable').layTable({
            even: true, height: 'full',
            sort: {field: 'id', type: 'desc'},
            cols: [[
                {checkbox: true},
                {field: 'id', title: 'ID', width: 80, sort: true, align: 'center'},
                {field: 'coupon_name', title: '优惠卷', minWidth: 20, sort: true, align: 'center'},
                {field: 'coupon_amount', title: '抵扣金额', minWidth: 20, sort: true, align: 'center'},
                {field: 'status_text', title: '状态', minWidth: 30},
                {field: 'user_name', title: '所属用户', minWidth: 50},
                {field: 'create_at', title: '发放时间', minWidth: 170, align: 'center', sort: true},
               
            ]]
        });
    });
</script><script type="text/html" id="toolbar"><!--<?php if(auth('remove')): ?>--><a data-action='<?php echo url("remove"); ?>' data-value="id#{{d.id}}" data-confirm="确认要删除这条记录吗？" class="layui-btn layui-btn-sm layui-btn-danger">删 除</a><!--<?php endif; ?>--><!--<?php if(auth("edit")): ?>--><a class="layui-btn layui-btn-sm"  data-open='<?php echo url("edit"); ?>?id={{d.id}}'>编 辑</a><!--<?php endif; ?>--></script></div>