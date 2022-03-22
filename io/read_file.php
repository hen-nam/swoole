<?php

swoole_async_readfile(__DIR__ . '/read.txt', function($filename, $content) {
    echo "async_readfile: $filename - $content \n";
});

swoole_async_read(__DIR__ . '/read.txt', function($filename, $content) {
    if ($content) {
        echo "async_read: $filename - $content \n";
    }
}, 2);

echo "start \n";