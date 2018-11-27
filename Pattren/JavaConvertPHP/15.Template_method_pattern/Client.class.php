<?php 
namespace TemplateMethodPattern;
class Client{
	

	public function main(){
		require './bmwmodel.class.php';
		require './benzmodel.class.php';
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

}

$c = new Client;
$c -> main();
