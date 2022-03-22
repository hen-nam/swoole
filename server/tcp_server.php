<?php

// 创建服务器
$server = new Swoole\Server('127.0.0.1', 9501);

// 设置运行时参数
$server->set([
    'worker_num' => 4,
    'max_request' => 50,
]);

// 注册事件回调函数
// 监听连接进入事件
$server->on('Connect', function ($server, $fd, $from_id) {
    echo "Client: Connect. - $fd - $from_id \n";
});
// 监听数据接收事件
$server->on('Receive', function ($server, $fd, $from_id, $data) {
    echo "Client: Receive $data. - $fd - $from_id \n";
    // 向客户端发送数据
    $server->send($fd, "Server: $data - $fd - $from_id \n");
});
// 监听连接关闭事件
$server->on('Close', function ($server, $fd) {
    echo "Client: Close. - $fd \n";
});

// 启动服务器
$server->start();