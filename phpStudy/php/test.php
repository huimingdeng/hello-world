<?php 
header("content-type:text/html;charset=utf-8");
// error_reporting(255);
require_once ("package/uploads.class.php");
echo '1';
$upload=new uploads();
$destination=$upload->uploadFile();
echo json_encode($destination);
header("refresh:3;url=uploadfile.php");
