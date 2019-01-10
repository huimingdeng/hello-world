<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GoodsController extends Controller
{
    //测试添加商品信息控制器
    public function index(){
    	return view('goods.addgoods',['title'=>'Add Goods View']);
    }

    public function addgoods(Request $request){

    	$goods_name = $request->input('goods_name');
    	$price = $request->input('price');
    	$disprice = $request->input('disprice');
    	$pubdate = time();
    	$editdate = time();
    	// return $goods_name.'-'.$price.'-'.$disprice;
    	// $res = DB::select("INSERT INTO goods(`goods_name`, `price`, `disprice`, `pubdate`, `editdate`) VALUES('?',?,?,?,?)",[$goods_name,$price,$disprice,$pubdate,$editdate]);
    	$res = DB::insert("INSERT INTO goods(`goods_name`, `price`, `disprice`, `pubdate`, `editdate`) VALUES('?',?,?,?,?)",[$goods_name,$price,$disprice,$pubdate,$editdate]);
    	dd($res);
    }
}
