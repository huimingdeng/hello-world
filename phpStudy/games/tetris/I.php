<?php 
/**
 * 形状 I
 * @author huimingdeng <1458575181@qq.com>
 * @version 1.0 
 */
namespace Tetris;

class I extends Tetromino
{
	public $bgc = 'yel';
	public $cell = [];
	
	function __construct()
	{
		$this->cell = [
			new Cell(0,1),new Cell(0,2),new Cell(0,3),new Cell(0,4)
		];
	}

	public function Rotate(){}
}