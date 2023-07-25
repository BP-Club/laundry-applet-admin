[CODE] 3
[INFO] 已完成对 50 张数据表优化操作
[FILE] think\admin\Exception in vendor/zoujingli/think-library/src/service/QueueService.php line 223
[TIME] 2023-02-02 21:01:15

[TRACE]
#0 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/Command.php(84): think\admin\service\QueueService->success()
#1 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/support/command/Database.php(94): think\admin\Command->setQueueSuccess()
#2 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/support/command/Database.php(57): think\admin\support\command\Database->_optimize()
#3 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/console/Command.php(210): think\admin\support\command\Database->execute()
#4 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(230): think\console\Command->run()
#5 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/support/command/Queue.php(327): think\Console->call()
#6 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/support/command/Queue.php(100): think\admin\support\command\Queue->doRunAction()
#7 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/console/Command.php(210): think\admin\support\command\Queue->execute()
#8 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(654): think\console\Command->run()
#9 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(313): think\Console->doRunCommand()
#10 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(250): think\Console->doRun()
#11 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/service/RuntimeService.php(226): think\Console->run()
#12 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/service/SystemService.php(407): think\admin\service\RuntimeService::doConsoleInit()
#13 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/service/SystemService.php(382): think\admin\service\SystemService::__callStatic()
#14 /www/wwwroot/cloudskys.cn/ThinkAdmin/think(25): think\admin\service\SystemService->__call()
#15 {main}