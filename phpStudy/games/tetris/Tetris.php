<?php 
/**
 * Tetris : http://www.imooc.com/article/285405
 * 阅读有感 -- 表格操作
 * @author huimingdeng
 * @version 1.0 
 */
namespace Tetris;

class Tetris{
	const GAP = 0; // 空白部分为0
	const FALL = 1; // 下落的4个格子状态
	const BLOCK = 2; // 固定后的状态
	const MATRIX_WIDTH = 25; // 宽25
	const MATRIX_HEIGHT = 10; // 列10
	private static $matrix = []; // 矩阵
	/**
	 * 构造函数，初始化
	 */
	public function __construct(){
		$a = $this->init();
		print_r($a);
	}
	/**
	 * 绘制初始化矩阵
	 * @return matrix 返回初始化矩阵信息
	 */
	public function init(){
		for ($i=0; $i < self::MATRIX_HEIGHT; $i++) { 
			for ($j=0; $j < self::MATRIX_WIDTH; $j++) { 
				self::$matrix[$i][$j] = self::GAP;
			}
		}
		return self::$matrix;
	}


}

$tetris = new Tetris();