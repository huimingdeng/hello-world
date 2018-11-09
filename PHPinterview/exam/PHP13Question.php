<?php 
class PHP13Question{

	private static $_instance = NULL;
	private $ok = [];

	public function __construct()
	{
		
	}

	/**
	 * 请问同时满足这样条件的数：被10除余9,被9除余8,被8除余7,在100至1000之间,有几个这样的数?
	 * 思路：
	 * 		10x + 9 = (9x+9) + x  ...... 被10除余9
	 * 		(9x+9)+x / 9 则 x = 8 ...... 被9除余8
	 * 		则 10*8+9 = 89，且 10 与 9 最小公倍数为 90
	 * 		89 + 90y = (88+88y)+(1+2y) ...... 被8除余7
	 * 		则 1+2y = 7 y=3
	 * 		则 90*3+89 = 359
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
	/**
	 * 输入一行字符，分别统计出其中英文字母、空格、数字和其它字符的个数。
	 * 正则计算
	 * @param  [type] $string [description]
	 * @return [type]         [description]
	 */
	public function frontlen($string)
	{
		$this->ok = [];
		$number_c = preg_match_all('/\d{1}/', $string, $front);
		$letter_c = preg_match_all('/[a-zA-Z]{1}/', $string, $letters);
		$chinese_c = preg_match_all('/[\x{4e00}-\x{9fa5}]{1}/u', $string, $chinese);
		$spacing_c = 0;
		$other_have_null_ch_c = strlen($string) - ($number_c + $letter_c + $chinese_c);
		$str = $this->letters($string);
		for($i=0;$i<count($str);$i++){
			if ($str[$i]==' ') {
				$spacing_c ++;
			}
		}
		$other_c = mb_strlen($string) - ($number_c + $letter_c + $chinese_c + $spacing_c);
		return $this->ok = array(
			'number_count' => $number_c,
			'letter_count' => $letter_c,
			'chinese_count' => $chinese_c,
			'spacing_count' => $spacing_c,
			'other_count' => $other_c
		);
	}
	/**
	 * 仿 Python 进行字符串切片使用
	 * @param  [type] $string [description]
	 * @return [type]         [description]
	 */
	public function letters($string){
		$this->ok = [];
		for ($i=0; $i < mb_strlen($string,'utf-8'); $i++) { 
			$letter = mb_substr($string, $i,1,'utf-8');
			array_push($this->ok,$letter);
		}
		return $this->ok;
	}

	/**
	 * 求s=a+aa+aaa+aaaa+aa...a的值，其中a是一个数字。例如2+22+222+2222+22222(此时共有5个数相加)，几个数相加有键盘控制。
	 * @param  [type] $m [description]
	 * @param  int $n 循环次数
	 * @return [type]    [description]
	 */
	public function addNumberCount($m,$n,$output=false)
	{

		$i = 0;
		$sum = 0;
		$this->ok = [];

		while ( $i < $n) {
			$sum = $m + $sum * 10;
			array_push($this->ok,$sum);
			$i++;
		}
		
		return ($output)?( ($n!=0)?(sprintf("%d = %s \n", array_sum($this->ok), implode(' + ',$this->ok)) ):(sprintf("%d = %s \n", $m, $m)) ):($this->ok);
	}
	/**
	 * 一个数如果恰好等于它的因子之和，这个数就称为"完数"。例如6=1＋2＋3.编程 找出1000以内的所有完数。
	 * 性质：
	 * 		所有的完全数都是三角形数
	 * 		可以表示成连续奇立方数之和
	 * 		所有的完全数的倒数都是调和数
	 * 		
	 * @param  [type] $num [description]
	 * @return [type]      [description]
	 */
	public function perfectNum($end=1000)
	{
		$i = 1;
		$tmp = [];
		while ($i <= $end) {
			$divisor = $this->Divisor($i,true);
			if( !empty($divisor) ){
				if( array_sum($divisor) === $i){
					$tmp[$i] = $i;
				}
			}
			$i++;
		}
		$this->ok = $tmp;
		unset($tmp);
		return $this->ok;
	}
	/**
	 * 计算一个数字的约数
	 * @param [type]  $num  [description]
	 * @param boolean $type false:返回所有约数，true:返回自身外的约数
	 */
	private function Divisor($num,$type=false){
		$i = 1;
		$this->ok = [];
		if(!$type){
			while ($i <= $num) {
				if($num%$i==0){
					array_push($this->ok,$i);
				}
				$i++;
			}
		}else{
			while ($i < $num) {
				if($num%$i==0){
					array_push($this->ok,$i);
				}
				$i++;
			}
		}
		return $this->ok;
	}
	/**
	 * 获取第n个三角形数，
	 * @param  [type] $n [description]
	 * @return [type]    [description]
	 */
	public function triangularNumber($n){
		return ($n*($n+1))/2;
	}
	/**
	 * 一球从100米高度自由落下，每次落地后反跳回原高度的一半；再落下，求它在 第10次落地时，共经过多少米？第10次反弹多高？
	 * 思路分析：
	 * 
	 */
	public function halfAndhalf($h=100){
		$one = $h/2;
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

$p = PHP13Question::get_instance();

$s = $p->range100to1000();


print_r($s);