# Laravel 学习笔记 #
Laravel学笔记，记录一些个人学习中遇到的知识点和遇到问题处理方案。

## laravel5.7 下载与安装 ##
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

## Laravel 路由<重点> ##

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
- 路由优先级？




## Laravel 控制器 ##
大小驼峰命名法。 使用命令创建控制器 `php artisan make:controller <模块名>/<控制器名>Controller`

大驼峰:每个单词首字母都大写  eg. HelloController

小驼峰:第一个单词全小写。后续单词首字母大写 eg. helloController


创建成果后，如果没有写<模块名>，则在 app/Http/Controllers/ 目录下生成，如果有<模块名> eg. Login，则控制器生成在 app/Http/Controllers/Login/ 目录下。 同时一般默认添加Contrller后缀。

### 控制器分层定义 ###


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

单一行为控制器参考：《[laravel5.7 中文文档](https://laravel-china.org/docs/laravel/5.7/controllers/2256#single-action-controllers)》