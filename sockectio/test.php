<?php
	require_once __DIR__.'/../vendor/autoload.php';
	use Workerman\Worker;
	use PHPSocketIO\SocketIO;
	
	
	
	define('GLOBAL_START', true);
	
	// 创建socket.io服务端，监听2021端口
	$io = new SocketIO(3120);
	
	// 当有客户端连接时打印一行文字
	$io->on('connection', function($connection)use($io){
		echo "new connection coming\n";
	});
	
	Worker::runAll();