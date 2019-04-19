<?php 
/**
 * 四连方格抽象类 Tetromino
 * @author huimingdeng <1458575181@qq.com>
 * @version 1.0 
 */

abstract class Tetromino{
	public $bgc; // 背景颜色
	public $cell = []; // 四连方格坐标 I :  (8,0),(9,0),(10,0),(11,0) 表示 横 I 
	abstract public function Rotate();
}