<?php
// 创建图片
$image = imagecreatetruecolor(100,40);
$bgcolor = imagecolorallocatealpha($image,rand(200,250),rand(200,250),rand(200,250),40);
imagefill($image, 0, 0, $bgcolor);

for ($i=0; $i<4; $i++){
	$fontsize=6;//1-5，使用内置字体
	$fontcolor=imagecolorallocate($image,rand(0,120),rand(0,120),rand(0,120));//颜色随机 0-120是深色区间
	$data = "AaBbCcDdEeFfGgHhIiJjKkLMmNnPpQqRrSsTtUuVvWwXxYyZz23456789";
	$fontcontent = substr($data,rand(0,strlen($data)), 1);//数字验证码
	// x,与y 避免验证码字体出现重叠或显示不全
	$x = ($i*100/4)+rand(5,10);//水平随机分布
	$y = rand(5,15);//垂直随机分布
	imagestring($image, $fontsize, $x, $y, $fontcontent, $fontcolor);
}
// 3.添加干扰点 -- 可设置 --- imagesetpixel  干扰线 imageline
// P.S. 干扰元素尽量避免喧宾夺主 
for($i=0;$i<180;$i++){
	$pointcolor = imagecolorallocate($image,rand(50,200),rand(50,200),rand(50,200));
	$x = rand(1,99);
	$y = rand(1,29);
	imagesetpixel($image,$x,$y,$pointcolor);
}
// 线干扰
for($i=0;$i<6;$i++){
	$linecolor = imagecolorallocate($image,rand(80,220),rand(80,220),rand(80,220));
	$x1 = rand(1,99);
	$y1 = rand(1,29);
	$x2 = rand(1,95);
	$y2 = rand(1,25);
	imageline($image,$x1,$y1,$x2,$y2,$linecolor);
}
// 验证码图片输出
header("Content-type:image/png");
imagepng($image);//输出到浏览器
imagedestroy($image);