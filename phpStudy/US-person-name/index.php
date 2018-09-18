<!DOCTYPE html>
<html>
<head>
	<title>拆分英文姓名</title>
	<meta charset="utf-8">
</head>
<body>
	<?php 
		set_time_limit(0);
		$csv=fopen("list-history.csv","r");
		$full_name=array();//全名存入
		echo "正在加载目标文件.........<br>\r\n";
		while(!feof($csv)){
			$tmp=fgetcsv($csv);//临时存储，0=>email，1=>full_name
			if($tmp[1]!='name'){
				$full_name[str_replace(array("\r\n", "\r", "\n"),'',$tmp[0])]=$tmp[1];
			}
		}
		// var_dump($full_name);
		// exit;
		echo "正在加载完成目标文件的分离邮件和用户全名工作.........<br>\r\n";
		fclose($csv);
		echo "关闭目标文件....<br>\r\n";
		clearstatcache();
		// sleep(1);
		//休眠5秒再执行，全名分割
		// 对已经clean的list文件结果，生成结果
		$list_rs=fopen("list-rs.txt","r");
		$lrs=array();//最终结果的邮件列表
		while(!feof($list_rs)){
			$lrs[]=fgets($list_rs);
		}
		fclose($list_rs);
		clearstatcache();
		
		// print_r($lrs);
		 // exit;
		// sleep(1);
		if(!empty($lrs)){
			$check_list=array();
			foreach ($lrs as $v) {
				if(!empty($v))
				$check_list[]=str_replace(array("\r\n", "\r", "\n"),'',$v);
			}
			// var_dump($check_list);
		}
		// exit;
		// echo "正在引入parser.php文件......<br>\r\n";
		require_once("parser.php");
		$parser = new FullNameParser();
		if(!empty($full_name)){
			$csv_tmp_body=array();
			// echo "正式开始分离用户名称......<br>\r\n";
			foreach ($full_name as $el=>$fn) {
				$tmp=$parser->parse_name($fn);
				$tmpA['email']=$el;
				$tmpA['fname']=$tmp['fname'];
				$tmpA['lname']=$tmp['lname'];
				if(!empty($tmpA)){
					$csv_tmp_body[$el]=$tmpA;
				}
			}
			// var_dump($csv_tmp_body);
			$csv_body=array();
			
			foreach ($csv_tmp_body as $k => $v) {
				if(in_array($k,$check_list)){
					$csv_body[]=$v;
				}
			}
			// var_dump($csv_body);
			// exit;

			echo "用户名分离完毕..............<br>\r\n";
			sleep(1);//休眠5秒再执行组装
			echo "开始组装完毕新文件列表的主体内容.....<br>";
			if(!empty($csv_body)){
				$csv_header=array("Email","Fname","Lname");//CSV的头部信息
				if(!file_exists('list.csv')){
					$new_list=fopen("list.csv","w");
					$h=implode(',',$csv_header).PHP_EOL;
					$c='';
					foreach ($csv_body as $k => $v) {
						$c .= implode(',',$v).PHP_EOL;
					}
					
					
					echo "组装csv文件完毕.......<br>\r\n";
					sleep(3);//循环组装后，休息3秒，写入文件
					$csv_list= $h.$c;
					echo "写入CSV文件......<br>";
					fwrite($new_list,$csv_list);
					fclose($new_list);
					echo "新文件正式生成，请检查文件结果......<br>\r\n....工作完毕!....(^_^)Y..<br>\r\n";
					clearstatcache();
				}else{
					echo "新文件生成失败或已存在，若重新生成，请删除就的生成文件............<br>\r\n";
				}
			}else{
				echo "用户名分离失败，请检查文件........<br>\r\n";
			}
		}else{
			echo "抱歉，目标文件分离工作出错，没有全名和邮件的数组.......<br>\r\n";
		}
	?>
</body>
</html>