<?php 
$pageTitle = "MVC复习（学习）";
$filename = basename(__FILE__);
require_once('header.php');
$createTime = date('Y-m-d',filectime($filename));?>
		<header><h1>PHP框架——MVC基础</h1></header>
		<main>
			<article>
				<?php $dir=dirname(__FILE__)."/MVC/test";
				$file_arr=scandir($dir,0);
				if(!empty($file_arr)){
					$array_dir=array();
					foreach ($file_arr as $k => $v) {
						if(is_file($dir.'/'.$v)){
							$array_dir[]=$v;
						}
					}
					if(!empty($array_dir)){?>
					<div class="row">
						<h2>测验用的</h2>
						<nav class="navbar">
						<ul class="">
						<?php foreach ($array_dir as $k => $v) {
							if($k==0){$ac="active";}else{$ac="";}?>
							<li class="<?php echo $ac;?>"><a href="MVC/test/<?php echo $v;?>" target="_blank"><?php echo $v;?></a></li>
							<?php
						}
						?>
						</ul>
						</nav>
					</div>
						<?php
					}
		 		}?>
		 		<?php $dir=dirname(__FILE__)."/MVC";
				$file_arr=scandir($dir,0);
				if(!empty($file_arr)){
					
					$array_dir=array();
					foreach ($file_arr as $k => $v) {
						if(is_file($dir.'/'.$v)){
							$array_dir[]=$v;
						}
					}
					if(!empty($array_dir)){?>
					<div class="row">
						<h2>MVC复习（学习）</h2>
						<nav class="navbar">
						<ul class="">
						<?php foreach ($array_dir as $k => $v) {
							if($k==0){$ac="active";}else{$ac="";}?>
							<li class="<?php echo $ac;?>"><a href="MVC/<?php echo ($v=='index.php')?$v.'?controller=test&method=show':$v;?>" target="_blank"><?php echo $v;?></a></li>
							<?php
						}
						?>
						</ul>
						</nav>
					</div>
						<?php
					}
		 		}?>
			</article>
		</main>
<?php include_once 'footer.php'; ?>		