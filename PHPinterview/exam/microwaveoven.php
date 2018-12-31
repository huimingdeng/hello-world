<?php 
// 微波炉：注意物品正加热时不能开门，带皮带壳食物不能被加热。
class MicrowaveOven{
	private $food; 
	private $iscook = false; //是否加热
	public $time; //微波炉时间设置

	public function __construct(Food $food, $time){
		$this->open();
		$this->food = $food;
		$this->time = $time;
		
	}
	// 启动微波炉加热
	private function start(){
		$this->iscook = true;
	}

	private function open(){
		if(!$this->iscook){
			echo "打开微波炉门\n";
		}else{
			echo "不能打开微波炉门\n";
		}
	}

	private function close(){
		echo "关闭微波炉门\n";
	}
	// 用于执行微波炉加热功能
	public function run(){
		$this->cook($this->food, $this->time);
	}
	// 加热食物
	private function cook(Food $food, $time){
		$this->close();
		if ($food->isSheel) {
			echo "不能加热\n";
		}
		$this->start();
		echo "正在加热中...\n";
		// 加热时间....，不在此执行了
		// sleep($this->time);
		echo "食物加热完成\n";
	}
}

// 食物，带皮带壳食物不能被加热。
class Food {
	public $isSheel = false; //是否带壳食物
	function __construct($sheel){
		$this->isSheel = $sheel;
	}
}

// 测试
$f = new Food(false);
$w = new MicrowaveOven($f,3);

$w->run();
