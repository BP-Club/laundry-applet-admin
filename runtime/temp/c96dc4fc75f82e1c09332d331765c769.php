<?php /*a:3:{s:73:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/admin/view/index/index.html";i:1670552399;s:78:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/admin/view/index/index-left.html";i:1670552399;s:77:"/www/wwwroot/test.cloudskys.cn/ThinkAdmin/app/admin/view/index/index-top.html";i:1670552399;}*/ ?>
<!DOCTYPE html><html lang="zh"><head><title><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); if(!empty($title)): ?> · <?php endif; ?><?php echo sysconf('site_name'); ?></title><meta charset="utf-8"><meta name="renderer" content="webkit"><meta name="format-detection" content="telephone=no"><meta name="apple-mobile-web-app-capable" content="yes"><meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"><meta name="apple-mobile-web-app-status-bar-style" content="black"><meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=0.4"><link rel="stylesheet" href="/static/plugs/layui/css/layui.css?at=<?php echo date('md'); ?>"><link rel="stylesheet" href="/static/theme/css/iconfont.css?at=<?php echo date('md'); ?>"><link rel="stylesheet" href="/static/theme/css/console.css?at=<?php echo date('md'); ?>"><link rel="stylesheet" href="/static/extra/style.css?at=<?php echo date('md'); ?>"><script src="/static/plugs/jquery/pace.min.js"></script><script src="<?php echo url('admin/api.plugs/script',[],false,false); ?>"></script></head><body class="layui-layout-body layui-layout-theme-<?php echo htmlentities((isset($theme) && ($theme !== '')?$theme:'default'),ENT_QUOTES); ?>"><div class="layui-layout layui-layout-admin layui-layout-left-hide"><!-- 左则菜单 开始 --><div class="layui-side"><a class="layui-side-target" data-target-menu-type></a><a class="layui-logo layui-elip" href="<?php echo sysuri('@'); ?>" title="<?php echo sysconf('app_name'); ?>"><span class="headimg headimg-no headimg-xs" data-lazy-src="<?php echo sysconf('site_icon'); ?>"></span><span class="headtxt"><?php echo sysconf('app_name'); if(sysconf('app_version')): ?><sup><?php echo sysconf('app_version'); ?></sup><?php endif; ?></span></a><div class="layui-side-scroll"><div class="layui-side-icon"><?php foreach($menus as $one): ?><div><a data-menu-node="m-<?php echo htmlentities($one['id'],ENT_QUOTES); ?>" data-open="<?php echo htmlentities($one['url'],ENT_QUOTES); ?>" data-target-tips="<?php echo htmlentities((isset($one['title']) && ($one['title'] !== '')?$one['title']:''),ENT_QUOTES); ?>"><?php if(!(empty($one['icon']) || (($one['icon'] instanceof \think\Collection || $one['icon'] instanceof \think\Paginator ) && $one['icon']->isEmpty()))): ?><i class="<?php echo htmlentities((isset($one['icon']) && ($one['icon'] !== '')?$one['icon']:''),ENT_QUOTES); ?>"></i><?php endif; ?><span><?php echo htmlentities((isset($one['title']) && ($one['title'] !== '')?$one['title']:''),ENT_QUOTES); ?></span></a></div><?php endforeach; ?></div><div class="layui-side-tree"><?php foreach($menus as $one): if(!(empty($one['sub']) || (($one['sub'] instanceof \think\Collection || $one['sub'] instanceof \think\Paginator ) && $one['sub']->isEmpty()))): ?><ul class="layui-nav layui-nav-tree layui-hide" data-menu-layout="m-<?php echo htmlentities($one['id'],ENT_QUOTES); ?>"><?php foreach($one['sub'] as $two): if(empty($two['sub']) || (($two['sub'] instanceof \think\Collection || $two['sub'] instanceof \think\Paginator ) && $two['sub']->isEmpty())): ?><li class="layui-nav-item"><a data-target-tips="<?php echo htmlentities($two['title'],ENT_QUOTES); ?>" data-menu-node="m-<?php echo htmlentities($one['id'],ENT_QUOTES); ?>-<?php echo htmlentities($two['id'],ENT_QUOTES); ?>" data-open="<?php echo htmlentities($two['url'],ENT_QUOTES); ?>"><span class='nav-icon <?php echo htmlentities((isset($two['icon']) && ($two['icon'] !== '')?$two['icon']:"layui-icon layui-icon-senior"),ENT_QUOTES); ?>'></span><span class="nav-text"><?php echo htmlentities((isset($two['title']) && ($two['title'] !== '')?$two['title']:''),ENT_QUOTES); ?></span></a></li><?php else: ?><li class="layui-nav-item" data-submenu-layout='m-<?php echo htmlentities($one['id'],ENT_QUOTES); ?>-<?php echo htmlentities($two['id'],ENT_QUOTES); ?>'><a data-target-tips="<?php echo htmlentities($two['title'],ENT_QUOTES); ?>"><span class='nav-icon layui-hide <?php echo htmlentities((isset($two['icon']) && ($two['icon'] !== '')?$two['icon']:"layui-icon layui-icon-triangle-d"),ENT_QUOTES); ?>'></span><span class="nav-text"><?php echo htmlentities((isset($two['title']) && ($two['title'] !== '')?$two['title']:''),ENT_QUOTES); ?></span></a><dl class="layui-nav-child"><?php foreach($two['sub'] as $thr): ?><dd><a data-target-tips="<?php echo htmlentities($thr['title'],ENT_QUOTES); ?>" data-open="<?php echo htmlentities($thr['url'],ENT_QUOTES); ?>" data-menu-node="m-<?php echo htmlentities($one['id'],ENT_QUOTES); ?>-<?php echo htmlentities($two['id'],ENT_QUOTES); ?>-<?php echo htmlentities($thr['id'],ENT_QUOTES); ?>"><span class='nav-icon <?php echo htmlentities((isset($thr['icon']) && ($thr['icon'] !== '')?$thr['icon']:"layui-icon layui-icon-senior"),ENT_QUOTES); ?>'></span><span class="nav-text"><?php echo htmlentities((isset($thr['title']) && ($thr['title'] !== '')?$thr['title']:''),ENT_QUOTES); ?></span></a></dd><?php endforeach; ?></dl></li><?php endif; ?><?php endforeach; ?></ul><?php endif; ?><?php endforeach; ?></div></div></div><!-- 左则菜单 结束 --><!-- 顶部菜单 开始 --><div class="layui-header"><ul class="layui-nav layui-layout-left"><li class="layui-nav-item" lay-unselect><a class="text-center" data-target-menu-type><i class="layui-icon layui-icon-spread-left"></i></a></li><li class="layui-nav-item" lay-unselect><a class="layui-logo-hide layui-elip" href="<?php echo sysuri('@'); ?>" title="<?php echo sysconf('app_name'); ?>"><span class="headimg headimg-no headimg-xs" data-lazy-src="<?php echo sysconf('site_icon'); ?>"></span></a></li><?php foreach($menus as $one): ?><li class="layui-nav-item"><a data-menu-node="m-<?php echo htmlentities($one['id'],ENT_QUOTES); ?>" data-open="<?php echo htmlentities($one['url'],ENT_QUOTES); ?>"><span><?php echo htmlentities((isset($one['title']) && ($one['title'] !== '')?$one['title']:''),ENT_QUOTES); ?></span></a></li><?php endforeach; ?></ul><ul class="layui-nav layui-layout-right"><li lay-unselect class="layui-nav-item"><a data-reload><i class="layui-icon layui-icon-refresh-3"></i></a></li><?php if(session('user.username')): ?><li class="layui-nav-item"><dl class="layui-nav-child"><dd lay-unselect><a data-modal="<?php echo sysuri('admin/index/info',['id'=>session('user.id')]); ?>"><i class="layui-icon layui-icon-set-fill"></i> 基本资料</a></dd><dd lay-unselect><a data-modal="<?php echo sysuri('admin/index/pass',['id'=>session('user.id')]); ?>"><i class="layui-icon layui-icon-component"></i> 安全设置</a></dd><?php if(isset($super) and $super): ?><dd lay-unselect><a data-load="<?php echo sysuri('admin/api.system/push'); ?>"><i class="layui-icon layui-icon-template-1"></i> 缓存加速</a></dd><dd lay-unselect><a data-load="<?php echo sysuri('admin/api.system/clear'); ?>"><i class="layui-icon layui-icon-fonts-clear"></i> 清理缓存</a></dd><?php endif; ?><dd lay-unselect><a data-width="520px" data-modal="<?php echo sysuri('admin/index/theme'); ?>"><i class="layui-icon layui-icon-theme"></i> 配色方案</a></dd><dd lay-unselect><a data-load="<?php echo sysuri('admin/login/out'); ?>" data-confirm="确定要退出登录吗？"><i class="layui-icon layui-icon-release"></i> 退出登录</a></dd></dl><a class="layui-elip"><span class="headimg" data-lazy-src="<?php echo htmlentities(session('user.headimg')); ?>"></span><span><?php echo htmlentities(session('user.nickname')?:session('user.username')); ?></span></a></li><?php else: ?><li class="layui-nav-item"><a data-href="<?php echo sysuri('admin/login/index'); ?>"><i class="layui-icon layui-icon-username"></i> 立即登录</a></li><?php endif; ?></ul></div><!-- 顶部菜单 结束 --><!-- 主体内容 开始 --><div class="layui-body"><div class="think-page-body"></div><!-- 页面加载动画 --><div class="think-page-loader layui-hide"><div class="loader"></div></div></div><!-- 主体内容 结束 --></div><!-- 加载动画 开始 --><div class="think-page-loader"><div class="loader"></div></div><!-- 加载动画 结束 --><script src="/static/plugs/layui/layui.js"></script><script src="/static/plugs/require/require.js"></script><script src="/static/admin.js"></script><script src="/static/extra/script.js"></script></body></html>