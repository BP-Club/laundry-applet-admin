<?php /*a:3:{s:70:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/shop/goods/form.html";i:1670552399;s:76:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;s:75:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/shop/goods/formstyle.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><style>
    .goods-item-box fieldset {
        width: 260px;
        height: 80px;
        padding: 15px 20px;
        display: inline-block;
        margin: 0 15px 15px 0;
    }

    .inner-input {
        width: 80px;
        height: 14px;
        padding: 1px 5px;
        line-height: 12px;
    }

    .goods-spec-box {
        position: relative;
        margin: 0 10px 10px 0;
        background: #EEEEEE;
        vertical-align: middle;
    }

    .goods-spec-name {
        z-index: 2;
        width: 40px;
        color: #fff;
        height: 25px;
        position: absolute;
        background: #999;
        line-height: 26px;
    }

    .goods-spec-close {
        right: 8px;
        z-index: 2;
        line-height: 28px;
        position: absolute;
        display: inline-block
    }

    .goods-spec-btn {
        height: 28px;
        margin-left: 5px !important;
        line-height: 26px !important;
    }

    .goods-spec-box input {
        z-index: 1;
        width: 120px;
        position: relative;
        border: 1px solid #999;
        padding: 5px 0 5px 45px;
        display: inline-block !important;
    }

    .goods-spec-box input[type=checkbox] {
        z-index: 2;
        width: 40px;
        height: 28px;
        border: none;
        cursor: pointer;
        appearance: none;
        position: absolute;
        -webkit-appearance: none;
    }

    .goods-spec-box input[type=checkbox]:before {
        top: 1px;
        left: 1px;
        width: 40px;
        height: 24px;
        content: ' ';
        position: absolute;
        background: #c9c9c9;
    }

    .goods-spec-box input[type=checkbox]:after {
        top: 1px;
        left: 1px;
        color: #999;
        width: 40px;
        height: 24px;
        content: '\e63f';
        font-size: 16px;
        line-height: 24px;
        position: absolute;
        text-align: center;
        font-family: 'layui-icon';
    }

    .goods-spec-box input[type=checkbox]:checked:after {
        color: #333;
        content: '\e605';
    }
</style><form action="<?php echo sysuri(); ?>" method="post" data-auto="true" class="layui-form layui-card" id="GoodsForm"><div class="layui-card-body"><!--<?php if(!(empty($marks) || (($marks instanceof \think\Collection || $marks instanceof \think\Paginator ) && $marks->isEmpty()))): ?>--><div class="layui-form-item label-required-prev"><span class="help-label"><b>商品标签</b>Mark Name</span><div class="layui-textarea help-checks"><?php foreach($marks as $mark): ?><label class="think-checkbox"><?php if(isset($vo['marks']) && is_array($vo['marks']) && in_array($mark, $vo['marks'])): ?><input name="marks[]" type="checkbox" value="<?php echo htmlentities($mark,ENT_QUOTES); ?>" lay-ignore checked><?php echo htmlentities($mark,ENT_QUOTES); else: ?><input name="marks[]" type="checkbox" value="<?php echo htmlentities($mark,ENT_QUOTES); ?>" lay-ignore><?php echo htmlentities($mark,ENT_QUOTES); ?><?php endif; ?></label><?php endforeach; ?></div></div><!--<?php endif; ?>--><!--<?php if(!(empty($payments) || (($payments instanceof \think\Collection || $payments instanceof \think\Paginator ) && $payments->isEmpty()))): ?>--><div class="layui-form-item label-required-prev"><span class="help-label"><b>支付方式</b>Goods Payment</span><div class="layui-textarea help-checks"><?php foreach($payments as $payment): ?><label class="think-checkbox"><?php if(isset($vo['payment']) && is_array($vo['payment']) && in_array($payment['code'], $vo['payment'])): ?><input name="payment[]" type="checkbox" value="<?php echo htmlentities($payment['code'],ENT_QUOTES); ?>" lay-ignore checked><?php echo htmlentities($payment['name'],ENT_QUOTES); else: ?><input name="payment[]" type="checkbox" value="<?php echo htmlentities($payment['code'],ENT_QUOTES); ?>" lay-ignore><?php echo htmlentities($payment['name'],ENT_QUOTES); ?><?php endif; ?></label><?php endforeach; ?></div></div><!--<?php endif; ?>--><!--<?php if(!(empty($cates) || (($cates instanceof \think\Collection || $cates instanceof \think\Paginator ) && $cates->isEmpty()))): ?>--><label class="layui-form-item block relative"><span class="help-label label-required-prev"><b>所属分类</b>Category Name</span><select class="layui-select" lay-search name="cateids"><?php foreach($cates as $cate): if(in_array($cate['id'], $vo['cateids'])): ?><option selected value="<?php echo arr2str($cate['ids']); ?>"><?php echo join(' ＞ ', $cate['names']); ?></option><?php else: ?><option value="<?php echo arr2str($cate['ids']); ?>"><?php echo join(' ＞ ', $cate['names']); ?></option><?php endif; ?><?php endforeach; ?></select></label><!--<?php endif; ?>--><label class="layui-form-item block relative"><span class="help-label"><b>商品名称</b>Goods Name</span><input class="layui-input" name="name" placeholder="请输入商品名称" required value="<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:''),ENT_QUOTES); ?>"></label><!--<?php if(!(empty($trucks) || (($trucks instanceof \think\Collection || $trucks instanceof \think\Paginator ) && $trucks->isEmpty()))): ?>--><label class="layui-form-item block relative label-required-prev"><span class="help-label"><b>邮费模板</b>Truck Template</span><select class="layui-select" name="truck_code" lay-search><option value="">--- 包 邮 ---</option><?php foreach($trucks as $truck): if(isset($vo['truck_code']) and $vo['truck_code'] == $truck['code']): ?><option selected value="<?php echo htmlentities($truck['code'],ENT_QUOTES); ?>"><?php echo htmlentities($truck['code'],ENT_QUOTES); ?> - <?php echo htmlentities((isset($truck['name']) && ($truck['name'] !== '')?$truck['name']:''),ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities($truck['code'],ENT_QUOTES); ?>"><?php echo htmlentities($truck['code'],ENT_QUOTES); ?> - <?php echo htmlentities((isset($truck['name']) && ($truck['name'] !== '')?$truck['name']:''),ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select></label><!--<?php endif; ?>--><div class="layui-form-item label-required-prev"><span class="help-label"><b>商品封面及轮播图片</b>Cover and Carousel Pictures</span><table class="layui-table"><thead><tr><th class="text-center">封面</th><th class="text-left" style="width:100%">轮播图片</th></tr><tr><td class="text-center text-top padding-0"><div class="help-images"><input name="cover" data-max-width="500" data-max-height="500" type="hidden" value="<?php echo htmlentities((isset($vo['cover']) && ($vo['cover'] !== '')?$vo['cover']:''),ENT_QUOTES); ?>"><script>$('[name="cover"]').uploadOneImage();</script></div></td><td class="text-left padding-0"><div class="help-images"><input name="slider" data-max-width="2048" data-max-height="1024" type="hidden" value="<?php echo htmlentities((isset($vo['slider']) && ($vo['slider'] !== '')?$vo['slider']:''),ENT_QUOTES); ?>"><script>$('[name="slider"]').uploadMultipleImage();</script></div></td></tr></thead></table></div><div class="goods-item-box"><div class="flex flex-wrap"><fieldset class="layui-bg-gray"><legend><span class="layui-badge think-bg-violet">商品返利配置</span></legend><div><?php foreach(['非返利商品，其代理不会获得奖励','是返利商品，其代理将会获得奖励'] as $k => $v): if((isset($vo['rebate_type']) and $vo['rebate_type'] == $k) or (empty($vo['rebate_type']) and $k == 0)): ?><input checked name="rebate_type" title="<?php echo htmlentities($v,ENT_QUOTES); ?>" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php else: ?><input name="rebate_type" title="<?php echo htmlentities($v,ENT_QUOTES); ?>" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php endif; ?><?php endforeach; ?></div></fieldset><fieldset class="layui-bg-gray"><legend><span class="layui-badge think-bg-violet">入会礼包配置</span></legend><div><?php foreach(['非入会礼包，购买后不会升级等级','是入会礼包，购买后升级会员等级'] as $k=>$v): if((isset($vo['vip_entry']) and $vo['vip_entry'] == $k) or (empty($vo['vip_entry']) and $k == 0)): ?><input checked lay-filter="vip_entry" name="vip_entry" title="<?php echo htmlentities($v,ENT_QUOTES); ?>" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php else: ?><input lay-filter="vip_entry" name="vip_entry" title="<?php echo htmlentities($v,ENT_QUOTES); ?>" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php endif; ?><?php endforeach; ?></div></fieldset><!--<?php if(!(empty($upgrades) || (($upgrades instanceof \think\Collection || $upgrades instanceof \think\Paginator ) && $upgrades->isEmpty()))): ?>--><fieldset class="layui-bg-gray"><legend><span class="layui-badge think-bg-violet">升级用户等级</span></legend><label><select class="layui-select" lay-filter="vip_upgrade" name="vip_upgrade"><?php foreach($upgrades as $upgrade): if(isset($vo['vip_upgrade']) and $vo['vip_upgrade'] == $upgrade['number']): ?><option selected value="<?php echo htmlentities((isset($upgrade['number']) && ($upgrade['number'] !== '')?$upgrade['number']:0),ENT_QUOTES); ?>">[ <?php echo htmlentities((isset($upgrade['number']) && ($upgrade['number'] !== '')?$upgrade['number']:'0'),ENT_QUOTES); ?> ] <?php echo htmlentities((isset($upgrade['name']) && ($upgrade['name'] !== '')?$upgrade['name']:''),ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities((isset($upgrade['number']) && ($upgrade['number'] !== '')?$upgrade['number']:0),ENT_QUOTES); ?>">[ <?php echo htmlentities((isset($upgrade['number']) && ($upgrade['number'] !== '')?$upgrade['number']:'0'),ENT_QUOTES); ?> ] <?php echo htmlentities((isset($upgrade['name']) && ($upgrade['name'] !== '')?$upgrade['name']:''),ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select><span class="help-block">购买此商品用户可直接升级至此等级！</span></label></fieldset><!--<?php endif; ?>--><fieldset class="layui-bg-gray"><legend><span class="layui-badge think-bg-violet">物流配送发货类型</span></legend><div><?php foreach(['虚拟商品，无需物流配送','实物商品，需要物流配送'] as $k=>$v): if((isset($vo['truck_type']) and $vo['truck_type'] == $k) or (empty($vo['truck_type']) and $k == 0)): ?><input checked name="truck_type" title="<?php echo htmlentities($v,ENT_QUOTES); ?>" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php else: ?><input name="truck_type" title="<?php echo htmlentities($v,ENT_QUOTES); ?>" type="radio" value="<?php echo htmlentities($k,ENT_QUOTES); ?>"><?php endif; ?><?php endforeach; ?></div></fieldset><!--<?php if(!(empty($discounts) || (($discounts instanceof \think\Collection || $discounts instanceof \think\Paginator ) && $discounts->isEmpty()))): ?>--><fieldset class="layui-bg-gray"><legend><span class="layui-badge think-bg-violet">用户购买折扣方案</span></legend><label><select class="layui-select" lay-search name="discount_id"><option value="0"> -- 不设置 --</option><?php foreach($discounts as $discount): if(isset($vo['discount_id']) and $vo['discount_id'] == $discount['id']): ?><option selected value="<?php echo htmlentities((isset($discount['id']) && ($discount['id'] !== '')?$discount['id']:0),ENT_QUOTES); ?>"><?php echo htmlentities((isset($discount['name']) && ($discount['name'] !== '')?$discount['name']:'0'),ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities((isset($discount['id']) && ($discount['id'] !== '')?$discount['id']:0),ENT_QUOTES); ?>"><?php echo htmlentities((isset($discount['name']) && ($discount['name'] !== '')?$discount['name']:'0'),ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select><span class="help-block">当用户等级达到指定等级后可享有折扣！</span></label></fieldset><!--<?php endif; ?>--><!--<?php if(!(empty($upgrades) || (($upgrades instanceof \think\Collection || $upgrades instanceof \think\Paginator ) && $upgrades->isEmpty()))): ?>--><fieldset class="layui-bg-gray"><legend><span class="layui-badge think-bg-violet">限制最低购买等级</span></legend><label><select class="layui-select" name="limit_low_vip"><option value="0"> -- 不设置 --</option><?php foreach($upgrades as $upgrade): if(isset($vo['limit_low_vip']) and $vo['limit_low_vip'] == $upgrade['number']): ?><option selected value="<?php echo htmlentities((isset($upgrade['number']) && ($upgrade['number'] !== '')?$upgrade['number']:0),ENT_QUOTES); ?>">[ <?php echo htmlentities((isset($upgrade['number']) && ($upgrade['number'] !== '')?$upgrade['number']:'0'),ENT_QUOTES); ?> ] <?php echo htmlentities((isset($upgrade['name']) && ($upgrade['name'] !== '')?$upgrade['name']:''),ENT_QUOTES); ?></option><?php else: ?><option value="<?php echo htmlentities((isset($upgrade['number']) && ($upgrade['number'] !== '')?$upgrade['number']:0),ENT_QUOTES); ?>">[ <?php echo htmlentities((isset($upgrade['number']) && ($upgrade['number'] !== '')?$upgrade['number']:'0'),ENT_QUOTES); ?> ] <?php echo htmlentities((isset($upgrade['name']) && ($upgrade['name'] !== '')?$upgrade['name']:''),ENT_QUOTES); ?></option><?php endif; ?><?php endforeach; ?></select><span class="help-block">限制此等级及低于此等级的用户不能购买！</span></label></fieldset><!--<?php endif; ?>--><fieldset class="layui-bg-gray"><legend><span class="layui-badge think-bg-violet">商品限购数量</span></legend><label><input class="layui-input" type="number" min="0" data-blur-number="0" name="limit_max_num" placeholder="请输入商品限购数量" value="<?php echo htmlentities((isset($vo['limit_max_num']) && ($vo['limit_max_num'] !== '')?$vo['limit_max_num']:0),ENT_QUOTES); ?>"><span class="help-block">限制每人可购买数量（为 0 时不限制）！</span></label></fieldset></div></div><div class="layui-form-item"><span class="help-label label-required-prev"><b>商品规格及商品SKU绑定</b><span class="color-red font-s12">（规格填写后不允许再次修改）</span></span><div class="margin-bottom-10" ng-class="{true:'layui-show'}[mode==='add'&&specs.length>0]" ng-repeat="x in specs track by $index" style="display:none"><div class="goods-spec-box padding-10 margin-0 relative" style="background:#ddd"><span class="text-center goods-spec-name">分组</span><label class="label-required-null inline-block"><input ng-blur="x.name=trimSpace(x.name)" ng-model="x.name" placeholder="请输入分组名称" required></label><div class="pull-right"><a class="layui-btn layui-btn-sm layui-btn-primary goods-spec-btn" ng-click="addSpecVal(x.list)">增加</a><a class="layui-btn layui-btn-sm layui-btn-primary goods-spec-btn" ng-class="{false:'layui-btn-disabled'}[$index>0]" ng-click="upSpecRow(specs,$index)">上移</a><a class="layui-btn layui-btn-sm layui-btn-primary goods-spec-btn" ng-class="{false:'layui-btn-disabled'}[$index<specs.length-1]" ng-click="dnSpecRow(specs,$index)">下移</a><a class="layui-btn layui-btn-sm layui-btn-primary goods-spec-btn" ng-click="delSpecRow(specs,$index)" ng-if="specs.length>1">删除</a></div></div><div class="goods-spec-box padding-10 margin-0 block relative" ng-if="x.list && x.list.length > 0"><label class="label-required-null inline-block margin-right-10 margin-bottom-5 relative nowrap" ng-repeat="xx in x.list"><input lay-ignore ng-click="xx.check=checkListChecked(x.list,$event.target.checked)" ng-model="xx.check" type="checkbox"><input ng-blur="xx.name=trimSpace(xx.name)" ng-keyup="xx.name=$event.target.value" ng-model="xx.name" placeholder="请输入规格" required type="text"><a class="layui-icon layui-icon-close font-s12 goods-spec-close" ng-click="x.list=delSpecVal(x.list,$index)" ng-if="x.list.length>1"></a></label></div></div><div ng-if="mode==='add'"><a class="layui-btn layui-btn-sm layui-btn-primary" ng-click="addSpecRow(specs)" ng-if="specs.length<3">增加规则分组</a><p class="margin-top-10"><span class="color-red">请完成属性修改后再编辑下面的规格信息，否则规格数据会丢失！</span></p></div><table class="layui-table margin-top-10"><thead><tr><th class="nowrap" ng-repeat="x in navas track by $index"><b ng-bind="x"></b></th><th class="text-center nowrap pointer" data-tips-text="批量设置商品SKU" ng-click="batchSet('sku',null,'请输入商品SKU代码')" width="12%"><b>商品SKU</b><i class="layui-icon">&#xe63c;</i></th><th class="text-center nowrap pointer" data-tips-text="批量设置市场价格" ng-click="batchSet('market',2,'请输入商品市场价格')" width="10%"><b>市场价格</b><i class="layui-icon">&#xe63c;</i></th><th class="text-center nowrap pointer" data-tips-text="批量设置销售价格" ng-click="batchSet('selling',2,'请输入商品市销售价格')" width="10%"><b>销售价格</b><i class="layui-icon">&#xe63c;</i></th><th class="text-center nowrap pointer" data-tips-text="批量设置奖励余额" ng-click="batchSet('balance',2,'请输入赠送账户余额')" width="10%"><b>奖励余额</b><i class="layui-icon">&#xe63c;</i></th><th class="text-center nowrap pointer layui-hide" data-tips-text="批量设置奖励积分" ng-click="batchSet('integral',0,'请输入赠送用户积分')" width="10%"><b>奖励积分</b><i class="layui-icon">&#xe63c;</i></th><th class="text-center nowrap pointer" data-tips-text="批量设置虚拟销量" ng-click="batchSet('virtual',0,'请输入虚拟销量数值')" width="10%"><b>虚拟销量</b><i class="layui-icon">&#xe63c;</i></th><th class="text-center nowrap pointer" data-tips-text="批量设置快递计件" ng-click="batchSet('express',0,'请输入快递计费基数')" width="10%"><b>快递计件</b><i class="layui-icon">&#xe63c;</i></th><th class="text-center nowrap pointer" width="08%"><b>销售状态</b></th></tr></thead><tbody><tr ng-repeat="rows in items track by $index"><td class="layui-bg-gray nowrap" ng-bind="td.name" ng-if="td.show" ng-repeat="td in rows"></td><td class="padding-0"><label><input class="layui-input border-0 padding-left-0 text-center" ng-blur="rows[0].sku=setValue(rows[0].key,'sku',$event.target.value)" ng-model="rows[0].sku"></label></td><td class="padding-0"><label class="padding-0 margin-0"><input class="layui-input border-0 padding-left-0 text-center" ng-blur="rows[0].market=setValue(rows[0].key,'market',$event.target.value,'(parseFloat(_)||0).toFixed(2)')" ng-model="rows[0].market"></label></td><td class="padding-0"><label class="padding-0 margin-0"><input class="layui-input border-0 padding-left-0 text-center" ng-blur="rows[0].selling=setValue(rows[0].key,'selling',$event.target.value,'(parseFloat(_)||0).toFixed(2)')" ng-model="rows[0].selling"></label></td><td class="padding-0"><label class="padding-0 margin-0"><input class="layui-input border-0 padding-left-0 text-center" ng-blur="rows[0].balance=setValue(rows[0].key,'balance',$event.target.value,'(parseFloat(_)||0).toFixed(2)')" ng-model="rows[0].balance"></label></td><td class="padding-0 layui-hide"><label class="padding-0 margin-0"><input class="layui-input border-0 padding-left-0 text-center" ng-blur="rows[0].integral=setValue(rows[0].key,'integral',$event.target.value,'(parseInt(_)||0)')" ng-model="rows[0].integral"></label></td><td class="padding-0"><label class="padding-0 margin-0"><input class="layui-input border-0 padding-left-0 text-center" ng-blur="rows[0].virtual=setValue(rows[0].key,'virtual',$event.target.value,'(parseInt(_)||0)')" ng-model="rows[0].virtual"></label></td><td class="padding-0"><label class="padding-0 margin-0"><input class="layui-input border-0 padding-left-0 text-center" ng-blur="rows[0].express=setValue(rows[0].key,'express',$event.target.value,'(parseInt(_)||0)')" ng-model="rows[0].express"></label></td><td class="text-center layui-bg-gray"><label class="think-checkbox margin-0 full-width full-height block"><input lay-ignore ng-model="rows[0].status" type="checkbox"></label></td></tr></tbody></table><p class="color-desc">请注意商品的SKU尽量不要重复，也不能产生订单后再修改，否则会造成订单数据无法关联！</p><label class="layui-hide"><textarea class="layui-textarea" name="data_specs">{{specs}}</textarea><textarea class="layui-textarea" name="data_items">{{items}}</textarea></label></div><label class="layui-form-item block"><span class="help-label"><b>商品简介描述</b></span><textarea class="layui-textarea" name="remark" placeholder="请输入商品简介描述"><?php echo (isset($vo['remark']) && ($vo['remark'] !== '')?$vo['remark']:''); ?></textarea></label><div class="layui-form-item block"><span class="help-label label-required-prev"><b>商品富文本详情</b></span><textarea class="layui-hide" name="content"><?php echo (isset($vo['content']) && ($vo['content'] !== '')?$vo['content']:''); ?></textarea></div><div class="hr-line-dashed margin-top-40"></div><?php if(!(empty($vo['code']) || (($vo['code'] instanceof \think\Collection || $vo['code'] instanceof \think\Paginator ) && $vo['code']->isEmpty()))): ?><input name="code" type="hidden" value="<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>"><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn layui-btn-danger" ng-click="pageBack()" type="button">取消编辑</button><button class="layui-btn" type="submit">保存商品</button></div></div></form></div></div><label class="layui-hide"><textarea id="GoodsSpecs"><?php echo (isset($vo['data_specs']) && ($vo['data_specs'] !== '')?$vo['data_specs']:''); ?></textarea><textarea id="GoodsItems"><?php echo (isset($vo['data_items']) && ($vo['data_items'] !== '')?$vo['data_items']:''); ?></textarea></label><script>
    /*! 入会礼包切换 */
    window.form.on('radio(vip_entry)', setVipEntry);
    setVipEntry({value: ('<?php echo htmlentities((isset($vo['vip_entry']) && ($vo['vip_entry'] !== '')?$vo['vip_entry']:"0"),ENT_QUOTES); ?>')});

    function setVipEntry(data, $input) {
        $input = $('select[name="vip_upgrade"]');
        if (parseInt(data.value)) {
            $input.removeClass('layui-disabled').removeAttr('disabled');
        } else {
            $input.addClass('layui-disabled').attr('disabled', 'disabled');
        }
        layui.form.render();
    }

    /*! 加载扩展插件 */
    require(['ckeditor', 'angular'], function () {
        window.createEditor('[name="content"]', {height: 500});
        var app = angular.module("GoodsForm", []).run(callback);
        angular.bootstrap(document.getElementById(app.name), [app.name]);

        function getRand(length, prefix) {
            return (function (time, code) {
                code += parseInt(time.substring(0, 1)) + parseInt(time.substring(1, 2)) + time.substring(2);
                while (code.length < length) code += Math.round(Math.random() * 10);
                return code;
            })(Date.now().toString(), prefix || '' + '')
        }

        function callback($rootScope) {
            $rootScope.mode = '<?php echo htmlentities((isset($mode) && ($mode !== '')?$mode:"add"),ENT_QUOTES); ?>', $rootScope.navas = [];
            $rootScope.items = angular.fromJson(angular.element('#GoodsItems').val() || '[]') || {};
            $rootScope.cache = angular.fromJson(angular.element('#GoodsItems').val() || '[]') || {};
            $rootScope.specs = angular.fromJson(angular.element('#GoodsSpecs').val() || '[{"name":"默认分组","list":[{"name":"默认规格","check":true}]}]');
            /*! 批量设置数值 */
            $rootScope.batchSet = function (name, fixed, title) {
                layer.prompt({
                    title: title || (fixed === null ? '请输入内容' : '请输入数量【 取值范围：1 - 999999 】'),
                    formType: 0, value: fixed === null ? '' : (1).toFixed(fixed), success: function ($fn) {
                        var min = (1).toFixed(fixed), max = (999999).toFixed(fixed);
                        $fn.find('.layui-layer-input').attr({'data-value-min': min, 'data-value-max': max, 'data-blur-number': fixed});
                    }
                }, function (value, index) {
                    layer.close(index), $rootScope.$apply(function () {
                        if (fixed !== null) value = (parseFloat(value) || 0).toFixed(fixed);
                        $rootScope.items.forEach(function (rows) {
                            rows.forEach(function (item) {
                                item[name] = value;
                            });
                        });
                    });
                });
            };
            $rootScope.pageBack = function () {
                $.msg.confirm('确定要取消编辑吗？', function (index) {
                    history.back(), $.msg.close(index);
                });
            };
            $rootScope.setValue = function (key, name, value, callback) {
                $rootScope.items[key] = $rootScope.items[key] || {};
                $rootScope.cache[key] = $rootScope.cache[key] || {};
                if (typeof callback === 'string' && callback.indexOf('_') > -1) {
                    value = eval(callback.replace('_', "'" + value + "'"));
                }
                return $rootScope.cache[key][name] = $rootScope.items[key][name] = value;
            };
            $rootScope.getValue = function (key, name, value) {
                var cache = $rootScope.cache[key] || {};
                if (typeof cache[name] === 'undefined') {
                    $rootScope.setValue(key, name, value, '_')
                    cache = $rootScope.cache[key] || {};
                }
                return cache[name];
            };
            /*! 去除空白字符 */
            $rootScope.trimSpace = function (value) {
                return (value + '').replace(/\s*/ig, '');
            };
            /*! 当前商品规格发生变化时重新计算规格列表 */
            $rootScope.$watch('specs', function () {
                var data = [], navs = [], table = [[]];
                $rootScope.specs.forEach(function (spec) {
                    var temp = [];
                    spec.list.forEach(function (item) {
                        if (item.check && item.name.length > 0) {
                            item.show = true, item.group = spec.name;
                            temp.push(item);
                        }
                    });
                    data.push(temp), navs.push(spec.name);
                });
                $rootScope.navas = navs;
                /*! 表格交叉 */
                data.forEach(function (rows) {
                    var temp = [];
                    table.forEach(function (line) {
                        rows.forEach(function (item) {
                            temp.push(line.concat(item));
                        });
                    });
                    table = temp;
                });
                /*! 表格数据  */
                data = angular.fromJson(angular.toJson(table));
                data.forEach(function (rows) {
                    var keys = [];
                    rows.forEach(function (item) {
                        keys.push(item.group + '::' + item.name);
                    }), rows.every(function (item) {
                        item.key = keys.join(';;');
                        item.sku = $rootScope.getValue(item.key, 'sku', getRand(14, 'S'));
                        item.status = !!$rootScope.getValue(item.key, 'status', 1);
                        item.market = $rootScope.getValue(item.key, 'market', '0.00');
                        item.balance = $rootScope.getValue(item.key, 'balance', '0.00');
                        item.selling = $rootScope.getValue(item.key, 'selling', '0.00');
                        item.integral = $rootScope.getValue(item.key, 'integral', '0');
                        item.express = $rootScope.getValue(item.key, 'express', '1');
                        item.virtual = $rootScope.getValue(item.key, 'virtual', '0');
                        return false;
                    });
                });
                $rootScope.items = data;
            }, true);
            /*! 判断规则是否能取消选择 */
            $rootScope.checkListChecked = function (data, check) {
                for (var i in data) if (data[i].check) return check;
                return true;
            };
            /*! 下移整行规格分组 */
            $rootScope.dnSpecRow = function (items, index) {
                if (index + 1 < items.length) (function (item) {
                    items.splice(index + 1, 1), items.splice(index, 0, item);
                })(items[index + 1]);
            };
            /*! 上移整行规格分组 */
            $rootScope.upSpecRow = function (items, index) {
                if (index > 0) (function (item) {
                    items.splice(index - 1, 1), items.splice(index, 0, item);
                })(items[index - 1]);
            };
            /*! 移除整行规格分组 */
            $rootScope.delSpecRow = function (items, index) {
                items.splice(index, 1)
            };
            /*! 增加整行规格分组 */
            $rootScope.addSpecRow = function (data) {
                data.push({name: '规格分组' + data.length, list: [{name: '规格属性', check: true}]})
            };
            /*! 增加分组的属性 */
            $rootScope.addSpecVal = function (data) {
                data.push({name: '规格属性' + data.length, check: true});
            };
            /*! 移除分组的属性 */
            $rootScope.delSpecVal = function (data, $index) {
                var temp = [];
                data.forEach(function (item, index) {
                    if (parseInt(index) !== parseInt($index)) temp.push(item);
                });
                return temp;
            };
        }
    });
</script></div>