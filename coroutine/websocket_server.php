<?php

// 创建协程容器
Swoole\Coroutine\run(function () {

    // 创建服务器
    $server = new Swoole\Coroutine\Http\Server('127.0.0.1', 9504);

    // 注册回调函数以处理参数
    $server->handle('/', function ($request, $ws) {

        // 发送握手成功信息
        $ws->upgrade();

        while (true) {

            // 接收消息
            $frame = $ws->recv();

            if (!$frame) {
                // 关闭连接
                $ws->close();
                break;
            }

            echo $frame->data . PHP_EOL;

            // 发送消息
            $ws->push("Server: $frame->data");
        }
    });

    // 启动服务器
    $server->start();
});