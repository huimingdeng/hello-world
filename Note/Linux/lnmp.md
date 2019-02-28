# LNMP #
搭建 LNMP ，学习编译安装软件。

## CentOS7 ##
使用 centos 编译搭建 lnmp。

需要安装包（库）安装：

1. make: `yum -y install gcc automake autoconf libtool make` 编译库
2. gc++: `yum -y install gcc gcc-c++ glibc` 编译库
3. openssl: `yum -y install openssl openssl-devel cyrus-sasl-md5` nginx 依赖 
4. cmake: `yum -y install cmake` mysql 编译库

完整库（按需安装）：

	cc gcc-c++ make cmake automake autoconf gd file bison patch mlocate flex 
	diffutils zlib zlib-devel pcre pcre-devel 
	libjpeg libjpeg-devel libpng libpng-devel libxml2 libxml2-devel
	freetype freetype-devel  
	glibc glibc-devel glib2 glib2-devel bzip2 bzip2-devel 
	ncurses ncurses-devel 
	curl curl-devel libcurl libcurl-devel 
	e2fsprogs e2fsprogs-devel 
	krb5 krb5-devel 
	openssl openssl-devel openldap openldap-devel openldap-clients 
	openldap-servers openldap-devellibxslt-devel nss_ldap
	kernel-devel libtool-libs 
	readline-devel gettext-devel libcap-devel
	php-mcrypt libmcrypt libmcrypt-devel recode-devel 
	icu gmp-devel libxslt libxslt-devel

	yum install -y gcc gcc-c++ make cmake automake autoconf gd file bison patch mlocate flex diffutils zlib zlib-devel pcre pcre-devel libjpeg libjpeg-devel libpng libpng-devel freetype freetype-devel libxml2 libxml2-devel glibc glibc-devel glib2 glib2-devel bzip2 bzip2-devel ncurses ncurses-devel curl curl-devel libcurl libcurl-devel e2fsprogs e2fsprogs-devel krb5 krb5-devel openssl openssl-devel openldap openldap-devel nss_ldap openldap-clients openldap-servers openldap-devellibxslt-devel kernel-devel libtool-libs readline-devel gettext-devel libcap-devel php-mcrypt libmcrypt libmcrypt-devel recode-devel gmp-devel icu libxslt libxslt-devel

### Nginx 搭建 ###

命令编译生成 Makefile ：

	./configure --prefix=/usr/local/nginx   
				\--with-http_ssl_module 		
				\--with-pcre=../pcre-8.39    
				\--with-zlib=../zlib-1.2.8	 

	1 ---- // nginx 安装到的目录
	2 ---- // 安装 ssl 模块，ssl证书等
	3 ---- // pcre: Perl Compatible Regular Expressions
	4 ---- // 压缩包

生成 Makefile 文件后使用 `make test` 测试查看是否还需要安装缺失的依赖库。

若需补充则需要 `make clean` 清除 Makefile 文件，重新编译生成。

### MySQL5.7.17 编译安装 ###

与MySQL5.7相对应的版本是boost_1_59_0

创建运行用户
	
	mkdir -p /usr/local/mysql/data
	useradd -M -s /sbin/nologin mysql  //创建用户mysql，不创建家目录，不允许登陆系统

解压软件包

	tar zxf mysql-5.7.17.tar.gz 
	cd mysql-5.7.17/
	

创建配置文件，然后编译：

	cmake \
		-DCMAKE_INSTALL_PREFIX=/usr/local/mysql \             //指定mysql数据库安装目录
		-DMYSQL_UNIX_ADDR=/usr/local/mysql/mysql.sock \       //连接文件位置
		-DSYSCONFDIR=/etc \                                   //指定配置文件目录
		-DSYSTEMD_PID_DIR=/usr/local/mysql \                  //进程文件目录
		-DDEFAULT_CHARSET=utf8  \                             //指定默认使用的字符集编码
		-DDEFAULT_COLLATION=utf8_general_ci \                 //指定默认使用的字符集校对规则
		-DWITH_INNOBASE_STORAGE_ENGINE=1 \                    //存储引擎
		-DWITH_ARCHIVE_STORAGE_ENGINE=1 \                     //存储引擎
		-DWITH_BLACKHOLE_STORAGE_ENGINE=1 \                   //存储引擎
		-DWITH_PERFSCHEMA_STORAGE_ENGINE=1 \                 //存储引擎
		-DMYSQL_DATADIR=/usr/local/mysql/data \         //数据库文件
		-DWITH_BOOST=/usr/local/boost \             //指定Boost库的位置，mysql5.7必须添加该参数
		-DWITH_SYSTEMD=1                                     //使系统支持MySQL数据库

