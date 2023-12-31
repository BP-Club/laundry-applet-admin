<?php /*a:2:{s:74:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/base/config/cropper.html";i:1670552399;s:76:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="think-box-shadow" id="ContentBox"><div class="padding-left-20 padding-right-20" style="max-width:800px"><div class="margin-top-10"><p>1. 上传邀请码的背景图片（ 支持 PNG 和 JPG 格式 ）</p><p>2. 选择需要绘制二维码的区域，生成相对图片坐标参数</p><p>3. 保存位置数据，下次可直接显示</p></div><div class="margin-top-20"><div style="width:800px;height:572px"><img alt="img" class="layui-hide" id="target" src="<?php echo htmlentities((isset($data['image']) && ($data['image'] !== '')?$data['image']:'https://d3o1694hluedf9.cloudfront.net/market-750.jpg'),ENT_QUOTES); ?>"></div><div class="margin-top-5"><label class="margin-top-5 block"><input class="layui-input layui-bg-gray" id="inputImage" readonly value=''></label><label class="margin-top-5 block"><input class="layui-input layui-bg-gray" id="inputData" readonly value=''></label></div></div><div class="margin-top-20 text-center"><a class="layui-btn layui-btn-primary margin-right-5" data-type="png,jpg" data-upload-image>上传背景图片</a><a class="layui-btn layui-btn-primary margin-left-5" data-upload-commit>保存配置参数</a></div></div><label class="layui-hide"><textarea class="layui-textarea" id="DefaPostion"><?php echo htmlentities((isset($data['postion']) && ($data['postion'] !== '')?$data['postion']:''),ENT_QUOTES); ?></textarea></label></div><script>
    // 加载插件并显示界面
    require(['cropper'], function (Cropper) {
        (function (image, defaData, options, cropper) {

            // 初始化图片背景
            cropper = new Cropper(image, options = {
                viewMode: 2, aspectRatio: 1, ready: function () {
                    if (typeof defaData === 'object') cropper.setData(defaData);
                }, crop: function () {
                    $('#inputImage').val(image.src);
                    $('#inputData').val(JSON.stringify(cropper.getData()));
                },
            });

            // 背景图片上传并切换
            $('[data-upload-image]').uploadFile(function (url) {
                (image.src = url), cropper.destroy();
                cropper = new Cropper(image, options);
            });

            // 保存图片配置参数
            $('[data-upload-commit]').on('click', function () {
                $.form.load('<?php echo url(""); ?>', {image: image.src, postion: JSON.stringify(cropper.getData())}, 'post');
            });
        })(document.getElementById('target'), JSON.parse($('#DefaPostion').val() || '{}'));

        // 窗口大小重置事件
        $(window).on('resize', function () {
            (function (height) {
                $('#ContentBox').css('minHeight', height + 'px')
            })($('.layui-layout-admin>.layui-body').height() - 120);
        }).trigger('resize');
    });
</script></div></div></div>