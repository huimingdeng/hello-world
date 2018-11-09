<?php 
class PHP13Question{

	private static $_instance = NULL;
	private $ok = [];

	public function __construct()
	{
		
	}

	/**
	 * 请问同时满足这样条件的数：被10除余9,被9除余8,被8除余7,在100至1000之间,有几个这样的数?
	 * @return [type] [description]
	 */
	public function range100to1000(){
		$this->ok = [];
		for ($x=100; $x < 1001; $x++) { 
			if ( ($x % 10) == 9 && ($x % 9) == 8 && ($x % 8) == 7 ){
				array_push($this->ok, $x);
			}
		}
		return $this->ok;
	}
	/**
	 * 有一对兔子，从出生后第3个月起每个月都生一对兔子，小兔子长到第三个月后每个月又生一对兔子，假如兔子都不死，问每个月的兔子总数为多少？
	 * @return [type] [description]
	 */
	public function rabbit(){

	}

	/**
	 * 判断101-200之间有多少个素数，并输出所有素数。
	 * @return [type] [description]
	 */
	public function primeNumber($s='',$e=''){
		(!is_numeric($s))?$s=101:$s;
		(!is_numeric($e))?$e=200:$e;
		$res = [];
		$y;
		for ($x=$s; $x < $e; $x++) { 
			/*for ($y=2; $y < $x; $y++) { 
				if($x%$y == 0){
					break;
				}
			}
			// 当 $y >= $x,则表示已经是自身外都不能整除
			if ($y >= $x && $x != 1) {
				array_push($this->ok, $x);
			}*/
			$tmp = $this->decompose($x);
			if( count($tmp) == 1 && $tmp[0] == $x )
				array_push($res,$x);
		}
		$this->ok = $res;
		return $this->ok;
	}
	/**
	 * 打印出所有的"水仙花数"，所谓"水仙花数"是指一个三位数，其各位数字立方和等于该数本身。
	 * 例如：153是一个"水仙花数"，因为153=1的三次方＋5的三次方＋3的三次方。
	 * @return [type] [description]
	 */
	public function daffodil()
	{
		$this->ok = [];
		for ($x=100; $x < 1000; $x++) { 
			$n_x = floor($x/100);//百位
			$n_y = ($x/10)%10;//十位
			$n_z = $x%10;//个位
			// echo $n_x."百".$n_y."十".$n_z."\n";
			if(pow($n_x,3)+pow($n_y,3)+pow($n_z,3) == $x ){
				// echo sprintf("%s = %s^3(%s)+%s^3(%s)+%s^3(%s) \n",$x,$n_x,pow($n_x,3),$n_y,pow($n_y, 3),$n_z,pow($n_z, 3));
				array_push($this->ok, $x);
			}
		}
		return $this->ok;
		
	}
	/**
	 * 将一个正整数分解质因数。例如：输入90,打印出90=2*3*3*5。
	 * 思路：递归函数调用，先除2，再3....
	 * @param  number $base [description]
	 * @return [type]       [description]
	 */
	public function decompose($base,$output=true)
	{
		if (is_numeric($base)&&$base>0) {
			$num = $base;
			$this->ok = [];
			$s = 0;
			for ($x=2; $x <= $base; $x++) { //遍历计算 $base/$x == 0 ,分解质因数
				if($base%$x == 0){ // 能整除为整数
					while ( $base%$x == 0 ) { // 循环，如 20 则可分为 2, 2, 5，否则返回 2 和 5
						$base = $base/$x;
						$s+=1;
						$this->ok[]=$x;
					}
				}else{
					continue;
				}
			}

			return ($output)?($this->ok):(sprintf("%s = %s; \n",$num,implode(" * ", $this->ok)));
			
		}else{
			return false;
		}
	}
	/**
	 * 利用条件运算符的嵌套来完成此题：学习成绩>=90分的同学用A表示，60-89分之间的用B表示，60分以下的用C表示。
	 * @return [type] [description]
	 */
	public function conditionOperator($source)
	{
		return (is_numeric($source))?(
			($source>=90)?('A'):(
				($source>=60)?('B'):('C')
			)
		):('false');
	}
	/**
	 * 输入两个正整数m和n，求其最大公约数和最小公倍数
	 *
	 * 最大公约数（质数分解 or 欧几里得算法 or 短除法）这里尝试 欧几里得算法 ($m,$n) = ?
	 * 最小公倍数=两数的乘积/最大公约（因）数 [$m,$n] = ?
	 * @param  [type] $m [description]
	 * @param  [type] $n [description]
	 * @return [type]    [description]
	 */
	public function GCDandLCM($m,$n)
	{
		$this->ok = [];
		$this->ok['GCD'] = $this->Euclid($m,$n);
		$this->ok['LCM'] = ($m*$n)/$this->Euclid($m,$n);

		return $this->ok;
	}
	/**
	 * 欧几里得算法
	 * ∵ 319÷377=0（余319）$m÷$n
	 * ∴（319，377）=（377，319）；
	 * ∵ 377÷319=1（余58）
	 * ∴（377，319）=（319，58）；
	 * ∵ 319÷58=5（余29）
	 * ∴ （319，58）=（58，29）；
	 * ∵ 58÷29=2（余0）
	 * ∴ （58，29）= 29；
	 * ∴ （319，377）=29。
	 * @param [type] $m [description]
	 * @param [type] $n [description]
	 * @return int 最大公约数
	 */
	private function Euclid($m, $n){
		if( $m % $n == 0 && $n % $m == 0){
			return 1;
		}else{
			$remainder = $m % $n;//319÷377=0（余319）
			return ($remainder!==0)?($this->Euclid($n,$remainder)):($n);
		}
	}

	public static function get_instance()
	{
		if (NULL === self::$_instance) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function __destruct(){
		self::$_instance = null;
		unset($this->ok);
	}
	
}

// $s = PHP13Question::get_instance()->range100to1000();
$s = PHP13Question::get_instance()->primeNumber(73,100);

// $s = PHP13Question::get_instance()->daffodil();
// $s = PHP13Question::get_instance()->decompose(199);

// $s = PHP13Question::get_instance()->conditionOperator(62);
// $s = PHP13Question::get_instance()->GCDandLCM(10,20);



print_r($s);