<?php
	function C($name,$method)
	{//OK
		require_once('/libs/Controller/'.$name.'Controller.class.php');
		eval('$obj=new '.$name.'Controller();$obj->'.$method.'();');
	}

	/**
	 * eval() 函数可将字符串转换为代码执行，并返回一个或多个值。
	 *	如果eval函数在执行时遇到错误,则抛出异常给调用者.
	 * 	类似的函数是loadcode ,loadcode并不立即执行代码,而是返回一个函数对象.
	 *  并且loadcode支持路径参数,eval并不支持. 
	 * 	eval并不支持代码中的return语句,而是将代码作为表达式直接计算出结果.
	 * 例：
	 * var d = eval("({name:'chentong'})")
	 * alert(d.name);
	 * 不过使用eval()方法不安全
	*/
	
	function M($name)
	{//OK
		require_once('/libs/Model/'.$name.'Model.class.php');
		$model = $name.'Model';
		$obj = new $model();
		return $obj;
	}

	function V($name)
	{//OK
		require_once('/libs/View/'.$name.'View.class.php');
		$view = $name.'View';
		$obj = new $view();
		return $obj;
	}
	/**
	 * 魔法函数是否打开，对单引号等进行转义
	 * @param  string $str 需转义的字符串
	 * @return string      转义后的字符串
	 */
	function daddslashes($str)
	{
		return (!get_magic_quotes_gpc()?addslashes($str):$str);
	}
	/**
	 *  @param string  $path 引入第三方类库的路径
	 *  @param string  $name 引入第三方类库的名称
	 *  @param array   $params 引入第三方类的初始化时候需要指定、赋值的属性，格式为 array(属性名=>属性值, 属性名2=>属性值2……)
	 */
	function ORG($path, $name, $params=array())
	{
		require_once('/libs/ORG/'.$path.$name.'.class.php');
		$obj = new $name();
		if(!empty($params)){
		foreach($params as $key=>$value){
				$obj->$key = $value;
			}
		}
		return $obj;
	}