# Swolle #
面向生产环境的 PHP 异步网络通信引擎

使 PHP 开发人员可以编写高性能的异步并发 TCP、UDP、Unix Socket、HTTP，WebSocket 服务。Swoole 可以广泛应用于互联网、移动通信、企业软件、云计算、网络游戏、物联网（IOT）、车联网、智能家居等领域。 使用 PHP + Swoole 作为网络通信框架，可以使企业 IT 研发团队的效率大大提升，更加专注于开发创新产品。

## install ##
使用 pecl 安装：
	
	#!/bin/bash
	pecl install swoole

HTTP Server 测试：

	<?php
	$http = new swoole_http_server("127.0.0.1", 9501);
	
	$http->on("start", function ($server) {
	    echo "Swoole http server is started at http://127.0.0.1:9501\n";
	});
	
	$http->on("request", function ($request, $response) {
	    $response->header("Content-Type", "text/plain");
	    $response->end("Hello World\n");
	});
	
	$http->start();

... 

案例：[Swoole：面向生产环境的 PHP 异步网络通信引擎](https://www.swoole.com/ "Swoole：面向生产环境的 PHP 异步网络通信引擎")

## 学习笔记目录 ##
