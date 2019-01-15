# Laravel 开发工具 #
使用 laravel 框架进行开发，使用的工具安装过程。

## Laravel-debugbar ##
该工具为 laravel 调试工具，作用和 THINKPHP 中的调试工具栏一样，不过需要手动安装。

以下为安装过程：参考 [laravel-debugbar](https://github.com/barryvdh/laravel-debugbar "laravel-debugbar")

1. 使用 composer 下载安装包，以学习案例项目 laravel57 为例：
	1. 进入 laravel57 项目目录下，在控制台中执行命令 `composer require barryvdh/laravel-debugbar --dev` 安装开发包
	2. 下载安装完成后效果：
	3. ![laravel-debugbar install](https://i.imgur.com/hpGcFXu.png)
2.  本人使用 `Sublime Text 3` 进行开发：因此使用快捷键 `Ctrl+P` 快速找到文件 `config\app.php` 进行配置：
	1.  在数组键 `providers` 中添加 `Barryvdh\Debugbar\ServiceProvider::class,`
	2.  在数组键 `aliases` 中添加 `'Debugbar' => Barryvdh\Debugbar\Facade::class,`
3.  运行命令 `php artisan vendor:publish --provider="Barryvdh\Debugbar\ServiceProvider"` 生成 `laravel-debugbar` 的配置文件
	1.  进入配置文件设置：
	2.  找到 `enabled` 项并修改为 `'enabled' => env('APP_DEBUG', false),`
	3.  ![laravel-debugbar 效果图](https://i.imgur.com/d7yaQ0J.png)
4.  配置完成后测试的效果图：
	1.  ![debugbar测试效果图](https://i.imgur.com/nqk6vaJ.png)

on Jan 15,2019 by [huimingdeng](https://github.com/huimingdeng)
