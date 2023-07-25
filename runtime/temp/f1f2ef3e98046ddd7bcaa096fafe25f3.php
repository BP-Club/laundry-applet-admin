<?php /*a:1:{s:75:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/market/view/coupon/item/grant.html";i:1675411768;}*/ ?>
<form action="<?php echo url('grant'); ?>" method="post" data-auto="true" class="layui-form layui-card" data-table-id="BaseTable"><div class="layui-card-body padding-left-40"><div class="layui-form-item label-required-prev"><div class="help-label"><b>等级类型</b>DataType</div><input class="layui-input" type="hidden" name="upgrade_ids" id="upgrade_ids" required/><select   xm-select="upgrade_ids_select" xm-select-search=""></select><p class="help-block">请选择对应的等级，向达到等级的用户发放优惠卷 ~</p></div></div><div class="hr-line-dashed"></div><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>确定发放</button><button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消吗？" data-close>取消</button></div></form><script>
    form.render();
    var upgrade_ids = new Array();
    require(['formSelects'], function (formSelects) {
            //初始化数据
            formSelects.data('upgrade_ids_select', 'local', {
                arr: [
                     <?php foreach($upgrades as $item): ?>
                      {"name": "<?php echo htmlentities($item['name'],ENT_QUOTES); ?>", "value": <?php echo htmlentities($item['id'],ENT_QUOTES); ?>},
                     <?php endforeach; ?>
                ]
            });

            //绑定事件
            formSelects.on('upgrade_ids_select', function(id, vals, val, isAdd, isDisabled){
                 if(isAdd){
                     upgrade_ids.push(val.value);
                 }else{
                     var index = upgrade_ids.indexOf(val.value);
                     upgrade_ids.splice(index,1);
                 }
                 console.log(upgrade_ids);
                $('#upgrade_ids').val(upgrade_ids.join(','));
            });
        })    
</script>        