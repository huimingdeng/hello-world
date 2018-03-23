<?php

class DB{
	private static $_instance = NULL;
	private $host;
	private $user;
	private $pass;
	private $db;
	private $table;
	private $condb;
	private $sql;
	public $charset = "utf8";
	private $errorMsg;
	private $res;

	public function __construct($host,$user,$pass,$db){
		//test
    $this->host = $host;
    $this->user = $user;
    $this->pass = $pass;
    $this->db = $db;
    $this->connectdb($this->host,$this->user,$this->pass,$this->db);
	}

	public function connectdb($host,$user,$pass,$db){
		$this->condb = new mysqli();
    $this->condb->connect($host,$user,$pass,$db);
    if($this->condb->errno){
    	return $this->errorMsg = "Connect Error: ".$this->condb->error;
    }
    $this->condb->set_charset($this->charset);
       	
  }
  /**
   * 
   */
  public function getTableInfo(){
  	
  	$this->sql = "SHOW TABLES";
  	$this->res = $this->condb->query($this->sql);
  	$table = array();
  	while ($temp = mysqli_fetch_assoc($this->res) ) {
  		$table[] = $temp["Tables_in_testdb"];
  	}
  	$this->res = $table;
  	return $this->res;
  }

  public function select($table,$limit=0){
    $this->sql = "select * from $table";
    ($limit)?($this->sql .= " limit ".$limit):$this->sql;
    
    $this->res = $this->condb->query($this->sql);
    $res = array();
    while ($temp = mysqli_fetch_assoc($this->res)) {
      $res[] = $temp;
    }
    $this->res = $res;
    return $this->res;
  }


	public static function get_instance($host,$user,$pass,$db){
		if(NULL == self::$_instance)
			self::$_instance = new self($host,$user,$pass,$db);
		return self::$_instance;
	}

	public function closeDb(){
		if($this->condb->close()){
      return "close Db\n";
    }else{
      $this->closeDb();
    }
		
	}
}

$host="localhost";
$user="root";
$pass="root";
$db="testdb";

$dbcon=DB::get_instance($host,$user,$pass,$db);

print_r($dbcon->select("employee",1));

echo $dbcon->closeDb();
