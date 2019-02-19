<?php 
/**
 * create by sublime text 3
 * author : huimingdeng
 * Create at : 2/19/2019 9:24
 */
// 38 严格模式declare与参数类型约束 

declare(strict_types=1);

function show(int $num){
	return $num;
}

var_dump(show('2'));//严格模式报错，非严格模式则类型强制转换
