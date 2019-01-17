<?php 
class Request{
	private static $_instance = null;
	private $mines;
	private $minesobj;

	public function __construct(){
		if( !empty($_POST) && isset($_POST['operation']) ){
			$operation = $_POST['operation'];
			$level = $_POST['level'];
			$status = $_POST['type'];

			require 'minesweeper.class.php';

			$this->minesobj = new Minesweeper($level);
			switch ($operation) {
				case 'init':
					$this->mines = $this->minesobj->getMines();
					$map = $this->minesobj->getMap();
					echo json_encode( ['status'=>200, 'chessboard'=>$map] );
					// echo $map;
					// exit(0);
					break;

				case 'check':
					$point = $_POST['point'];
					echo json_encode(['status'=>200, 'msg'=>true]);
					exit(0);
					break;
				
				
			}
			
		}else{
			echo json_encode(['status'=>404,'data'=>null]);
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

