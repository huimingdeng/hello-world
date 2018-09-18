<!DOCTYPE html>
<html>
<head>
	<title>js+jquery+html 学习</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="jQuery/css/bootstrap.css">
</head>
<body>
	<div class="container">
		<header><h1>jQuery学习</h1></header>
		<main>
			<?php $dir=dirname(__FILE__)."/jsForm";
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
						<li class="<?php echo $ac;?>"><a href="jsForm/<?php echo $v;?>" target="_blank"><?php echo $v;?></a></li>
						<?php
					}
					?>
					</ul>
					</nav>
					<?php
				}
			 }?>
		</main>
		<footer>&copy; by dhm &nbsp; 2017.11.10 <a href="/"><?php echo $_SERVER['HTTP_HOST']?></a></footer>
	</div>
</body>
</html>