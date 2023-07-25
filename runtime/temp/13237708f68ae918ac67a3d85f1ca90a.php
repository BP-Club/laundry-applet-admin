<?php /*a:1:{s:69:"/www/wwwroot/uexwash.com/ThinkAdmin/app/admin/view/config/system.html";i:1670552399;}*/ ?>
<form action="<?php echo sysuri(); ?>" method="post" data-auto="true" class="layui-form layui-card"><div class="layui-card-body padding-left-40"><div class="layui-row layui-col-space15 margin-bottom-5"><div class="layui-col-xs4 padding-bottom-0"><label class="relative block"><span class="help-label"><b>登录表单标题</b>Login Name</span><input name="login_name" required placeholder="请输入登录页面的表单标题" value="<?php echo sysconf('login_name')?:'系统管理'; ?>" class="layui-input"></label></div><div class="layui-col-xs4 padding-bottom-0"><div class="help-label label-required-prev"><b>后台登录入口</b>Login Entry</div><label class="layui-input relative block nowrap label-required-null"><span><?php echo sysuri('@',[],false,true); ?></span><input autofocus required pattern="[a-zA-Z_][a-zA-Z0-9_]*" placeholder="请输入后台登录入口" class="layui-input inline-block padding-0 border-0" style="width:100px;background:none" value="<?php echo substr(sysuri('admin/index/index',[],false), strlen(sysuri('@'))); ?>" name="xpath"></label></div><div class="layui-col-xs4 padding-bottom-0"><div class="help-label label-required-prev"><b>后台默认配色</b>Theme Style</div><select class="layui-select" name="site_theme" lay-filter="SiteTheme"><?php foreach($themes as $k=>$v): if(sysconf('base.site_theme') == $k): ?><option selected value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php echo htmlentities($v,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div><div class="layui-col-xs12 padding-top-0 padding-bottom-0"><span class="help-block">后台登录入口是由英文字母开头，且不能有相同名称的模块，设置之后原地址不能继续访问，请谨慎配置 ~</span></div></div><div class="layui-form-item margin-bottom-5"><div class="help-label"><b>登录背景图片</b>Background Image</div><div class="layui-textarea help-images"><input type="hidden" value="<?php echo sysconf('login_image'); ?>" name="login_image"></div></div><div class="layui-form-item margin-bottom-5"><div class="help-label label-required-prev"><b>浏览器小图标</b>Browser Icon</div><label class="relative block label-required-null"><input class="layui-input" required pattern="^(http|/)" placeholder="请上传浏览器图标" value="<?php echo sysconf('site_icon'); ?>" name="site_icon"><a class="input-right-icon layui-icon layui-icon-upload-drag" data-file="btn" data-type="png,jpg,jpeg" data-field="site_icon"></a></label><div class="help-block sub-span-blue">
                建议上传 <span>128x128</span> 或 <span>256x256</span> 的 <span>JPG</span>,<span>PNG</span>,<span>JPEG</span> 图片，保存后会自动生成 <span>48x48</span> 的 <span>ICO</span> 文件 ~
            </div></div><div class="layui-row layui-col-space15 margin-bottom-5"><div class="layui-col-xs4 padding-bottom-0"><label class="layui-form-item margin-bottom-5 relative block"><span class="help-label"><b>网站名称</b>Site Name</span><input name="site_name" required placeholder="请输入网站名称" value="<?php echo sysconf('site_name'); ?>" class="layui-input"><span class="help-block">网站名称将显示在浏览器的标签上 ~</span></label></div><div class="layui-col-xs4 padding-bottom-0"><label class="layui-form-item margin-bottom-5 relative block"><span class="help-label"><b>后台程序名称</b>App Name</span><input name="app_name" required placeholder="请输入程序名称" value="<?php echo sysconf('app_name'); ?>" class="layui-input"><span class="help-block">管理程序名称显示在后台左上标题处 ~</span></label></div><div class="layui-col-xs4 padding-bottom-0"><label class="layui-form-item margin-bottom-5 relative block"><span class="help-label"><b>后台程序版本</b>App Version</span><input name="app_version" placeholder="请输入程序版本" value="<?php echo sysconf('app_version'); ?>" class="layui-input"><span class="help-block">管理程序版本显示在后台左上标题处 ~</span></label></div><div class="layui-col-xs4 padding-top-0 padding-bottom-0"><label class="relative block"><span class="help-label"><b>公网安备号</b>Baian</span><input name="beian" placeholder="请输入公网安备号" value="<?php echo sysconf('beian'); ?>" class="layui-input"></label></div><div class="layui-col-xs4 padding-top-0 padding-bottom-0"><label class="relative block"><span class="help-label"><b>网站备案号</b>Miitbeian</span><input name="miitbeian" placeholder="请输入网站备案号" value="<?php echo sysconf('miitbeian'); ?>" class="layui-input"></label></div><div class="layui-col-xs4 padding-top-0 padding-bottom-0"><label class="relative block"><span class="help-label"><b>网站版权信息</b>Copyright</span><input name="site_copy" required placeholder="请输入版权信息" value="<?php echo sysconf('site_copy'); ?>" class="layui-input"></label></div><div class="layui-col-xs12 help-block padding-top-0">
                网站备案号和公安备案号可以在<a target="_blank" href="https://beian.miit.gov.cn">备案管理中心</a>查询并获取，网站上线时必需配置备案号，备案号会链接到信息备案管理系统 ~
            </div></div></div><div class="hr-line-dashed"></div><div class="layui-form-item text-center"><button class="layui-btn" type="submit">保存配置</button><button class="layui-btn layui-btn-danger" type='button' data-confirm="确定要取消修改吗？" data-close>取消修改</button></div></form><script>
    $('[name=login_image]').uploadMultipleImage();
    layui.form.on('select(SiteTheme)', function (data) {
        var alls = '', prox = 'layui-layout-theme-', curt = prox + data.value;
        $(data.elem.options).map(function () {
            if (this.value !== data.value) alls += ' ' + prox + this.value;
        });
        $('.layui-layout-body').removeClass(alls).addClass(curt)
    });
</script>