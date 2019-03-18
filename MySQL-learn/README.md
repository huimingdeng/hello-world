# MySQL-learn #
数据库连接方式，pdo :

config.php 测试使用的配置;

PdoMySQL.class.php PDO 链接模式；

db.class.php mysqli 对象模式；

## MySQL 优化知识 ##
见目录：`mysql_performance_optimization`下的 `*.md` 文件

## 备注知识点 ##
windows mysql 升级问题。

### P.S. windows phpStudy2018 软件升级 mysql 版本到5.7： ###

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

### 1055 error ###
window 的 mysql 升级后执行 update 语句或出现错误：`#1050 ...` 错误，需要取消 `ONLY_FULL_GROUP_BY`，在 `PHPStudy` 中如下图所示位置设置：

![sql mode 设置](https://i.imgur.com/pezAbYd.png)

	STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION

### P.S. phpmyadmin Users(用户) 列无法展示用户。 ###

因为新版的mysql换了user表的表结构，去除了password字段，换成了authentication_string。而phpstudy自带的phpmyadmin，为了适应老版本的php，使用了比较古老的版本。所以，就不认识新的mysql结构了。

升级服务 mysql_upgrade -uroot -p 不成功，升级 phpmyadmin 登陆 phpmyadmin 

![phpMyAdmin 升级](https://i.imgur.com/DRPrbY9.png)

直接下载，下载成功后解压重命名为 `phpMyAdmin` ,覆盖旧版本的 `phpMyAdmin` 即可。


**mysql5.7.17 编译安装需要库 boost 压缩包迁移到百度云盘中不再上传到GitHub上**

### yum 安装 mysql5.7 ###
不使用编译安装，使用命令安装则需 rpm(镜像管理工具) ：`wget -i -c http://dev.mysql.com/get/mysql57-community-release-el7-10.noarch.rpm` （rmp 源可在MySQL官网中按需查找）

制定源：`rpm -Uvh mysql57-community-release-el7-10.noarch.rpm ` 或 `yum -y install mysql57-community-release-el7-10.noarch.rpm`

安装：`yum -y install mysql-community-server`

启动：`service mysqld start`

mysql安装成功后创建的超级用户'root'@'localhost'的密码会被存储在/var/log/mysqld.log，可以使用如下命令查看密码：

	grep 'temporary password' /var/log/mysqld.log

设置iptables开放3306端口：

安装参考 [https://www.cnblogs.com/luohanguo/p/9045391.html](https://www.cnblogs.com/luohanguo/p/9045391.html "CentOS7 yum方式安装MySQL5.7")

P.S. mysql 安装完成后密码设置问题，参考：[centos7 安装MySQL7 并更改初始化密码](https://www.cnblogs.com/shihuibei/p/9249155.html "centos7 安装MySQL7 并更改初始化密码")