<!DOCTYPE html>
<html>
<head>
	<title>php函数</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>php函数</h1>
		</header>
		<main>
			<?php $dir=dirname(__FILE__)."/phpfunc";
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
					<li class="<?php echo $ac;?>"><a href="phpfunc/<?php echo $v;?>" target="_blank"><?php echo $v;?></a></li>
					<?php
				}
				?>
				</ul>
				</nav>
				<?php
			}
		 }?>
			
		</main>
		<footer>&copy; by dhm &nbsp; &nbsp; 2018,03,20 &nbsp; <a href="/"><?php echo $_SERVER['HTTP_HOST'];?></a></footer>
		<?php include_once("footer.php");?>
	</div>
	<script type="text/javascript">
		function fresh(id,src){
			document.getElementById(id).src=src;
		}
	</script>
</body>
</html>