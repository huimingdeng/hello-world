<!DOCTYPE html>
<html>
<head>
	<title>PHP函数</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header><h1>Filter函数 <small>——过滤函数</small></h1></header>
		<main>
			<?php include_once("navbar.php"); navbar(basename(__FILE__));?>
			<div class="row">
				<div class="col-xs-6">
					<p><b>1.<code>filter_has_var(type, variable)</code></b>:检查是否存在指定输入类型的变量。如果成功则返回 TRUE，如果失败则返回 FALSE。</p>
					<form class="form-inline" action="filter.php" id="filter1" method="post">
						<input type="text" name="name" class="form-control">
						<input type="submit" name="submit" class="btn btn-success" value="提交">
					</form>
					<?php
					if(isset($_POST['name'])){
						if(!filter_has_var(INPUT_POST, "name"))
						{
						echo("Input type does not exist");
						}
						else
						{
						echo("Input type exists ".$_POST['name']);
						}
					}?>
				</div>
				<div class="col-xs-6">
					<p><b>2.<code>filter_list()</code></b>:返回包含所有得到支持的过滤器的一个数组。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="blue">print_r</i>(<i class="blue">filter_list</i>());<em class="red">?&gt;</em></pre>
					<p class="text-success">打印<code>filter_list()</code>:<br><kbd><?php $filter=filter_list();echo "Array(\n<br>\r\n";
					foreach($filter as $k=>$v){
						echo "\n[\n".$k."\n] => ".$v."<br>\r\n";
						}echo ")\r\n";?></kbd></p>
				</div>
			</div>
		</main>
		<footer>&copy; by dhm &nbsp; &nbsp; 20171108 &nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST'];?></a></footer>
		<?php include_once("footer.php");?>
	</div>
</body>
</html>