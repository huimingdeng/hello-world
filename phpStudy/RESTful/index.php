<?php

// 入口，担当路由/控制器角色

include 'vendor/autoload.php';

use RESTFUL\SiteRestHandler;

$view = "";
if (isset($_GET["view"])) {
	$view = $_GET["view"];
}

/*
 * RESTful service 控制器
 * URL 映射
 */
switch ($view) {

case "all":
	// 处理 REST Url /site/list/
	$siteRestHandler = new SiteRestHandler();
	$siteRestHandler->getAllSites();
	break;

case "single":
	// 处理 REST Url /site/show/<id>/
	$siteRestHandler = new SiteRestHandler();
	$siteRestHandler->getSite($_GET["id"]);
	break;

case "":
	//404 - not found;
	break;
}