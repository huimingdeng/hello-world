# Sublime Text Plugins #
日常常用插件及配置信息记录。

## SublimeLinter ##
日常开发，怎么少得了代码检验工具呢？使用 Sublime 必备插件：[SublimeLinter](http://www.sublimelinter.com/en/stable/  "SublimeLinter") 。

### SublimeLinter-phpcs 配置 ###
phpcs（PHP Code Sniffer） 自定义设置：`Preference->Package Settings->PHP Code Sniffer->Settings - User` 详细配置参数参考 `Preference->Package Settings->PHP Code Sniffer->Settings - Default`

	{
		"show_debug": true,
		"php_cs_fixer_show_quick_panel":true,
		"php_cs_fixer_executable_path":"F:\\phpStudy\\PHPTutorial\\php\\php-7.2.1-nts\\php-cs-fixer-v2.phar",
		"phpcs_executable_path":"C:\\Users\\DHM\\AppData\\Roaming\\Composer\\vendor\\bin\\phpcs.bat",
		"phpcs_php_path":"F:\\phpStudy\\PHPTutorial\\php\\php-7.2.1-nts\\php.exe",
	}

参考文章：[sublime text 3 phpcs](https://blog.csdn.net/yxwb1253587469/article/details/72896241 "sublime text 3 phpcs")


### PHP Companion ###
命名空间查找补全插件，鼠标选择类名 eg. `Command` 执行 `Ctrl+shif+P` 输入 `fine use` 则自动查找补充命名空间。 

### phpfmt ###
`PHP` 代码规范自动修补插件。

### PHPNamespace ###
`PHP` 命名空间自动载入插件