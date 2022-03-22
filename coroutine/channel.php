<?php

// 创建协程容器
Swoole\Coroutine\run(function () {

    // 创建通道
    $channel = new Swoole\Coroutine\Channel(10);

    // 创建协程
    Swoole\Coroutine::create(function () use ($channel) {
        // 向通道写入数据
        $channel->push('hello');
    });

    // 创建协程
    Swoole\Coroutine::create(function () use ($channel) {
        // 向通道写入数据
        $channel->push([
            'key1' => 'value',
            'key2' => 123,
        ]);
    });

    // 创建协程
    Swoole\Coroutine::create(function () use ($channel) {
        // 获取通道的元素数量
        $length = $channel->length();
        for ($i = 0; $i < $length; ++ $i) {
            // 从通道读取数据
            $data = $channel->pop();
            var_dump($data);
        }
    });

});