**如果在 CMAKE 的过程中有报错（报错多是环境包安装错误），当报错解决后，需要把源码目录（mysql-5.7.17/）中的 CMakeCache.txt 文件删除，然后再重新CMAKE，否则错误依旧**

没有错误后，执行编译 `make`,`make test`:没错无则执行 `make install` 否则继续按照错误提示处理。

测试 `make`：`22% Linking CXX static library libinnobase.a`

#### 修改数据库目录权限 ####
	chown -R mysql:mysql /usr/local/mysql/

mysql 5.7 版本和以前的有所不同，如果配置文件不做修改，则服务启动失败

	vim /etc/my.cnf
	[client]
	port = 3306
	default-character-set=utf8
	socket = /usr/local/mysql/mysql.sock
	[mysql]
	port = 3306
	default-character-set=utf8
	socket = /usr/local/mysql/mysql.sock
	[mysqld]
	user = mysql
	basedir = /usr/local/mysql
	datadir = /usr/local/mysql/data
	port = 3306
	character_set_server=utf8
	pid-file = /usr/local/mysql/mysqld.pid
	socket = /usr/local/mysql/mysql.sock
	server-id = 1
	sql_mode=NO_ENGINE_SUBSTITUTION,STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_AUTO_VALUE_ON_ZERO,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,PIPES_AS_CONCAT,ANSI_QUOTES

修改完后，将配置文件权限修改：

	chown mysql:mysql /etc/my.cnf   //修改配置文件的权限

#### 设置环境变量 ####
	echo 'PATH=/usr/local/mysql/bin:/usr/local/mysql/lib:$PATH' >> /etc/profile
	echo 'export PATH' >> /etc/profile
	source /etc/profile   //使写入生效

#### 初始化数据库 ####
	cd /usr/local/mysql/
	bin/mysqld \
		--initialize-insecure \         //生成初始化密码（5.7版本才有），实际会生成空密码
		--user=mysql \                  //指定管理用户
		--basedir=/usr/local/mysql \    //指定工作目录
		--datadir=/usr/local/mysql/data //指定数据文件目录
或直接运行：

	/usr/local/mysql/bin/mysqld  --initialize-insecure --user=mysql --basedir=/usr/local/mysql --datadir=/usr/local/mysql/data

#### 添加系统服务 ####
	cp /usr/local/mysql/usr/lib/systemd/system/mysqld.service /usr/lib/systemd/system/
	systemctl daemon-reload    //刷新识别mysqld.service服务
	systemctl enable mysqld    //加入系统自启动
	systemctl start mysqld     //启动服务
	netstat -anpt | grep 3306

P.S. `systemctl enable mysqld` 命令失败则用 `systemctl list-unit-files` 命令查看是否在 `/usr/lib/systemd/system/` 目录,如果不再，则再次复制 `mysqld.service` 文件到该目录。

