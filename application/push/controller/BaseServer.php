<?php
/**
 * Created by PhpStorm.
 * User: zhouwenping
 * Date: 2017/11/9
 * Time: 下午5:13
 */

namespace app\push\controller;


use Workerman\Worker;
use GatewayWorker\Gateway;
use GatewayWorker\Register;
use GatewayWorker\BusinessWorker;

/**
 * Worker控制器扩展类
 */
abstract class BaseServer {
	protected $config;
	
	/**
	 * 架构函数
	 * @access public
	 */
	public function __construct ()
	{
		if ( isset($this->config[ 'gateway' ]) && $this->config[ 'gateway' ] != '' ) {
			$gateway = new Gateway($this->config[ 'gateway' ][ 'address' ]);
			// 设置名称，方便status时查看
			$gateway->name = $this->config[ 'gateway' ][ 'name' ];
			// 设置进程数，gateway进程数建议与cpu核数相同
			$gateway->count = $this->config[ 'gateway' ][ 'count' ];
			// 分布式部署时请设置成内网ip（非127.0.0.1）
			$gateway->lanIp = $this->config[ 'gateway' ][ 'lanIp' ];//默认是127.0.0.1，内部通讯端口
			// 内部通讯起始端口，假如$gateway->count=4，起始端口为4000
			// 则一般会使用4000 4001 4002 4003 4个端口作为内部通讯端口
			$gateway->startPort = $this->config[ 'gateway' ][ 'startPort' ];
			// 心跳间隔
			$gateway->pingInterval = $this->config[ 'gateway' ][ 'pingInterval' ];
			// 心跳数据
			$gateway->pingData = $this->config[ 'gateway' ][ 'pingData' ];
			// 服务注册地址
			$gateway->registerAddress = $this->config[ 'gateway' ][ 'registerAddress' ];
		}
		if ( isset($this->config[ 'register' ]) && $this->config[ 'register' ] != '' ) {
			$register = new Register($this->config[ 'register' ][ 'address' ]);
		}
		if ( isset($this->config[ 'business' ]) && $this->config[ 'business' ] != '' ) {
			$business = new BusinessWorker();
			// worker名称
			$business->name = $this->config[ 'business' ][ 'name' ];
			// bussinessWorker进程数量
			$business->count = $this->config[ 'business' ][ 'count' ];
			// 服务注册地址
			$business->registerAddress = $this->config[ 'business' ][ 'registerAddress' ];
			$business->eventHandler = $this->config[ 'business' ][ 'eventHandler' ];
		}
		
		// Run worker
		Worker::runAll ();
	}
	
	protected function init ()
	{
	}
	
}