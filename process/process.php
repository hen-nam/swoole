<?php

// 创建子进程
$process = new Swoole\Process(function($process) {
    // 子进程执行一个外部程序
    $process->exec('/Users/hn/work/soft/php/bin/php', [__DIR__ . '/../server/http_server.php']);
}, true);

// 启动子进程
$pid = $process->start();
echo $pid . PHP_EOL;

// 回收结束运行的子进程
Swoole\Process::wait();