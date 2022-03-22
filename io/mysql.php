<?php

$db = new swoole_mysql;

$server = [
    'host' => 'localhost',
    'port' => 3306,
    'user' => 'root',
    'password' => '',
    'database' => 'o2o',
    'charset' => 'utf8',
];

$db->connect($server, function($db, $result) {
    if ($result === false) {
        var_dump($db->connect_errno, $db->connect_error);
        die;
    }
    $sql = 'SHOW TABLES';
    $db->query($sql, function($db, $result) {
        // 执行失败
        if ($result === false) {
            var_dump($db->errno, $db->error);
        }
        // 执行成功，SQL 为非查询语句
        elseif ($result === true) {
            var_dump($db->affected_rows, $db->insert_id);
        }
        // 执行成功，SQL 为查询语句
        else {
            var_dump($result);
        }
        $db->close();
    });
});

echo 'start' . PHP_EOL;