<!DOCTYPE html>
<html>
<head>
	<title>phpStudy</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="php/globals/bootstrap.css">

</head>
<body>
	<div class="container">
		<header><h1>PHP复习之路</h1>&ge;</header>
		<main>
		<?php $dir=dirname(__FILE__)."/";
		$file_arr=scandir($dir,0);
		if(!empty($file_arr)){
			$array_dir=array();
			require_once("un.php");//引入不显示的文件数组
			foreach ($file_arr as $k => $v) {
				if(is_file($dir.'/'.$v)&&!in_array($v,$not_show_display)){
					$array_dir[]=$v;
				}
			}
			if(!empty($array_dir)){?>
				<nav class="nav nav-pills nav-stacked">
				<ul>
				<?php foreach ($array_dir as $k => $v) {
					if($k==0){$ac="active";}else{$ac="";}?>
					<li class="<?php echo $ac;?>"><a href="<?php echo $v;?>"><?php echo $v;?></a></li>
					<?php
				}
				?>
				</ul>
				</nav>
				<?php
			}
		 }?>
		</main>
		<footer>&copy;by dhm &nbsp,20171016, &nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST'];?></a></footer>
	</div>
	<script type="text/javascript" src="php/globals/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="php/globals/bootstrap.js"></script>
</body>
</html>