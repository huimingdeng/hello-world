<?php 
	/**
	* 文件上传类
	*/
	class uploads
	{
		protected $fileName;
		protected $imgFaq;
		protected $uploadPath;
		protected $allowedMime;
		protected $allowedExt;
		protected $maxSize;
		protected $fileInfo;
		protected $error;
		protected $ext;
		protected $uniName;
		protected $destination;
		
		/**
		 * 
		 * @param string  $fileName    文件对象名称
		 * @param string  $uploadPath  文件上传路径
		 * @param boolean $imgFaq      图片是否验证，默认是
		 * @param integer $maxSize     文件上传限制大小，5M=5242880
		 * @param array   $allowedExt  允许上传的文件扩展类型
		 * @param array   $allowedMine 允许上传的图片类型
		 */
		public function __construct($fileName='file',$uploadPath="./uploads",$imgFaq=true,$maxSize=5242880,$allowedExt=array('jpeg','jpg','png','gif'),$allowedMime=array('image/jpeg','image/png','image/gif'))
		{
			$this->fileName=$fileName;//文件名
			$this->maxSize=$maxSize;
			$this->allowedMime=$allowedMime;
			$this->allowedExt=$allowedExt;//扩展名
			$this->uploadPath=$uploadPath;//上传保存路径
			$this->imgFaq=$imgFaq;
			$this->fileInfo=$_FILES[$this->fileName];
			$this->error='';
			// echo "ddd";
		}

		/**
		 * 检测文件上传是否错误[OK]
		 * @return boolean
		 */
		protected function checkError(){
			if($this->fileInfo['error']!=0){
				switch($this->fileInfo['error']){
					case 1:
						$this->error="上传的文件超过了PHP配置文件中upload_max_filesize选项限制的值";
						break;
					case 2:
						$this->error="上传文件的大小超过了表单中 MAX_FILE_SIZE 选项指定的值";
						break;
					case 3:
						$this->error="文件只有部分被上传";
						break;
					case 4:
						$this->error="没有文件被上传。";
						break;
					case 6:
						$this->error="找不到临时文件夹。";
						break;
					case 7:
						$this->error="文件写入失败。";
						break;
					case 8:
						$this->error="由于PHP扩展程序中断，无法上传";
						break;
				}
				return false;
			}
			return true;			
		}

		/**
		 * 检测文件大小[0K]
		 * @return boolean
		 */
		protected function checkSize(){
			if($this->fileInfo['size'] > $this->maxSize){
				$this->error="上传文件过大";
				return false;
			}
			return true;
		}

		/**
		 * 检测文件扩展名[OK]
		 * @return boolean
		 */
		protected function checkExt(){
			$this->ext=strtolower( pathinfo($this->fileInfo['name'],PATHINFO_EXTENSION) );
			if(!in_array($this->ext,$this->allowedExt)){
				$this->error="不允许的扩展名";
				return false;
			}
			return true;
		}
		/**
		 * 检测文件类型[OK]
		 * @return boolean
		 */
		protected function checkMime(){
			if(!in_array($this->fileInfo['type'],$this->allowedMime)){
				$this->error="文件类型错误";
				return false;
			}
			return true;
		}
		/**
		 * 检测是否为真实图片[OK]
		 * @return boolean
		 */
		protected function checkTrueImage(){
			if($this->imgFaq){
				if(!@getimagesize($this->fileInfo['tmp_name'])){
					$this->error="文件真实类型不是图片";
					return false;
				}
				return true;
			}
		}
		/**
		 * 检测文件上传方式是否为http post上传的[OK]
		 * @return boolean
		 */
		protected function checkHTTPPost(){
			if(!is_uploaded_file($this->fileInfo['tmp_name'])){
				$this->error="文件不是通过HTTP POST上传的";
				return false;
			}
			return true;
		}
		/**
		 * 显示错误信息，中断程序
		 */
		protected function showError(){
			exit('<span style="color:red">'.$this->error.'</span>');
		}
		/**
		 * 检查上传文件的路径是否存在，不存在则创建
		 */
		protected function checkUploadPath(){
			if(!file_exists($this->uploadPath)){
				mkdir($this->uploadPath,0777,true);
			}
		}
		/**
		 * 获取唯一字符串
		 * @return string
		 */
		protected function getUniName(){
			return md5(uniqid(microtime(true),true));
		}
		/**
		 * 文件上传
		 * @return string
		 */
		public function uploadFile(){
			if($this->checkError()&&$this->checkSize()&&$this->checkExt()&&$this->checkMime()&&$this->checkTrueImage()&&$this->checkHTTPPost()){
				$this->checkUploadPath();
				$this->uniName=$this->getUniName();
				$this->destination=$this->uploadPath.'/'.$this->uniName.'.'.$this->ext;
				
				if( @move_uploaded_file( $this->fileInfo['tmp_name'],$this->destination ) ){
					return $this->destination;
				}else{
					$this->error="文件移动失败";
					$this->showError();
				}
			}else{
				$this->showError();
			}
		}

	}
