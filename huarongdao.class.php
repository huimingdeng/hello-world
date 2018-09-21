<?php 

/**
 * 华容道 -- Java -> PHP
 * https://blog.csdn.net/csdnsevenn/article/details/82782947
 */
class HuaRongDao
{
	private static $_instace = null;
	protected $history = [];//version >5.3 已经搜索的状态
	const LEFT = 4;//小键盘 4 
	const RIGHT = 6; 
	const UP = 8; 
	const DOWN = 2;
	private $init = [0,1,2,3,4,5,6,7,8];//[0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15];//
	private $huarongdao = [];//3*3|4*4
	private $x,$y; //坐标
	private $winStatus;//最终状态走通
	private $action = [];//移动记录 moreArr
	private $test = 0;

	private function __construct()
	{

		$min=array_search(min($this->init), $this->init);
		$this->winStatus = implode('',array_diff($this->init, array($this->init[$min]))).$this->init[$min];
		shuffle($this->init);
		$this->__init();
		$this->HuaRongDao();
		echo "初始位置：(".$this->x.",".$this->y.")"."\n";
		if($this->Solve()){
			$this->echoRoute();
			echo "此时:\n";
			$this->echoStatus();
			echo "\n";
		}else{
			echo "抱歉...\n";
		}
		
	}

	private function __init()
	{
		$str = '';
		$l = 0;
		for ($i=0; $i < count($this->init); $i++) { 
			if (($i+1)%floor(sqrt(count($this->init)))==0) {
				$str .= $this->init[$i];
				$this->huarongdao[$l] = explode(',', $str);
				$str = '';
				$l++;
			}else{
				$str .= $this->init[$i].',';
			}
		}

		$this->echoInit();
	}

	private function HuaRongDao()
	{
		for ($i=0; $i < count($this->huarongdao); $i++) { 
			for ($j=0; $j < count($this->huarongdao); $j++) { 
				if($this->huarongdao[$i][$j] == 0){
					$this->x = $i;
					$this->y = $j;
				}
			}
		}
	}

	/**
	 * 华容道能否移动
	 * @param init $direction 方向
	 */
	private function CanMove($direction)
	{
		switch ($direction) {
			case self::LEFT:
				return $this->y > 0;
				break;
			case self::RIGHT:
				return $this->y < (floor(sqrt(count($this->init)))-1);
				break;
			case self::UP:
				return $this->x > 0;
				break;
			case self::DOWN:
				return $this->x < (floor(sqrt(count($this->init)))-1);
				break;
		}
		return false;
	}
	/**
	 * 华容道移动
	 * @param int $direction 方向
	 */
	private function Move($direction)
	{
		switch ($direction) {
			case self::LEFT:
				$temp = $this->huarongdao[$this->x][$this->y-1];
				$this->huarongdao[$this->x][$this->y-1] = 0;
				$this->huarongdao[$this->x][$this->y] = $temp;
				$this->y-=1;
				break;
			
			case self::RIGHT:
				$temp = $this->huarongdao[$this->x][$this->y+1];
				$this->huarongdao[$this->x][$this->y+1] = 0;
				$this->huarongdao[$this->x][$this->y] = $temp;
				$this->y+=1;
				break;

			case self::UP:
				$temp = $this->huarongdao[$this->x-1][$this->y];
				$this->huarongdao[$this->x-1][$this->y] = 0;
				$this->huarongdao[$this->x][$this->y] = $temp;
				$this->x-=1;
				break;

			case self::DOWN:
				$temp = $this->huarongdao[$this->x+1][$this->y];
				$this->huarongdao[$this->x+1][$this->y] = 0;
				$this->huarongdao[$this->x][$this->y] = $temp;
				$this->x+=1;
				break;
		}
		// 记录方向
		array_push($this->action,$direction);

	}

	/**
	 * 遇到错误回退
	 * @param int $direction 方向
	 */
	private function MoveBack($direction)
	{
		switch ($direction) {
			case self::LEFT:
				$temp = $this->huarongdao[$this->x][$this->y+1];
				$this->huarongdao[$this->x][$this->y+1] = 0;
				$this->huarongdao[$this->x][$this->y] = $temp;
				$this->y+=1;
				break;
			
			case self::RIGHT:
				$temp = $this->huarongdao[$this->x][$this->y-1];
				$this->huarongdao[$this->x][$this->y-1] = 0;
				$this->huarongdao[$this->x][$this->y] = $temp;
				$this->y-=1;
				break;

			case self::UP:
				$temp = $this->huarongdao[$this->x+1][$this->y];
				$this->huarongdao[$this->x+1][$this->y] = 0;
				$this->huarongdao[$this->x][$this->y] = $temp;
				$this->x+=1;
				break;

			case self::DOWN:
				$temp = $this->huarongdao[$this->x-1][$this->y];
				$this->huarongdao[$this->x-1][$this->y] = 0;
				$this->huarongdao[$this->x][$this->y] = $temp;
				$this->x-=1;
				break;
		}
		array_pop($this->action);
	}

