<?php

use app\data\command\OrderClean;
use app\data\command\UserAgent;
use app\data\command\UserAmount;
use app\data\command\UserTransfer;
use app\data\command\UserUpgrade;
use app\data\command\Pulish;
use app\data\command\Coupon;
use app\data\command\SharePoster;

use app\data\service\OrderService;
use app\data\service\RebateService;
use app\data\service\UserBalanceService;
use app\data\service\UserRebateService;
use think\admin\Library;
use think\Console;
use app\market\service\CouponService;


if (Library::$sapp->request->isCli()) {
    // 动态注册操作指令
    Console::starting(function (Console $console) {
        $console->addCommand(OrderClean::class);
        $console->addCommand(UserAgent::class);
        $console->addCommand(UserAmount::class);
        $console->addCommand(UserUpgrade::class);
        $console->addCommand(UserTransfer::class);
        $console->addCommand(Pulish::class);
        $console->addCommand(Coupon::class);
        $console->addCommand(SharePoster::class);
    });
} else {
    // 注册订单支付处理事件
    Library::$sapp->event->listen('ShopOrderPayment', function ($orderNo) {

        Library::$sapp->log->notice("订单 {$orderNo} 支付事件，执行用户返利行为");
        RebateService::instance()->execute($orderNo);

        Library::$sapp->log->notice("订单 {$orderNo} 支付事件，执行发放余额行为");
        UserBalanceService::confirm($orderNo);

        Library::$sapp->log->notice("订单 {$orderNo} 支付事件，执行用户升级行为");
        OrderService::upgrade($orderNo);
    });

    // 注册订单确认支付事件
    Library::$sapp->event->listen('ShopOrderConfirm', function ($orderNo) {
        Library::$sapp->log->notice("订单 {$orderNo} 确认事件，执行返利确认行为");
        UserRebateService::confirm($orderNo);
    });
    
    
     // 注册推广分享事件
    Library::$sapp->event->listen('ShareNewUser', function ($data) {
        Library::$sapp->log->notice("分享新用户事件触发");
        CouponService::gain('ShareNewUser',$data);
    });
    
}

if (!function_exists('show_goods_spec')) {
    /**
     * 商品规格过滤显示
     * @param string $spec 原规格内容
     * @return string
     */
    function show_goods_spec(string $spec): string
    {
        $specs = [];
        foreach (explode(';;', $spec) as $sp) {
            $specs[] = explode('::', $sp)[1];
        }
        return join(' ', $specs);
    }
}