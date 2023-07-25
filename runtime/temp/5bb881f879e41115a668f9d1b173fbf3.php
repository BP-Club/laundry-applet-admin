<?php /*a:1:{s:72:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/store/view/order/back.html";i:1677468078;}*/ ?>
<form action="<?php echo sysuri(); ?>" method="post" data-auto="true" class="layui-form layui-card" data-table-id="BaseTable"><div class="layui-card-body padding-left-40"><div class="layui-form-item"><label class="layui-form-label">退回形式</label><div class="layui-input-block"><select class="layui-select" lay-search name="return_type" lay-filter="return_type"><?php foreach([1=>'自提',2=>'配送'] as $key=>$value): ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>"><?php echo htmlentities($value,ENT_QUOTES); ?></option>
                {/if}
                <?php endforeach; ?></select></div></div><div class="layui-form-item" id="address"><label class="layui-form-label">地址</label><div class="layui-input-block"><input name="address" value='<?php echo htmlentities((isset($order['takeAddr']['address']) && ($order['takeAddr']['address'] !== '')?$order['takeAddr']['address']:""),ENT_QUOTES); ?>' required placeholder="请输入地址" class="layui-input"><p class="help-block"><b>必选</b>，请填写地址</p></div></div><div class="layui-form-item"  id="contacts"><label class="layui-form-label">联系人</label><div class="layui-input-block"><input name="contacts" value='<?php echo htmlentities((isset($order['takeAddr']['name']) && ($order['takeAddr']['name'] !== '')?$order['takeAddr']['name']:""),ENT_QUOTES); ?>' required placeholder="请输入联系人" class="layui-input"><p class="help-block"><b>必选</b>，请填写联系人</p></div></div><div class="layui-form-item"  id="phone"><label class="layui-form-label">电话</label><div class="layui-input-block"><input name="phone" value='<?php echo htmlentities((isset($order['takeAddr']['phone']) && ($order['takeAddr']['phone'] !== '')?$order['takeAddr']['phone']:""),ENT_QUOTES); ?>' required placeholder="请输入地址" class="layui-input"><p class="help-block"><b>必选</b>，请填写电话</p></div></div><div class="layui-form-item"><label class="layui-form-label">备注</label><div class="layui-input-block"><textarea name="remark"  placeholder="请输入备注" maxlength="10000" class="layui-textarea"></textarea></div></div><input type='hidden' value='6' name='process_status'/><?php if(!(empty($order_id) || (($order_id instanceof \think\Collection || $order_id instanceof \think\Paginator ) && $order_id->isEmpty()))): ?><input type='hidden' value='<?php echo htmlentities($order_id,ENT_QUOTES); ?>' name='order_id'/><?php endif; ?></div><?php if(!(empty($id) || (($id instanceof \think\Collection || $id instanceof \think\Paginator ) && $id->isEmpty()))): ?><input type='hidden' value='<?php echo htmlentities($id,ENT_QUOTES); ?>' name='id'><?php endif; ?><div class="hr-line-dashed"></div><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>确定</button><button class="layui-btn layui-btn-danger" type='button'  data-close>取消</button></div><script>
        $("#address").hide();
        $("#contacts").hide();
        $("#phone").hide();
        form.on('select(return_type)', function(data){
             if(data.value==2){
                 $("#address").show();
                 $("#contacts").show();
                 $("#phone").show();
             }else{
                 $("#address").hide();
                 $("#contacts").hide();
                 $("#phone").hide();
             }
        }); 
    </script></form>