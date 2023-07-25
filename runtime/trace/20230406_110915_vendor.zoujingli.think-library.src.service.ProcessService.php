[CODE] 0
[INFO] exec() has been disabled for security reasons
[FILE] think\exception\ErrorException in vendor/zoujingli/think-library/src/service/ProcessService.php line 140
[TIME] 2023-04-06 11:09:15

[TRACE]
#0 [internal function]: think\initializer\Error->appError()
#1 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/zoujingli/think-library/src/service/ProcessService.php(140): exec()
#2 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/zoujingli/think-library/src/service/ProcessService.php(163): think\admin\service\ProcessService::exec()
#3 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/zoujingli/think-library/src/service/ProcessService.php(49): think\admin\service\ProcessService::isfile()
#4 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/zoujingli/think-library/src/support/command/Queue.php(275): think\admin\service\ProcessService::think()
#5 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/zoujingli/think-library/src/support/command/Queue.php(253): think\admin\support\command\Queue->createListenProcess()
#6 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/zoujingli/think-library/src/support/command/Queue.php(100): think\admin\support\command\Queue->listenAction()
#7 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/topthink/framework/src/think/console/Command.php(210): think\admin\support\command\Queue->execute()
#8 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(654): think\console\Command->run()
#9 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(313): think\Console->doRunCommand()
#10 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/topthink/framework/src/think/Console.php(250): think\Console->doRun()
#11 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/zoujingli/think-library/src/service/RuntimeService.php(226): think\Console->run()
#12 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/zoujingli/think-library/src/service/SystemService.php(407): think\admin\service\RuntimeService::doConsoleInit()
#13 /www/wwwroot/uexwash.com/ThinkAdmin/vendor/zoujingli/think-library/src/service/SystemService.php(382): think\admin\service\SystemService::__callStatic()
#14 /www/wwwroot/uexwash.com/ThinkAdmin/think(25): think\admin\service\SystemService->__call()
#15 {main}