<?php
/**
 * Created by PhpStorm.
 * User: DHM
 * Date: 2017/8/24
 * Time: 10:47
 * Description: MySQL数据库连接
 */
//连接方式1
$host="localhost";
$user="root";
$pass="root";
$dbname="laravel57";
@$con=mysqli_connect($host,$user,$pass,$dbname);
if(mysqli_connect_errno($con)){
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}else{
    mysqli_close($con);
}
