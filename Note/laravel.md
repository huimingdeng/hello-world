# Laravel 学习笔记 #
Laravel学笔记，记录一些个人学习中遇到的知识点和遇到问题处理方案。
《[laravel5.7中文文档](https://laravel-china.org/docs/laravel/5.7 "文档")》
## 01. laravel5.7 下载与安装 ##
laravel 框架下载安装部署项目方式。

### composer 脚手架安装 laravel5.7 ###
使用composer 安装脚手架。 默认安装 laravel 最新版，目前安装的为 5.7.19

    composer global require "laravel/installer" // 默认安装到 C:\Users\<用户>\AppData\Roaming\Composer
	cd C:\Users\<用户>\AppData\Roaming\Composer 
	dir //列出目录内容
![laravel vendor](https://i.imgur.com/cRhAtAY.png)

	// 切换到项目目录，并创建 laravel 项目目录
	cd F:\DHM-Project
	laravel new laravel57  // P.S. 注意 PHP 扩展必须开启 extension=php_fileinfo.dll，
						   // extension=php_mbstring.dll 和 extension=php_openssl.dll
						   // 否则无法在项目目录 laravel57 中生成 vendor 目录
	dir //罗列目录 ，扩展若不开启，则下面中的 vendor 目录无法生成：

![laravel57 vendor](https://i.imgur.com/mneguVr.png)

### GitHub 下载源码安装 ###
下载地址 [https://github.com/laravel/laravel](https://github.com/laravel/laravel "https://github.com/laravel/laravel")

### Windows7 使用PHPStudy2018 Nginx环境 ###
启动 phpstduy2018 ，点击切换版本 `php7.2.10-nts + Nginx` ,然后打开Nginx多虚拟域名配置文件 `vhosts.conf` 本人 Nginx 配置路径为：`D:\phpStudy\PHPTutorial\nginx\conf\vhosts.conf`, 文件中进行如下配置：

	server{
		listen 80;
		server_name	www.laravel57.com laravel57.com;
	
		#charset koi8-r;
	
		#access_log	logs/host.access.log	main;
		root	"D:/PhpProject/laravel57/public";
		location / {
			index	index.html	index.htm	index.php	1.php;
			autoindex	on;
				try_files	$uri	$uri/	/index.php?$query_string;
		}
		#error_page 404		/404.html;
	
		# redirect server error pages to the static page /50x.html
		#
		error_page	500 502 503 504	/50x.html;
		location	=	/50x.html {
			root	html;
		}
		// 该部分可以复制 nginx.conf 中的
		location ~ \.php(.*)$  {
	            fastcgi_pass   127.0.0.1:9000;
	            fastcgi_index  index.php;
	            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
	            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
	            fastcgi_param  PATH_INFO  $fastcgi_path_info;
	            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
	            include        fastcgi_params;
	        }
	
	}
然后，本地环境就可浏览器输入 www.laravel57.com 或 laravel57.com 进行访问了。

## 02. Laravel 路由<重点> ##

- Laravel特性： 每个方法必须设置路由才可以访问，不设置路由则无法访问。
- Laravel 不支持 pathinfo 模式
- 路由定义：
	- eg. `Route::get('hello', function(){ return 'hello'; });`
- 路由参数 eg. `Route::post('login/{name}/{id?}')` {id?}:表示可以忽略，但使用 get 必须要设置默认值。

Jan 2,2019

### Artisan 的使用 ###
php artisan + <命令> 创建对应功能模块，亦可以自定义创建命令。例如 Laravel控制器 的事例。

例如使用artisan创建命令，`php artisan make:command ServiceMakeCommand` 回车后在 app/Http/Console/Commands/ 目录生存文件 ServiceMakeCommand.php
![artisan命令使用，创建命令](https://i.imgur.com/J59JJqd.png)

ServiceMakeCommand.php 文件分析，如图所示：
![命令文件分析](https://i.imgur.com/i57Df6h.png)

    protected $signature = 'command:name'; // 定义命令分组和命令名 
										// command：表示命令分组，name：表示命令的名称
	protected $description = 'Command description'; // 定义命令的描述
	// 执行：
	php artisan //可以在控制台中看到对应命令 


### 自定义路由 ###
对 laravel 框架项目进行路由的自定义。`RouteServiceProvider.php`中添加函数。P.S. laravel 框架中定义。

疑问：

- 如何创建自定义路由？
	- 在 `<Project>/routes/` 目录中新建PHP文件，eg. `admin.php`;
	- 在 `admin.php` 中定义路由 `Route::get()` 或 `Route::post()`
	- 在 `RouteServiceProvider.php` 中定义相关路由实现函数
	- 在 `RouteServiceProvider.php` 中的 `map()` 地图函数中使用上一步定义的路由实现函数。
	- -- writed by huimingdeng on Jan 4,2019
- 路由优先级？
	- 后面定义的路由优先级覆盖前面定义的路由
	- 示例说明图：![优先级说明示例图](https://i.imgur.com/2GHKeG3.png)




## 03. Laravel 控制器 ##
大小驼峰命名法。 使用命令创建控制器 `php artisan make:controller <模块名>/<控制器名>Controller`

大驼峰:每个单词首字母都大写  eg. `HelloController`

小驼峰:第一个单词全小写。后续单词首字母大写 eg. `helloController`


创建成果后，如果没有写<模块名>，则在 `app/Http/Controllers/` 目录下生成，如果有<模块名> eg. Login，则控制器生成在 `app/Http/Controllers/Login/` 目录下。 同时一般默认添加Contrller后缀。

### 控制器分层定义 ###
分层定义？什么是控制器分层？有何作用？

控制器分层定义可以按功能模块创建，也可以服务等方式创建，分层作用是可以方便管理，文件功能一目了然。

### (单一)行为控制器 ###
单一行为处理:定义一个只处理单个行为的控制器.

魔术方法 `__invoke()` : 当尝试以调用函数的方式调用一个对象时，__invoke() 方法会被自动调用。

官方示例： 

	<?php
	class CallableClass 
	{
	    function __invoke($x) {
	        var_dump($x);
	    }
	}
	$obj = new CallableClass;
	$obj(5);
	var_dump(is_callable($obj));
	?>
结果：

	int(5)
	bool(true)

定义单一行为控制器；

在 `routes/web.php` 中定义路由

	// 单一行为控制器
	Route::get('slip/{name?}', 'Only\SlipController');

控制台中执行命令，创建单一行为控制器：`php artisan make:controller Only/SlipController --invokable`,示意图如下：

![单一行为控制器案例](https://i.imgur.com/KI4cOW4.png)



单一行为控制器参考：《[laravel5.7 中文文档](https://laravel-china.org/docs/laravel/5.7/controllers/2256#single-action-controllers)》

on Jan 5,2019 by huimingdeng. 
### 资源控制器 ###
何为资源控制器？如何创建资源控制器？

创建资源控制器：`php artisan make:controller <controllername> --resource` 

eg. `php artisan make:controller Api/UserController --resource`

生成文件后，文件中的各函数（行为）和动作对照关系如图：

![资源控制器行为动作对照表](https://i.imgur.com/8H3LLCk.png)

效果如图：

![资源控制器的创建](https://i.imgur.com/gCwcBZ6.png)

P.S. 注意，在测试验证调试 post 等非 get 动作，需要注释掉中间件验证 `\App\Http\Middleware\VerifyCsrfToken::class,` 文件为：`app\Http\Kernel.php` 否则使用 postman 工具进行调试会报错。示例：

![post 请求示例](https://i.imgur.com/bAXMUHQ.png)
on Jan 6,2019 by huimingdeng

## 04. CSRF 保护 ##
常见的攻击方式：SQL注入，xxs，dos，ddos，csrf等。

- xss : 基于 dom 的 js 脚本攻击。转义处理
- dos : Denial of Service的简称，即拒绝服务，造成DoS的攻击行为被称为DoS攻击，其目的是使计算机或网络无法提供正常的服务。最常见的DoS攻击有计算机网络带宽攻击和连通性攻击。
- sql注入：把SQL命令插入到Web表单提交或输入域名或页面请求的查询字符串，最终达到欺骗服务器执行恶意的SQL命令。
- ddos : 分布式拒绝服务(DDoS:Distributed Denial of Service)攻击指借助于客户/服务器技术，将多个计算机联合起来作为攻击平台，对一个或多个目标发动DDoS攻击，从而成倍地提高拒绝服务攻击的威力。
- csrf : 伪造授权用户请求攻击网站。 

在模板表单中添加 @csrf 可以跳过中间件组 `$middlewareGroups` 中 `\App\Http\Middleware\VerifyCsrfToken::class,` 类的验证，否则表单 post 等非 get 跳转的路由路径中会报 419 错误。

如果不想进入 csrf 验证，则可以在 `<project>/app/Http/Middleware/VerifyCsrfToken.php` 的数组中进行设置：

	protected $except = [
        //填写路由地址
    ];

### requests 请求与 response 响应 ###
控制器中使用 `Illuminate\Http\Request` 类获取请求数据。

路由闭包中获取请求数据 `Route::get('/', function(Request $request){  });` 

app/Http/Controller/kernel.php 中间件

	protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
		// 消除请求参数左右空格
        \App\Http\Middleware\TrimStrings::class,
		//请求空值转为null
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

响应：在做接口开发中的重点。

修改响应状态，内容：

	Route::get('status',function(){
		return response('hello world',500)->header('content-type','text/html');
	})

上传文件,存储在 `storage/app/public`,命令创建存储链接 `php artisan storage:link` 在 `public` 目录中生成。



	

下载文件：

	Route::get('download', function(){
		return response->download(public_path('images\timg.jpg'),'newname.jpg');
	});

预览文件：

	Route::get('preview', function(){
		return response()->file(public_path('images\timg.jpg'));
	});

重定向(重定向到外链)：

	Route::get('away', function(){
		return redirect()->away('http://www.baidu.com');
		// return redirect('preview');
	});

### cookie 和 session ###
laravel 中设置 cookie 不能够使用传统的原生方式设置。必须使用 request 中的方法设置。设置路由：

	// cookie
	Route::get('cookie', 'Login\LoginController@setcookie');
	Route::get('getcookie', 'Login\LoginController@getcookie');

	//--------- LoginController method -----------
	use Illuminate\Support\Facades\Cookie; 或 use Cookie; (这是laravel的cookie类别名)
	... 
	/**
     * cookie 设置
     * @param  Request $request larave 请求对象
     * @param  string  $name    cookie名
     * @param  string  $value   cookie值
     * @param  integer $time    cookie周期
     * @return void
     */
    public function setcookie(Request $request,$name='laravel',$value='laravel5719',$time=10){
    	return response('')->cookie($name, $value, $time);
    }
	//获取cookie
    public function getcookie($name='laravel'){
    	return Cookie::get($name);
    }
	//删除cookie
	public function delcookie($name='laravel'){
    	$cookie = Cookie::forget($name);
    	return response('成功删除')->withCookie($cookie);
    }

session 设置：



### 验证器 ###
`$request->validate()`: 传统方式：

	public function login(Request $request)
    {
    	if($request->method() == 'POST'){
    		$request->validate([
    			'username' => 'required|min:4|max:20',
    			'password' => 'required|min:6|max:32'
    		]);

    		return 'ok';
    	}
    	return view('login.login');
    }

laravel 模板设置：

	<div class="content">
        <form action="login" method="post">
            @csrf
            <div class="row">
                User: <input type="text" name="username">
                <br>
                Pass: <input type="text" name="password">
                <br>
                <input type="submit" value="submit">
            </div>
        </form>
    </div>
	//判断是否存在错误信息
    @if($errors->any())
    <div class="error">
        <ul>
            @foreach ($errors->messages() as $key => $error)
                <li>{{$key}} -->> {{$error[0]}}</li>
            @endforeach
        </ul>
    </div>
    @endif	

laravel提供新方式，首先创建请求验证：

    php artisan make:request <model>\<name>Request //创建请求验证

请求验证类： eg. LoginRequest.php

	class LoginRequest extends FormRequest{
		protected $redirect = 'error'; //实现设置父类的重定向验证跳转
	    /**
	     * Determine if the user is authorized to make this request.
	     *
	     * @return bool
	     */
	    public function authorize()
	    {
	        return true;
	    }
	
	    /**
	     * Get the validation rules that apply to the request.
	     *
	     * @return array
	     */
	    public function rules()
	    {
	        return [
	            //
	            'username'=>'required|max:16|min:4',
	            'password'=>'required|min:8|max:16',
	        ];
	    }
	}

## 05. 模板 ##
模板指令 `@<name>` 符号开头， `@end<name>` 结束, 循环指令：

	<div class="flex-center">
        <dl>
            @foreach($name as $v)
                <dt>{{ $v['id'] }}</dt>
                <dd>{{ $v['name'] }}</dd>
                <dd>{{ $v['age'] }}</dd>
            @endforeach
        </dl>
    </div>

### 模板传参 ###
示例：路由设置

	// 视图传参 view 直接传参 数组
	Route::get('view', function(){
		return view('view.index',['name'=>'huimingdeng']);
	});
	// with 传参：键值对
	Route::get('admin', 'Admin\AdminController@admin');

实现方法：

	public function admin(){
        return view('view.index')->with('name',[
            0 => ['id'=>10,'name'=>'huimingdeng','age'=>26],
            1 => ['id'=>9, 'name'=>'jiashideng', 'age'=>37],
            2 => ['id'=>8, 'name'=>'liyaxie', 'age'=>37],
            3 => ['id'=>7, 'name'=>'qidadeng', 'age'=>66]
        ]);
    }

模板示例：见上面的模板指令示例；`{{ }}`：表示的是对数据进行转义输出，若针对富文本则不需要转义情况，使用 `{!! !!}`。P.S. 下面代码为 `storage/framework/views/` 解析后的代码：

	<div class="flex-center">
        <dl>
            <?php $__currentLoopData = $name; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <dt><?php echo e($v['id']); ?></dt>
                <dd><?php echo e($v['name']); ?></dd>
                <dd><?php echo e($v['age']); ?></dd>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </dl>
    </div>

#### 模板继承 ####
`child.blade.php` 继承 `parent.blade.php` 父模板不要结束标签 eg. `@endsection` ,不然子模板无法使用。P.S. 父模板相当于在子模板做占位符的作用; 父模板的 `@show()`结束作为子模板内容输出。`@parent`：保留父模板。

- `@yield`:内容无法保留父模板内容。
- `@stop()`:可以结束标签。

示例：child.blade.php

	@extends('template/parent')

	@section('head')
		@yield('content', '我是子模板，不过使用的是 @section(\'head\'):则在父模板前面显示 ')
	@stop()
	
	@section('bottom')
	<div>
		 @yield('content','我是子模板，继承了父模板, 不过使用的是 @section(\'bootom\'):在父模板后面显示 ') 
		@parent
		<div>我是子模板</div>
	</div>
	@stop()

示例： template/parent.blade.php

	<!DOCTYPE html>
	<html>
		<head>
			<meta charset="utf-8">
			<title>@yield('title','parent template')</title>
		</head>
		<body>
			@section('head')
				@show()
				<div>
					@yield('content','我是父模板')
				</div>
			@section('bottom')
			@show()
		</body>
	</html>

路由调用子模板：

	// 视图继承
	Route::get('child',function(){
		return view('child');
	});
效果图：

![视图继承效果](https://i.imgur.com/iBaR57o.png)

#### 卡槽（slots）与组件（Components） ####
要使用则先定义。卡槽相当于电商的弹窗提示功能。

### 流程控制语句 ###
laravel流程控制语句举例。

## 06. 数据库 ##
laravel数据

## 07. Eloquent模型 ##
laravel Eloquent 模型


## 08. authorize 用户验证(Auth) ##
laravel 用户验证。


## laravel 项目 ##
学习 laravel 基础后，进行项目实践。