![mysql 启动测试](https://i.imgur.com/nchRR8Z.png)

#### 后续 ####
编译安装，默认数据库密码为空，修改密码命令：`mysqladmin -u root -p password "root" ` -u 指定登陆用户为 root ，密码为 root

授权远程登录：`grant all privileges on *.* to 'root'@'%' identified by 'root' with grant option`

防火墙处理：
	
	systemctl disable firewalld.service 
	systemctl stop firewalld.service
	setenforce 0



### PHP 编译安装 ###
下载 `wget  http://cn2.php.net/distributions/php-7.2.15.tar.gz`

粗暴方式，不知道情况安装依赖的库：

	yum -y install gcc gcc-c++ 
	yum -y install libxml2 libxml2-devel 
	yum -y install autoconf libjpeg libjpeg-devel libpng libpng-devel 
	yum -y install freetype freetype-devel 
	yum -y install zlib zlib-devel 
	yum -y install glibc glibc-devel glib2 glib2-devel

PHP 一般情况，有以下依赖库即可：

	gcc gcc-c++ 
	libxml2-devel 
	m4 autoconf 
	pcre-devel 
	make 
	cmake 
	bison 
	openssl 
	openssl-devel	


创建目录 `mkdir -p /usr/local/php/etc` , 否则编译下面命令会报 `--prefix=/usr/local/php: No such file or directory` 错误

生成 makefile 文件，然后编译：
	
	./configure --prefix=/usr/local/php
				\--prefix=/usr/local/php
				\--with-config-file-path=/usr/local/php/etc
				\--with-libxml-dir=/usr   
				\--with-mhash 
				\--with-openssl 
				\--with-mysqli=shared,mysqlnd 
				\--with-pdo-mysql=shared,mysqlnd 
				\--with-zlib 
				\--enable-zip 
				\--enable-inline-optimization 
				\--disable-debug 
				\--disable-rpath 
				\--enable-shared 
				\--enable-xml 
				\--enable-bcmath 
				\--enable-shmop 
				\--enable-sysvsem 
				\--enable-mbregex
				\--enable-mbstring 
				\--enable-pcntl 
				\--enable-sockets 
				\--without-pear 
				\--with-gettext 
				\--enable-session

错误示例：执行以上编译命令，我的虚拟机中反馈信息（缺失部分）：

	config.status: creating php7.spec
	config.status: creating main/build-defs.h
	config.status: creating scripts/phpize
	config.status: creating scripts/man1/phpize.1
	config.status: creating scripts/php-config
	config.status: creating scripts/man1/php-config.1
	config.status: creating sapi/cli/php.1
	config.status: creating sapi/phpdbg/phpdbg.1
	config.status: creating sapi/cgi/php-cgi.1
	config.status: creating ext/phar/phar.1
	config.status: creating ext/phar/phar.phar.1
	config.status: creating main/php_config.h
	config.status: executing default commands
	[root@ming php-7.2.15]#             \--prefix=/usr/local/php
	-bash: --prefix=/usr/local/php: No such file or directory
	[root@ming php-7.2.15]#             \--with-config-file-path=/usr/local/php/etc
	-bash: --with-config-file-path=/usr/local/php/etc: No such file or directory
	[root@ming php-7.2.15]#             \-with-libxml-dir=/usr
	-bash: -with-libxml-dir=/usr: No such file or directory
	[root@ming php-7.2.15]#             \--with-mhash
	-bash: --with-mhash: command not found
	[root@ming php-7.2.15]#             \--with-openssl
	-bash: --with-openssl: command not found
	[root@ming php-7.2.15]#             \--with-mysqli=shared,mysqlnd
	-bash: --with-mysqli=shared,mysqlnd: command not found
	[root@ming php-7.2.15]#             \--with-pdo-mysql=shared,mysqlnd
	-bash: --with-pdo-mysql=shared,mysqlnd: command not found
	[root@ming php-7.2.15]#             \--with-zlib
	-bash: --with-zlib: command not found
	[root@ming php-7.2.15]#             \--enable-zip
	-bash: --enable-zip: command not found
	[root@ming php-7.2.15]#             \--enable-inline-optimization
	-bash: --enable-inline-optimization: command not found
	[root@ming php-7.2.15]#             \--disable-debug
	-bash: --disable-debug: command not found
	[root@ming php-7.2.15]#             \--disable-rpath
	-bash: --disable-rpath: command not found
	[root@ming php-7.2.15]#             \--enable-shared
	-bash: --enable-shared: command not found
	[root@ming php-7.2.15]#             \--enable-xml
	-bash: --enable-xml: command not found
	[root@ming php-7.2.15]#             \--enable-bcmath
	-bash: --enable-bcmath: command not found
	[root@ming php-7.2.15]#             \--enable-shmop
	-bash: --enable-shmop: command not found
	[root@ming php-7.2.15]#             \--enable-sysvsem
	-bash: --enable-sysvsem: command not found
	[root@ming php-7.2.15]#             \--enable-mbregex
	-bash: --enable-mbregex: command not found
	[root@ming php-7.2.15]#             \--enable-mbstring
	-bash: --enable-mbstring: command not found
	[root@ming php-7.2.15]#             \--enable-pcntl
	-bash: --enable-pcntl: command not found
	[root@ming php-7.2.15]#             \--enable-sockets
	-bash: --enable-sockets: command not found
	[root@ming php-7.2.15]#             \--without-pear
	-bash: --without-pear: command not found
	[root@ming php-7.2.15]#             \--with-gettext
	-bash: --with-gettext: command not found
	[root@ming php-7.2.15]#             \--enable-session

上面错误信息，mysql 部分是因为未安装 mysql。

#### 根据报错信息补充库 ####
编译一遍后，安装提示，补充依赖库，安装 libmcrypt mhash mcrypt





## 参考学习文章 ##

1. [centOS下编译安装Nginx](https://www.jianshu.com/p/078083f76324 "centOS下编译安装Nginx")
2. [编译安装MySQL](https://blog.51cto.com/13643643/2132594 "编译安装MySQL5.7")
3. [编译安装PHP7](https://www.jianshu.com/p/fc69f47fb7b8 "编译安装PHP7")