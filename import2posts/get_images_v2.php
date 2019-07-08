<?php 
$fn = file("get_images.csv");
foreach ($fn as $lines) {
	$arr = explode(',', $lines);
	// echo $arr[0].PHP_EOL;
	$path = str_replace(["\r\n", "\n", "\r", "\""], '', $arr[0]);
	// echo $path .PHP_EOL;
	$pmc_id = str_replace(["\r\n", "\n", "\r", "\""], '', $arr[1]);
	// echo $pmc_id.PHP_EOL;
	if(file_exists($path)){
		$in = pathinfo($path);
		$save = dirname(__FILE__).'/'. $pmc_id. '-' .$in['basename'];
		@copy($path, $save);
		if(!file_exists($save)){
			echo "复制失败 ". $path. PHP_EOL;
		}
	}else{
		$path = str_replace('pmc_crispr_v2','pmc_crispr_v2_black_and_white',$path);
		if(file_exists($path)){
			$in = pathinfo($path);
			$save = dirname(__FILE__).'/'. $pmc_id. '-' .$in['basename'];
			@copy($path, $save);
			if(!file_exists($save)){
				echo "复制失败 ". $path. PHP_EOL;
			}
		}else{
			echo "黑白图 ".$path." 不存在".PHP_EOL;
		}
	}
}