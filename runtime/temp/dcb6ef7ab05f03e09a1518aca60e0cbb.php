<?php /*a:1:{s:78:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/base/upgrade/form.html";i:1670552399;}*/ ?>
<style>
    [data-level-zero] {
        top: 0;
        left: -10px;
        right: -10px;
        bottom: 3px;
        color: #FFF;
        display: flex;
        position: absolute;
        font-size: 18px;
        border-radius: 3px;
        align-items: center;
        justify-content: center;
        background: rgba(0, 0, 0, 0.4);
        text-shadow: #666 1px 1px 3px;
    }

    .min-input {
        width: 80px
    }

    .min-input[type=number] {
        padding-left: 15px
    }
</style><form action="<?php echo sysuri(); ?>" class="layui-form layui-card" data-auto="true" method="post"><div class="layui-card-body padding-left-40"><fieldset class="layui-form-item layui-bg-gray"><legend><span class="layui-badge layui-bg-cyan">用户等级</span></legend><div class="layui-form-item layui-row layui-col-space15"><div class="layui-col-xs3 block relative"><span class="help-label label-required-prev"><b>等级序号</b>Serial</span><select class="layui-select" name="number" lay-filter="number"><?php $__FOR_START_797102821__=0;$__FOR_END_797102821__=$max;for($i=$__FOR_START_797102821__;$i < $__FOR_END_797102821__;$i+=1){ if(isset($vo['number']) and $vo['number'] == $i): ?><option selected value="<?php echo htmlentities($i,ENT_QUOTES); ?>">当前 VIP <?php echo htmlentities($vo['number'],ENT_QUOTES); ?> 等级</option><?php else: ?><option value="<?php echo htmlentities($i,ENT_QUOTES); ?>">设置 VIP <?php echo htmlentities($i,ENT_QUOTES); ?> 等级</option><?php endif; } ?></select></div><label class="layui-col-xs9 block relative"><span class="help-label label-required-prev"><b>等级名称</b>Name</span><input class="layui-input" name="name" placeholder="请输入等级名称" required value="<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''),ENT_QUOTES); ?>"></label></div></fieldset><div class="layui-row layui-col-space15"><div class="layui-col-xs6"><fieldset class="layui-form-item layui-bg-gray"><legend><span class="layui-badge layui-bg-cyan">升级规则</span></legend><div class="layui-form-item notselect"><?php $vo['upgrade_type'] = $vo['upgrade_type'] ?? 1; foreach([1=>'达成所有升级条件',0=>'达成任何升级条件'] as $k => $v): if(isset($vo['upgrade_type']) and $vo['upgrade_type'] == $k): ?><label class="think-radio"><input checked lay-ignore name="upgrade_type" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></label><?php else: ?><label class="think-radio"><input lay-ignore name="upgrade_type" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></label><?php endif; ?><?php endforeach; ?></div></fieldset></div><div class="layui-col-xs6"><fieldset class="layui-form-item layui-bg-gray"><legend><span class="layui-badge layui-bg-cyan">团队计数</span></legend><div class="layui-form-item notselect"><?php $vo['upgrade_team'] = $vo['upgrade_team'] ?? 1; foreach([1=>'参与团队人数统计',0=>'不参与团队人数统计'] as $k => $v): if(isset($vo['upgrade_team']) and $vo['upgrade_team'] == $k): ?><label class="think-radio"><input checked lay-ignore name="upgrade_team" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></label><?php else: ?><label class="think-radio"><input lay-ignore name="upgrade_team" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></label><?php endif; ?><?php endforeach; ?></div></fieldset></div></div><fieldset class="layui-form-item layui-bg-gray"><legend><span class="layui-badge layui-bg-cyan">升级条件</span></legend><div class="font-s13 relative"><div><label class="think-checkbox notselect"><?php if(isset($vo['goods_vip_status']) and $vo['goods_vip_status'] == 1): ?>
                        ① <input lay-ignore name="goods_vip_status" type="checkbox" value="1" checked>开启
                        <?php else: ?>
                        ① <input lay-ignore name="goods_vip_status" type="checkbox" value="1">开启
                        <?php endif; ?>
                        需要 <span class="color-blue">购买入会礼包</span> 达成升级；
                    </label></div><div><label class="think-checkbox notselect"><?php if(isset($vo['teams_direct_status']) and $vo['teams_direct_status'] == 1): ?>
                        ② <input lay-ignore name="teams_direct_status" type="checkbox" value="1" checked>开启
                        <?php else: ?>
                        ② <input lay-ignore name="teams_direct_status" type="checkbox" value="1">开启
                        <?php endif; ?><span class="color-blue">直推团队</span> 升级，<span class="color-blue">直推团队</span> 达到
                        <input class="inline-block text-center min-input" name="teams_direct_number" data-blur-number="0" min="0" type="number" value="<?php echo htmlentities((isset($vo['teams_direct_number']) && ($vo['teams_direct_number'] !== '')?$vo['teams_direct_number']:'0'),ENT_QUOTES); ?>">
                        人；
                    </label></div><div><label class="think-checkbox notselect"><?php if(isset($vo['teams_indirect_status']) and $vo['teams_indirect_status'] == 1): ?>
                        ③ <input lay-ignore name="teams_indirect_status" type="checkbox" value="1" checked>开启
                        <?php else: ?>
                        ③ <input lay-ignore name="teams_indirect_status" type="checkbox" value="1">开启
                        <?php endif; ?><span class="color-blue">间接团队</span> 升级，<span class="color-blue">间接团队</span> 达到
                        <input class="inline-block text-center min-input" name="teams_indirect_number" data-blur-number="0" min="0" type="number" value="<?php echo htmlentities((isset($vo['teams_indirect_number']) && ($vo['teams_indirect_number'] !== '')?$vo['teams_indirect_number']:'0'),ENT_QUOTES); ?>">
                        人；
                    </label></div><div><label class="think-checkbox notselect"><?php if(isset($vo['teams_users_status']) and $vo['teams_users_status'] == 1): ?>
                        ④ <input lay-ignore name="teams_users_status" type="checkbox" value="1" checked>开启
                        <?php else: ?>
                        ④ <input lay-ignore name="teams_users_status" type="checkbox" value="1">开启
                        <?php endif; ?><span class="color-blue">团队总数</span> 升级，<span class="color-blue">团队总数</span> 达到
                        <input class="inline-block text-center min-input" name="teams_users_number" data-blur-number="0" min="0" type="number" value="<?php echo htmlentities((isset($vo['teams_users_number']) && ($vo['teams_users_number'] !== '')?$vo['teams_users_number']:'0'),ENT_QUOTES); ?>">
                        人；
                    </label></div><div><label class="think-checkbox notselect"><?php if(isset($vo['order_amount_status']) and $vo['order_amount_status'] == 1): ?>
                        ⑤ <input lay-ignore name="order_amount_status" type="checkbox" value="1" checked>开启
                        <?php else: ?>
                        ⑤ <input lay-ignore name="order_amount_status" type="checkbox" value="1">开启
                        <?php endif; ?><span class="color-blue">订单总额</span> 升级，<span class="color-blue">订单总额</span> 达到
                        <input class="inline-block text-center min-input" name="order_amount_number" data-blur-number="2" min="0" type="number" value="<?php echo htmlentities((isset($vo['order_amount_number']) && ($vo['order_amount_number'] !== '')?$vo['order_amount_number']:'0'),ENT_QUOTES); ?>">
                        元；
                    </label></div><div data-level-zero class="layui-hide notselect">默认等级，无需配置升级规则</div></div></fieldset><fieldset class="layui-form-item layui-bg-gray"><legend><span class="layui-badge layui-bg-cyan">奖利规则</span></legend><div class="notselect relative"><?php foreach($prizes as $prize): if(isset($vo['rebate_rule']) && is_array($vo['rebate_rule']) && isset($vo['rebate_rule'][$prize['code']])): ?><label class="think-checkbox"><input lay-ignore name="rebate_rule[]" type="checkbox" value="<?php echo htmlentities($prize['code'],ENT_QUOTES); ?>" checked><?php echo htmlentities($prize['name'],ENT_QUOTES); ?></label><?php else: ?><label class="think-checkbox"><input lay-ignore name="rebate_rule[]" type="checkbox" value="<?php echo htmlentities($prize['code'],ENT_QUOTES); ?>"><?php echo htmlentities($prize['name'],ENT_QUOTES); ?></label><?php endif; ?><?php endforeach; ?><div data-level-zero class="layui-hide notselect">默认等级，不能发放等级奖励</div></div></fieldset><fieldset class="layui-form-item layui-hide"><legend><span class="layui-badge layui-bg-cyan">等级描述</span></legend><label class="layui-form-item block relative"><textarea class="layui-textarea" name="remark" placeholder="请输入用户等级描述"><?php echo htmlentities((isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''),ENT_QUOTES); ?></textarea></label></fieldset></div><div class="hr-line-dashed"></div><?php if(isset($vo['id'])): ?><input name='id' type='hidden' value='<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>'><?php endif; if(isset($vo['number'])): ?><input name='old_number' type='hidden' value='<?php echo htmlentities($vo['number'],ENT_QUOTES); ?>'><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>保存数据</button><button class="layui-btn layui-btn-danger" data-close data-confirm="确定要取消编辑吗？" type='button'>取消编辑</button></div></form><script>
    $(function () {
        var $elem = $('[data-level-zero]');
        layui.form.on('select(number)', apply);
        apply({value: parseInt("<?php echo htmlentities((isset($vo['number']) && ($vo['number'] !== '')?$vo['number']:0),ENT_QUOTES); ?>")});

        function apply(data) {
            data.value > 0 ? $elem.addClass('layui-hide') : $elem.removeClass('layui-hide');
        }
    });
</script>
