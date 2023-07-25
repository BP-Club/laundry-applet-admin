<?php /*a:2:{s:68:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/wechat/view/news/index.html";i:1670552399;s:79:"/www/wwwroot/cloudskys.cn/ThinkAdmin/app/wechat/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><style>
    #news-box {
        position: relative
    }

    #news-box .news-item {
        top: 0;
        left: 0;
        padding: 5px;
        margin: 10px;
        width: 300px;
        overflow: hidden;
        position: relative;
        border-radius: 5px;
        border: 1px solid #ccc;
        box-sizing: content-box;
        box-shadow: 0 2px 3px 0 rgba(0, 0, 0, 0.2);
    }

    #news-box .news-item .news-articel-item {
        height: 150px;
    }

    #news-box .news-item .news-articel-item p {
        bottom: 0;
        width: 100%;
        color: #fff;
        padding: 5px;
        max-height: 5em;
        font-size: 12px;
        overflow: hidden;
        position: absolute;
        text-overflow: ellipsis;
        background: rgba(0, 0, 0, .7)
    }

    #news-box .news-item .news-articel-item.other {
        height: 50px;
        padding: 5px 0
    }

    #news-box .news-item .news-articel-item span {
        width: 225px;
        overflow: hidden;
        line-height: 50px;
        white-space: nowrap;
        display: inline-block;
        text-overflow: ellipsis
    }

    #news-box .news-item .news-articel-item div {
        width: 70px;
        height: 50px;
        float: right;
        overflow: hidden;
        position: relative;
        background-position: center center;
        background-size: cover;
    }

    #news-box .hr-line-dashed {
        margin: 6px 0 1px 0
    }

    #news-box .news-item .hr-line-dashed:last-child {
        display: none
    }

    #news-box .news-tools {
        top: 0;
        z-index: 80;
        color: #fff;
        width: 302px;
        padding: 0 5px;
        margin-left: -6px;
        line-height: 38px;
        text-align: right;
        position: absolute;
        background: rgba(0, 0, 0, .7)
    }

    #news-box .news-tools a {
        color: #fff;
        margin-left: 10px
    }
</style><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"><?php if(auth('add')): ?><button data-open="<?php echo url('add'); ?>" class='layui-btn layui-btn-sm layui-btn-primary'>添加图文</button><?php endif; ?></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="think-box-shadow"><div id="news-box" class="layui-clear layui-hide"><?php foreach($list as $vo): ?><div class="news-item"><div class='news-tools layui-hide'><a data-phone-view="<?php echo url('wechat/api.view/news'); ?>?id=<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>" style="cursor:pointer">预览</a><a data-open='<?php echo url("edit"); ?>?id=<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>' style="cursor:pointer">编辑</a><a data-news-del="<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>" style="cursor:pointer">删除</a></div><?php foreach($vo['articles'] as $k => $v): if($k < 1): ?><div data-tips-image='<?php echo htmlentities($v['local_url'],ENT_QUOTES); ?>' data-lazy-src="<?php echo htmlentities($v['local_url'],ENT_QUOTES); ?>" class='news-articel-item'><?php if($v['title']): ?><p><?php echo htmlentities($v['title'],ENT_QUOTES); ?></p><?php endif; ?></div><div class="hr-line-dashed"></div><?php else: ?><div class='news-articel-item other'><span><?php echo htmlentities($v['title'],ENT_QUOTES); ?></span><div data-tips-image='<?php echo htmlentities($v['local_url'],ENT_QUOTES); ?>' data-lazy-src="<?php echo htmlentities($v['local_url'],ENT_QUOTES); ?>"></div></div><div class="hr-line-dashed"></div><?php endif; ?><?php endforeach; ?></div><?php endforeach; ?></div><?php if(empty($list) || (($list instanceof \think\Collection || $list instanceof \think\Paginator ) && $list->isEmpty())): ?><span class="notdata">没有记录哦</span><?php else: ?><?php echo (isset($pagehtml) && ($pagehtml !== '')?$pagehtml:''); ?><?php endif; ?></div></div></div><script>
    $('body').off('mouseenter', '.news-item').on('mouseenter', '.news-item', function () {
        $(this).find('.news-tools').removeClass('layui-hide');
    }).off('mouseleave', '.news-item').on('mouseleave', '.news-item', function () {
        $(this).find('.news-tools').addClass('layui-hide');
    });
    $.msg.loading();
    require(['jquery.masonry'], function (Masonry) {
        layui.layer.closeAll();
        $('#news-box').removeClass('layui-hide');
        var newsbox = document.querySelector('#news-box');
        var msnry = new Masonry(newsbox, {itemSelector: '.news-item', columnWidth: 0});
        msnry.layout(), $('body').on('click', '[data-news-del]', function (event) {
            $.msg.confirm('确定要删除图文吗？', function (index) {
                $.msg.close(index), $.form.load('<?php echo url("remove"); ?>', {value: 0, field: 'delete', id: $(event.target).data('news-del')}, 'post', function (ret) {
                    if (ret.code) {
                        $(event.target).parents('.news-item').remove();
                        msnry = new Masonry(newsbox, {itemSelector: '.news-item', columnWidth: 0});
                        return msnry.layout(), (msnry.items.length < 1 && $.form.open('<?php echo url("index"); ?>')), $.msg.success(ret.info), false;
                    } else {
                        return $.msg.error(ret.info), false;
                    }
                });
            });
        });
    });
</script></div>