	protected function getStatus()
	{
		$status = 0;
        for($i=0; $i<count($this->huarongdao); $i++) {
            for($j=0; $j<count($this->huarongdao); $j++) {
                $status = $status * 10 + $this->huarongdao[$i][$j];
            }
        }
        return $status;
	}

	/**
	 * 深度搜索
	 * @param int $direction 方向
	 */
	protected function DepthSearch($direction)
	{
		$this->test++;
		// echo "\n第".$this->test."次:"."\n";
		// echo "向".$this->getDirString($direction)."移动"."\n";
		// echo "history-before:\n";
		// echo "\t[".implode(',',$this->history)."]"."\n";
		if($this->CanMove($direction)&&count($this->action)<8){//&&$this->test<20
			
			$this->Move($direction);//先按一个方向处理
			// echo "移动后位置：(".$this->x.",".$this->y.")"."\n";
			$status = $this->getStatus();
			// echo "--->"."\t".$status."\n";
			if($status === $this->winStatus){
				return true;
			}
			// print_r($this->history);
			// 判断是否走过的路径
			if(in_array($status, $this->history)){
				// echo "返回一次\n";
				$this->MoveBack($direction);
				// echo "action-back-after:\n";
				// echo "\t[".implode(',',$this->action)."]"."\n";
				return false;
			}
			
			// 当前状态进入列表
			array_push($this->history, $status);
			
			// echo "action:\n";
			// echo "\t[".implode(',',$this->action)."]"."\n";
			
			$continue = $this->DepthSearch(self::RIGHT) || $this->DepthSearch(self::DOWN) || $this->DepthSearch(self::LEFT) || $this->DepthSearch(self::UP);
			// var_dump($continue);
			if($continue){
				return true;
			}else{
				$this->MoveBack($direction);
				return false;
			}
		}
		// echo "向".$this->getDirString($direction)."移动失败，位置还是："."(".$this->x.",".$this->y.")"."\n";
		// echo "action:\n";
		// echo "\t[".implode(',',$this->action)."]"."\n";
		
		return false;
	}

	public function Solve()
	{
		$status = $this->getStatus();
		if($status === $this->winStatus){
			return true;
		}
		array_push($this->history, $status);
		return $this->DepthSearch(self::RIGHT) || $this->DepthSearch(self::DOWN)|| $this->DepthSearch(self::LEFT) || $this->DepthSearch(self::UP) ;
	}

	// 打印路径
    public function echoRoute() {
        for($i=0; $i < count($this->action); $i++) {
            echo ($this->getDirString($this->action[$i]));
        }
        echo "\n";
    }
    //方向转字符串
	protected function getDirString($direction)
	{
		switch ($direction) {
            case self::LEFT:
                return "左";
            case self::RIGHT:
                return "右";
            case self::UP:
                return "上";
            case self::DOWN:
                return "下";
        }
        return null;
	}

	protected function echoStatus()
	{
		for ($i=0; $i < count($this->huarongdao); $i++) { 
			for ($j=0; $j < count($this->huarongdao); $j++) { 
				echo $this->huarongdao[$i][$j];
			}
		}
	}

	public static function get_Instace()
	{
		if (NULL === self::$_instace)
			self::$_instace = new self();
		return self::$_instace;
	}

	public function __destruct()
	{
		self::$_instace = null;
	}

	private function echoInit()
	{
		$template = "华容道初始值："."\n";
		$template.= $this->separatorNum();
		for ($i=0; $i < count($this->init); $i++) { 
			if ( ($i+1)%floor(sqrt(count($this->init)))==0 ) {
				$template.= sprintf("%s\t|\n",$this->init[$i]);
			}elseif( ($i+1)%floor(sqrt(count($this->init))) ==1 ){
				$template.= sprintf("|\t%s\t",$this->init[$i]);
			}else{
				$template.= sprintf("%s\t",$this->init[$i]);
			}
		}
		$template.= $this->separatorNum();
		echo $template;
	}

	private function separatorNum(){
		switch ( floor(sqrt(count($this->init))) ) {
			case 3:
				return sprintf("+---------------+\n");
				break;
			
			case 4:
				return sprintf("+-------------------+\n");
				break;
		}
	}
}

HuaRongDao::get_Instace();
