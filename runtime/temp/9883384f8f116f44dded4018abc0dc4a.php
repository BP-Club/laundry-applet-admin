<?php /*a:2:{s:73:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/total/portal/index.html";i:1678083989;s:76:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="think-box-shadow portal-block-container notselect"><div class="layui-row layui-col-space15"><div class="layui-col-sm6 layui-col-md3"><div class="portal-block-item nowrap" style="background:linear-gradient(-125deg,#57bdbf,#2f9de2)"><div>商品总量</div><div><?php echo htmlentities((isset($goodsTotal) && ($goodsTotal !== '')?$goodsTotal:'0'),ENT_QUOTES); ?></div><div>当前商品总数量</div></div><i class="portal-block-icon layui-icon layui-icon-app"></i></div><div class="layui-col-sm6 layui-col-md3"><div class="portal-block-item nowrap" style="background:linear-gradient(-125deg,#ff7d7d,#fb2c95)"><div>用户总量</div><div><?php echo htmlentities((isset($usersTotal) && ($usersTotal !== '')?$usersTotal:'0'),ENT_QUOTES); ?></div><div>当前用户总数量</div></div><i class="portal-block-icon layui-icon layui-icon-user"></i></div><div class="layui-col-sm6 layui-col-md3"><div class="portal-block-item nowrap" style="background:linear-gradient(-113deg,#c543d8,#925cc3)"><div>订单总量</div><div><?php echo htmlentities((isset($orderTotal) && ($orderTotal !== '')?$orderTotal:'0'),ENT_QUOTES); ?></div><div>已付款订单总数</div></div><i class="portal-block-icon layui-icon layui-icon-form"></i></div><div class="layui-col-sm6 layui-col-md3"><div class="portal-block-item nowrap" style="background:linear-gradient(-141deg,#ecca1b,#f39526)"><div>交易金额</div><div><?php echo htmlentities((isset($amountTotal) && ($amountTotal !== '')?$amountTotal:'0'),ENT_QUOTES); ?></div><div>已成交金额总数</div></div><i class="portal-block-icon layui-icon layui-icon-rmb"></i></div></div></div><div class="layui-row layui-col-space15 margin-top-10"><div class="layui-col-xs12 layui-col-md6"><div class="think-box-shadow"><div id="main1" style="width:100%;height:350px"></div></div></div><div class="layui-col-xs12 layui-col-md6"><div class="think-box-shadow"><div id="main2" style="width:100%;height:350px"></div></div></div><div class="layui-col-xs12 layui-col-md6"><div class="think-box-shadow"><div id="main3" style="width:100%;height:350px"></div></div></div><div class="layui-col-xs12 layui-col-md6"><div class="think-box-shadow"><div id="main4" style="width:100%;height:350px"></div></div></div><div class="layui-col-xs12 layui-col-md6"><div class="think-box-shadow"><div id="main5" style="width:100%;height:350px"></div></div></div></div><label class="layui-hide"><textarea id="jsondata1"><?php echo htmlentities(json_encode($days),ENT_QUOTES); ?></textarea></label><script>    require(['echarts'], function (echarts) {
        var data1 = JSON.parse($('#jsondata1').html());
        var days = data1.map(function (item) {
            return item['当天日期'];
        });


     
        (function (charts) {
            window.addEventListener("resize", function () {
                charts.resize()
            });
            charts.setOption({
                title: [{left: 'center', text: '近十天用户增涨趋势'}],
                tooltip: {trigger: 'axis', show: true, axisPointer: {type: 'cross', label: {}}},
                xAxis: [{data: days, gridIndex: 0}],
                yAxis: [
                    {
                        splitLine: {show: true}, gridIndex: 0, type: 'value', axisLabel: {
                            formatter: '{value} 人'
                        }
                    }
                ],
                grid: [{left: '10%', right: '3%', top: '25%'}],
                series: [
                    {
                        smooth: true, showBackground: true,
                        areaStyle: {color: 'rgba(180, 180, 180, 0.5)'},
                        type: 'line', showSymbol: true, xAxisIndex: 0, yAxisIndex: 0,
                        label: {normal: {position: 'top', formatter: '{c} 人', show: true}},
                        data: data1.map(function (item) {
                            return item['增加用户'];
                        }),
                    }
                ]
            });
        })(echarts.init(document.getElementById('main1')));

        (function (charts) {
            window.addEventListener("resize", function () {
                charts.resize()
            });
            charts.setOption({
                title: [{left: 'center', text: '近十天订单数量趋势'}],
                tooltip: {trigger: 'axis', show: true, axisPointer: {type: 'cross', label: {}}},
                xAxis: [{data: days, gridIndex: 0}],
                yAxis: [
                    {
                        splitLine: {show: true}, gridIndex: 0, type: 'value', axisLabel: {
                            formatter: '{value} 单'
                        }
                    }
                ],
                grid: [{left: '10%', right: '3%', top: '25%'}],
                series: [
                    {
                        smooth: true, showBackground: true,
                        areaStyle: {color: 'rgba(180, 180, 180, 0.5)'},
                        type: 'line', showSymbol: true, xAxisIndex: 0, yAxisIndex: 0,
                        label: {normal: {position: 'top', formatter: '{c} 单', show: true}},
                        data: data1.map(function (item) {
                            return item['订单数量'];
                        }),
                    }
                ]
            });
        })(echarts.init(document.getElementById('main2')));

        (function (charts) {
            window.addEventListener("resize", function () {
                charts.resize()
            });
            charts.setOption({
                title: [{left: 'center', text: '近十天交易金额趋势'}],
                grid: [{left: '10%', right: '3%', top: '25%'}],
                tooltip: {
                    trigger: 'axis',
                },
                xAxis: [{data: days, gridIndex: 0}],
                yAxis: [{type: 'value', splitLine: {show: true}, gridIndex: 0, axisLabel: {formatter: '{value} 元'}}],
                series: [
                    {
                        smooth: true, showBackground: true,
                        areaStyle: {color: 'rgba(180, 180, 180, 0.5)'},
                        type: 'line', showSymbol: true, xAxisIndex: 0, yAxisIndex: 0,
                        label: {position: 'top', formatter: '{c} 元', show: true},
                        data: data1.map(function (item) {
                            return item['订单金额'];
                        }),
                    }
                ]
            });
        })(echarts.init(document.getElementById('main3')));

        (function (charts) {
            window.addEventListener("resize", function () {
                charts.resize()
            });
            charts.setOption({
                title: [{left: 'center', text: '近十天代理收益趋势'}],
                grid: [{left: '10%', right: '3%', top: '25%'}],
                tooltip: {
                    trigger: 'axis',
                },
                xAxis: [{data: days, gridIndex: 0}],
                yAxis: [{type: 'value', splitLine: {show: true}, gridIndex: 0, axisLabel: {formatter: '{value} 元'}}],
                series: [
                    {
                        smooth: true, showBackground: true,
                        areaStyle: {color: 'rgba(180, 180, 180, 0.5)'},
                        type: 'line', showSymbol: true, xAxisIndex: 0, yAxisIndex: 0,
                        label: {position: 'top', formatter: '{c} 元', show: true},
                        data: data1.map(function (item) {
                            return item['代理收益'];
                        }),
                    }
                ]
            });
        })(echarts.init(document.getElementById('main4')));

        (function (charts) {
            window.addEventListener("resize", function () {
                charts.resize()
            });
               charts.setOption({
                title: [{left: 'center', text: '近十天平台收益趋势'}],
                grid: [{left: '10%', right: '3%', top: '25%'}],
                tooltip: {
                    trigger: 'axis',
                },
                xAxis: [{data: days, gridIndex: 0}],
                yAxis: [{type: 'value', splitLine: {show: true}, gridIndex: 0, axisLabel: {formatter: '{value} 元'}}],
                series: [
                    {
                        smooth: true, showBackground: true,
                        areaStyle: {color: 'rgba(180, 180, 180, 0.5)'},
                        type: 'line', showSymbol: true, xAxisIndex: 0, yAxisIndex: 0,
                        label: {position: 'top', formatter: '{c} 元', show: true},
                        data: data1.map(function (item) {
                            return item['平台收益'];
                        }),
                    }
                ]
            });
        })(echarts.init(document.getElementById('main5')));
    });
</script></div></div></div>