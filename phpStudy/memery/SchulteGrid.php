<?php 
if (isset($_GET['line']) && !empty($_GET['line'])) {
	$line = $_GET['line'];
	if ($line>10 || !is_numeric($line)) {
		$line = 10;
	}elseif($line < 5){
		$line = 5;
	}
}else{
	$line = 5;
}


function Schulte($line)
{
	$schulte = range(1, $line**2);
	shuffle($schulte);
	return $schulte;
}

function PrintTab($schulte, $line) {
	$ht = "<table class=\"table\">\n";
	$ht.= "\t<tr>\n";
	foreach ($schulte as $k => $v) {
		$k+=1;
		$ht .= "<td>". $v ."</td>";
		if (is_int($k/$line)){
			$ht.= "\n\t</tr>\n\t<tr>\n";
		}
	}
	$ht.= "\n\t</tr>\n";
	$ht.= "</table>\n";
	return $ht;
}

 ?>



 <!DOCTYPE html>
 <html>
 <head>
 	<title>Schulte Grid (舒尔特方格训练——默认5*5)</title>
 	<meta charset="utf-8">
 	<style type="text/css">
 		.container{width: 800px; margin: 0 auto;}
 		.table{ border: 1px solid black; padding: 5px; }
 		.table td { border: 1px solid black; text-align: center; vertical-align: middle; padding: 15px; font-weight: bold; }
 	</style>
 </head>
 <body>
 	<div class="container">
 		<form method="get" action="SchulteGrid.php">
	 		<h1>最大为10*10, 最小为5*5</h1>
	 		<p><input type="text" name="line" value="5"><input type="submit" value="生成"></p>
	 		<?php $schulte = Schulte($line);
	 			echo PrintTab($schulte, $line);
	 		?>
	 	</form>
 	</div>
 </body>
 </html>