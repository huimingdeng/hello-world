<!DOCTYPE html>
<html>
<head>
	<title>数组排序函数</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header><h1>数组排序函数</h1></header>
		<main>
			<?php include_once("navbar.php"); navbar(basename(__FILE__));?>
			<div class="row">
				<div class="col-xs-6">
					<p><b>1.<code>sort()</code></b>:对数组进行升序排列</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">asf</i>=<i class="orange">array</i>(<br> "ten",<br> "nine",<br> "eight",<br> "seven",<br> "six",<br> "five",<br> "four",<br> "three",<br> "two",<br> "one",<br> "zero"<br> );<br> <i class="blue">sort</i>(<i class="green">$</i><i class="blue">asf</i>);<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">asf</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">排序后结果：（按数组的值的字母顺序进行升序排列--键值对重置）<br><kbd><?php $asf=array("ten","nine","eight","seven","six","five","four","three","two","one","zero");
						sort($asf);
						print_r($asf);
					?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>2.<code>rsort()</code></b>:对数组进行降序排列</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="blue">rsort</i>(<i class="green">$</i><i class="blue">asf</i>);<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">asf</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">将<code>asort()</code>结果再次排序后结果：（按数组的值的字母顺序进行降序排列--键值对重置）<br><kbd><?php rsort($asf); print_r($asf);?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>3.<code>asort()</code></b>:根据关联数组的值，对数组进行升序排列。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="blue">asort</i>(<i class="green">$</i><i class="blue">asf</i>);<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">asf</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">将上一个<code>rsort()</code>结果再次排序：（键值对不变，注意观察对比<code>rsort()</code>结果）<br><kbd><?php asort($asf); print_r($asf);?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>4.<code>ksort()</code></b>:根据关联数组的键，对数组进行升序排列</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="blue">ksort</i>(<i class="green">$</i><i class="blue">asf</i>);<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">asf</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">将上一个结果按键的值（这里是数字顺序升序）进行升序排序<br><kbd><?php ksort($asf); print_r($asf);?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>5.<code>arsort()</code></b>:根据关联数组的值，对数组进行降序排列</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="blue">arsort</i>(<i class="green">$</i><i class="blue">asf</i>);<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">asf</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">将上一排序结果按值（26字母）降序排列：<br><kbd><?php arsort($asf); print_r($asf);?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>6.<code>krsort()</code></b>:根据关联数组的键，对数组进行降序排列</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="blue">krsort</i>(<i class="green">$</i><i class="blue">asf</i>);<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">asf</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">将上一排序结果按键降序排列：<br><kbd><?php krsort($asf); print_r($asf);?></kbd></p>
				</div>
			</div>
		</main>
		<footer>&copy; by dhm &nbsp; &nbsp; 2017,11,08 &nbsp; <a href="/"><?php echo $_SERVER['HTTP_HOST'];?></a></footer>
		<?php include_once("footer.php");?>
	</div>
</body>
</html>