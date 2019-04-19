<?php 
/**
 * 单元格状态
 * @author huimingdeng <1458575181@qq.com>
 * @version 1.0 类版本	
 */
namespace Tetris;

class CellStatus{
	const GAP = 0; // 空白部分为0
	const FALL = 1; // 下落的4个格子状态
	const BLOCK = 2; // 固定后的状态
}