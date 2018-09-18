<?php
/**
* 
*/
class File
{
	/**
	 * 打开句柄
	 */
	function __construct($filename)
	{
		if(is_file($filename)){

		}
		if(is_dir($filename)){

		}
	}

	//复制文件、文件夹
	public function copy(source, dest){
		if(is_file($source)){
			if(!file_exists($filename)){}
		}
	}
	// 删除文件、文件夹
	public function delete(oid){

	}

}