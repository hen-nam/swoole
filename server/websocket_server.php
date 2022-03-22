<?php

// 创建服务器
$ws = new Swoole\WebSocket\Server('0.0.0.0', 9504);

// 监听连接打开事件
$ws->on('Open', function($ws, $request) {
    echo "Client: Open. - {$request->fd}\n";
    var_dump($request->get, $request->server);
    $ws->push($request->fd, 'hello');
});

// 监听消息事件
$ws->on('Message', function($ws, $frame) {
    echo "Client: Message {$frame->data}. - fd: {$frame->fd}, opcode: {$frame->opcode}, finish: {$frame->finish}\n";
    $ws->push($frame->fd, "Server: {$frame->data}");
});

// 监听连接关闭事件
$ws->on('Close', function($ws, $fd) {
    echo "Client: Close. - {$fd}\n";
});

// 启动服务器
$ws->start();