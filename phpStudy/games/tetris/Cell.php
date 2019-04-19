<?php 
/**
 * 四连方格单元格
 * @author huimingdeng <1458575181@qq.com>
 * @version 1.0 
 */
namespace Tetris;

class Cell{
	public $rowindex;
	public $colindex;

	public function __construct($rowindex, $colindex)
	{
		$this->rowindex = $rowindex;
		$this->colindex = $colindex;
	}
}
