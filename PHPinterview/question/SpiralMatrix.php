<?php 
/**
 * 给定一个正整数 n，生成一个包含 1 到 n2 所有元素，且元素按顺时针顺序螺旋排列的正方形矩阵。
 * 示例:
 * 输入: 3
 * 输出:
 * [
 * 	[ 1, 2, 3 ],
 * 	[ 8, 9, 4 ],
 * 	[ 7, 6, 5 ]
 * ]
 * 来源：力扣（LeetCode）
 * 链接：https://leetcode-cn.com/problems/spiral-matrix-ii
 * 著作权归领扣网络所有。商业转载请联系官方授权，非商业转载请注明出处。
 */
class Solution {
	private $matrix = [];
	private $n;
    /**
     * @param Integer $n
     * @return Integer[][]
     */
    public function generateMatrix(int $n) {
        $matrix = [];
        $this->n = $n;
        $max = $n**2;
        $num = 1; // 矩阵值
        
        for($x=0;$x<$n/2;$x++) {
            //先从行开始遍历，这时候一定要找关系，仔细想想
            for($y=$x;$y<=$n-$x-1;$y++) {
                $matrix[$x][$y] = $num++;
                echo '$x=>',$x,"\tx=>",$x,"\ty=>",$y,"\tv=>",$num-1, "\n";
            }
             
            //遍历一竖
            for($y=$x+1;$y<=$n-$x-1;$y++) {
                $matrix[$y][$n-$x-1] = $num++;
                echo '$x=>',$x,"\tx=>",$y,"\ty=>",$n-$x-1,"\tv=>",$num-1, "\n";
            }
             
            //遍历底层一行
            for($y=$n-$x-2;$y>=$x;$y--) {
                $matrix[$n-$x-1][$y] = $num++;
                echo '$x=>',$x,"\tx=>",$n-$x-1,"\ty=>",$y,"\tv=>",$num-1, "\n";
            }
             
            //遍历左边一竖
            for($y=$n-$x-2;$y>=$x+1;$y--) {
                $matrix[$y][$x] = $num++;
                echo '$x=>',$x,"\tx=>",$y,"\ty=>",$x,"\tv=>",$num-1, "\n";
            }
            echo PHP_EOL;
        }
        
        $this->matrix = $matrix;
        return $this;
    }

    public function getMatrix(){
    	return $this->matrix;
    }
    
    public function printMatrix(){
    	for($i=0;$i<$this->n;$i++){
    		echo "|";
        	for($j=0;$j<$this->n;$j++){
        		echo "\t",$this->matrix[$i][$j], "\t|";
        	}
        	echo PHP_EOL;
        }
    }
}
