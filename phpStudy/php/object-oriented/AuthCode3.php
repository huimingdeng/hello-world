<?php
session_start();
// error_reporting(255);
require 'AuthCode.class.php';  
$_vc = new AuthCode("cn");  //实例化一个对象
$_vc->output();  
$_SESSION['authcode'] = $_vc->getCode();//验证码保存到SESSION中
