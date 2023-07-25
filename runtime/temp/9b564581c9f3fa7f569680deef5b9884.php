<?php /*a:2:{s:79:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/total/portal/store_index.html";i:1678080743;s:76:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div class="think-box-shadow portal-block-container notselect"><div class="layui-row layui-col-space15"><div class="layui-col-sm6 layui-col-md3"><div class="portal-block-item nowrap" style="background:linear-gradient(-113deg,#c543d8,#925cc3)"><div>订单总量</div><div><?php echo htmlentities((isset($orderTotal) && ($orderTotal !== '')?$orderTotal:'0'),ENT_QUOTES); ?></div><div>已付款订单总数</div></div><i class="portal-block-icon layui-icon layui-icon-rmb"></i></div><div class="layui-col-sm6 layui-col-md3"><div class="portal-block-item nowrap" style="background:linear-gradient(-141deg,#ecca1b,#f39526)"><div>交易金额</div><div><?php echo htmlentities((isset($amountTotal) && ($amountTotal !== '')?$amountTotal:'0'),ENT_QUOTES); ?></div><div>已成交金额总数</div></div><i class="portal-block-icon layui-icon layui-icon-rmb"></i></div><div class="layui-col-sm6 layui-col-md3"><div class="portal-block-item nowrap" style="background:linear-gradient(-113deg,#c543d8,#925cc3)"><div>今天结算收益</div><div><?php echo htmlentities((isset($settleTotal) && ($settleTotal !== '')?$settleTotal:'0'),ENT_QUOTES); ?></div><div>已成交金额总数</div></div><i class="portal-block-icon layui-icon layui-icon-rmb"></i></div><div class="layui-col-sm6 layui-col-md3"><div class="portal-block-item nowrap" style="background:linear-gradient(-141deg,#ecca1b,#f39526)"><div>待结算收益</div><div><?php echo htmlentities((isset($unSettleTotal) && ($unSettleTotal !== '')?$unSettleTotal:'0'),ENT_QUOTES); ?></div><div>已成交金额总数</div></div><i class="portal-block-icon layui-icon layui-icon-rmb"></i></div></div></div><div class="layui-row layui-col-space15 margin-top-10"><!--近十天订单数量趋势 --><div class="layui-col-xs12 layui-col-md6"><div class="think-box-shadow"><div id="main1" style="width:100%;height:350px"></div></div></div><!--近十天金额交易趋势 --><div class="layui-col-xs12 layui-col-md6"><div class="think-box-shadow"><div id="main2" style="width:100%;height:350px"></div></div></div></div><label class="layui-hide"><textarea id="jsondata1"><?php echo htmlentities(json_encode($days),ENT_QUOTES); ?></textarea></label><script>
require(['echarts'], function (echarts) {
        var data1 = JSON.parse($('#jsondata1').html());
        var days = data1.map(function (item) {
            return item['当天日期'];
        });

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
        })(echarts.init(document.getElementById('main1')));

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
        })(echarts.init(document.getElementById('main2')));

    });
</script></div></div></div>