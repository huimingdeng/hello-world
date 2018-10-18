<?php 
/**
 * 类Python字符分割，未完成
 */
class Split
{
	private static $_instance = null;
	private $string; //字符串
	private $strlen; //字符串长度
	private $letter; //字母
	private $type; //类型默认为 'list'
	private $list = [];//列表

	function __construct($string,$type='list')
	{
		$this->string = $string;
		$this->splitStr2list();
	}

	private function splitStr2list()
	{
		$this->strlen = mb_strlen($this->string);
		if($this->strlen>0){
			for ($i=0; $i < $this->strlen; $i++) { 
				$letter = mb_substr($this->string,$i,1,'utf8');
				array_push($this->list,$letter);
			}
		}
	}

	private function splitStr2letter($start){

		$letter = mb_substr($this->string,$start,1,'utf8');
		return $letter;	
	}

	public static function getLetter($start){
		$obj = self::$_instance;
		$end = $obj->strlen;
		if($start >= $end){
			echo "Error: Subscript exceeds character length.\n";
			return;
		}elseif($start<0){
			return $obj->splitStr2letter($start);
		}else{
			return $obj->list[$start];
		}
	}
	/**
	 * 获取字符长度
	 * @return [type] [description]
	 */
	public function getLen()
	{
		return $this->strlen;
	}
	/**
	 * 获取字符串列表
	 * @return [type] [description]
	 */
	public function getList()
	{
		return $this->list;
	}
	/**
	 * 以Python列表形式输出一个字符串
	 * @return [type] [description]
	 */
	public function dumpList()
	{
		echo '['.implode(',', $this->list).']';
	}

	public static function get_Instance()
	{
		if(self::$_instance===null)
			self::$_instance = new self('construct中');
		return self::$_instance;
	}
}

$s = Split::get_Instance();
echo $s::getLetter(-1);