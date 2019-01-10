<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use DB;

class DBController extends Controller
{
    //
    public function index()
    {
    	// $tables = DB::select('show tables');
    	// dd($tables);
    	$table = DB::select('DESC goods');
    	dd($table);
    }

    // 事务处理
    public function transaction()
    {
    	// 默认自动事务处理

    	// 手动事务处理
    	// DB::beginTransaction();
    }
}
