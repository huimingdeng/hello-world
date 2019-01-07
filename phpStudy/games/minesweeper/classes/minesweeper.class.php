<?php 
// 扫雷游戏
class Minesweeper{
	private $rows = 9;
	private $cols = 9;
	private $num = 10;
	private $map; //绘制表格
	private $res; //设置地雷
	private $mine = "*";
	private $mines = [];

	// 
	public function __construct(int $level=0){

		$this->__init($level);
		$this->map();
		$this->setMine();
	}
	/**
	 * 初始化游戏盘符
	 * @param  int $type 等级，共3级
	 * @return void
	 */
	protected function __init($type){

		switch ($type) {
			case 1:
				$this->rows = $this->cols = 16;
				$this->num = 40;
				break;
			case 2:
				$this->rows = 16;
				$this->cols = 30;
				$this->num = 99;
				break;
			
			default:
				$this->rows = $this->cols = 9;
				$this->num = 10;
				break;
		}

	}
	/**
	 * 根据等级设置随机地雷
	 */
	protected function setMine(){

		$this->mines = array
		(
		    "7_2" => "*",
		    "1_1" => "*",
		    "7_3" => "*",
		    "1_3" => "*",
		    "9_8" => "*",
		    "3_9" => "*",
		    "1_2" => "*",
		    "4_3" => "*",
		    "2_3" => "*"
		);
		/*$num = 0;
		while ($num < $this->num) {
			$x = rand(1,$this->rows);
			$y = rand(1,$this->cols);
			$this->mines[$x.'_'.$y] = $this->mine;
			$num++;
		}
		print_r($this->mines);*/
	}

	/**
	 * 绘制表格
	 * @return [type] [description]
	 */
	protected function map(){
		// $table = "<table>\n %s \n</table>\n";
		// $tr = "";
		// for($row=1;$row<=$this->rows;$row++){
		// 	$tr .= '<tr>'."\n";
		// 	for ($col=1; $col <= $this->cols; $col++) { 
		// 		$tr .= '<td>'. '<input class="btn" value="">' .'</td>'."\n";
		// 	}
		// 	$tr .= '</tr>'."\n";
		// }
		// $this->map = sprintf($table,$tr);
	}

	public function resolve($x,$y){
		$key = $x.'_'.$y;

	}

	public function __destruct(){

	}
}


