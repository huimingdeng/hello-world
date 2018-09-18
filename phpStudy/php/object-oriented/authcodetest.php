<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>AuthCode</title>
</head>
<body>	
	<?php
	if(isset($_REQUEST['authcode'])){
		session_start();
		if(strtolower(trim($_REQUEST['authcode']))==$_SESSION['authcode']){
			echo "验证成功";
		}else{
			echo "输入错误";
		}
		exit();
	}
	?>
	<div style="margin:0 auto; width:980px;">
		<h1>验证码测试</h1>
		<form action="authcodetest.php" method="post">
			<img id="test" src="AuthCode3.php?r=<?php echo rand();?>" >
			<a href="javascript:void(0);" onclick="document.getElementById('test').src='AuthCode3.php?r='+Math.random()">换一张</a>
			<br/>
			<!-- <img src="AuthCode2.php"> -->
			<input type="text" name="authcode"><br>
			<input type="submit" name="提交">
		</form>
	</div>
	<?php if(isset($_SESSION['authcode'])){ echo $_SESSION['authcode'];}?>
</body>
</html>