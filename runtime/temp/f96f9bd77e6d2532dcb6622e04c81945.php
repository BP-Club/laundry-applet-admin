<?php /*a:1:{s:79:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/base/discount/form.html";i:1670552399;}*/ ?>
<form action="<?php echo sysuri(); ?>" method="post" data-auto="true" class="layui-form layui-card" data-table-id="DiscountTable"><div class="layui-card-body padding-left-40"><label class="layui-form-item block relative"><span class="help-label"><b>折扣方案名称</b>Discount Name</span><input class="layui-input" name="name" placeholder="请输入折扣方案名称" required value="<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''),ENT_QUOTES); ?>"></label><div class="layui-form-item label-required-prev"><span class="help-label"><b>用户等级折扣</b>Discount Scheme</span><table class="layui-table think-level-box" lay-skin="line"><thead><tr><th class="text-left" style="width:auto">用户等级</th><th class="text-right">原价比例 ( 0.00% - 100.00% )</th></tr></thead><tbody><?php foreach($levels as $level): ?><tr class="think-bg-white"><td class="nowrap sub-span-blue">[ <span>VIP<?php echo htmlentities((isset($level['number']) && ($level['number'] !== '')?$level['number']:'0'),ENT_QUOTES); ?></span> ] <?php echo htmlentities((isset($level['name']) && ($level['name'] !== '')?$level['name']:''),ENT_QUOTES); ?></td><td class="nowrap padding-0"><label><?php  $key = '_level_' . $level['number'];  ?><input data-blur-number="4" data-value-min="0" data-value-max="100" name="_level_<?php echo htmlentities($level['number'],ENT_QUOTES); ?>" value="<?php echo isset($vo[$key]) ? htmlentities($vo[$key],ENT_QUOTES) : '100.0000'; ?>" placeholder="请输入用户等级折扣"><span class="notselect margin-left-5">%</span></label></td></tr><?php endforeach; ?></tbody></table></div><label class="layui-form-item block relative"><span class="help-label"><b>折扣方案备注</b>Discount Remark</span><textarea class="layui-textarea" name="remark" placeholder="请输入折扣方案备注"><?php echo htmlentities((isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''),ENT_QUOTES); ?></textarea></label><div class="hr-line-dashed"></div><?php if(!(empty($vo['id']) || (($vo['id'] instanceof \think\Collection || $vo['id'] instanceof \think\Paginator ) && $vo['id']->isEmpty()))): ?><input name='id' type='hidden' value='<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>'><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>保存数据</button><button class="layui-btn layui-btn-danger" data-close data-confirm="确定要取消编辑吗？" type='button'>取消编辑</button></div></div></form><style>
    .think-level-box tr input {
        width: 90%;
        height: 38px;
        border: none;
        text-align: right;
        line-height: 38px;
    }
</style>