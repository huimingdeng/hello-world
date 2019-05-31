<?php
/**
 * 
 * 阅读有感 -- 表格操作
 * @author huimingdeng
 * @version 1.0
 * @link http://www.imooc.com/article/285405 Tetris
 */
namespace Tetris;

class Tetris
{

    const MATRIX_WIDTH     = 25; // 宽25
    const MATRIX_HEIGHT    = 20; // 列20
    private static $matrix = []; // 矩阵
    /**
     * 构造函数，初始化
     */
    public function __construct()
    {
        $this->init();
        $this->MatrixRender();
    }
    /**
     * 绘制初始化矩阵
     * @return matrix 返回初始化矩阵信息
     */
    public function init()
    {
        for ($i = 0; $i < self::MATRIX_HEIGHT; $i++) {
            for ($j = 0; $j < self::MATRIX_WIDTH; $j++) {
                self::$matrix[$i][$j] = CellStatus::GAP;
            }
        }
        return self::$matrix;
    }
    /**
     * 矩阵表格渲染
     */
    public function MatrixRender()
    {
        $table = '<table class=\'table table-bordered\' border=\'0\' cellpadding=\'0\' cellspacing=\'0\'>';
        $tr    = '';

        for ($i = 0; $i < self::MATRIX_WIDTH; $i++) {
            $tr .= '<tr>';
            $td = '';
            for ($j = 0; $j < self::MATRIX_HEIGHT; $j++) {

                $cellstatus = self::$matrix[$j][$i];
                switch ($cellstatus) {
                    case CellStatus::FALL:
                        $td .= '<td class=\'yel\'>' . '</td>';
                        break;
                    case CellStatus::BLOCK:
                        $td .= '<td class=\'gry\'>' . '</td>';
                        break;
                    default:
                        $td .= '<td class=\'blk\'>' . '</td>';
                        break;
                }

            }
            $tr .= $td;
            $tr .= '</tr>';
        }
        $table .= $tr;
        $table .= '</table>';
        echo $table;
    }

}

include_once 'CellStatus.php';
