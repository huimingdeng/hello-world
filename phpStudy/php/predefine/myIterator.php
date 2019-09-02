<?php 
/**
 * 迭代器： 
 * 	1. rewind  --> 确定索引为 第一个 -- 0 -> 2
 * 	2. valid --> 验证是否有效 Y -> (1)
 * 		(1). current --> 返回值 -> (2)
 * 	 	(2). key --> 返回索引 --> (3)
 * 	 	(3). next --> 索引自增 --> 2
 * 	3. end
 */

class myIterator implements Iterator {
	private $position = 0;
    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
    );  

	public function __construct()
	{
		$this->position = 0;
	}
	// 实现 Iterator current 函数
	public function current()
	{
		var_dump(__METHOD__);
		return $this->array[$this->position];
	}
	// 实现 Iterator next 函数	
	public function next(){
		var_dump(__METHOD__);
		++$this->position;
	}

	public function key(){
		var_dump(__METHOD__);
		return $this->position;
	}
	// 倒带
	public function rewind(){
		var_dump(__METHOD__);
		$this->position = 0;
	}
	public function valid(){
		var_dump(__METHOD__);
		return isset($this->array[$this->position]);
	}
}

$it = new myIterator();

foreach($it as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}