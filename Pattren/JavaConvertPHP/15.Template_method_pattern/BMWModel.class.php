<?php 
namespace TemplateMethodPattern;
require_once('carmodel.class.php');
class BMWModel extends CarModel
{
	protected function alarm(){
		echo "宝马车的喇叭声音是这样的...\n";
	}
	protected function engineBoom(){
		echo "宝马车的引擎是这个声音的...\n";
	}
	protected function start(){
		echo "宝马车跑起来是这个样子的...\n";
	}
	protected function stop(){
		echo "宝马车应该这样停车...\n";
	}

}
