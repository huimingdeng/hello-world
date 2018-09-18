<?php
$filename=$_GET['filename'];//含路径的文件名
$type=$_GET['type'];
if($type=='down'){
	download($filename);
}elseif($type="del"){
	DeleteFile($filename);
}

function download($filename){
	header("content-disposition:attachment;filename=".basename($filename));
	header("content-length:".filesize($filename));
	readfile($filename);
}

function DeleteFile($filename){
	
	if(unlink($filename)){
		echo "删除".basename($filename)."成功";
	}else{
		echo "删除".basename($filename)."失败";
	}
	header("refresh:3;url=../uploadfile.php");
	
}