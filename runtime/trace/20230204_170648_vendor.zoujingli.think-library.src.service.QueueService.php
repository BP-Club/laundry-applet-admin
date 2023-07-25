[CODE] 4
[INFO] 没有用户数据可操作！
[FILE] think\admin\Exception in vendor/zoujingli/think-library/src/service/QueueService.php line 233
[TIME] 2023-02-04 17:06:48

[TRACE]
#0 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/Command.php(69): think\admin\service\QueueService->error()
#1 /www/wwwroot/cloudskys.cn/ThinkAdmin/app/data/command/Coupon.php(53): think\admin\Command->setQueueError()
#2 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/console/Command.php(210): app\data\command\Coupon->execute()
#3 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(230): think\console\Command->run()
#4 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/support/command/Queue.php(327): think\Console->call()
#5 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/support/command/Queue.php(100): think\admin\support\command\Queue->doRunAction()
#6 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/console/Command.php(210): think\admin\support\command\Queue->execute()
#7 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(654): think\console\Command->run()
#8 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(313): think\Console->doRunCommand()
#9 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(250): think\Console->doRun()
#10 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/service/RuntimeService.php(226): think\Console->run()
#11 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/service/SystemService.php(407): think\admin\service\RuntimeService::doConsoleInit()
#12 /www/wwwroot/cloudskys.cn/ThinkAdmin/vendor/zoujingli/think-library/src/service/SystemService.php(382): think\admin\service\SystemService::__callStatic()
#13 /www/wwwroot/cloudskys.cn/ThinkAdmin/think(25): think\admin\service\SystemService->__call()
#14 {main}