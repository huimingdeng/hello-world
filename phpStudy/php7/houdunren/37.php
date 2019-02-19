<?php 
/**
 * create by sublime text 3
 * author : huimingdeng
 * Create at : 2/19/2019 9:21
 */
// 37 点语法与参数默认值及传值与传址特性

function sum(...$vars){
	print_r($vars);
}


sum(1,2,3,4,5);