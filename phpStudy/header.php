<!DOCTYPE html>
<html>
<head>
	<title><?php echo $pageTitle; ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="php/globals/bootstrap.css">
	<link href="javascript/css/public.css" rel="stylesheet" type="text/css"/>
	<?php $author='<a href="https://github.com/huimingdeng/" target="_blank" title="author:DHM">DHM(huimingdeng)</a>'; ?>
	<?php $host_url = ('localhost' == strtolower($_SERVER['HTTP_HOST']))?('http://localhost/phpStudy/'):('http://'.$_SERVER['HTTP_HOST']); 
		$host_name = $_SERVER['HTTP_HOST'];
	?>
</head>
<body>
	<div class="container">