<!DOCTYPE html>
<html>
<head>
	<title>工作小程序，运行时间可能较长，以后看能否使用Linux命令处理</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../php/globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../php/globals/public.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>工作小程序 <small>——未完成</small></h1>

		</header>
		<main>
			<article>
				<div class="row">
					<p><b>1.小程序：</b>将文件A.csv中的邮件与文件B.txt中的邮件进行比较，排除A.csv中存在的邮件，得到新文件C.txt和已经被排除掉的文件D.txt(要求，被排除的必须是csv文件中)</p>
					<div class="col-xs-6">
						<p><b>小程序1：</b>上传需要进行比较的文件</p>
						<form action="upload.php" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="fileA">文件A</label>
								<input type="file" name="file[]" id="fileA">
							</div>
							<div class="form-group">
								<label for="fileB">文件B</label>
								<input type="file" name="file[]" id="fileB">
							</div>
							<input type="hidden" name="upf" value="uploadfile">
							<input type="submit" name="submit" value="上传对比文件" class="btn btn-success">
						</form>
					</div>
					<div class="col-xs-6">
						<p><b>小程序2：</b>选择对比文件，设置对比对象</p>
						<?php $compare="./compare";
							if(file_exists($compare)){
								//获取目录下的文件
								$d=dir($compare);?>
							<form action="upload.php" method="post">
								<?php while(($file=$d->read()) !== false ){
									if(is_file($compare.'/'.$file)){?>
								<div class="form-group">
									<label><input type="checkbox" name="file[]" value="<?php echo $file;?>"><?php echo $file;?></label>
								</div>
								<?php }
								}?>
								<input type="submit" class="btn btn-danger" name="submit" value="运行对比程序">
							</form>
						<?php }else{?>
							<ul>
							<li>暂无对比文件，请上传</li>
							</ul>
						<?php }?>
							
						
					</div>
				</div>
			</article>
		</main>
		<footer>&copy; by dhm &nbsp;,&nbsp; 20171018 ,&nbsp;&nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST']; ?></a></footer>
		<?php require_once("../php/footer.php");?>
	</div>
</body>
</html>
