<?php 
use think\admin\Library;
use app\store\service\OrderService;
use think\Console;
use app\store\command\Settle;
use app\store\command\UnPayOrder;

if (Library::$sapp->request->isCli()) {
    // 动态注册操作指令
    Console::starting(function (Console $console) {
        $console->addCommand(Settle::class);
       
    });
}


if (Library::$sapp->request->isCli()) {
    // 动态注册操作指令
    Console::starting(function (Console $console) {
        $console->addCommand(UnPayOrder::class);
       
    });
}

Library::$sapp->event->listen('StoreOrderInStock', function ($orderid) {
    Library::$sapp->log->notice("订单 {$orderid} 更改状态入库中");
    OrderService::updateInStock($orderid);
});


Library::$sapp->event->listen('StoreOrderBack', function ($order) {
    Library::$sapp->log->notice("订单 ".$order['id']." 更改状态退回给客户");
    OrderService::back($order);
});


Library::$sapp->event->listen('StoreOrderWashing', function ($orderid) {
    Library::$sapp->log->notice("订单 {$orderid} 更改状态清洗中");
    OrderService::updateWashing($orderid);
});


Library::$sapp->event->listen('StoreOrderTransport', function ($orderid) {
    Library::$sapp->log->notice("订单 {$orderid} 更改状态运输中");
    OrderService::updateTransport($orderid);
});