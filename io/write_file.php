<?php

swoole_async_writefile(__DIR__ . '/write.txt', date("YmdHis \n"), function($filename) {
    echo "async_writefile: $filename wirte ok. \n";
}, FILE_APPEND);

swoole_async_write(__DIR__ . '/write.txt', date("YmdHis \n"), -1, function($filename) {
    echo "async_write: $filename wirte ok. \n";
});

echo "start \n";