<?php

// 一键协程化
Swoole\Runtime::enableCoroutine();

// 创建协程容器
Swoole\Coroutine\run(function () {

    // 创建协程
    Swoole\Coroutine::create(function () {

        $file = '/Users/hn/work/project/swoole/demo_swoole_4/static/file.txt';
        file_put_contents($file, "hello\n", FILE_APPEND);
        echo file_get_contents($file);

    });

    echo "进程\n";

});