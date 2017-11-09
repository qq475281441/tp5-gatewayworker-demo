<?php
/**
 * Created by PhpStorm.
 * User: zhouwenping
 * Date: 2017/11/9
 * Time: 下午4:20
 */

namespace app\push\controller;

use \GatewayWorker\Lib\Gateway;

class Event {
	/**
	 * 进程启动后初始化数据库连接
	 */
	public static function onWorkerStart ($worker)
	{
	}
	
	/**
	 * 有消息时
	 *
	 * @param int   $client_id
	 * @param mixed $message
	 *
	 * @throws Exception
	 */
	public static function onMessage ($client_id, $message)
	{
		echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']}  client_id:$client_id session:" . json_encode ($_SESSION) . " onMessage:" . $message . "\n";
		// 使用数据库实例
		// 客户端传递的是json数据
		$message_data = json_decode ($message, TRUE);
	}
	
	/**
	 * 当客户端断开连接时
	 *
	 * @param integer $client_id 客户端id
	 */
	public static function onClose ($client_id)
	{
		// debug
		echo "client:{$_SERVER['REMOTE_ADDR']}:{$_SERVER['REMOTE_PORT']} gateway:{$_SERVER['GATEWAY_ADDR']}:{$_SERVER['GATEWAY_PORT']}  client_id:$client_id onClose:''\n";
		
	}
}