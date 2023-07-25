<?php /*a:2:{s:72:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/store/view/store/form.html";i:1676522129;s:83:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/store/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><form action="<?php echo sysuri(); ?>" class="layui-card layui-form" data-auto="true" method="post"><div class="layui-card-body"><div class="layui-form-item"><label class="layui-form-label">门店名字</label><div class="layui-input-block"><input name="name" value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:""),ENT_QUOTES); ?>' required placeholder="请输入门店名字" class="layui-input"><p class="help-block"><b>必选</b>，请填写项目名称</p></div></div><div class="layui-form-item"><label class="layui-form-label">地址</label><div class="layui-input-block"><input name="address" value='<?php echo htmlentities((isset($vo['address']) && ($vo['address'] !== '')?$vo['address']:""),ENT_QUOTES); ?>' required placeholder="请输入地址" class="layui-input"><p class="help-block"><b>必选</b>，请填写地址</p></div></div><div class="layui-form-item"><span class="layui-form-label">封面图片</span><div class="layui-input-block"><table class="layui-table"><thead><tr><th class="text-center">封面</th></tr><tr><td class="text-center text-top padding-0"><div class="help-images"><input name="cover" data-max-width="500" data-max-height="500" type="hidden" value="<?php echo htmlentities((isset($vo['cover']) && ($vo['cover'] !== '')?$vo['cover']:''),ENT_QUOTES); ?>"><script>$('[name="cover"]').uploadOneImage();</script></div></td></tr></thead></table></div></div><div class="layui-form-item"><label class="layui-form-label">工作时间段</label><div class="layui-input-block"><input name="work_time" value='<?php echo htmlentities((isset($vo['work_time']) && ($vo['work_time'] !== '')?$vo['work_time']:""),ENT_QUOTES); ?>' required placeholder="请输入工作时间段" class="layui-input"><p class="help-block"><b>必选</b>，请填写工作时间段</p></div></div><div class="layui-form-item"><label class="layui-form-label">状态</label><div class="layui-input-block"><select class="layui-select" lay-search name="status" lay-filter="status"><?php foreach(['关闭','开启'] as $key=>$value): if(isset($vo['status']) && $key == $vo['status']): ?><option selected value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item"  id="project_block"><label class="layui-form-label">绑定账号</label><div class="layui-input-block"><input type="hidden" name="sys_users" id="sys_users" required value="<?php echo htmlentities((isset($vo['sys_users']) && ($vo['sys_users'] !== '')?$vo['sys_users']:""),ENT_QUOTES); ?>"/><select   xm-select="sys_users_select"></select></div></div><div class="hr-line-dashed"></div><?php if(!(empty($vo['id']) || (($vo['id'] instanceof \think\Collection || $vo['id'] instanceof \think\Paginator ) && $vo['id']->isEmpty()))): ?><input type='hidden' value='<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>' name='id'><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>保存数据</button><button class="layui-btn layui-btn-danger" data-history-back data-confirm="确定要取消编辑吗？" type='button'>取消编辑</button></div></div></form><script>
    var data = [
                 <?php foreach($sysUsers as $item): ?>
                  {"name": "<?php echo htmlentities($item['name'],ENT_QUOTES); ?>", "value": <?php echo htmlentities($item['id'],ENT_QUOTES); ?>},
                 <?php endforeach; ?>
               ];
    form.render();
    var sys_users = new Array();
    require(['formSelects'], function (formSelects) {
            formSelects.data('sys_users_select', 'local', {
                arr: data
            });

            <?php if(!empty($vo)): ?>
            formSelects.value('sys_users_select', [<?php echo htmlentities($vo['sys_users'],ENT_QUOTES); ?>]); 
            sys_users =  [<?php echo htmlentities($vo['sys_users'],ENT_QUOTES); ?>];
            <?php endif; ?>            //绑定事件
            formSelects.on('sys_users_select', function(id, vals, val, isAdd, isDisabled){
                 if(isAdd){
                     sys_users.push(val.value);
                 }else{
                     var index = sys_users.indexOf(val.value);
                     sys_users.splice(index,1);
                 }
                 console.log(sys_users);
                $('#sys_users').val(sys_users.join(','));
            });
        })   
</script></div></div></div>