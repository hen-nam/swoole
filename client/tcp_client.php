<?php

$client = new Swoole\Client(SWOOLE_SOCK_TCP);

// 连接服务器
if (!$client->connect('127.0.0.1', 9501)) {
    exit("Connect failed. Error: {$client->errCode}\n");
}

// 向服务器发送数据
$client->send('hello');

// 从服务器接收数据
echo $client->recv();

// 关闭服务器连接
$client->close();