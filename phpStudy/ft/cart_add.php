<?php 
session_start();
if($_REQUEST['action']=='api'){
	$cat_no=array(
	'cat_nos'=>$_GET['cat_nos'],
	'prt'=>$_GET['prt']?$_GET['prt']:1,
	);
	if(!empty($cat_no)){
		echo json_encode(array('status'=>'success','info'=>'success,产品已经存放到您的购物车中。'));
	}else{
		echo json_encode(array("status"=>"fail","info"=>"Please login first","redirect"=>"login/?url=".urlencode($_SERVER["REQUEST_URI"])));
	}
}else{
	echo $_SERVER['REQUEST_URI'];
	//header("location:/phpStudy/login/?url=".urlencode($_SERVER["REQUEST_URI"]));
	//die();
	
}

// 获取信息添加到数据表中
