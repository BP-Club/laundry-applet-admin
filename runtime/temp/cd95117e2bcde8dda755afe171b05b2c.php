<?php /*a:2:{s:76:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/project/view/additem/form.html";i:1670674486;s:85:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/project/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><form action="<?php echo sysuri(); ?>" class="layui-card layui-form" data-auto="true" method="post"><div class="layui-card-body"><div class="layui-form-item"><label class="layui-form-label">项目名称</label><div class="layui-input-block"><input name="title" value='<?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:""),ENT_QUOTES); ?>' required placeholder="请输入项目名称" class="layui-input"><p class="help-block"><b>必选</b>，请填写项目名称</p></div></div><div class="layui-form-item"><label class="layui-form-label">项目价格</label><div class="layui-input-block"><input type="number" name="price" value='<?php echo htmlentities((isset($vo['price']) && ($vo['price'] !== '')?$vo['price']:""),ENT_QUOTES); ?>' required placeholder="请输入项目价格" class="layui-input"><p class="help-block"><b>必选</b>，请填写项目价格</p></div></div><div class="layui-form-item"><label class="layui-form-label">说明</label><div class="layui-input-block"><textarea name="intro" required="" placeholder="请输入文字" maxlength="10000" class="layui-textarea"><?php echo (isset($vo['intro']) && ($vo['intro'] !== '')?$vo['intro']:""); ?></textarea></div></div><div class="hr-line-dashed"></div><?php if(!(empty($vo['id']) || (($vo['id'] instanceof \think\Collection || $vo['id'] instanceof \think\Paginator ) && $vo['id']->isEmpty()))): ?><input type='hidden' value='<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>' name='id'><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>保存数据</button><button class="layui-btn layui-btn-danger" data-history-back data-confirm="确定要取消编辑吗？" type='button'>取消编辑</button></div></div><script></script></form></div></div></div>