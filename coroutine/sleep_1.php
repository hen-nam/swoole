<?php

// 创建协程容器
Swoole\Coroutine\run(function () {
// 创建协程，并立即执行
    Swoole\Coroutine::create(function () {
        // 休眠（阻塞）
        sleep(2);
        echo '协程 1' . PHP_EOL;
    });

// 创建协程，并立即执行
    go(function () {
        // 协程休眠（非阻塞）
        Co::sleep(1);
        echo '协程 2' . PHP_EOL;
    });

    echo '进程' . PHP_EOL;
});