<?php 
/**
 * 双向队列
 */
class Dique
{
	/**
	 * 声明双向队列空数组
	 * @var array
	 */
	private $dique = array();
	/**
	 * 队列头，设置对头进入
	 * @param unknown $item 
	 */
	public function setFirst($item)
	{
		return array_unshift($this->dique, $item);
	}
	/**
	 * 队列头元素出队
	 * @return int       返回成功或false
	 */
	public function removeFirst()
	{
		return array_shift($this->dique);
	}
	/**
	 * 队列尾部进入元素
	 * @param unknown $item 未知类型元素
	 */
	public function setLast($item)
	{
		return array_push($this->dique, $item);
	}
	/**
	 * 返回队尾元素
	 * @return 
	 */
	public function removeLast()
	{
		return array_pop($this->dique);
	}
	/**
	 * 打印数组
	 * @return array 打印数组
	 */
	public function dumpDique()
	{
		var_dump($this->dique);
	}
	/**
	 * 获取队列
	 * @return [type] [description]
	 */
	public function getDique()
	{
		return $this->dique;
	}
	/**
	 * 清空队列
	 * @return  
	 */
	public function emptyDique()
	{
		unset($this->dique);
	}
}

// Test
$dique = new Dique();
/*
$dique->setFirst('ab');
$dique->setLast('cd');
$dique->setFirst('cd');
$dique->setLast('ab');
$dique->dumpDique();
$dique->removeLast();
$dique->dumpDique();
$dique->emptyDique();*/
