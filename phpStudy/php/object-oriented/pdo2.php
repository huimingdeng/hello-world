<?php
try{
	$dsn = 'mysql:host=localhost;dbname=testdb';
	$user = 'root';
	$pass = 'root';
	$pdo = new PDO($dsn, $user, $pass);
	$sql = "INSERT INTO dprt(dprt_name) VALUES('fulengen'),('igenebio'),('genecopoeia');";
	$res = $pdo->exec($sql);
	echo $res;
	$pdo = null;
}catch(PDOException $e){
	echo $e->getMessage();
	die();
}