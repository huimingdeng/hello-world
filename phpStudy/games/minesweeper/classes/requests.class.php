<?php 
class Request{
	private static $_instance = null;
	private $mines;
	private $minesobj;
	private $level;
	private $map;

	public function __construct(){
		if( !empty($_POST) && isset($_POST['operation']) ){
			$operation = $_POST['operation'];
			
			require 'minesweeper.class.php';

			
			switch ($operation) {
				case 'init':
					$this->level = $_POST['level'];
					$this->type = $_POST['type'];
					$this->initGame();
					// echo $map;
					// exit(0);
					break;

				case 'check':
					$point = $_POST['point'];
					echo json_encode(['status'=>200, 'msg'=>true]);
					exit(0);
					break;

				case 'get'://测试是否持久化内存地雷结果
					$this->get();
					break;
				
				
			}
			
		}else{
			echo json_encode(['status'=>404,'data'=>null]);
		}
	}

	private function initGame(){
		$this->minesobj = new Minesweeper($this->level);
		$this->mines = serialize($this->minesobj->getMines());
		$this->map = $this->minesobj->getMap();
		echo json_encode( ['status'=>200, 'chessboard'=>$this->map, 'res'=>$this->mines] );
	}

	private function get(){//测试用
		echo json_encode(['status'=>200, 'res'=>unserialize($this->mines)]);
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

