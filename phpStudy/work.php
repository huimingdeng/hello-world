<!DOCTYPE html>
<html>
<head>
	<title>工作</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="php/globals/bootstrap.css">
</head>
<body>
	<div class="container">
		<header>工作</header>
		<main>
		<?php $dir=dirname(__FILE__)."/work";
			$file_arr=scandir($dir,0);
			if(!empty($file_arr)){
				$array_dir=array();
				foreach ($file_arr as $k => $v) {
					if(is_file($dir.'/'.$v)){
						$array_dir[]=$v;
					}
				}
				if(!empty($array_dir)){?>
					<nav class="nav nav-pills nav-stacked">
					<ul>
					<?php foreach ($array_dir as $k => $v) {
						if($k==0){$ac="active";}else{$ac="";}?>
						<li class="<?php echo $ac;?>"><a href="work/<?php echo $v;?>"><?php echo $v;?></a></li>
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
</body>
</html>