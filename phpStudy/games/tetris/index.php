<!DOCTYPE HTML>
<html>
	<head>
		<title>俄罗斯方块</title>
		<meta charset="utf-8">
		<link rel="stylesheet" href="../minesweeper/assets/css/bootstrap.min.css">
		<style type="text/css">
			.yel {background: yellow;}
			.blk {background: black;}
			.gry  {background: gray;}
		</style>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<h1>俄罗斯方块</h1>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<?php 
						include_once 'Tetris.php';
						$tetris = new Tetris\Tetris();
					?>
				</div>
			</div>
		</div>
		
	</body>
</html>

