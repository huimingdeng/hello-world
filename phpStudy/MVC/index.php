<?php 
// 1.先统一URL路径格式 eg.index.php?controller=控制器名&method=方法名
	require_once "function.php";
	require_once "config.php";
	//引入smarty
	$view = ORG('Smarty/','Smarty',$viewconfig);
	// 定义允许访问控制器
	$controllerAllow=array('test','index');
	$methodAllow = array('test','index','show');
	$controller = in_array($_GET['controller'], $controllerAllow)?daddslashes($_GET['controller']):'index';
	$method = in_array($_GET['method'],$methodAllow)?daddslashes($_GET['method']):'index';

	C($controller,$method);
