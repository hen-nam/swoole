<?php

// 创建协程容器
Swoole\Coroutine\run(function () {
    // 创建客户端
    $client = new Swoole\Coroutine\Http\Client('127.0.0.1', 9503);

    // 设置参数
    $client->set([
        'timeout' => 1,
    ]);

    // 发起 GET 请求
    $client->get('/?a=b');

    //  获取返回包体
    echo $client->body . PHP_EOL;

    // 获取 HTTP 状态码
    echo $client->statusCode . PHP_EOL;

    // 关闭连接
    $client->close();
});