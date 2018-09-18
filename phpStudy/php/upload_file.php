<?php //单文件上传
    header("content-type:text/html;charset=utf-8");
    include_once("package/upload.func.php");
    $fileInfo=$_FILES['file'];
    $newinfo=uploadFile($fileInfo);
    // print_r($newinfo);
    echo $newinfo;
    header("refresh:5;url=filesystem.php");
?>