<?php

// 创建协程容器
Swoole\Coroutine\run(function () {
    // 连接服务器
    $client = new Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);
    if (!$client->connect('127.0.0.1', 9501)) {
        exit('连接失败，错误：' . $client->errCode . PHP_EOL);
    }

    // 向服务器发送数据
    $client->send('hello');

    // 从服务器接收数据
    echo $client->recv();

    // 关闭服务器连接
    $client->close();
});