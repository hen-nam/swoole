<?php

echo date('H:i:s') . PHP_EOL;

$processes = [];

for ($i = 0; $i < 5; ++ $i) {
    // 创建子进程
    $process = new Swoole\Process(function($process) use($i) {
        sleep(1);
        // 子进程向管道中写入数据
        $process->write($i . PHP_EOL);
    }, true);
    // 启动子进程
    $process->start();
    $processes[] = $process;
}

foreach ($processes as $process) {
    // 子进程从管道中读取数据
    echo $process->read();
}

echo date('H:i:s') . PHP_EOL;