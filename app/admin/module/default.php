<?php



return [
    'name' => 'admin',
    'vers' => '2022.03.06.01',
    'user' => '广州楚才信息科技有限公司',
    'link' => 'https://www.cuci.cc',
    'desc' => '系统管理模块，提供系统配置及应用模块管理。',
    'menu' => [
        [
            'name' => '应用管理',
            'subs' => [],
        ],
        [
            'name' => '系统管理',
            'subs' => [
                [
                    'name' => '系统配置',
                    'subs' => [
                        ['name' => '系统参数配置', 'icon' => 'layui-icon layui-icon-set', 'path' => 'admin/config/index'],
                        ['name' => '系统任务管理', 'icon' => 'layui-icon layui-icon-log', 'path' => 'admin/queue/index'],
                        ['name' => '系统日志管理', 'icon' => 'layui-icon layui-icon-tabs', 'path' => 'admin/oplog/index'],
                        ['name' => '应用模块管理', 'icon' => 'layui-icon layui-icon-app', 'path' => 'admin/module/index'],
                        ['name' => '数据字典管理', 'icon' => 'layui-icon layui-icon-read', 'path' => 'admin/base/index'],
                    ],
                ],
                [
                    'name' => '权限管理',
                    'subs' => [
                        ['name' => '访问权限管理', 'icon' => 'layui-icon layui-icon-vercode', 'path' => 'admin/auth/index'],
                        ['name' => '系统用户管理', 'icon' => 'layui-icon layui-icon-username', 'path' => 'admin/user/index'],
                    ],
                ],
            ],
        ],
    ],
];