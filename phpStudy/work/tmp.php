<?php set_time_limit(0);
//将f1和f2中排除f0中的邮件
$f0=fopen("Hubspot_list.csv","r");
$f0_arr=array();
while (!feof($f0)) {
	$tmp=fgetcsv($f0);
	if(preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$tmp[0]))
	$f0_arr[]=$tmp[0];
}
fclose($f0);
//str_replace(array("\r\n", "\r", "\n");
$f1=fopen("list_cdna_from_2016v2.txt","r");
// $f1=fopen("list_immunity_gene_from_2015.txt", "r");
$f1_arr=array();
while(!feof($f1))
$f1_arr[]=str_replace(array("\r\n", "\r", "\n"),'',fgets($f1));
fclose($f1);
// 比较两个文件，排除
if(!empty($f0_arr)&&!empty($f1_arr)){
	// $rs1=array();
	$rs1="";
	foreach ($f1_arr as $k => $v) {
		if(in_array($v,$f0_arr))
			$rs1.=$v.PHP_EOL;
	}
	// $newf1=fopen("new_list_cdna_from_2016v2.txt","w");
	// $newf1=fopen("new_list_immunity_gene_from_2015.txt","w");
	$newf1=fopen("new_exclude_cdna_from_2016v2.txt","w");
	fwrite($newf1, $rs1);
	fclose($newf1);
	if(file_exists("new_exclude_cdna_from_2016v2.txt")){
		echo "生成新文件成功";
	}else{
		echo "生成新文件失败";
	}
}
clearstatcache();