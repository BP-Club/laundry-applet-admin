大道至简 · 原生框架
---

## 代码仓库

ThinkAdmin 为 MIT 协议开源项目，安装使用或二次开发不受约束，欢迎 fork 项目。

部分代码来自互联网，若有异议可以联系作者进行删除。

* 在线体验地址：https://v6.thinkadmin.top （账号和密码都是 admin ）
* Gitee仓库地址：https://gitee.com/zoujingli/ThinkAdmin/tree/v6
* GitHub仓库地址：https://github.com/zoujingli/ThinkAdmin/tree/v6

## 框架指令

* 执行 `build.cmd` 可更新 `composer` 插件，会删除并替换 `vendor` 目录
* 执行 `php think run` 启用本地开发环境，访问 `http://127.0.0.1:8000`
* 执行 `php think xadmin:fansall` 同步微信粉丝数据（依赖于 `wechat` 模块）
* 执行 `php think xadmin:sysmenu` 重写系统菜单并生成新编号并清理已禁用的菜单
* 执行 `php think xadmin:version` 查看当前版本号，显示 `ThinkPHP` 版本及 `ThinkLibrary` 版本

#### 1. 线上代码更新

* 执行 `php think xadmin:install admin` 从线上服务更新 `admin` 模块的所有文件（注意文件安全）
* 执行 `php think xadmin:install wechat` 从线上服务更新 `wechat` 模块的所有文件（注意文件安全）
* 执行 `php think xadmin:install static` 从线上服务更新 `static` 静态资料文件（注意文件安全）
* 执行 `php think xadmin:install config` 从线上服务更新 `config` 常用配置文件（注意文件安全）

#### 2. 守护进程管理（可自建定时任务去守护监听主进程）

* 执行 `php think xadmin:queue listen` [监听]启动异步任务监听服务
* 执行 `php think xadmin:queue start`  [控制]检查创建任务监听服务（建议定时任务执行）
* 执行 `php think xadmin:queue query`  [控制]查询当前任务相关的进程
* 执行 `php think xadmin:queue status`  [控制]查看异步任务监听状态
* 执行 `php think xadmin:queue stop`   [控制]平滑停止所有任务进程

#### 3. 本地调试管理（可自建定时任务去守护监听主进程）

* 执行 `php think xadmin:queue webstop` [调试]停止本地调试服务
* 执行 `php think xadmin:queue webstart` [调试]开启本地调试服务（建议定时任务执行）
* 执行 `php think xadmin:queue webstatus` [调试]查看本地调试状态

## 问题修复

* 增加`CORS`跨域规则配置，配置参数置放于`config/app.php`，需要更新`ThinkLibrary`。
* 修复`layui.table`导致基于`ThinkPHP`模板输出自动转义`XSS`过滤机制失效，需要更新`ThinkLibrary`。
* 修复在模板中使用`{:input(NAME)}`取值而产生的`XSS`问题，模板取值更换为`{$get.NAME|default=''}`。
* 修复`CKEDITOR`配置文件，禁用所有标签的`on`事件，阻止`xss`脚本注入，需要更新`ckeditor/config.js`。
* 修复文件上传入口的后缀验证，读取真实文件后缀与配置对比，阻止不合法的文件上传并存储到本地服务器。
* 修改`JsonRpc`接口异常处理机制，当服务端绑定`Exception`时，客户端将能收到`error`消息及异常数据。
* 修改`location.hash`访问机制，禁止直接访问外部`URL`资源链接，防止外部`XSS`攻击读取本地缓存数据。
* 增加后台主题样式配置，支持全局默认+用户个性配置，需要更新`ThinkLibrary`,`static`,`admin`组件及模块。
* 后台行政区域数据更新，由原来的腾讯地图数据切换为百度地图最新数据，需要更新`static`，数据库版需另行更新。

## 项目版本

体验账号及密码都是 admin

