<?php 
// DB 测试
Route::get('db', function(){
	dd(config());
});

// 链接
Route::get('con', 'DBController@index');

// 事务处理
Route::get('transaction', 'DBController@transaction');


// Goods 添加测试

Route::get('addgoods', 'GoodsController@index');
Route::post('addone', 'GoodsController@addgoods');