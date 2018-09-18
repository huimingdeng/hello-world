<?php 

	// 创建一个新的cURL资源
	$ch = curl_init();

	// 设置URL和相应的选项
	curl_setopt($ch, CURLOPT_URL, 'http://www.myblog.com/');
	curl_setopt($ch, CURLOPT_HEADER, 0);

	// 复制句柄
	$ch2 = curl_copy_handle($ch);

	// 抓取URL (http://www.myblog.com/) 并把它传递给浏览器
	curl_exec($ch2);

	// 关闭cURL资源，并且释放系统资源
	curl_close($ch2);
	curl_close($ch);
