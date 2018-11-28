<?php 
namespace BuilderPattern;

require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'carbuilder.class.php');
require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'benzbuilder.class.php');
require(dirname(__FILE__) . DIRECTORY_SEPARATOR . 'bmwbuilder.class.php');

class Client{
	
	public function main(){
		
		$sequence = [];
		array_push($sequence, "start");
		array_push($sequence, "engine boom");
		array_push($sequence, "alarm");
		array_push($sequence, "stop");

		$benzbuilder = new BenzBuilder();
		$benzbuilder->setSequence($sequence);
		$benz = $benzbuilder->getCarModel();
		$benz->run();

		$bwmbuilder = new BMWBuilder();
		$bwmbuilder->setSequence($sequence);
		$bwm = $bwmbuilder->getCarModel();
		$bwm->run();
		
	}

}

$c = new Client;
$c -> main();