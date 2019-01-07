<?php 
class Request{
	private static $_instance = null;

	public function __construct(){
		if( !empty($_POST) && isset($_POST['operation']) ){
			$operation = $_POST['operation'];
			require 'minesweeper.class.php';
			$mines = new Minesweeper();
			
			
		}else{
			echo json_encode(['status'=>200,'data'=>null]);
		}
	}

	public static function getInstance()
	{
		if (NULL === self::$_instance) {
			self::$_instance = new self();	
		}
		return self::$_instance;
	}

}

Request::getInstance();