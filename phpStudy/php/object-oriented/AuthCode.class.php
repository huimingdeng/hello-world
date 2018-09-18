<?php
/**
* AUTHOR: Ming
* DATE: 2018/03/26
* VERSION: 1.0
*/
class AuthCode
{
	private $enstr = "abcdefghkmnpqrstuvwxyzABCDEFGHJKMNPQRSTUVWXYZ23456789";
	private $cnstr = "中国特色社会主义市场经济人民当家做主慕课网美帝霸权英腐俄熊鹰视狼顾一去二三里烟岩村是我离原上草岁枯荣野火烧不尽春风吹又生极客学院县乡改罪恶";//UTF8 3 字节
	private $font;//字体
	private $code;//验证码
	private $codelen = 4;//验证码长度,默认4，可改
	private $image;//验证码图
	private $width = 100;//验证码宽度
	private $height =30;//验证码高度
	private $type = "en";//默认英文字体
	private $fontsize = 12;

	/**
	 * 准备，若有字体文件则引入字体文件,默认为英文 en，可选中文 cn
	 */
	public function __construct($type="en")
	{
		$this->type = $type;
		if("cn"==$this->type){
			$this->font = dirname(__FILE__).'/font/FZYTK.TTF';
		}
		else{
			$this->font = dirname(__FILE__).'/font/ELEPHNT.TTF';
		}
	}
	/**
	 * 创建背景图片
	 * @return [type] [description]
	 */
	private function creatImg(){
		$this->image = imagecreatetruecolor($this->width, $this->height);
		$bgcolor = imagecolorallocate($this->image, rand(200,250),rand(200,255),rand(195,255)); 
		// 绘制矩形
		// imagefilledrectangle($this->image, 0, $this->width, $this->width, 0, $bgcolor);
		imagefill($this->image,0,0,$bgcolor);
	}
	
	/**
	 * 组装验证码文字
	 * @return [type] [description]
	 */
	private function createFont(){
		
		if("cn"==$this->type){
			$data = str_split($this->cnstr,3);
			$this->fontsize=rand(12,16);
		}else{
			$data = $this->enstr;
		}
		// $this->angle = rand(0,30);
		for($i=0;$i<$this->codelen;$i++){
			$fontcolor=imagecolorallocate($this->image,rand(0,120),rand(0,120),rand(0,120));
			$x = (($this->width*$i)/$this->codelen)+rand(5,8);//水平随机分布
			$y = rand(5,$this->height/2);

			if("cn"==$this->type){
				$index = rand(0,count($data));
				$fontcont = $data[$index];
				$this->code.= $fontcont;
				imagettftext($this->image,$this->fontsize,mt_rand(-60,60),$x,$this->height/1.2,$fontcolor,$this->font,$fontcont);
			}else{
				$fontcont = substr($data,rand(0,strlen($data)), 1);
				$this->code.=$fontcont;
				// imagestring($this->image, $this->fontsize, $x, $y, $fontcont, $fontcolor);
				imagettftext($this->image,$this->fontsize,mt_rand(-60,60),$x,$this->height/1.2,$fontcolor,$this->font,$fontcont);
			}
		}
	}
	/**
	 * 验证码添加干扰元素
	 * @return [type] [description]
	 */
	private function createPoint(){
		// 干扰点
		for($i=0;$i<180;$i++){
			$pointcolor = imagecolorallocate($this->image,rand(50,200),rand(50,200),rand(50,200));
			$x = rand(1,$this->width);
			$y = rand(1,$this->height);
			imagesetpixel($this->image,$x,$y,$pointcolor);
		}
		// 干扰线
		for($i=0;$i<4;$i++){
			$linecolor = imagecolorallocate($this->image,rand(80,220),rand(80,220),rand(80,220));
			$_x=$this->width -2;
			$_y=$this->height -2;
			$x1 = rand(2,$_x);
			$y1 = rand(2,$_y);
			$x2 = rand(2,$_x);
			$y2 = rand(2,$_y);
			imageline($this->image,$x1,$y1,$x2,$y2,$linecolor);
		}
	}

	/**
	 * 修改验证码长度，默认4个验证码的长度
	 * @param integer $codelen 默认4
	 */
	public function setCodeLen($codelen=4){
		$this->codelen = $codelen;
	}
	/**
	 * 浏览器输出图片
	 * @return 输出验证码图片
	 */
	private function showImg(){
		header("Content-type:image/png");
		imagepng($this->image);
		imagedestroy($this->image);
	}
	/**
	 * 最终输出验证码图
	 * @return 执行输出二位码
	 */
	public function output(){
		$this->creatImg();//创建背景图
		$this->createFont();
		$this->createPoint();//创建干扰元素
		$this->showImg();
	}

	/**
	 * 获取验证码类型，非0则为混合，为零则小写
	 * @param  integer $type [description]
	 * @return [type]        [description]
	 */
	public function getCode(){	
		return strtolower($this->code);
	}

}
