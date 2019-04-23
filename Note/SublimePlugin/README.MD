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

`settings-user`:

	{
		"autocomplete": true,
		"enable_auto_align": true,
		"format_on_save": true,
		"indent_with_space": true,
		"php_bin": "F:\\phpStudy\\PHPTutorial\\php\\php-7.2.1-nts\\php.exe",
	// 或 "php_bin":"F:/coding/phpStudy/PHPTutorial/php/php-7.2.1-nts/php.exe",
		"psr1_naming": false,
		"psr2": true,
		"version": 4
	}

### PHPNamespace ###
`PHP` 命名空间自动载入插件,当前默认 `Settings-default` 的设置

### docBlockr ###
PHP/JavaScript 等注释自动补充 `@param` 、 `@return` 等信息。



## 我的常用插件： ##

	"channels":
	[
		"https://raw.githubusercontent.com/HBLong/channel_v3_daily/master/channel_v3.json"
	],
	"in_process_packages":
	[
	],
	"installed_packages":
	[
		"Alignment",
		"AlignTab",
		"All Autocomplete",
		"AutoFileName",
		"BracketHighlighter",
		"ChineseLocalizations",
		"Color Highlight",
		"ColorPicker",
		"ConvertToUTF8",
		"CTags",
		"DocBlockr",
		"Emmet",
		"Emmet Css Snippets",
		"FTPSync",
		"Git",
		"JavaScript Completions",
		"JavaScript Console",
		"jQuery",
		"JsFormat",
		"Package Control",
		"PHP Companion",
		"Phpcs",
		"phpfmt",
		"PhpNamespace",
		"Pretty JSON",
		"SFTP",
		"SublimeLinter",
		"SublimeLinter-csslint",
		"SublimeLinter-jscs",
		"SublimeLinter-jshint",
		"SublimeLinter-php",
		"SublimeLinter-phpcs",
		"SublimeREPL"
	]

### P.S.  ###

[https://packagecontrol.io/](https://packagecontrol.io/ "ERROR") 出错，无法连接，导致 package control 无法使用到 channel_v3.json ，而 CSDN 的一份 channel_v3.json 要 42 币，而且不知道是否可用，现找到一份亲测可用的，可自行部署到自己的机子上进行访问。 -- February,25,2019


### sublimeLinter 设置 ###

	// SublimeLinter Settings - User
	{
		
		"paths": {
	        "linux": [],
	        "osx": [],
	        "windows": [
	            "F:/phpStudy/PHPTutorial/php/php-7.2.1-nts",
	        	"F:/wamp/bin/php/php7.0.4",
	        	"F:/wamp/bin/php/php5.6.19"
	        ]
	    },
	    "linters": {
	        "phpcs": {
	            "disable":true,
	            "standard": "${folder}/phpcs.xml"
	        }
	    }
	}