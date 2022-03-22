<?php

$client = new Swoole\Client(SWOOLE_SOCK_UDP);

// 连接到远程服务器
if (!$client->connect('127.0.0.1', 9502)) {
    exit("Connect failed. Error: {$client->errCode}\n");
}

// 向服务器发送数据
$client->send("hello\n");

// 从服务器接收数据
echo $client->recv();

// 关闭服务器连接
$client->close();