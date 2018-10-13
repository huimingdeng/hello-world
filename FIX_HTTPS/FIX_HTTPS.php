<?php 
/**
 * NAME:FIX_HTTPS
 * VERSION: 2.1.1
 * DESCRIPTION: 添加判断内容存在 genecopoeia，才执行替换
 * MTIME: Oct 13,2018
 */
class FIX_HTTPS
{	
	private static $_instance = null;
	private $path;
	private $file;
	private $config = array();

	private function __construct($path)
	{
		date_default_timezone_set("Asia/Shanghai");
		echo "init..."."\n";
		file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 运行 '.__CLASS__.' 并初始化...'."\n",FILE_APPEND);
		echo "Including configuration files...."."\n";
		$this->_config();
		$this->path = $path.DIRECTORY_SEPARATOR;
		file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 准备执行查找目录 '.$this->path."\n",FILE_APPEND);
		echo "Start preparing the recursive directory ".$this->path." ..."."\n";
		$this->eachdir($this->path);
	}

	protected function _config(){
		$this->config = require_once(dirname(__FILE__).DIRECTORY_SEPARATOR."config.php");
	}

	private function eachdir($rootpath){
		if(!empty($this->config['ALLOWEDFLOOR'])){
			foreach ($this->config['ALLOWEDFLOOR'] as $key => $value) {
				$allow_path = $rootpath.$value.DIRECTORY_SEPARATOR;
				$this->checkIsFile($allow_path);
			}
		}elseif(empty($this->config['ALLOWEDFLOOR'])){
			$this->checkIsFile($rootpath);
		}else{
			echo "\nError: error of the program or configuration file error...\n";
		}
	}

	private function checkIsFile($file){
		if(is_file($file)){
			$this->file = $file;
			file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 准备执行替换 https 程序，将文件 '.$this->file.' 中的 http 协议替换成 https 协议。'."\n",FILE_APPEND);
			$this->openFile();
			return;
		}else{
			$path_v2 = $file;
			echo "Start reading files under directory ". $path_v2 . " ..." . "\n";
			file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 执行查找目录 '.$path_v2."\n",FILE_APPEND);
			$sources = array_diff(scandir($path_v2,0),array('.','..',basename(__FILE__)));
			sort($sources);
			if(!empty($sources)){
				file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 准备循环目录 '.$path_v2.' 中的资源...'."\n",FILE_APPEND);
				foreach ($sources as $s) {
					if (is_file($path_v2.$s)) {
						if(!in_array(basename($s),$this->config['DISALLOWEDFILES'])){
							$this->checkIsFile($path_v2.$s);
						}else{
							file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 文件 '.$s.' 被设置为不需执行替换操作...'."\n",FILE_APPEND);
						}
					}elseif(is_dir($path_v2.$s)){
						$path = $path_v2.$s.DIRECTORY_SEPARATOR;
						if (!in_array(strtolower($s),$this->config['DISALLOWEDFLOOR'])) {
							$this->checkIsFile($path);
						}else{
							file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 目录 '.$path.' 不需要执行...'."\n",FILE_APPEND);
						}
						
					}else{
						break;
					}
				}
			}else{
				echo "The directory is empty ..." . "\n";
				file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 目录 '.$path_v2.' 不存在需要执行的文件...'."\n",FILE_APPEND);
				return;
			}
		}
	}

	private function openFile(){
		$filename = pathinfo(basename($this->file),PATHINFO_FILENAME);
		$ext = pathinfo(basename($this->file),PATHINFO_EXTENSION);
		
		if(in_array(strtolower($ext), $this->config['ALLOWEDEXT'])){
			echo "Reading the file ".$this->file." ..."."\n";
			$content = file_get_contents($this->file);

			if(preg_match('/(http:\/\/www\.genecopoeia\.com|http:\/\/genecopoeia\.com|http:\/\/othello\.genecopoeia\.com)/', $content)){

				$new_content_v0 = preg_replace('/(http:\/\/www\.genecopoeia\.com)/', 'https://www.genecopoeia.com', $content);
				$new_content_v1 = preg_replace('/(http:\/\/genecopoeia\.com)/', 'https://genecopoeia.com', $new_content_v0);
				$new_content = preg_replace('/(http:\/\/othello\.genecopoeia\.com)/', 'https://othello.genecopoeia.com', $new_content_v1);

				if($this->config['IS_TEST']){
					echo "Test ..."."\n";
					$new_filename = dirname($this->file).DIRECTORY_SEPARATOR.$filename."_new.".$ext;
					echo "Generate new file ". $new_filename . " ..." ."\n";
					file_put_contents($new_filename, $new_content);
				}else{
					$new_filename = $this->file;
					if($this->config['IS_BACK']){
						$back_filename = dirname($this->file).DIRECTORY_SEPARATOR.$filename.".back.".date('Ymd').".".$ext;
						echo "Backup the original file ".$this->file." and rename it as ".basename($back_filename). " ..."."\n";
						file_put_contents($back_filename,$content);
					}
					echo "Replace the HTTP protocol to save back to the original file ..."."\n";
					file_put_contents($new_filename, $new_content);
				}
				
				file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 已将文件 '.$this->file.' 中的 http 协议替换成 https 协议。'."\n",FILE_APPEND);
			}else{
				file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 文件 '.$this->file.'无需要替换的项目协议。'."\n",FILE_APPEND);
			}
		}else{
			file_put_contents("fix_https_logs.txt",'['.date('Y-m-d H:i:s').'] 文件 '.$this->file.' 不符合 ['.implode(',',$this->config['ALLOWEDEXT']).'] 后缀，所以不执行替换操作。'."\n",FILE_APPEND);
		}
	}

	public static function get_Instance(){
		if(NULL === self::$_instance)
			self::$_instance = new self(dirname(__FILE__));
		return self::$_instance;
	}

	public function __destruct(){
		echo "The program is finished ..."."\n";
		file_put_contents("fix_https_logs.txt", "\n" ,FILE_APPEND);
	}
}

FIX_HTTPS::get_Instance();

