# Laravel 学习笔记 #
Laravel学笔记，记录一些个人学习中遇到的知识点和遇到问题处理方案。

## composer 脚手架安装 laravel5.7 ##
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

## Laravel 路由 ##

- Laravel特性： 每个方法必须设置路由才可以访问，不设置路由则无法访问。
- Laravel 不支持 pathinfo 模式
- 路由定义：
	- eg. `Route::get('hello', function(){ return 'hello'; });`
- 路由参数 eg. `Route::post('login/{name}/{id?}')` {id?}:表示可以忽略，但使用 get 必须要设置默认值。

Jan 2,2019

## Laravel 控制器 ##
大小驼峰命名法。 使用命令创建控制器 `php artisan make:controller <模块名>/<控制器名>Controller`

大驼峰:每个单词首字母都大写  eg. HelloController

小驼峰:第一个单词全小写。后续单词首字母大写 eg. helloController


创建成果后，如果没有写<模块名>，则在 app/Http/Controllers/ 目录下生成，如果有<模块名> eg. Login，则控制器生成在 app/Http/Controllers/Login/ 目录下。 同时一般默认添加Contrller后缀。

### 控制器分层定义 ###
