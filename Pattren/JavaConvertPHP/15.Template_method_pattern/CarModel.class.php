<?php 
namespace TemplateMethodPattern;

abstract class CarModel{
	private $sequence = array();
	protected abstract function start();
	protected abstract function stop();
	protected abstract function alarm();
	protected abstract function engineBoom();
	final public function run() {
		for ($i=0; $i < count($this->sequence); $i++) { 
			switch (trim(strtolower($this->sequence[$i]))) {
				case 'start':
					$this->start();
					break;
				
				case 'stop':
					$this->stop();
					break;

				case 'alarm':
					$this->alarm();
					break;

				case 'engine boom':
					$this->engineBoom();
					break;
			}
		}
	}
	final public function setSequence($sequence=[]){
		$this->sequence = $sequence;
	}
	
}