<?php

// @todo 通过用户访问设置自定义模块名称
$defaultModule = 'Web';
$defaultController = 'Index';
$defaultAction = 'Index';

return [
    // 修改访问默认模块
    'default' => [
        'type' => 'regex',
        'match' => '#^/$#',
        'route' => [
            'module' => $defaultModule,
            'controller' => $defaultController,
            'action' => $defaultAction
        ],
    ],

    // 其他自定义路由
];