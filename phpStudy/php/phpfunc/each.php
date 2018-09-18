<!DOCTYPE html>
<html>
<head>
	<title>each() & list()</title>
	<meta charset="utf-8">
	<style type="text/css">
		.container{width: 980px; margin:0 auto;}
		pre {background-color: #42b711; width: 80%; border-radius: 5px; color: red; font-weight: bold; padding: 5px;}
	</style>
</head>
<body>
	<div class="container">
		<pre>
		&lt;?php
		$foo = array("bob", "fred", "jussi", "jouni", "egon", "marliese");
		$bar = list($key, $cat_no) = each($foo);
		print_r($bar);
		print_r($cat_no);
		?&gt;</pre>
		<?php
		$foo = array("bob", "fred", "jussi", "jouni", "egon", "marliese");

		$bar = list($key, $cat_no) = each($foo);
		print_r($bar);
		print_r($cat_no);
		?>
	</div>
</body>
</html>