<?php 
class BenzModel extends CarModel{
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
}