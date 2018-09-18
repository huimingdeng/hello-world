<?php 
header("content-type:text/html;charset=utf-8");
require_once("package/uploadfile.class.php");
set_time_limit(0);
// print_r($_FILES);
// error_reporting(255);
if(@$_POST['upf']=="uploadfile"){
	$allowedExt=array('txt','csv');
	$upload=new uploadfile("file","./compare", $allowedExt);
	$result1=$upload->uploadFile();
	echo $result1;
	header("refresh:3;url=index.php");
}else{//执行对比,排除
	@$file=$_POST['file'];
	if(!empty($file)&&count($file)==2){
		$ext0=pathinfo($file[0],PATHINFO_EXTENSION);
		$ext1=pathinfo($file[1],PATHINFO_EXTENSION);
		if($ext0=="txt"&&$ext1=="csv"){
			$fileA=$file[0];
			$fileB=$file[1];
		}elseif($ext0=="csv"&&$ext1=="txt"){
			$fileA=$file[1];
			$fileB=$file[0];
		}elseif($ext1==$ext0){
			echo '<span style="color:red">两项文件后缀都是一样，请重新选择</span>';
			header("refresh:3;url=index.php");
			exit;
		}
		$compare=new comparefile($fileA,$fileB);
		echo $compare->comparefile();
	}else{
		echo '<span style="color:red">请选择两项对比的文件</span>';
		header("refresh:3;url=index.php");
	}
}