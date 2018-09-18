<?php
$host="localhost";
$user="root";
$pass="root";
$dbname="ft";
$port="3306";
$conn=mysqli_connect($host,$user,$pass,$dbname,$port);
if($conn){
    //成功执行

}else{
    die("Could not connect:".mysqli_connect_error());
}
mysqli_close($conn);
?>