<?php
$fr=fopen("FILES/hubspot-bounce-list-test.csv");
while (!feof($fr)) {
	# 循环读取，并删除第一格含=的数据
	$lies=fgetcsv($fr);
	print_r($lies);
}
fclose($fr);