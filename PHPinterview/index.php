<!DOCTYPE HTML>
<html>
	<head>
		<title>PHP 面试集锦</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="assets/css/markdown.css">
		
	</head>
	<body>
		<?php 
			require_once 'HyperDown/Parser.php';
			$parser = new HyperDown\Parser;
			$text = file_get_contents('README.md');
			$html = $parser->makeHtml($text);
		?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>PHP 面试集锦</h1>
					<summary class="d-block pb-2">
						<div class="Details-content--closed f4">
						这是一份 PHP 面试集锦，包含面试题的脚本运行结果。</div>
					</summary>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="commit-tease">
						<div class="AvatarStack flex-self-start">
							<div class="AvatarStack-body"><span class="glyphicon glyphicon-th-list avatar"></span></div>
						</div>
						<div class="flex-auto f6 mr-3">
							<a href="#">PHP面试集锦脚本</a>
						</div>
					</div>
					<div class="file-wrap">
						<?php $dir=dirname(__FILE__)."/exam";
							$file_arr=scandir($dir,0); 
							$array_dir=array();
							foreach ($file_arr as $k => $v) {
								if(is_file($dir.'/'.$v)){
									$array_dir[]=$v;
								}
							}
						if(!empty($array_dir)){?>
							<table class="files">
								<tbody>
								<?php foreach ($array_dir as $k => $v)  {?>
									<tr>
										<td class="icon"><span class="glyphicon glyphicon-file"></span></td>
										<td><a href="exam/<?php echo $v;?>"><?php echo $v;?></a></td>
										<td class="age"><?php echo date("Y-m-d H:i:s",filemtime('exam/'.$v)); ?></td>
									</tr>
								<?php }?>
								</tbody>
							</table>
						<?php } ?>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="Box Box--condensed instapaper_body md">
						<div class="Box-body p-6">
							<article class="markdown-body entry-content">
								<?php echo $html; ?>
							</article>
						</div>
					</div>
				</div>
			</div>
			<div class="footer px-3 ">
				<div class="position-relative d-flex flex-justify-between pt-6 pb-2 mt-6 f6 text-gray border-top border-gray-light">&copy; DHM(huimingdeng) <?php echo date('Y-m'); ?></div>
				<div class="d-flex pb-6"></div>
			</div>
		</div>
	</body>
</html>