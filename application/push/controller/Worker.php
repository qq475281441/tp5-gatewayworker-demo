<?php

namespace app\push\controller;

use app\push\controller\BaseServer;

class Worker extends BaseServer {
	protected $config;
	
	public function __construct ()
	{
		//Gateway 进程配置，外部客户端连接进程
		$this->config[ 'gateway' ] = Config ('worker.gateway') == '' ? '' : Config ('worker.gateway');
		
		//实例化Register服务==============内部注册进程=====================
		$this->config[ 'register' ] = Config ('worker.register') == '' ? '' : Config ('worker.register');
		
		//实例化BusinessWorker进程,业务处理进程================
		$this->config[ 'business' ] = Config ('worker.business') == '' ? '' : Config ('worker.business');
		
		parent::__construct ();
	}
}
