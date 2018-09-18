<?php
try{
	$dsn='uri:file://D:\phpStudy\WWW\phpStudy\php\object-oriented\config.conf';
	$user = 'root';
	$pass = 'root';
	$pdo = new PDO($dsn,$user,$pass);
	$sql = <<<EOP
	CREATE TABLE IF NOT EXISTS `depart`(
	`dprt_id`  int UNSIGNED NOT NULL AUTO_INCREMENT ,
	`dprt_name`  varchar(50) NOT NULL ,
	`num`  int UNSIGNED NULL ,
	PRIMARY KEY (`dprt_id`),
	UNIQUE INDEX (`dprt_name`) 
	);
EOP;
	$res = $pdo -> exec($sql);
	var_dump($res);
}catch(PDOException $e){
	echo $e->getMessage();
}
