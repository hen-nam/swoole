<?php

$client = new swoole_redis;

$client->connect('127.0.0.1', 6379, function($client, $result) {
    if ($result === false) {
        var_dump($client->errCode, $client->errMsg);
        return;
    }
//    $client->set('key', 'swoole', function ($client, $result) {
//        var_dump($result);
//        $client->close();
//    });
    $client->get('key', function ($client, $result) {
        var_dump($result);
        $client->close();
    });
});

echo 'start' . PHP_EOL;