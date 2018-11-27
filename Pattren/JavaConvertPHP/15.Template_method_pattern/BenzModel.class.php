<?php 
namespace TemplateMethodPattern;
require_once("carmodel.class.php");
class BenzModel extends CarModel{
	public function __construct(){
		spl_autoload_register(array($this,"autoFile"));
	}
	protected function alarm(){
		echo "奔驰车的喇叭声音是这样的...\n";
	}
	protected function engineBoom(){
		echo "奔驰车的引擎是这个声音的...\n";
	}
	protected function start(){
		echo "奔驰车跑起来是这个样子的...\n";
	}
	protected function stop(){
		echo "奔驰车应该这样停车...\n";
	}
	protected function autoFile($class){
		$path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
		$classname = strtolower($class);
		$classfile = $path . $classname . '.class.php';

		if (file_exists($classfile))
			require_once($classfile);
	}

	public function __destruct(){
		spl_autoload_unregister(array($this,'autoFile'));
	}
}