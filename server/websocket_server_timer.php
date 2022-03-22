<?php

class WebSocketServer{
    /**
     * 服务器主机名
     */
    const HOST = '0.0.0.0';

    /**
     * 服务器端口号
     */
    const PORT = 9504;

    /**
     * 服务器对象
     * @var null|\Swoole\WebSocket\Server
     */
    public $ws = null;

    /**
     * WebSocketServer constructor.
     */
    public function __construct() {
        $this->ws = new Swoole\WebSocket\Server(self::HOST, self::PORT);
        $this->ws->set([
            'worker_num' => 4,
            'task_worker_num' => 4,
        ]);
        $this->ws->on('Open', [$this, 'onOpen']);
        $this->ws->on('Message', [$this, 'onMessage']);
        $this->ws->on('Task', [$this, 'onTask']);
        $this->ws->on('Finish', [$this, 'onFinish']);
        $this->ws->on('Close', [$this, 'onClose']);
        $this->ws->start();
    }

    /**
     * 监听 WebSocket 连接打开事件
     * @param $ws
     * @param $request
     */
    public function onOpen($ws, $request) {
        echo "Client: Open - $request->fd\n";
        // var_dump($request->fd, $request->get, $request->server);
        // $ws->push($request->fd, "hello, welcome\n");
    }

    /**
     * 监听 WebSocket 消息事件
     * @param $ws
     * @param $frame
     */
    public function onMessage($ws, $frame) {
        echo "Client: Message {$frame->data} - fd: {$frame->fd}, opcode: {$frame->opcode}, finish: {$frame->finish}\n";
        $ws->task('task data');
        $ws->push($frame->fd, "Server: {$frame->data}.");
    }

    /**
     * 监听 WebSocket 任务事件
     * @param $ws
     * @param $taskId
     * @param $srcWorkerId
     * @param $data
     * @return string
     */
    public function onTask($ws, $taskId, $srcWorkerId, $data) {
        echo "Server: Task - $data\n";
        // var_dump($taskId, $srcWorkerId, $data);
        sleep(10);
        return 'finish data';
    }

    /**
     * 监听 WebSocket 任务完成事件
     * @param $ws
     * @param $taskId
     * @param $data
     */
    public function onFinish($ws, $taskId, $data) {
        // var_dump($taskId, $data);
        // 设置间隔定时器
        swoole_timer_tick(1000, function($timerId) {
            echo "Server: timer_tick - timerId: $timerId \n";
        });
        // 设置一次性定时器
        swoole_timer_after(5000, function() {
            echo "Server: timer_after\n";
        });
        echo "Server: Finish - $data\n";
    }

    /**
     * 监听 WebSocket 连接关闭事件
     * @param $ws
     * @param $fd
     */
    public function onClose($ws, $fd) {
        echo "Client: Close - $fd\n";
    }
}

$webSocketServer = new WebSocketServer;