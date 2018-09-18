<?php //单文件上传
	
	/**
	 * @param array 	$fileInfo 		文件数组
	 * @param string 	$uploadPath 	上传文件保存目录
	 * @param boolean	$flaq	是否启用真实图片类型判断,默认启用
	 * @param array 	$allowedExts	允许上传的文件类型，默认为4种图片类型
	 * @param int 		$maxSize 	允许上传文件的最大值，默认2M
	 */
	function uploadFile($fileInfo,$uploadPath="uploads",$flag=true,$allowedExts=array('jpeg','jpg','png','gif'),$maxSize=2097152){
		// $allowedExts=array('jpeg','jpg','png','gif');
		if($fileInfo['error']>0){
			switch($fileInfo['error']){
				case 1:
					$msg="上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值";
					break;
				case 2:
					$msg="上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值";
					break;
				case 3:
					$msg="文件只有部分被上传";
					break;
				case 4:
					$msg="没有文件被上传。";
					break;
				case 6:
					$msg="找不到临时文件夹。";
					break;
				case 7:
					$msg="文件写入失败。";
					break;
			}
		}
		// 检查类型
		$ext=pathinfo($fileInfo['name'],PATHINFO_EXTENSION);//获取文件扩展名
		if(!in_array($ext, $allowedExts)){
			exit("非法文件类型");
		}
		if(!is_array($allowedExts)){
			exit("系统错误");
		}
		// $maxSize=2097152;//2M
		if($fileInfo['size']>$maxSize){
			exit("上传文件过大");
		}
		if(!is_uploaded_file($fileInfo['tmp_name'])){
			exit("文件不是通过HTTP POST上传的");
		}
		if($flag){//真，检查是否为真实图片
			if(!getimagesize($fileInfo['tmp_name'])){
				exit("不是真实的图片类型");
			}
		}
		if(!file_exists($uploadPath)){
			mkdir($uploadPath,0777,true);
			chmod($uploadPath,0777);//windows不用
		}
		$destination=$uploadPath."/".md5(uniqid(microtime(true),true)).'.'.$ext;
		if(!@move_uploaded_file($fileInfo['tmp_name'], $destination)){
			exit('文件移动失败');
		}
		// echo "文件上传成功";
		/*return array(
			'newName'	=> $destination,
			'size' 		=> $fileInfo['size'],
			'type'		=> $fileInfo['type']
			);*/
		return $destination."上传成功！";
	}

	function getFile(){
		$i=0;
		foreach ($_FILES as $file) {
			if(is_array($file['name'])){
				foreach ($file['name'] as $k => $v) {
					$files[$i]['name']=$file['name'][$k];
					$files[$i]['type']=$file['type'][$k];
					$files[$i]['tmp_name']=$file['tmp_name'][$k];
					$files[$i]['size']=$file['size'][$k];
					$files[$i]['error']=$file['error'][$k];
					$i++;
				}
			}elseif(is_string($file['name'])){
				$files[$i]=$file;
				$i++;
			}
		}
		return $files;
	}
?>