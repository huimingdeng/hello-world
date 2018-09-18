<!DOCTYPE html>
<html>
<head>
	<title>jQuery动画</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/public.css">
	<script type="text/javascript" src="js/jquery.js"></script>
</head>
<body>
	<div class="container w980">
		<header><?php include_once("navbar.php"); navbar(basename(__FILE__));?></header>
		<main>
			<h1>jQuery动画 <small>—— show(),hide(),toggle(),animation(),slideUp(),slideDown()...</small></h1>
			<article>
				<div class="row">
					<div class="col-xs-8">
						<p><b>1.<code>toggle([duration] [,complete])</code> or <code>toggle(duration [,easing] [,complete])</code> or <code>toggle(options)</code></b>:<em title="显示或隐藏匹配的元素。">Display or hide the matched elements.</em></p>
						<pre>$("#animate01").on("click",function(){<br> $("#nv01").parent('a').toggle(3000,function(){<br>  $(this).css('border','1px solid #42b712');<br> }<br>}</pre>
						<p><code>toggle(options)</code>操作选择项方式：</p>
						<pre>$("#nv01").hover(function() {<br>  $(this).parent('a').toggle({ <br>	duration:3000,<br>	complete:function(){<br>	  $(this).css({<br>		"border":"1px solid #ccc",<br>		"background-color":"rgba(235,222,124,.6)"<br>	  })<br> 	}<br> }) <br>}, function() {<br> $(this).parent('a').toggle({<br>	duration:3000,<br>	complete:function(){<br>	  $(this).css({<br>		"border":"1px solid #ccc",<br>		"background-color":"none"<br>	  })<br> 	}<br> })  <br>})</pre>
						<p class="text-success">案例效果：<br><a class="btn btn-success" id="animate01">动画演示01</a>&nbsp; &nbsp;<a class="btn btn-warning" id="animate02">动画演示02</a></p>
						<div class="row">
							<div class="col-xs-4">
								<a href="javascript:void(0);" class="thumbnail" title="toggle()">
									<img src="images/nv01.jpg" id="nv01" class="img-responsive img-circle" alt="toggle">
								</a>
							</div>
						</div>
						<script type="text/javascript">
							$("#animate01").on("click",function(){
								$("#nv01").parent('a').toggle(3000,function(){
									$(this).css('border','1px solid #42b712');
								});
							})
							$("#animate02").on("click",function(){
								$("#nv01").parent('a').toggle();
							})
							$("#nv01").hover(function() {
								$(this).parent('a').toggle({
									duration:3000,
									complete:function(){
										$(this).css({
											"border":"1px solid #ccc",
											"background-color":"rgba(235,222,124,.6)"
										})
									}
								})
							}, function() {
								$(this).parent('a').toggle({
									duration:3000,
									//easing:linear,//必须有插件
									complete:function(){
										$(this).css({
											"border":"1px solid #42b712",
											"background-color":"none"
										})
									}
								})
							});
						</script>
						<p><b>2.<code>slideUp([duration] [,complete])</code> or <code>slideUp(duration [,easing] [,complete])</code> or <code>slideUp(options)</code></b>:<em title="用滑动动作隐藏匹配的元素">Hide the matched elements with a sliding motion</em>.</p>
						<pre></pre>
					</div>
				</div>
			</article>
		</main>
		<footer>&copy; by dhm &nbsp; &nbsp; 2017.11.13. &nbsp; <a href="/"><?php echo $_SERVER['HTTP_HOST'];?></a></footer>
		<?php include_once("footer.php");?>
	</div>
</body>
</html>