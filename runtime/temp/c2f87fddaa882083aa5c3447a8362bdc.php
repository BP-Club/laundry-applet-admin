<?php /*a:2:{s:69:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/news/item/form.html";i:1670552399;s:76:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><form action="<?php echo sysuri(); ?>" class="layui-card layui-form" data-auto="true" method="post"><div class="layui-card-body"><!--<?php if(!(empty($marks) || (($marks instanceof \think\Collection || $marks instanceof \think\Paginator ) && $marks->isEmpty()))): ?>--><div class="layui-form-item label-required-prev"><span class="help-label"><b>文章标签</b>News Mark</span><div class="layui-textarea help-checks"><?php foreach($marks as $tag): if(isset($vo['mark']) && is_array($vo['mark']) && in_array($tag['name'], $vo['mark'])): ?><label class="think-checkbox notselect"><input checked lay-ignore name="mark[]" type="checkbox" value="<?php echo htmlentities($tag['name'],ENT_QUOTES); ?>"><?php echo htmlentities($tag['name'],ENT_QUOTES); ?></label><?php else: ?><label class="think-checkbox notselect"><input lay-ignore name="mark[]" type="checkbox" value="<?php echo htmlentities($tag['name'],ENT_QUOTES); ?>"><?php echo htmlentities($tag['name'],ENT_QUOTES); ?></label><?php endif; ?><?php endforeach; ?></div></div><!--<?php endif; ?>--><div class="layui-form-item label-required-prev"><span class="help-label"><b>文章封面</b>News Conver</span><div class="relative block label-required-null"><input class="layui-input think-bg-gray" name="cover" placeholder="请上传文章封面" readonly required value='<?php echo htmlentities((isset($vo['cover']) && ($vo['cover'] !== '')?$vo['cover']:""),ENT_QUOTES); ?>'><a class="layui-icon layui-icon-upload input-right-icon" data-file data-field="cover" data-type="gif,png,jpg,jpeg"></a></div></div><label class="layui-form-item relative block"><span class="help-label"><b>文章标题</b>News Title</span><input class="layui-input" name="name" placeholder="请输入文章标题" required value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:""),ENT_QUOTES); ?>'></label><div class="layui-form-item label-required-prev"><span class="help-label"><b>文章内容</b>News Content</span><div class="relative block"><textarea class="layui-hide" name="content" placeholder="请输入文章内容"><?php echo htmlentities((isset($vo['content']) && ($vo['content'] !== '')?$vo['content']:''),ENT_QUOTES); ?></textarea></div></div><div class="hr-line-dashed"></div><?php if(!(empty($vo['id']) || (($vo['id'] instanceof \think\Collection || $vo['id'] instanceof \think\Paginator ) && $vo['id']->isEmpty()))): ?><input name='id' type='hidden' value='<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>'><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type="submit">保存数据</button><button class="layui-btn layui-btn-danger" data-history-back data-confirm="确定要取消编辑吗？" type='button'>取消编辑</button></div></div></form><script>
    $('input[name="cover"]').uploadOneImage();
    require(['ckeditor'], function () {
        window.createEditor('[name=content]', {height: 350})
    });
</script></div></div></div>