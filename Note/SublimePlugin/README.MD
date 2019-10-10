# Sublime Text Plugins

日常常用插件及配置信息记录。

## SublimeLinter

日常开发，怎么少得了代码检验工具呢？使用 Sublime 必备插件：[SublimeLinter](http://www.sublimelinter.com/en/stable/  "SublimeLinter") 。

### SublimeLinter-phpcs 配置

phpcs（PHP Code Sniffer） 自定义设置：`Preference->Package Settings->PHP Code Sniffer->Settings - User` 详细配置参数参考 `Preference->Package Settings->PHP Code Sniffer->Settings - Default`

```json
{
    "show_debug": true,
    "php_cs_fixer_show_quick_panel":true,
    "php_cs_fixer_executable_path":"F:\\phpStudy\\PHPTutorial\\php\\php-7.2.1-nts\\php-cs-fixer-v2.phar",
    "phpcs_executable_path":"C:\\Users\\DHM\\AppData\\Roaming\\Composer\\vendor\\bin\\phpcs.bat",
    "phpcs_php_path":"F:\\phpStudy\\PHPTutorial\\php\\php-7.2.1-nts\\php.exe",
}
```

参考文章：[sublime text 3 phpcs](https://blog.csdn.net/yxwb1253587469/article/details/72896241 "sublime text 3 phpcs")

php-cs-fixer.phar 的下载使用 `composer global require squizlabs/php_codesniffer ` 安装，然后配置系统环境变量。

### PHP Companion

命名空间查找补全插件，鼠标选择类名 eg. `Command` 执行 `Ctrl+shif+P` 输入 `fine use` 则自动查找补充命名空间。 

如果 `fine use` 失败，请安装 phpcs

### phpfmt

`PHP` 代码规范自动修补插件。

`settings-user`:

```json
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
```

以上配置，存在一些问题，phpfmt 会误判无效代码而删除，例如类定义静态方法会删除关键字`public` 和 `static`，因此可以使用如下配置，则只是用修复，而不删除代码：

```json
{
    "passes":
    [
        "OnlyOrderUseClauses"
    ],
    "version": 1
}
```

### PHPNamespace

`PHP` 命名空间自动载入插件,当前默认 `Settings-default` 的设置

### docBlockr

PHP/JavaScript 等注释自动补充 `@param` 、 `@return` 等信息。

## 我的常用插件：

```json
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
```

### P.S.

[https://packagecontrol.io/](https://packagecontrol.io/ "ERROR") 出错，无法连接，导致 package control 无法使用到 channel_v3.json ，而 CSDN 的一份 channel_v3.json 要 42 币，而且不知道是否可用，现找到一份亲测可用的，可自行部署到自己的机子上进行访问。 -- February,25,2019

### sublimeLinter 设置

```json
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
```

`phpcs` 相关配置和软件安装参考 [sublime text 3 phpcs](https://blog.csdn.net/yxwb1253587469/article/details/72896241 "sublime text 3 phpcs")

设置好后，`PHP` 注释补充 `@pacage`、 `@author` 等会自动补充 `<name>` `[<email>]` 等信息

### JavaScript Completions 设置

```json
{
    "completion_active_list": {
        "jQuery": true,
        "CSS": true,
    }
}
```

## xdebug client

安装插件 `xdebug client`.

### xdebug 配置

phpstudy2018 配置 xdebug 方案：

开启`phpinfo`查看信息，然后下载对应版本的 [xdebug](https://xdebug.org/download.php)  。

![phpinfo](https://i.loli.net/2019/08/29/h4tJlBuImedGO9R.png)

配置 `php.ini` 文件

```ini
[XDebug]
xdebug.profiler_output_dir="F:\phpStudy\PHPTutorial\tmp\xdebug"
xdebug.trace_output_dir="F:\phpStudy\PHPTutorial\tmp\xdebug"
;zend_extension="D:\Program Files\phpStudy20161103\php\php-7.2.1-nts\ext\php_xdebug.dll"
zend_extension="F:\phpStudy\PHPTutorial\php\php-7.2.1-nts\ext\php_xdebug-2.8.0beta2-7.2-vc15-nts.dll"
;启用代码自动跟踪
xdebug.auto_trace=1
;允许收集传递给函数的参数变量 
xdebug.collect_params=1
;允许收集函数调用的返回值
xdebug.collect_return=1
;指定堆栈跟踪文件的存放目录 
xdebug.trace_output_dir="F:\phpStudy\PHPTutorial\tmp\xdebug"　　

;启用性能检测分析  
xdebug.profiler_enable=on
```

## go 配置执行

sublime text 3 配置编译 go `ctrl+B` 执行，以及`go` 语法提示。

1. 安装 `Golang build` 配置参考 [Golang Build Configuration](https://github.com/golang/sublime-build/blob/master/docs/configuration.md)

2. 配置 `首选项` -> `package settings` -> `Golang Config` -> `Setings - User`
   
   1. ```json
      {
           "windows": {
               "PATH": "E:\\software\\Go\\bin",
               "GOPATH": "E:\\software\\Go"
           }
       }
      ```

3. 重启 sublime 。

或者安装 `GoSbulime` ,如果使用 `package control` 无法安装，则可以到[GitHub](https://github.com/DisposaBoy/GoSublime)下载压缩包，解压安装，`首选项` -> `浏览插件目录` 中进行解压安装

新建编译系统 `Go.sublime-build`

```json
{
    "cmd": ["go", "run", "$file_name"], 
    "file_regex": "^[ ]*File \"(…*?)\", line ([0-9]*)", 
    "working_dir": "$file_path", 
    "selector": "source.go"
}
```

配置环境变量

```json
{
    "env" : {

        "GOPATH":"", // 工程目录
        "GOROOT":"E:\\software\\Go\\"
    }
}
```

## PHPunit

安装，PHPunit，配置 phpunit.xml

```xml
<?xml version="1.0" encoding="UTF-8"?>
<phpunit bootstrap="vendor/autoload.php">
    <testsuites>
        <testsuite name="test">
            <file>test/Test.php</file>
        </testsuite>
    </testsuites>
</phpunit>
```


