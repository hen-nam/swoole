<?php

// 创建服务器
$server = new Swoole\Server('127.0.0.1', 9502, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

// 注册事件回调函数
// 监听数据接收事件
$server->on('Packet', function ($server, $data, $clientInfo) {
    echo "Client: Packet $data";
    var_dump($clientInfo);
    // 向客户端发送 UDP 数据包
    $server->sendto($clientInfo['address'], $clientInfo['port'], "Server: $data");
});

// 启动服务器
$server->start();