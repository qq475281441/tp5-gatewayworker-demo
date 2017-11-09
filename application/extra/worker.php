<?php
/**
 * Created by PhpStorm.
 * User: zhouwenping
 * Date: 2017/11/9
 * Time: 下午5:19
 *
 * worker配置文件
 *
 * 共三个worker进程，不需要某个进程则将它的配置留空即可
 */

return [
	'gateway' => [
		'address' => 'Websocket://0.0.0.0:7373',
		'name' => 'ChatGateway',
		'count' => 4,
		'lanIp' => '127.0.0.1',
		//默认是127.0.0.1，内部通讯端口,分布式部署时请设置成内网ip（非127.0.0.1）
		'startPort' => 4000,
		// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000,则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
		'pingInterval' => 10,
		//心跳
		'pingData' => '{"type":"ping"}',
		'registerAddress' => '0.0.0.0:1238'
	],
	
	'register' => ['address' => 'text://0.0.0.0:1238'],
	
	'business' => [
		'name' => 'ChatBusinessWorker',
		'count' => 4,
		'registerAddress' => '127.0.0.1:1238',
		'eventHandler' => 'app\push\controller\Event',
	]
];