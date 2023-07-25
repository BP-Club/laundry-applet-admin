<?php /*a:1:{s:69:"/www/wwwroot/uexwash.com/ThinkAdmin/app/store/view/order/refunds.html";i:1680855808;}*/ ?>
<form action="<?php echo sysuri(); ?>" method="post" data-auto="true" class="layui-form layui-card" data-table-id="BaseTable"><div class="layui-card-body padding-left-40"><div class="layui-form-item"><ul class="layui-timeline"><?php foreach($refunds as $key=>$vo): ?><li class="layui-timeline-item"><i class="layui-icon layui-timeline-axis"></i><div class="layui-timeline-content layui-text"><h4 class="layui-timeline-title"><?php echo htmlentities($vo['create_at'],ENT_QUOTES); ?></h4><div class="timeline-content">
                      退款凭证：<?php foreach($vo['datas'] as $image): ?><div class="headimg headimg-no" data-tips-hover data-tips-image data-lazy-src="<?php echo htmlentities($image,ENT_QUOTES); ?>"></div><?php endforeach; ?><br>申请理由：<?php echo htmlentities($vo['remark'],ENT_QUOTES); ?><br>申请者：用户
                       <?php if($vo['status'] > 0): ?><hr/><?php if($vo['status'] == 1): ?>
                       结果：<span class="color-green"><?php echo htmlentities($vo['status_text'],ENT_QUOTES); ?></span><?php else: ?>
                       结果：<span class="color-red"><?php echo htmlentities($vo['status_text'],ENT_QUOTES); ?></span><?php endif; ?><br>理由：<?php echo htmlentities($vo['feedback_text'],ENT_QUOTES); ?><br>操作者：<?php echo htmlentities($vo['adminer'],ENT_QUOTES); ?><?php endif; ?></div></div></li><?php endforeach; ?></ul></div><?php if($lastRefundStatus == 0): ?><div class="layui-form-item layui-inline"><label class="layui-form-label  uex-label">结果</label><label class="layui-input-inline"><select class="layui-select" name="status"><?php foreach([1 => '通过',2 => '不通过'] as $k=>$v): ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endforeach; ?></select></label></div><div class="layui-form-item"><label class="layui-form-label uex-label">反馈信息</label><div class="layui-input-block"><textarea name="feedback_text"  placeholder="请输入反馈备注" maxlength="10000" class="layui-textarea"></textarea></div></div><?php endif; ?></div><div class="hr-line-dashed"></div><?php if(!(empty($lastRefundId) || (($lastRefundId instanceof \think\Collection || $lastRefundId instanceof \think\Paginator ) && $lastRefundId->isEmpty()))): ?><input type='hidden' value='<?php echo htmlentities($lastRefundId,ENT_QUOTES); ?>' name='lastRefundId'/><?php endif; if(!(empty($orderId) || (($orderId instanceof \think\Collection || $orderId instanceof \think\Paginator ) && $orderId->isEmpty()))): ?><input type='hidden' value='<?php echo htmlentities($orderId,ENT_QUOTES); ?>' name='orderId'/><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>确定</button><button class="layui-btn layui-btn-danger" type='button'  data-close>取消</button></div></form><style>
    .uex-label{
        font-size: 13px;
        text-align: center;
    }
    .uex-box{
        font-size: 13px;
        padding: 9px 15px;
        font-weight: 400;
        line-height: 20px; 
    }
    .timeline-content{
        font-size: 12px;
    }
</style>