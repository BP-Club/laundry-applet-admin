<?php /*a:3:{s:80:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/user/transfer/index.html";i:1670552399;s:82:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;s:87:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/data/view/user/transfer/index_search.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth('config')): ?>--><a class="layui-btn layui-btn-sm layui-btn-primary" data-modal="<?php echo url('config'); ?>" data-width="900px">用户提现配置</a><!--<?php endif; ?>--><!--<?php if(auth('payment')): ?>--><a class="layui-btn layui-btn-sm layui-btn-primary" data-modal="<?php echo url('payment'); ?>">微信转账配置</a><!--<?php endif; ?>--><!--<?php if(auth('sync')): ?>--><a class="layui-btn layui-btn-sm layui-btn-primary" data-queue="<?php echo url('sync'); ?>">后台打款服务</a><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="think-box-notify"><!-- 0 $total, 1 $count, 2 $audit, 3 $locks -->
    提现统计：已产生提现累计 <b><?php echo htmlentities((isset($transfer['0']) && ($transfer['0'] !== '')?$transfer['0']:0.00),ENT_QUOTES); ?></b> 元（ 含待转账 <b><?php echo htmlentities((isset($transfer['3']) && ($transfer['3'] !== '')?$transfer['3']:'0.00'),ENT_QUOTES); ?></b> 元，含待审核 <b><?php echo htmlentities((isset($transfer['2']) && ($transfer['2'] !== '')?$transfer['2']:'0.00'),ENT_QUOTES); ?></b> 元 ），累计已提现 <b><?php echo htmlentities((isset($transfer['1']) && ($transfer['1'] !== '')?$transfer['1']:0.00),ENT_QUOTES); ?></b> 元。
</div><div class="think-box-shadow"><fieldset><legend>条件搜索</legend><form action="<?php echo sysuri(); ?>" autocomplete="off" class="layui-form layui-form-pane form-search" method="get" onsubmit="return false"><div class="layui-form-item layui-inline"><label class="layui-form-label">用户手机</label><label class="layui-input-inline"><input class="layui-input" name="phone" placeholder="请输入用户手机" value="<?php echo htmlentities((isset($get['phone']) && ($get['phone'] !== '')?$get['phone']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">用户昵称</label><label class="layui-input-inline"><input class="layui-input" name="nickname" placeholder="请输入用户昵称" value="<?php echo htmlentities((isset($get['nickname']) && ($get['nickname'] !== '')?$get['nickname']:''),ENT_QUOTES); ?>"></label></div><div class="layui-form-item layui-inline"><label class="layui-form-label">提现方式</label><div class="layui-input-inline"><select name="type"><option value="">-- 全部 --</option><?php foreach($types as $k=>$v): if(input('type') == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">打款状态</label><div class="layui-input-inline"><select name="status"><option value="">-- 全部 --</option><?php foreach(['已拒绝', '待审核', '已审核', '待打款', '已打款','已完成'] as $k=>$v): if(input('status') == $k.''): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item layui-inline"><label class="layui-form-label">申请时间</label><div class="layui-input-inline"><input class="layui-input" data-date-range name="create_at" placeholder="请选择申请时间" value="<?php echo htmlentities((isset($get['create_at']) && ($get['create_at'] !== '')?$get['create_at']:''),ENT_QUOTES); ?>"></div></div><div class="layui-form-item layui-inline"><button class="layui-btn layui-btn-primary"><i class="layui-icon">&#xe615;</i> 搜 索</button></div></form></fieldset><table class="layui-table" lay-skin="line"><?php if(!(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty()))): ?><thead><tr><th class='list-table-check-td think-checkbox'><label><input data-auto-none data-check-target='.list-check-box' type='checkbox'></label></th><th>提现用户</th><th>提现订单</th><th>提现通道</th><th>处理记录</th><th></th></tr></thead><?php endif; ?><tbody><?php foreach($list as $key => $vo): ?><tr><td class='list-table-check-td think-checkbox'><label><input class="list-check-box" type='checkbox' value='<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>'></label></td><td class="nowrap"><div class="headimg headimg-md" data-lazy-src="<?php echo htmlentities((isset($vo['user']['headimg']) && ($vo['user']['headimg'] !== '')?$vo['user']['headimg']:'/static/theme/img/headimg.png'),ENT_QUOTES); ?>" data-tips-image></div><div class="inline-block sub-span-blue"><div><!--<?php if(!(empty($vo['user']['username']) || (($vo['user']['username'] instanceof \think\Collection || $vo['user']['username'] instanceof \think\Paginator ) && $vo['user']['username']->isEmpty()))): ?>-->
                        用户姓名：<span class="color-text"><?php echo htmlentities((isset($vo['user']['username']) && ($vo['user']['username'] !== '')?$vo['user']['username']:'-'),ENT_QUOTES); ?></span><!--<?php else: ?>-->
                        用户昵称：<span class="color-text"><?php echo htmlentities((isset($vo['user']['nickname']) && ($vo['user']['nickname'] !== '')?$vo['user']['nickname']:'-'),ENT_QUOTES); ?></span><!--<?php endif; ?>--><span class="margin-left-5">[ <b class="color-red">VIP<?php echo htmlentities($vo['user']['vip_code'],ENT_QUOTES); ?></b> ] <b class="color-red"><?php echo htmlentities($vo['user']['vip_name'],ENT_QUOTES); ?></b></span></div><div>用户手机：<span class="color-text"><?php echo htmlentities((isset($vo['user']['phone']) && ($vo['user']['phone'] !== '')?$vo['user']['phone']:'-'),ENT_QUOTES); ?></span></div><div class="sub-strong-blue">剩余可提现 <b><?php echo htmlentities($vo['user']['rebate_total']-$vo['user']['rebate_used'],ENT_QUOTES); ?></b> 元 已提现 <b><?php echo htmlentities($vo['user']['rebate_used']+0,ENT_QUOTES); ?></b> 元 待到账 <b><?php echo htmlentities($vo['user']['rebate_lock']+0,ENT_QUOTES); ?></b> 元</div></div></td><td class='text-left nowrap'><?php if($vo['status'] == '0'): ?><span class="layui-badge layui-badge-middle layui-bg-red">已失败</span><?php endif; if($vo['status'] == '1'): ?><span class="layui-badge layui-badge-middle layui-bg-cyan">待审核</span><?php endif; if($vo['status'] == '2'): ?><span class="layui-badge layui-badge-middle layui-bg-blue">已审核</span><?php endif; if($vo['status'] == '3'): ?><span class="layui-badge layui-badge-middle layui-bg-blue">待打款</span><?php endif; if($vo['status'] == '4'): ?><span class="layui-badge layui-badge-middle layui-bg-green">已打款</span><?php endif; if($vo['status'] == '5'): ?><span class="layui-badge layui-badge-middle layui-bg-green">已完成</span><?php endif; ?><div class="text-middle inline-block">
                    提现金额：<b class="color-blue"><?php echo htmlentities($vo['amount']+0,ENT_QUOTES); ?></b> 元
                    <?php if($vo['charge_amount']>0): ?><span class="color-desc"> ( 含手续费 <?php echo htmlentities($vo['charge_amount']+0,ENT_QUOTES); ?> 元 )</span><?php endif; ?><div>提现单号：<b class="color-blue"><?php echo htmlentities((isset($vo['code']) && ($vo['code'] !== '')?$vo['code']:'--'),ENT_QUOTES); ?></b></div><div>提现方式：<?php echo htmlentities((isset($vo['type_name']) && ($vo['type_name'] !== '')?$vo['type_name']:'-'),ENT_QUOTES); ?></div><div>提现描述：<span class="color-desc"><?php echo htmlentities((isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:'-'),ENT_QUOTES); ?></span></div></div></td><td class='text-left nowrap'><?php if(in_array(($vo['type']), explode(',',"wechat_banks,transfer_banks"))): ?><div>开户银行：<?php echo htmlentities((isset($vo['bank_name']) && ($vo['bank_name'] !== '')?$vo['bank_name']:'-'),ENT_QUOTES); ?></div><div>开户分行：<?php echo htmlentities((isset($vo['bank_bran']) && ($vo['bank_bran'] !== '')?$vo['bank_bran']:''),ENT_QUOTES); ?></div><div>账户姓名：<?php echo htmlentities((isset($vo['bank_user']) && ($vo['bank_user'] !== '')?$vo['bank_user']:''),ENT_QUOTES); ?></div><div>银行卡号：<?php echo htmlentities((isset($vo['bank_code']) && ($vo['bank_code'] !== '')?$vo['bank_code']:''),ENT_QUOTES); ?></div><?php endif; if(in_array(($vo['type']), explode(',',"wechat_qrcode,alipay_qrcode"))): ?><div class="headimg headimg-md" data-lazy-src="<?php echo htmlentities($vo['qrcode'],ENT_QUOTES); ?>" data-tips-image></div><?php endif; if(in_array(($vo['type']), explode(',',"alipay_account"))): ?><div>支付宝姓名：<?php echo htmlentities((isset($vo['alipay_user']) && ($vo['alipay_user'] !== '')?$vo['alipay_user']:'-'),ENT_QUOTES); ?></div><div>支付宝账号：<?php echo htmlentities((isset($vo['alipay_code']) && ($vo['alipay_code'] !== '')?$vo['alipay_code']:''),ENT_QUOTES); ?></div><?php endif; if(in_array(($vo['type']), explode(',',"wechat_wallet"))): ?><div class="color-desc">提现到微信钱包零钱</div><?php endif; ?></td><td class='text-left nowrap'>
                申请时间：<?php echo htmlentities(format_datetime($vo['create_at']),ENT_QUOTES); ?><br>
                最后处理：<?php echo htmlentities(format_datetime($vo['change_time']),ENT_QUOTES); ?><br>
                交易时间：<?php echo htmlentities(format_datetime($vo['trade_time']),ENT_QUOTES); ?><br>
                交易描述：<span class="color-desc"><?php echo htmlentities((isset($vo['change_desc']) && ($vo['change_desc'] !== '')?$vo['change_desc']:'--'),ENT_QUOTES); ?></span><br></td><td class='text-left nowrap'><?php if(auth('auditStatus') and $vo['status'] == 1): ?><a class="layui-btn layui-btn-sm layui-btn-normal" data-modal="<?php echo url('auditStatus'); ?>?code=<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>">提现审核</a><?php endif; if(auth('auditPayment') and in_array($vo['status'], [2,3,4])): ?><a class="layui-btn layui-btn-sm" data-modal="<?php echo url('auditPayment'); ?>?code=<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>">提现打款</a><?php endif; ?></td></tr><?php endforeach; ?></tbody></table><?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?><span class="notdata">没有记录哦</span><?php else: ?><?php echo (isset($pagehtml) && ($pagehtml !== '')?$pagehtml:''); ?><?php endif; ?></div></div></div></div>