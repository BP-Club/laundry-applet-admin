<?php /*a:2:{s:79:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/market/view/coupon/item/form.html";i:1676522485;s:84:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/market/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><form action="<?php echo sysuri(); ?>" class="layui-card layui-form" data-auto="true" method="post"><div class="layui-card-body"><div class="layui-form-item"><label class="layui-form-label">优惠卷名称</label><div class="layui-input-block"><input name="name" value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:""),ENT_QUOTES); ?>' required placeholder="请输入优惠卷名称" class="layui-input"><p class="help-block"><b>必选</b>，请填写菜单名称 </p></div></div><div class="layui-form-item"><label class="layui-form-label">抵扣金额</label><div class="layui-input-block"><input type="number" name="amount" value='<?php echo htmlentities((isset($vo['amount']) && ($vo['amount'] !== '')?$vo['amount']:"0"),ENT_QUOTES); ?>' required placeholder="请输入抵扣金额" class="layui-input"><p class="help-block"><b>必选</b>，请填写抵扣金额 </p></div></div><div class="layui-form-item"><label class="layui-form-label">说明</label><div class="layui-input-block"><textarea name="intro" required="" placeholder="请输入文字" maxlength="10000" class="layui-textarea"><?php echo htmlentities((isset($vo['intro']) && ($vo['intro'] !== '')?$vo['intro']:""),ENT_QUOTES); ?></textarea></div></div><div class="layui-form-item"><label class="layui-form-label">库存类型</label><div class="layui-input-block"><select class="layui-select" lay-search name="stock_type" lay-filter="stock_type"><?php foreach([1 => '数量无限',2 => '数量有限'] as $key=>$value): if(isset($vo['stock_type']) && $key == $vo['stock_type']): ?><option selected value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item"  id="stock" ><label class="layui-form-label">库存数量</label><div class="layui-input-block"><input type="number" name="stock" value='<?php echo htmlentities((isset($vo['stock']) && ($vo['stock'] !== '')?$vo['stock']:""),ENT_QUOTES); ?>' required placeholder="请输入库存数量" class="layui-input"><p class="help-block"><b>必选</b>，请填写库存数量</p></div></div><div class="layui-form-item"><label class="layui-form-label">使用场景</label><div class="layui-input-block"><select class="layui-select" lay-search name="use_scene" lay-filter="use_scene"><?php foreach([1 => '全平台',2 => '指定项目'] as $key=>$value): if(isset($vo['use_scene']) && $key == $vo['use_scene']): ?><option selected value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item"  id="project_block"><label class="layui-form-label">指定项目</label><div class="layui-input-block"><input type="hidden" name="project_ids" id="project_ids" value="<?php echo htmlentities((isset($vo['project_ids']) && ($vo['project_ids'] !== '')?$vo['project_ids']:""),ENT_QUOTES); ?>"/><select   xm-select="projects_select" xm-select-search=""></select></div></div><div class="layui-form-item"><label class="layui-form-label">使用要求</label><div class="layui-input-block"><select class="layui-select" lay-search name="use_requirement" lay-filter="use_requirement"><?php foreach([1 => '无要求',2 => '指定最低消费金额'] as $key=>$value): if(isset($vo['use_requirement']) && $key == $vo['use_requirement']): ?><option selected value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item" id="min_consume_amount" ><label class="layui-form-label">最低消费金额</label><div class="layui-input-block"><input type="number" name="min_consume_amount" value='<?php echo htmlentities((isset($vo['min_consume_amount']) && ($vo['min_consume_amount'] !== '')?$vo['min_consume_amount']:"0"),ENT_QUOTES); ?>' required placeholder="请输入最低消费金额" class="layui-input"><p class="help-block"><b>必选</b>，请填写最低消费金额 </p></div></div><div class="layui-form-item"><label class="layui-form-label">使用日期</label><div class="layui-input-block"><input data-date-range name="use_date" value='<?php echo htmlentities((isset($vo['use_date']) && ($vo['use_date'] !== '')?$vo['use_date']:""),ENT_QUOTES); ?>' placeholder="使用日期" required class="layui-input"></div></div><div class="hr-line-dashed"></div><?php if(!(empty($vo['id']) || (($vo['id'] instanceof \think\Collection || $vo['id'] instanceof \think\Paginator ) && $vo['id']->isEmpty()))): ?><input type='hidden' value='<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>' name='id'><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>保存数据</button><button class="layui-btn layui-btn-danger" data-history-back data-confirm="确定要取消编辑吗？" type='button'>取消编辑</button></div></div><script>        form.render();
        var project_ids = new Array();
        require(['formSelects'], function (formSelects) {
            formSelects.data('projects_select', 'local', {
                arr: [
                     <?php foreach($projects as $item): ?>
                      {"name": "<?php echo htmlentities($item['title'],ENT_QUOTES); ?>", "value": <?php echo htmlentities($item['id'],ENT_QUOTES); ?>},
                     <?php endforeach; ?>
                ]
            });
            <?php if(!empty($vo)): ?>
            formSelects.value('projects_select', [<?php echo htmlentities($vo['project_ids'],ENT_QUOTES); ?>]); 
            project_ids =  [<?php echo htmlentities($vo['project_ids'],ENT_QUOTES); ?>];
            <?php endif; ?>            formSelects.on('projects_select', function(id, vals, val, isAdd, isDisabled){
                 if(isAdd){
                     project_ids.push(val.value);
                 }else{
                     var index = project_ids.indexOf(val.value);
                     project_ids.splice(index,1);
                 }
                 console.log(project_ids);
                $('#project_ids').val(project_ids.join(','));
            });
        })
     
        <?php if(isset($vo['use_scene']) && 2 == $vo['use_scene']): ?>
        $("#project_block").show();
        <?php else: ?>
        $("#project_block").hide();
        <?php endif; if(isset($vo['stock_type']) && 2 == $vo['stock_type']): ?>
        $("#stock").show();
        <?php else: ?>
        $("#stock").hide();
        <?php endif; if(isset($vo['use_requirement']) && 2 == $vo['use_requirement']): ?>
        $("#min_consume_amount").show();
        <?php else: ?>
        $("#min_consume_amount").hide();
        <?php endif; ?>        form.on('select(stock_type)', function(data){
             if(data.value==2){
                 $("#stock").show();
             }else{
                 $("#stock").hide();
             }
        }); 
        
        form.on('select(use_requirement)', function(data){
             if(data.value==2){
                 $("#min_consume_amount").show();
             }else{
                 $("#min_consume_amount").hide();
             }
        }); 
        
        
        form.on('select(use_scene)', function(data){
             if(data.value==2){
                 $("#project_block").show();
             }else{
                 $("#project_block").hide();
             }
        });
    </script></form></div></div></div>