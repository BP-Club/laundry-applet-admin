<?php /*a:2:{s:72:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/base/message/form.html";i:1670552399;s:76:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><form action="<?php echo sysuri(); ?>" method="post" data-auto="true" class="layui-form layui-card" data-table-id="MessageTable"><div class="layui-card-body"><label class="layui-form-item relative block"><span class="help-label"><b>通知标题</b>Notify Title</span><input class="layui-input" name="name" placeholder="请输入通知标题" required value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:""),ENT_QUOTES); ?>'></label><div class="layui-form-item label-required-prev"><span class="help-label"><b>通知内容</b>Notify Content</span><label class="relative block"><textarea class="layui-hide" name="content" placeholder="请输入通知内容"><?php echo htmlentities((isset($vo['content']) && ($vo['content'] !== '')?$vo['content']:''),ENT_QUOTES); ?></textarea></label></div><div class="hr-line-dashed"></div><?php if(!(empty($vo['id']) || (($vo['id'] instanceof \think\Collection || $vo['id'] instanceof \think\Paginator ) && $vo['id']->isEmpty()))): ?><input name='id' type='hidden' value='<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>'><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type="submit">保存数据</button><button class="layui-btn layui-btn-danger" data-confirm="确定要取消编辑吗？" type='button' data-history-back>取消编辑</button></div></div></form><script>
    require(['ckeditor'], function () {
        window.createEditor('[name=content]', {height: 530});
    });
</script></div></div></div>