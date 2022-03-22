<?php

// 创建服务器
$http = new Swoole\Http\Server('0.0.0.0', 9503);

// 注册事件回调函数
// 监听请求事件
$http->on('Request', function($request, $response) {
    // 创建 Redis 客户端
    $redis = new Swoole\Coroutine\Redis();
    // 连接 Redis 服务器
    $redis->connect('127.0.0.1', 6379);
    $key = $request->get['key'];
    // Redis 设置值
    $redis->set($key, 'value');
    // Redis 获取值
    $value = $redis->get($key);
    $response->end($value);
});

// 启动服务器
$http->start();