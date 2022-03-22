<?php

// 创建协程容器
Swoole\Coroutine\run(function () {
    // 创建服务器
    $server = new Swoole\Coroutine\Http\Server('127.0.0.1', 9503);

    // 注册回调函数以处理参数
    $server->handle('/', function ($request, $response) {
        $response->end('<h1>index</h1>');
    });
    $server->handle('/test', function ($request, $response) {
        $response->end('<h1>test</h1>');
    });

    // 启动服务器
    $server->start();
});