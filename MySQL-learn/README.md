# MySQL-learn #
数据库连接方式，


config.php 测试使用的配置


P.S. windows phpStudy2018 软件升级 mysql 版本到5.7：

进入 `F:/phpStudy/PHPTutorial/` 目录，将`MySQL`目录重命名备份，将下载的 mysql5.7 压缩包解压并重命名为 `MySQL` ；复制备份的 `my.ini` 文件到 5.7 的bin目录下(`F:/phpStudy/PHPTutorial/MySQL/bin`) 添加代码：

	skip-grant-tables = 0
	explicit_defaults_for_timestamp=true
	#skip-grant-tables = 1
	log-error = "F:/phpstudy/PHPTutorial/MySQL/data/error.log"

然后 `cmd` 在 `F:/phpstudy/PHPTutorial/MySQL/bin` 目录下执行代码：

	mysqld --initialize-insecure --user=mysql
	mysqld --install
	//安装成功会显示 successful xxx
	net start mysql
	//登陆mysql，可能密码为空或生成随机密码，注意获取，然后登陆
	use mysql
	
	update user set authentication_string = password('root'),
	password_expired = 'N', 
	password_last_changed = now() where user = 'root'; //设置密码
	flush privileges; //刷新权限

因为 password 高版本被更换，可以查看警告信息，执行设置密码语句要注意是否 CHANGE=1,如果是 CHANGE=0 在不成功的

	SHOW WARNINGS; 

	//重启mysql，要讲my.ini skip-grant-tables = 0注释掉
	net restart mysql

打开我的电脑-管理-服务，查看系统服务，如果没有mysqla服务，用`sc delete mysql`命令删除已有MySQL服务；然后如下图，添加新的mysql服务，这样PHPstudy就可以重启mysql了。

![添加mysql服务](https://i.imgur.com/wrc0BFE.png)