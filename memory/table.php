<?php

// 创建内存表
$table = new Swoole\Table(1024);

// 内存表增加列
$table->column('id', Swoole\Table::TYPE_INT, 4);
$table->column('name', Swoole\Table::TYPE_STRING, 10);
$table->column('age', Swoole\Table::TYPE_INT, 1);

// 生成内存表
$table->create();

// 设置内存表的行
$table->set('Jay', ['id' => 1, 'name' => 'Jay', 'age' => 18]);
// 内存表的行原子自增
$table->incr('Jay', 'age', 2);
// 内存表的行原子自减
$table->decr('Jay', 'age', 1);
// 检查内存表的行是否存在
if ($table->exist('Jay')) {
    // 获取内存表的行
    $data = $table->get('Jay');
    var_dump($data);
    // 删除内存表的行
    $table->del('Jay');
}

// 设置内存表的行
$table['Zhn'] = ['id' => 2, 'name' => 'Zhn', 'age' => 30];
// 获取内存表的行
var_dump($table['Zhn']);