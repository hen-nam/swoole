<?php

// 一键协程化
Swoole\Runtime::enableCoroutine();

// 创建协程容器
Swoole\Coroutine\run(function () {

    // 创建 Redis 客户端
    $redis = new Redis;
    // 连接 Redis 服务器
    $redis->connect('127.0.0.1', 6379);
    // 写入数据
    $redis->set('key', 'value');
    // 读取数据
    echo $redis->get('key') . PHP_EOL;

});