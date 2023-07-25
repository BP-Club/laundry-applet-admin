<?php /*a:2:{s:71:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/base/slider/form.html";i:1670552399;s:76:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><style>
    [data-upload-image] + .uploadimage {
        width: 100px;
        height: 100px;
        margin: 0 !important;
    }
</style><div class="think-box-shadow"><form id="DataForm" class='layui-form' autocomplete='off' action="<?php echo sysuri(); ?>?type=<?php echo htmlentities((isset($get['type']) && ($get['type'] !== '')?$get['type']:''),ENT_QUOTES); ?>" onsubmit="return false" style="width:850px"><div class="text-center padding-top-10"><b class="color-text font-s16"><?php echo htmlentities((isset($title) && ($title !== '')?$title:'图片内容管理'),ENT_QUOTES); ?></b><div class="color-desc font-s12"><?php echo htmlentities((isset($base['content']) && ($base['content'] !== '')?$base['content']:'图片尺寸：1080px * 1882px'),ENT_QUOTES); ?></div><!--<?php if($app->isDebug() && !empty($skey)): ?>--><i class="color-desc pull-right"><?php echo htmlentities($skey,ENT_QUOTES); ?></i><!--<?php endif; ?>--></div><div class="hr-line-dashed margin-bottom-25"></div><div class="layui-form-item" data-item-box><div class="layui-form-item text-center"><a class="layui-btn layui-btn-normal" data-item-add>添加选项</a></div></div><div class="hr-line-dashed"></div><div class="layui-form-item text-center"><button class="layui-btn" data-submit>保存数据</button></div></form></div><div data-item-tpl class="layui-hide"><div class="layui-form-item" style="padding-left:80px" data-news-item><div class="layui-input-inline text-center" style="width:140px"><input data-upload-image name="img[]" type="hidden"></div><div class="nowrap margin-bottom-5"><label class="inline-block relative text-middle"><span class="color-green font-s13 margin-right-5">图标标题</span><input class="layui-input inline-block" style="width:280px" name="title[]" value="#" required placeholder="请输入图标标题"></label><div class="inline-block margin-left-5"><a data-item-up class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-up"></i></a><a data-item-dn class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-down"></i></a><a data-item-rm class="layui-btn layui-btn-primary"><i class="layui-icon layui-icon-close"></i></a></div></div><div class="nowrap margin-bottom-5"><label class="inline-block relative"><span class="color-green font-s13 margin-right-5">跳转规则</span><input class="layui-input inline-block" style="width:280px" name="url[]" value="#" required placeholder="请输入跳转规则"></label><div class="inline-block margin-left-5"><select class="layui-select" name="type[]" lay-filter="TypeSelect" data-item-rule lay-ignore><?php foreach($rules as $key=>$rule): ?><option value="<?php echo htmlentities($key,ENT_QUOTES); ?>" data-node="<?php echo htmlentities((isset($rule['node']) && ($rule['node'] !== '')?$rule['node']:''),ENT_QUOTES); ?>"><?php echo htmlentities($key,ENT_QUOTES); ?> - <?php echo htmlentities($rule['name'],ENT_QUOTES); ?></option><?php endforeach; ?></select></div><div class="help-block">若要跳转页面，请选择对应的数据或填写跳转的 URL 地址，不跳转请填写 “#” 号占位。</div></div></div></div><label class="layui-hide"><textarea id="DefaultData"><?php echo htmlentities(json_encode((isset($data) && ($data !== '')?$data:[])),ENT_QUOTES); ?></textarea></label><script>
    $(function () {

        /*! 默认数据处理 */
        var defas = JSON.parse($('#DefaultData').val()), idx;
        if (defas.length > 0) for (idx in defas) addItem(defas[idx]); else addItem({});

        /*! 跳转规则选择器 */
        layui.form.on('select(TypeSelect)', function (data) {
            var input = $(data.elem).parent().prev('label').find('input');
            var option = data.elem.options[data.elem.options.selectedIndex];
            var title = option.innerText.split(' - ').pop(), node = option.dataset.node;
            window.setItemValue = function (id, name) {
                input.val(data.value + '#' + (id || '0') + '#' + (name || title));
            }, this.openModel = function (url) {
                return $.form.modal(url, {}, title, null, true, null, '840px', '5%');
            };

            if (data.value === '#') return input.val('#');
            if (data.value === 'LK') return /^https?:\/\//.test(input.val()) || input.val('#').focus();
            if (node.length > 0) return this.openModel('<?php echo url("@URLTEMP"); ?>'.replace('URLTEMP', node));
            return window.setItemValue();
        });

        /*! 表单元素操作 */
        $('form#DataForm').on('click', '[data-item-add]', function () {
            addItem({});
        }).on('click', '[data-item-rm]', function () {
            $(this).parents('[data-news-item]').remove();
            setAddButton();
        }).on('click', '[data-item-up]', function () {
            var item = $(this).parents('[data-news-item]');
            var prev = item.prev('[data-news-item]');
            if (item.index() > 0) item.insertBefore(prev);
        }).on('click', '[data-item-dn]', function () {
            var item = $(this).parents('[data-news-item]');
            var next = item.next('[data-news-item]');
            if (next) item.insertAfter(next);
        }).vali(function (form, data) {
            for (idx in form.img) {
                if (!form.img[idx]) return $.msg.tips('需要上传图片文件哦！');
                data.push({img: form.img[idx], url: form.url[idx], type: form.type[idx], title: form.title[idx]});
            }
            $.form.load(this.action, {data: JSON.stringify(data)}, 'post');
        });

        /*! 添加图片数据项 */
        function addItem(data) {
            data.url = data.url || '#';
            var $html = $($('[data-item-tpl]').html());
            for (idx in data) $html.find('[name^=' + idx + ']').val(data[idx]);
            $html.find('select').removeAttr('lay-ignore').find('option').each(function () {
                if (data.url === '#' && this.value === data.url) this.selected = true;
                else if (this.value === data.url.split('#')[0]) this.selected = true;
            }), $('[data-item-add]').parent().before($html), setAddButton();
            /*! 初始化插件绑定 */
            $.form.reInit($html).find('input[data-upload-image]').uploadOneImage();
        }

        /*! 检查并操作按钮 */
        function setAddButton() {
            this.limit = parseInt('<?php echo htmlentities((isset($number) && ($number !== '')?$number:0),ENT_QUOTES); ?>');
            this.laster = $('[data-item-box] [data-item-add]').parent();
            this.number = $('[data-item-box] [data-news-item]').size();
            if (this.number >= this.limit && this.limit > 0) {
                this.laster.addClass('layui-hide');
            } else {
                this.laster.removeClass('layui-hide');
            }
        }
    });
</script></div></div></div>