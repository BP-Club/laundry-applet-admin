<?php /*a:2:{s:81:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/base/postage/template/form.html";i:1670552399;s:76:"/www/wwwroot/uexwash.com/ThinkAdmin/app/data/view/../../admin/view/main.html";i:1670552399;}*/ ?>
<div class="layui-card"><?php if(!(empty($title) || (($title instanceof \think\Collection || $title instanceof \think\Paginator ) && $title->isEmpty()))): ?><div class="layui-card-header"><span class="layui-icon font-s10 color-desc margin-right-5">&#xe65b;</span><?php echo htmlentities((isset($title) && ($title !== '')?$title:''),ENT_QUOTES); ?><div class="pull-right"></div></div><?php endif; ?><div class="layui-card-line"></div><div class="layui-card-body"><div class="layui-card-html"><div id="TruckForm"><form action="<?php echo sysuri(); ?>" class='layui-form layui-card shadow' data-auto="true" method="post"><div class="layui-card-body padding-40 padding-bottom-10"><label class="layui-form-item block relative"><span class="help-label"><b>邮费模板名称</b>Name</span><input class="layui-input" name="name" placeholder="请输入邮费模板名称" required value='<?php echo htmlentities((isset($vo['name']) && ($vo['name'] !== '')?$vo['name']:""),ENT_QUOTES); ?>'><span class="color-desc"><b>必填</b>，邮费模板名称用于区分邮费模板规则，仅在后台选择邮费模板时使用。</span></label><div class="layui-form-item label-required-prev"><span class="help-label"><b>配送区域计费规则</b>Region</span><table class="layui-table"><thead><tr><th class="nowrap text-left">可配送区域</th><th class="nowrap text-center">首件（个）</th><th class="nowrap text-center">运费（元）</th><th class="nowrap text-center">续件（个）</th><th class="nowrap text-center">续费（元）</th></tr></thead><tbody><!--已选择的区域邮费规则--><tr ng-if="item.city.length > 0" ng-repeat="item in rules"><td><b class="color-green">自定区域：</b><div class="margin-right-5 inline-block" ng-if="ShowProvinceStatus(province)" ng-repeat="province in item.city"><b class="font-w7" ng-bind="province.name"></b><span class="color-desc">{{ShowProvinceCityName(province)}}</span></div><a class="margin-left-5 inline-block nowrap" ng-click="EditRuleItem(item)">编辑</a><a class="margin-left-5 inline-block nowrap" ng-click="RemoveRuleItem(item)">删除</a></td><td class="padding-0 text-center"><input class="layui-input text-center padding-left-0 border-0" ng-blur="convertNumber(item.rule,'firstNumber',0)" ng-model="item.rule.firstNumber"></td><td class="padding-0 text-center"><input class="layui-input text-center padding-left-0 border-0" ng-blur="convertNumber(item.rule,'firstAmount',2)" ng-model="item.rule.firstAmount"></td><td class="padding-0 text-center"><input class="layui-input text-center padding-left-0 border-0" ng-blur="convertNumber(item.rule,'repeatNumber',0)" ng-model="item.rule.repeatNumber"></td><td class="padding-0 text-center"><input class="layui-input text-center padding-left-0 border-0" ng-blur="convertNumber(item.rule,'repeatAmount',2)" ng-model="item.rule.repeatAmount"></td></tr><tr ng-if="defs.city.length > 0"><td colspan="5"><a class="font-w7" ng-click="AddRuleItem()">添加可配送区域和运费</a></td></tr><!-- 未选择的区域邮费规则 --><tr ng-if="defs.city.length > 0"><td><b class="color-green">默认区域：</b><div class="margin-right-5 inline-block" ng-repeat="province in defs.city"><b class="font-w7" ng-bind="province.name"></b><span class="color-desc">{{ShowProvinceCityName(province)}}</span></div></td><td class="padding-0 text-center"><input class="layui-input text-center padding-left-0 border-0" ng-blur="convertNumber(defs.rule,'firstNumber',0)" ng-model="defs.rule.firstNumber"></td><td class="padding-0 text-center"><input class="layui-input text-center padding-left-0 border-0" ng-blur="convertNumber(defs.rule,'firstAmount',2)" ng-model="defs.rule.firstAmount"></td><td class="padding-0 text-center"><input class="layui-input text-center padding-left-0 border-0" ng-blur="convertNumber(defs.rule,'repeatNumber',0)" ng-model="defs.rule.repeatNumber"></td><td class="padding-0 text-center"><input class="layui-input text-center padding-left-0 border-0" ng-blur="convertNumber(defs.rule,'repeatAmount',2)" ng-model="defs.rule.repeatAmount"></td></tr></tbody></table></div><label class="layui-form-item layui-hide"><textarea class="layui-textarea layui-bg-gray" name="normal">{{defs.rule}}</textarea><textarea class="layui-textarea layui-bg-gray" name="content">{{GetRuleData()}}</textarea></label><div class="hr-line-dashed margin-top-30"></div><?php if(!(empty($vo['id']) || (($vo['id'] instanceof \think\Collection || $vo['id'] instanceof \think\Paginator ) && $vo['id']->isEmpty()))): ?><input name="id" type="hidden" value="<?php echo htmlentities($vo['id'],ENT_QUOTES); ?>"><?php endif; if(!(empty($vo['code']) || (($vo['code'] instanceof \think\Collection || $vo['code'] instanceof \think\Paginator ) && $vo['code']->isEmpty()))): ?><input name="code" type="hidden" value="<?php echo htmlentities($vo['code'],ENT_QUOTES); ?>"><?php endif; ?><div class="layui-form-item text-center"><button class="layui-btn" type='submit'>保存数据</button></div></div></form><div class='layui-form layui-card layui-hide' id="RegionDialog"><div class="layui-card-body padding-20"><div class="layui-row layui-col-space10"><div class="layui-col-xs8"><div class="layui-textarea" style="height:360px;overflow:auto"><div><span class="pointer notselect margin-right-10" ng-click="CheckAllProvince(true)">全选</span><span class="pointer notselect margin-right-10" ng-click="CheckAllProvince(false)">取消</span></div><hr class="hr-line-dashed margin-top-5 margin-bottom-5"><div class="layui-row layui-col-space5"><div class="layui-col-xs3 nowrap" ng-if="ShowProvinceShow(x)" ng-repeat="x in citys"><label class="think-checkbox margin-right-0"><input lay-ignore ng-change="SwitchActiveProvince(x, true)" ng-model="x.status" ng-value="x.name" type="checkbox"></label><span class="pointer notselect color-blue" ng-click="SwitchActiveProvince(x, false)" ng-if="x.name==city.name">{{x.name}}</span><span class="pointer notselect color-text" ng-click="SwitchActiveProvince(x, false)" ng-if="x.name!=city.name">{{x.name}}</span></div></div></div></div><div class="layui-col-xs4"><div class="layui-textarea" style="height:360px;overflow:auto"><div><span class="pointer notselect margin-right-10" ng-click="CheckAllCity(true)">全选</span><span class="pointer notselect margin-right-10" ng-click="CheckAllCity(false)">取消</span><b class="pull-right color-blue" ng-bind="city.name"></b></div><hr class="hr-line-dashed margin-top-5 margin-bottom-5"><label class="think-checkbox nowrap layui-elip" ng-if="x.show" ng-repeat="x in city.subs"><input lay-ignore ng-model="x.status" ng-value="x.name" type="checkbox" value=""> {{x.name}}
                        </label></div></div></div></div><div class="layui-form-item text-center"><button class="layui-btn" ng-click="SetRuleItem()">确定选择</button></div></div></div><label class="layui-hide"><textarea id="CityData"><?php echo json_encode($citys); ?></textarea><textarea id="NormalData"><?php echo (isset($vo['normal']) && ($vo['normal'] !== '')?$vo['normal']:''); ?></textarea><textarea id="ContentData"><?php echo (isset($vo['content']) && ($vo['content'] !== '')?$vo['content']:''); ?></textarea></label><script>
    require(['angular'], function () {
        var app = angular.module("TruckForm", []).run(callback);
        var _data = document.getElementById('CityData').value || '[]';
        var _rule = {city: [], rule: {firstNumber: 1, firstAmount: "1.00", repeatNumber: 1, repeatAmount: "1.00"}};
        angular.bootstrap(document.getElementById(app.name), [app.name]);

        function callback($rootScope) {
            $rootScope.rule = angular.fromJson(angular.toJson(_rule));
            $rootScope.defs = angular.fromJson(angular.toJson(_rule));
            $rootScope.rules = [];
            $rootScope.city = {subs: []};
            $rootScope.citys = angular.fromJson(_data) || [];
            /*! 默认显示城市 */
            $rootScope.citys.forEach(function (item) {
                delete item.id, delete item.pid;
                item.subs.forEach(function (item) {
                    delete item.id, delete item.pid;
                    item.show = true, item.status = false;
                });
            });
            /*! 对象值到为指定小数 */
            $rootScope.convertNumber = function (item, name, fixed) {
                item[name] = parseFloat(item[name] || 0).toFixed(fixed)
            };
            /*! 生成待提交的数据 */
            $rootScope.GetRuleData = function () {
                var data = [];
                $rootScope.rules.forEach(function (rule) {
                    var item = {city: [], rule: rule.rule};
                    rule.city.forEach(function (province) {
                        var citys = [];
                        province.subs.forEach(function (city) {
                            citys.push(city.name)
                        });
                        item.city.push({name: province.name, subs: citys})
                    });
                    if (item.city.length > 0) data.push(item);
                });
                return data;
            };
            /*! 添加规则选项 */
            $rootScope.AddRuleItem = function () {
                $rootScope.rule = angular.fromJson(angular.toJson(_rule));
                $rootScope.rules.push($rootScope.rule);
                $rootScope.showDialog();
            };
            /*! 编辑规则选项 */
            $rootScope.EditRuleItem = function (rule) {
                rule.city.forEach(function (item) {
                    item.subs.forEach(function (item) {
                        item.show = true;
                    });
                });
                $rootScope.rule = rule;
                $rootScope.showDialog();
            }
            /*! 删除规则选项 */
            $rootScope.RemoveRuleItem = function (rule) {
                rule.city.forEach(function (item) {
                    item.subs.forEach(function (item) {
                        item.show = true;
                        item.status = false;
                    });
                });
                var rules = [];
                $rootScope.rules.forEach(function (item) {
                    if (item !== rule) rules.push(item);
                })
                $rootScope.rules = rules;
            }
            /*! 确认规则选项 */
            $rootScope.SetRuleItem = function () {
                layui.layer.closeAll();
                $rootScope.rule.city.forEach(function (province) {
                    province.subs.forEach(function (city) {
                        if (city.status) city.show = false;
                    });
                });
            };
            /*! 配送区域城市名称显示处理 */
            $rootScope.ShowProvinceCityName = function (province) {
                var isfull, citys = [];
                province.subs.forEach(function (city) {
                    citys.push(city.name);
                });
                // 省份已选择全部城市，只显示省份名称
                isfull = $rootScope.citys.some(function (item) {
                    if (item.name === province.name && citys.length >= item.subs.length) {
                        return true;
                    }
                });
                return isfull ? '' : ' ( ' + citys.join('、') + ' ) ';
            };
            $rootScope.ShowProvinceShow = function (province) {
                return province.subs.some(function (item) {
                    if (item.show) return true;
                })
            }
            $rootScope.ShowProvinceStatus = function (province) {
                return province.subs.some(function (item) {
                    if (item.status) return true;
                });
            };
            /*! 省份全选或取消 */
            $rootScope.CheckAllProvince = function (status) {
                $rootScope.citys.forEach(function (province) {
                    province.subs.forEach(function (city) {
                        if (city.show) city.status = !!status;
                    })
                });
            };
            /*! 城市全选或取消 */
            $rootScope.CheckAllCity = function (status) {
                $rootScope.city.subs.forEach(function (item) {
                    if (item.show) item.status = !!status;
                });
            };
            /*! 展开省份下的城市 */
            $rootScope.SwitchActiveProvince = function (province, force) {
                $rootScope.city = province;
                province.subs.forEach(function (item) {
                    if (item.show && force) item.status = !!province.status;
                });
            };
            /*! 显示区域选择器 */
            $rootScope.showDialog = function () {
                layui.layer.open({
                    type: 1, shade: false, area: '800px', title: '区域选择器',
                    content: $('#RegionDialog').removeClass('layui-hide'), end: function () {
                        $('#RegionDialog').addClass('layui-hide'), $rootScope.SetRuleItem();
                    }
                });
            };
            /*! 实时生成规则数据 */
            $rootScope.SetRuleData = function () {
                /*! 合并当前操作数据到缓存 */
                var _province_cache = {}, _city_cache = {}, _defs_cache = [];
                $rootScope.rule.city.forEach(function (province) {
                    _province_cache[province.name] = province;
                    province.subs.forEach(function (city) {
                        _city_cache[province.name + '-' + city.name] = true;
                    });
                });
                /*! 筛选出当前选中的城市 */
                $rootScope.citys.forEach(function (province) {
                    var _defs_citys = [];
                    _province_cache[province.name] = _province_cache[province.name] || {name: province.name, subs: []};
                    /*! 城市集联动省份选项选择 */
                    province.status = province.subs.some(function (city) {
                        if (city.show && city.status) return true;
                    });
                    province.subs.forEach(function (city) {
                        if (!city.status) _defs_citys.push(city);
                        if (city.status && city.show && !_city_cache[province.name + '-' + city.name]) {
                            _province_cache[province.name].subs.push(city);
                            _city_cache[province.name + '-' + city.name] = true;
                        }
                    });
                    if (_defs_citys.length > 0) _defs_cache.push({name: province.name, subs: _defs_citys});
                });
                $rootScope.defs.city = _defs_cache;
                /* 将临时数据转换为区域规则选项 */
                var provinces = [], province = {};
                for (var i in _province_cache) {
                    province = {name: _province_cache[i].name, subs: []};
                    _province_cache[i].subs.forEach(function (item) {
                        if (item.status) province.subs.push(item);
                    });
                    if (province.subs.length > 0) provinces.push(province);
                }
                $rootScope.rule.city = provinces;
            }
            /*! 数据变化监听处理 */
            $rootScope.$watch('citys', $rootScope.SetRuleData, true);

            /*! 默认数据显示处理 */
            var NormalData = angular.fromJson($('#NormalData').val() || '{}') || {};
            for (var i in NormalData) $rootScope.defs.rule[i] = NormalData[i];
            var ContentData = angular.fromJson($('#ContentData').val() || '[]') || [];
            ContentData.forEach(function (item) {
                $rootScope.rule = angular.fromJson(angular.toJson(_rule));
                $rootScope.rule.rule = item.rule;
                $rootScope.rules.push($rootScope.rule);
                item.city.forEach(function (province) {
                    province.subs.forEach(function (city) {
                        $rootScope.citys.forEach(function (_item) {
                            _item.subs.forEach(function (_city) {
                                if (_city.name === city) _city.status = true;
                            });
                        });
                    });
                });
                $rootScope.SetRuleData();
                $rootScope.SetRuleItem();
            });
        }
    });
</script></div></div></div>