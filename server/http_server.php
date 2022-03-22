<?php

// 创建服务器
$http = new Swoole\Http\Server('0.0.0.0', 9503);

// 配置静态文件根目录
$http->set([
    'enable_static_handler' => true,
    'document_root' => '/Users/hn/work/project/swoole/demo_swoole_4/static',
]);

// 注册事件回调函数
// 监听请求事件
$http->on('Request', function($request, $response) {
    // 获取 HTTP 请求 GET 、 POST 参数
    var_dump($request->get, $request->post);
    // 设置 HTTP 响应 header 信息
    $response->header('Content-Type', 'text/html; charset=utf-8');
    // 设置 HTTP 响应 cookie 信息
    $response->cookie('user', 'zhn');
    // 发送 HTTP 响应体，并结束请求处理
    $response->end('<h1>Hello Swoole. #' . mt_rand(1000, 9999) . '</h1>');
});

// 启动服务器
$http->start();