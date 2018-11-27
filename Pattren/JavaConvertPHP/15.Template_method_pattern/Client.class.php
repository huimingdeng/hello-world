<?php 
class Client{
	function __construct(){
		spl_autoload_register(array($this,"autoFile"));
	}

	public function main(){
		
		$baoma = new BMWModel();
		$benz = new BenzModel();
		$sequence = [];
		array_push($sequence, "engine boom");
		array_push($sequence, "start");
		array_push($sequence, "alarm");
		array_push($sequence, "stop");

		$baoma->setSequence($sequence);
		$baoma->run();
		$benz->setSequence($sequence);
		$benz->run();
	}

	private function autoFile($class){
		$path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
		$classname = strtolower($class);
		$classfile = $path . $classname . '.class.php';

		if (file_exists($classfile))
			require_once($classfile);
	}
}

$c = new Client;
$c -> main();