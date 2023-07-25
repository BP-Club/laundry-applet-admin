<?php /*a:2:{s:76:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/project/view/project/form.html";i:1674897666;s:85:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/project/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><form action="<?php echo sysuri(); ?>" class="layui-card layui-form" data-auto="true" method="post"><div class="layui-card-body"><div class="layui-form-item"><label class="layui-form-label">项目名称</label><div class="layui-input-block"><input name="name" value='<?php echo htmlentities((isset($vo['title']) && ($vo['title'] !== '')?$vo['title']:""),ENT_QUOTES); ?>' required placeholder="请输入项目名称" class="layui-input"><p class="help-block"><b>必选</b>，请填写项目名称</p></div></div><div class="layui-form-item"><span class="layui-form-label">封面及轮播图片</span><div class="layui-input-block"><table class="layui-table"><thead><tr><th class="text-center">封面</th><th class="text-left" style="width:100%">轮播图片</th></tr><tr><td class="text-center text-top padding-0"><div class="help-images"><input name="cover" data-max-width="500" data-max-height="500" type="hidden" value="<?php echo htmlentities((isset($vo['cover']) && ($vo['cover'] !== '')?$vo['cover']:''),ENT_QUOTES); ?>"><script>$('[name="cover"]').uploadOneImage();</script></div></td><td class="text-left padding-0"><div class="help-images"><input name="slider" data-max-width="2048" data-max-height="1024" type="hidden" value="<?php echo htmlentities((isset($vo['slider']) && ($vo['slider'] !== '')?$vo['slider']:''),ENT_QUOTES); ?>"><script>$('[name="slider"]').uploadMultipleImage();</script></div></td></tr></thead></table></div></div><div class="layui-form-item"><label class="layui-form-label">基本价格</label><div class="layui-input-block"><input type="number" name="price_base" value='<?php echo htmlentities((isset($vo['price_base']) && ($vo['price_base'] !== '')?$vo['price_base']:"0"),ENT_QUOTES); ?>' required placeholder="请输入基本价格" class="layui-input"><p class="help-block"><b>必选</b>，请填写基本价格</p></div></div><div class="layui-form-item"><label class="layui-form-label">项目状态</label><div class="layui-input-block"><select class="layui-select" lay-search name="status" lay-filter="status"><?php foreach(['禁用','使用'] as $key=>$value): if(isset($vo['status']) && $key == $vo['status']): ?><option selected value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item"><label class="layui-form-label">计费模式</label><div class="layui-input-block"><select class="layui-select" lay-search name="charge_mode" lay-filter="charge_mode"><?php foreach([1=>'单只宠物叠加',2=>'固定宠物数量叠加',3=>'无宠物数量要求'] as $key=>$value): if(isset($vo['charge_mode']) && $key == $vo['charge_mode']): ?><option selected value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item" id="charge_pet_num"><label class="layui-form-label">固定宠物数量</label><div class="layui-input-block"><input type="number"    name="charge_pet_num" value='<?php echo htmlentities((isset($vo['charge_pet_num']) && ($vo['charge_pet_num'] !== '')?$vo['charge_pet_num']:"0"),ENT_QUOTES); ?>' required placeholder="请输入固定宠物数量" class="layui-input"><p class="help-block"><b>必选</b>例如100元包含3只猫的服务，第4只起才额外加价</p></div></div><div class="layui-form-item" id="maxnum_add_price"><label class="layui-form-label">每只宠物额外费用</label><div class="layui-input-block"><input type="number"    name="maxnum_add_price" value='<?php echo htmlentities((isset($vo['maxnum_add_price']) && ($vo['maxnum_add_price'] !== '')?$vo['maxnum_add_price']:"0"),ENT_QUOTES); ?>' required placeholder="每只宠物额外费用" class="layui-input"><p class="help-block"><b>必选</b></p></div></div><div class="layui-form-item"><label class="layui-form-label">超距离计费</label><div class="layui-input-block"><select class="layui-select" lay-search name="distance_charge" lay-filter="distance_charge"><?php foreach(['关闭','开启'] as $key=>$value): if(isset($vo['distance_charge']) && $key == $vo['distance_charge']): ?><option selected value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></div></div><div class="layui-form-item"  id="distance_charge_price" ><label class="layui-form-label">超距离收费价</label><div class="layui-input-block"><input type="number"  name="distance_charge_price" value='<?php echo htmlentities((isset($vo['distance_charge_price']) && ($vo['distance_charge_price'] !== '')?$vo['distance_charge_price']:"0"),ENT_QUOTES); ?>' required placeholder="请输入基本价格" class="layui-input"><p class="help-block"><b>必选</b>，请填超服务距离收费价</p></div></div><div class="layui-form-item"><label class="layui-form-label">附加项目</label><div class="layui-input-block"><input type="hidden" name="addit_item_ids" id="addit_item_ids" value="<?php echo htmlentities((isset($vo['addit_item_ids']) && ($vo['addit_item_ids'] !== '')?$vo['addit_item_ids']:""),ENT_QUOTES); ?>"/><select   xm-select="addit_item_select" xm-select-search=""></select></div></div><div class="layui-form-item"><label class="layui-form-label">服务备注(JSON配置)</label><div class="layui-input-block"><textarea name="service_remark_jsons"  placeholder="请输入文字" maxlength="10000" class="layui-textarea"><?php echo (isset($vo['service_remark_jsons']) && ($vo['service_remark_jsons'] !== '')?$vo['service_remark_jsons']:""); ?></textarea></div></div><div class="layui-form-item"><label class="layui-form-label">详情</label><div class="layui-input-block"><textarea name="detail" required="" placeholder="请输入文字" maxlength="10000" class="layui-textarea"><?php echo (isset($vo['detail']) && ($vo['detail'] !== '')?$vo['detail']:""); ?></textarea></div></div><div class="hr-line-dashed"></div><?php if(!(empty($vo['id']) || (($vo['id'] instanceof \think\Collection || $vo['id'] instanceof \think\Paginator ) && $vo['id']->isEmpty()))): ?><input type='hidden' value='<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>' name='id'><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>保存数据</button><button class="layui-btn layui-btn-danger" data-history-back data-confirm="确定要取消编辑吗？" type='button'>取消编辑</button></div></div><script>
        form.render();
        var addit_item_ids = new Array();
        require(['ckeditor','formSelects'], function (ckeditor,formSelects) {
            window.createEditor('[name="detail"]', {height: 500});
            formSelects.data('addit_item_select', 'local', {
                arr: [
                     <?php foreach($addititems as $item): ?>
                      {"name": "<?php echo htmlentities($item['title'],ENT_QUOTES); ?>", "value": <?php echo htmlentities($item['id'],ENT_QUOTES); ?>},
                     <?php endforeach; ?>
                ]
            });
            <?php if(!empty($vo)): ?>
            formSelects.value('addit_item_select', [<?php echo htmlentities($vo['addit_item_ids'],ENT_QUOTES); ?>]); 
            addit_item_ids =  [<?php echo htmlentities($vo['addit_item_ids'],ENT_QUOTES); ?>];
            <?php endif; ?>            formSelects.on('addit_item_select', function(id, vals, val, isAdd, isDisabled){
                 if(isAdd){
                     addit_item_ids.push(val.value);
                 }else{
                     var index = addit_item_ids.indexOf(val.value);
                     addit_item_ids.splice(index,1);
                 }
                 console.log(addit_item_ids);
                $('#addit_item_ids').val(addit_item_ids.join(','));
            });
        })
        
     
        <?php if(isset($vo['charge_mode']) && 2 == $vo['charge_mode']): ?>
        $("#charge_pet_num").show();
        $("#maxnum_add_price").show();
        <?php else: ?>
        $("#charge_pet_num").hide();
        $("#maxnum_add_price").hide();
        <?php endif; if(isset($vo['distance_charge']) && 1 == $vo['distance_charge']): ?>
        $("#distance_charge_price").show();
        <?php else: ?>
        $("#distance_charge_price").hide();
        <?php endif; ?>        form.on('select(charge_mode)', function(data){
             if(data.value==2){
                 $("#charge_pet_num").show();
                 $("#maxnum_add_price").show();
             }else{
                 $("#charge_pet_num").hide();
                 $("#maxnum_add_price").hide();
             }
        }); 
        
        form.on('select(distance_charge)', function(data){
             if(data.value==1){
                 $("#distance_charge_price").show();
             }else{
                 $("#distance_charge_price").hide();
             }
        }); 
        
        
        form.on('select(use_scene)', function(data){
          
        });
    </script></form></div></div></div>