<!DOCTYPE html>
<html>
<head>
	<title>文件上传</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header><h1>PHP文件上传案例 <small>——图片上传</small></h1></header>
		<main>
			<?php require_once("navbar.php"); navbar(basename(__FILE__));?>
			<div class="row">
				<form action="test.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
					    <label for="file">文件名：</label>
					    <input type="file" name="file" id="file">
				    </div>
					 <input type="submit" class="btn btn-primary" name="submit" value="提交">
				</form>
			</div>
			<div class="row">
				<h2>图片列表：</h2>
				<?php $dir="uploads";
					$filedir=scandir($dir,0);
					$files=array();
					foreach ($filedir as $k => $v) {
						if(is_file($dir.'/'.$v))
						$files[]=$v;
					}
					if(!empty($files)){
						foreach ($files as $k => $v) {?>
				<div class="col-xs-2 max-height-3">
					<a href="<?php echo "package/download.php?type=down&filename=../".$dir."/".$v;?>" title="下载该图片" class="thumbnail">
					<img src="<?php echo $dir."/".$v;?>" class="img-responsive <?php if($k%2==0){echo "img-rounded";}else{echo "img-circle";}?>" alt="Responsive image"></a>
					 <div class="caption">
				        <h3><?php echo substr_replace($v, '...', 3);?></h3>
				        <div><a href="<?php echo "package/download.php?type=del&filename=../".$dir."/".$v;?>" class="btn btn-danger btn-sm" role="button">Delete</a> </div>
				      </div>
				</div>		
				<?php	}
					}?>
			</div>
		</main>
		<footer>&copy; by dhm &nbsp;,&nbsp; 20171024 ,&nbsp;&nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST']; ?></a></footer>
		<?php require_once("footer.php");?>
	</div>
</body>
</html>