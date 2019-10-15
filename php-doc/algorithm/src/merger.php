<?php 
namespace algorithm;

class merger {
	private $array;

	public function set($array){
		$this->array = $array;
		return $this;
	}
	/**
	 * 归并排序拆分集合
	 * @param  array  $array 需要排序的数组
	 * @return array        排序后的数据
	 */
	private static function mergeSort(array $array){
		$len = count($array);
		// 递归结束条件
		if($len <= 1){
			return $array;
		}
		// 取中间值
		$mindex = intval($len / 2);
		// 拆分 array 
		$left = array_slice($array, 0, $mindex);
		$right = array_slice($array, $mindex);
		// 比较合并左侧
		$left = self::mergeSort($left);
		$right = self::mergeSort($right);
		$array = self::merge($left, $right);
		return $array;
	}
	/**
	 * 合并数组
	 * @param  array $a1 集合1
	 * @param  array $a2 集合2
	 * @return array     返回合并后的集合
	 */
	private static function merge($a1, $a2){
		$array = [];
		while (count($a1) && count($a2)) {
			$array[] = $a1[0] < $a2[0]?array_shift($a1):array_shift($a2);
		}
		return array_merge($array, $a1, $a2);
	}

	public function run(){
		return self::mergeSort($this->array);
	}

}

