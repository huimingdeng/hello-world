<?php 

class test{
	private static $_instance = NULL;

	public function __construct(){
		echo "hello world.\n";
	}

	public static function get_instance(){
		if(NULL == self::$_instance)
			self::$_instance = new self();
		return self::$_instance;
	}
}

// test::get_instance();

/*$host="localhost";
$user="root";
$pass="root";
$db="test_db";*/
require_once 'db.class.php';
// $test=new DB($host,$user,$pass,$db);
require_once 'config.php';
$test=new DB();
// $res=$test->select("employee",1);
$res = $test->select("tdb_goods");
print_r($res);
$test->closeDb();