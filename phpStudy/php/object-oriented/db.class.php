<?php

class DB
{
  private static $_instance = NULL;
  public static $config = array();
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

	public function __construct($dbconfig=''){
		//test
    if(!is_array($dbconfig)){//无参数，使用默认的
      $dbconfig = array(
        'hostname' => DB_HOST,
        'username' => DB_USER,
        'password' => DB_PWD,
        'database' => DB_NAME,
        'hostport' => DB_PORT,
        'dbms' => DB_TYPE,
        );
    }
    self::$config = $dbconfig;
    // $this->connectdb($dbconfig);
    $this->condb = new mysqli();
    $this->condb->connect(self::$config['hostname'],self::$config['username'],self::$config['password'],self::$config['database']);
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


	public static function get_instance(){
		if(NULL == self::$_instance)
			self::$_instance = new self();
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

// require_once 'config.php';

// $dbcon=DB::get_instance();

// print_r($dbcon->select("employee",1));

// echo $dbcon->closeDb();
