# Note 目录 #
readme 文件作为 Note 下面的一个导航作用

## linux-note-Oct-10-2018.md ##
Linux centos7 学习笔记，含FTP服务配置等。 [进入](https://github.com/huimingdeng/hello-world/blob/master/Note/note-Oct-10-2018.md "CentOS7 笔记")

使用 Windows7 安装 VMware 15 学习。

## nginx.Note.Oct.26.2018 ##
Jan 9,2019 整理创建目录 Nginx ，迁移相关笔记到 Nginx 目录。

Nginx学习笔记。[进入](https://github.com/huimingdeng/hello-world/blob/master/Note/Nginx/nginx.Note.Oct.26.2018.md "Nginx 学习笔记")

## php-7.1.0-note.md ##
Jan 9,2019 整理创建 PHP 目录，迁移下面文件进入 PHP 目录。

该文件为 《PHP 7底层设计与源码实现》 一书的一些实践笔记。[进入](https://github.com/huimingdeng/hello-world/blob/master/Note/PHP/php-7.1.0-note.md "php7.1.0-源码分析")

php-7.1.0.tar.gz 配套源码

    tar -zxvf php7.1.0.tar.gz

## jquery.note.md ##
jquery 复习笔记。 [进入](https://github.com/huimingdeng/hello-world/blob/master/Note/jquery.note.md "jQuery 复习笔记")

## Laravel 目录 ##
Jan 9,2019 整理添加目录， laravel.md 迁移进入 Laravel 目录。

Jan 2,2019 新建 laravel 学习笔记。 [进入](https://github.com/huimingdeng/hello-world/blob/master/Note/Laravel/laravel.md "Laravel 学习笔记")

## WordPress ##
Jan 9,2019 新建 Wordpress 目录：用于记录开发 WordPress和学习的笔记，进行总结。


## sublime Text3 ##
https://packagecontrol.io/ 出错，无法连接，导致 package control 无法使用到 channel_v3.json ，而 CSDN 的一份 channel_v3.json 要 42 币，而且不知道是否可用，现找到一份亲测可用的，可自行部署到自己的机子上进行访问。 -- February,25,2019

## 其它知识 ##
Google 访问助手无法同步其它设备最新书签解决方案：
1. 浏览器输入 `chrome://flags/#account-consistency`
2. 选择高亮选项 `Identity consistency between browser and cookie jar` 设置为 `Disabled`，点击 `RELAUNCH NOW`,重启后，重新设置为 `Default`，再重启，即可解决。


一、将IP地址转化成整数的方法如下：

1、通过String的split方法按.分隔得到4个长度的数组

2、通过左移位操作（<<）给每一段的数字加权，第一段的权为2的24次方，第二段的权为2的16次方，第三段的权为2的8次方，最后一段的权为1

	192.168.0.1 换成 32位
	decbin(192 << 24)	//11000000,00000000,00000000,00000000
	decbin(168 << 16)	//00000000,10101000,00000000,00000000
	decbin(0 << 8)		//00000000,00000000,00000000,00000000
	decbin(1 << 0)		//00000000,00000000,00000000,00000001

	结果： 11000000.10101000.00000000.00000001
	
笔算用取余法：

![取余法示例](https://i.imgur.com/l8bQIMp.png)


二、将数值转换为ip地址

将十进制整数形式转换成127.0.0.1形式的ip地址

将整数形式的IP地址转化成字符串的方法如下：

1、将整数值进行右移位操作（>>>），右移24位，右移时高位补0，得到的数字即为第一段IP。

2、通过与操作符（&）将整数值的高8位设为0，再右移16位，得到的数字即为第二段IP。

3、通过与操作符吧整数值的高16位设为0，再右移8位，得到的数字即为第三段IP。

4、通过与操作符吧整数值的高24位设为0，得到的数字即为第四段IP