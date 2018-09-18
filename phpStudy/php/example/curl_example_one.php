<?php //php/curl.php
// 创建一个新cURL资源
 $ch = curl_init();
// 设置URL和相应的选项
 curl_setopt($ch, CURLOPT_URL, "https://www.baidu.com/");
 curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);//https专用
 curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);//文件流形式
 curl_setopt($ch, CURLOPT_HEADER, 0);
 // 抓取URL并把它传递给浏览器
 $html=curl_exec($ch);
 // 关闭cURL资源，并且释放系统资源
 curl_close($ch);
 var_dump($html);
 ?>