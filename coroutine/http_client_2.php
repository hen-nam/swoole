<?php

// 创建服务器
$http = new Swoole\Http\Server('0.0.0.0', 9505);

// 注册事件回调函数
// 监听请求事件
$http->on('Request', function($request, $response) {
    // 创建客户端
    $client = new Swoole\Coroutine\Http\Client('127.0.0.1', 9503);

    // 发起 GET 请求
    $client->get('/');

    // 获取返回包体
    $body = $client->body;

    // 关闭连接
    $client->close();

    // 发送 HTTP 响应体，并结束请求处理
    $response->end($body);
});

// 启动服务器
$http->start();