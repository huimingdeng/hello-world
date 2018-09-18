<?php 
//查找用于需要修改HTTPS协议文件
$fr = fopen('findresultproduct.txt','r');
$pattern="/(^E:[0-9a-zA-z\-_]+\.(php|html|[\d+]):)/i";//E:\\gcdev2\\httpdocs\\product\\([a-zA-Z0-9]+){1,2}\\
$files=array();
while (!feof($fr)) {

	$lines = fgetss($fr);
	// echo $lines;
	if(preg_match($pattern,$lines,$res)){
		// print_r($res);
		// $files[]=$res[0];
		$tmp = substr($res[0],0,strlen($res[0])-1);
		$tmp = preg_replace("/\\\/i","/",$tmp);
		echo preg_replace("/^E:/i","/home",$tmp)."\n";
	}
}
// }
fclose($fr);