<?php /*a:2:{s:77:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/wechat/view/config/payment.html";i:1670552399;s:84:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/wechat/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><!--<?php if(auth("payment_test")): ?>--><button data-modal="<?php echo url('payment_test'); ?>" class='layui-btn layui-btn-sm layui-btn-primary'>微信支付测试</button><!--<?php endif; ?>--></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="think-box-shadow"><div class="layui-anim layui-anim-fadein padding-top-20" style="width:850px"><form action="<?php echo url('payment_save'); ?>" method="post" data-auto="true"  class='layui-form layui-card shadow-none' lay-filter="payment"><div class="layui-card-header border-0"><div class="layui-bg-gray padding-col-20 border-radius-5">
                    微信商户参数配置，此处交易的商户号需要与微信公众号对接的公众号 APPID 匹配。
                </div></div><div class="layui-card-body"><div class="layui-form-item margin-top-15"><label class="layui-form-label"><b>MCH_ID</b><br><span class="nowrap color-desc">微信商户账号</span></label><div class="layui-input-block"><input name="wechat.mch_id" required placeholder="请输入微信商户账号（必填）" value="<?php echo sysconf('wechat.mch_id'); ?>" class="layui-input"><p class="help-block">微信商户账号，需要在微信商户平台获取，MCH_ID 与 APPID 匹配</p></div></div><div class="layui-form-item"><label class="layui-form-label"><b>MCH_KEY</b><br><span class="nowrap color-desc">微信商户密钥</span></label><div class="layui-input-block"><input name="wechat.mch_key" placeholder="请输入微信商户密钥（必填）" maxlength="32" pattern=".{32}" required value="<?php echo sysconf('wechat.mch_key'); ?>" class="layui-input"><p class="help-block">微信商户密钥，需要在微信商户平台操作设置操作密码并获取商户接口密钥</p></div></div><div class="hr-line-dashed"></div><div class="layui-form-item"><label class="layui-form-label"><b>MCH_CERT</b><br><span class="nowrap color-desc">微信商户证书</span></label><div class="layui-input-block"><?php foreach(['none'=>'暂不使用证书', 'pem'=>'上传 PEM 证书', 'p12'=>'上传 P12 证书'] as $k=>$v): ?><input type="radio" data-pem-type="<?php echo htmlentities($k,ENT_QUOTES); ?>" name="wechat.mch_ssl_type" value="<?php echo htmlentities($k,ENT_QUOTES); ?>" title="<?php echo htmlentities($v,ENT_QUOTES); ?>" lay-filter="data-mch-type"><?php endforeach; ?><div data-mch-type="none"></div><p class="help-block">请选择需要上传证书类型，P12 或 PEM 二选一，证书需要从微信商户平台获取</p><div data-mch-type="p12" class="layui-tab-item padding-top-15 padding-bottom-15"><input name="wechat.mch_ssl_p12" value="<?php echo htmlentities((isset($mch_ssl_p12) && ($mch_ssl_p12 !== '')?$mch_ssl_p12:''),ENT_QUOTES); ?>" type="hidden"><button data-file="btn" data-uptype="local" data-safe="true" data-type="p12" data-field="wechat.mch_ssl_p12" type="button" class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-vercode"></i> 上传 P12 证书
                            </button><p class="help-block margin-top-10">微信商户支付 P12 证书，实现订单退款、打款、发红包等支出功能都使用证书</p></div><div data-mch-type="pem" class="layui-tab-item padding-top-15 padding-bottom-15"><input name="wechat.mch_ssl_key" value="<?php echo htmlentities((isset($mch_ssl_key) && ($mch_ssl_key !== '')?$mch_ssl_key:''),ENT_QUOTES); ?>" type="hidden"><button data-file="btn" data-uptype="local" data-safe="true" data-type="pem" data-field="wechat.mch_ssl_key" type="button" class="layui-btn layui-btn-primary margin-right-5"><i class="layui-icon layui-icon-vercode"></i> 上传 KEY 证书
                            </button><input name="wechat.mch_ssl_cer" value="<?php echo htmlentities((isset($mch_ssl_cer) && ($mch_ssl_cer !== '')?$mch_ssl_cer:''),ENT_QUOTES); ?>" type="hidden"><button data-file="btn" data-uptype="local" data-safe="true" data-type="pem" data-field="wechat.mch_ssl_cer" type="button" class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-vercode"></i> 上传 CERT 证书
                            </button><p class="help-block margin-top-10">微信商户支付 PEM 双向证书，实现订单退款、打款、发红包等支出功能都使用证书</p></div></div></div><!--<?php if(auth('paymentsave')): ?>--><div class="hr-line-dashed margin-top-30"></div><div class="layui-form-item text-center"><button class="layui-btn" type="submit">保存配置</button></div><!--<?php endif; ?>--></div></form></div></div></div></div><script>
    (new function (type) {
        type = "<?php echo sysconf('wechat.mch_ssl_type'); ?>" || 'none';
        layui.form.val('payment', {'wechat.mch_ssl_type': type});
        layui.form.on('radio(data-mch-type)', apply), apply.call(this, {value: type});
        ['wechat.mch_ssl_p12', 'wechat.mch_ssl_key', 'wechat.mch_ssl_cer'].forEach(function (type) {
            $('input[name="' + type + '"]').on('change', function (that) {
                that = this, that.$button = $(this).next('button'), setTimeout(function () {
                    if (typeof that.value === 'string' && that.value.length > 5) {
                        that.$button.find('i').addClass('color-green layui-icon-vercode').removeClass('layui-icon-upload-drag');
                    } else {
                        that.$button.find('i').removeClass('color-green layui-icon-vercode').addClass('layui-icon-upload-drag');
                    }
                }, 100);
            }).trigger('change');
        });

        function apply(data) {
            $('[data-mch-type="' + data.value + '"]').show().siblings('[data-mch-type]').hide();
        }
    });
</script></div>