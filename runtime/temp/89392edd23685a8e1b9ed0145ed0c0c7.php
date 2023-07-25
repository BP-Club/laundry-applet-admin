<?php /*a:1:{s:72:"/www/wwwroot/uexwash.com/ThinkAdmin/app/admin/view/api/upload/image.html";i:1670552399;}*/ ?>
<div class="image-dialog" id="ImageDialog"><div class="image-dialog-head"><div class="pull-left flex"><input class="layui-input margin-right-5" v-model="keys" style="height:30px;line-height:30px" placeholder="请输入搜索关键词"><a class="layui-btn layui-btn-sm layui-btn-normal" @click="search">搜 索</a></div><div class="pull-right"><a class="layui-btn layui-btn-sm layui-btn-normal" @click="uploadImage">上传图片</a></div></div><div class="image-dialog-body"><div class="image-dialog-item" v-for="x in list" @click="setItem(x)" style="display:none" v-show="show" :class="{'image-dialog-checked':x.checked}"><div class="uploadimage" :style="x.style"></div><p class="image-dialog-item-name layui-elip" v-text="x.name"></p><span class="image-dialog-item-size">{{formatSize(x.size)}}</span><span class="image-dialog-item-type">{{x.xext.toUpperCase()}}</span></div></div><div class="image-dialog-foot"><div id="ImageDialogPage" class="image-dialog-page"></div><div id="ImageDialogButton layui-hide" class="image-dialog-button layui-btn layui-btn-normal" v-if="data.length>0" @click="confirm">
            已选 {{ data.length }} 张，确认
        </div></div></div><script>
    require(['vue'], function (vue) {
        var app = new vue({
            el: '#ImageDialog',
            data: {
                didx: 0,
                page: 1, limit: 15, show: false, mult: false,
                keys: '', list: [], data: [], idxs: {}, urls: [],
            },
            created: function () {
                this.didx = $.msg.mdx.pop();
                this.$btn = $('#<?php echo htmlentities((isset($get['id']) && ($get['id'] !== '')?$get['id']:""),ENT_QUOTES); ?>');
                this.$ups = $('#ImageDialogUploadLayout [data-file]');
                this.mult = "<?php echo htmlentities((isset($get['file']) && ($get['file'] !== '')?$get['file']:'image'),ENT_QUOTES); ?>" === 'images';
                this.loadPage(), setTimeout(function () {
                    $('#ImageDialogButton').removeClass('layui-hide');
                }, 1000);
            },
            methods: {
                // 搜索刷新数据
                search: function () {
                    this.page = 1;
                    this.loadPage();
                },
                // 确认选择数据
                confirm: function () {
                    this.urls = [];
                    this.data.forEach(function (file) {
                        app.setValue(file.xurl);
                    }), this.setInput();
                },
                // 格式文件大小
                formatSize: function (size) {
                    return $.formatFileSize(size);
                },
                // 设置单项数据
                setItem: function (item) {
                    if (!this.mult) {
                        this.setValue(item.xurl).setInput();
                    } else if ((item.checked = !this.idxs[item.id])) {
                        (this.idxs[item.id] = item) && this.data.push(item);
                    } else {
                        delete this.idxs[item.id];
                        this.data.forEach(function (temp, idx) {
                            temp.id === item.id && app.data.splice(idx, 1);
                        });
                    }
                },
                // 更新列表数据
                setList: function (items, count) {
                    this.list = items;
                    this.list.forEach(function (item) {
                        item.checked = !!app.idxs[item.id]
                        item.style = 'background-image:url(' + item.xurl + ')';
                    }), this.addPage(count);
                },
                // 设置选择数据
                setValue: function (xurl) {
                    $.msg.close(this.didx);
                    this.urls.push(xurl) && this.$btn.triggerHandler('push', xurl);
                    return this;
                },
                // 设置输入表单
                setInput: function () {
                    if (this.$btn.data('input')) {
                        $(this.$btn.data('input')).val(this.urls.join('|')).trigger('change');
                    }
                },
                // 创建分页工具条
                addPage: function (count) {
                    this.show = true;
                    layui.laypage.render({
                        curr: this.page, count: count, limit: app.limit,
                        layout: ['count', 'prev', 'page', 'next', 'refresh'],
                        elem: 'ImageDialogPage', jump: function (obj, first) {
                            if (!first) app.loadPage(app.page = obj.curr);
                        },
                    });
                },
                // 加载页面数据
                loadPage: function () {
                    this.params = {page: this.page, limit: this.limit, output: 'layui.table', name: this.keys || ''};
                    this.params.type = '<?php echo htmlentities((isset($get['type']) && ($get['type'] !== '')?$get['type']:"gif,png,jpg,jpeg"),ENT_QUOTES); ?>';
                    $.form.load('<?php echo url("image"); ?>', this.params, 'get', function (ret) {
                        return app.setList(ret.data, ret.count), false;
                    });
                },
                // 上传图片文件
                uploadImage: function () {
                    this.urls = [];
                    this.$ups.off('push').on('push', function (e, xurl) {
                        app.setValue(xurl);
                    }).off('upload.complete').on('upload.complete', function () {
                        app.setInput();
                    }).click();
                },
            }
        });
    });
</script><label class="layui-hide" id="ImageDialogUploadLayout"><!-- 图片上传组件 开始 --><?php if(isset($get['file']) && $get['file'] == 'image'): ?><button class="layui-btn" data-file data-path="<?php echo htmlentities((isset($get['path']) && ($get['path'] !== '')?$get['path']:''),ENT_QUOTES); ?>" data-type="png,jpg,jpeg,gif"></button><?php else: ?><button class="layui-btn" data-file="mul" data-path="<?php echo htmlentities((isset($get['path']) && ($get['path'] !== '')?$get['path']:''),ENT_QUOTES); ?>" data-type="png,jpg,jpeg,gif"></button><?php endif; ?><!-- 图片上传组件 结束 --></label>