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
下载 Nginx `wget -c https://nginx.org/download/nginx-1.10.1.tar.gz`
命令生成配置文件 ：

	[root@ming nginx-1.10.1]# ./configure 	查看默认配置信息，若符合需求则可以直接编译安装
	checking for OS
	 + Linux 3.10.0-957.1.3.el7.x86_64 x86_64
	checking for C compiler ... found
	 + using GNU C compiler
	 + gcc version: 4.8.5 20150623 (Red Hat 4.8.5-36) (GCC)
	checking for gcc -pipe switch ... found
	checking for -Wl,-E switch ... found
	checking for gcc builtin atomic operations ... found
	checking for C99 variadic macros ... found
	checking for gcc variadic macros ... found
	checking for gcc builtin 64 bit byteswap ... found
	checking for unistd.h ... found
	checking for inttypes.h ... found
	checking for limits.h ... found
	checking for sys/filio.h ... not found
	checking for sys/param.h ... found
	checking for sys/mount.h ... found
	checking for sys/statvfs.h ... found
	checking for crypt.h ... found
	checking for Linux specific features
	checking for epoll ... found
	checking for EPOLLRDHUP ... found
	checking for O_PATH ... found
	checking for sendfile() ... found
	checking for sendfile64() ... found
	checking for sys/prctl.h ... found
	checking for prctl(PR_SET_DUMPABLE) ... found
	checking for sched_setaffinity() ... found
	checking for crypt_r() ... found
	checking for sys/vfs.h ... found
	checking for nobody group ... found
	checking for poll() ... found
	checking for /dev/poll ... not found
	checking for kqueue ... not found
	checking for crypt() ... not found
	checking for crypt() in libcrypt ... found
	checking for F_READAHEAD ... not found
	checking for posix_fadvise() ... found
	checking for O_DIRECT ... found
	checking for F_NOCACHE ... not found
	checking for directio() ... not found
	checking for statfs() ... found
	checking for statvfs() ... found
	checking for dlopen() ... not found
	checking for dlopen() in libdl ... found
	checking for sched_yield() ... found
	checking for SO_SETFIB ... not found
	checking for SO_REUSEPORT ... found
	checking for SO_ACCEPTFILTER ... not found
	checking for IP_RECVDSTADDR ... not found
	checking for IP_PKTINFO ... found
	checking for IPV6_RECVPKTINFO ... found
	checking for TCP_DEFER_ACCEPT ... found
	checking for TCP_KEEPIDLE ... found
	checking for TCP_FASTOPEN ... found
	checking for TCP_INFO ... found
	
	checking for accept4() ... found
	checking for eventfd() ... found
	checking for int size ... 4 bytes
	checking for long size ... 8 bytes
	checking for long long size ... 8 bytes
	checking for void * size ... 8 bytes
	checking for uint32_t ... found
	checking for uint64_t ... found
	checking for sig_atomic_t ... found
	checking for sig_atomic_t size ... 4 bytes
	checking for socklen_t ... found
	checking for in_addr_t ... found
	checking for in_port_t ... found
	checking for rlim_t ... found
	checking for uintptr_t ... uintptr_t found
	checking for system byte ordering ... little endian
	checking for size_t size ... 8 bytes
	checking for off_t size ... 8 bytes
	checking for time_t size ... 8 bytes
	checking for setproctitle() ... not found
	checking for pread() ... found
	checking for pwrite() ... found
	checking for pwritev() ... found
	checking for sys_nerr ... found
	checking for localtime_r() ... found
	checking for posix_memalign() ... found
	checking for memalign() ... found
	checking for mmap(MAP_ANON|MAP_SHARED) ... found
	checking for mmap("/dev/zero", MAP_SHARED) ... found
	checking for System V shared memory ... found
	checking for POSIX semaphores ... not found
	checking for POSIX semaphores in libpthread ... found
	checking for struct msghdr.msg_control ... found
	checking for ioctl(FIONBIO) ... found
	checking for struct tm.tm_gmtoff ... found
	checking for struct dirent.d_namlen ... not found
	
	checking for struct dirent.d_type ... found
	checking for sysconf(_SC_NPROCESSORS_ONLN) ... found
	checking for openat(), fstatat() ... found
	checking for getaddrinfo() ... found
	checking for PCRE library ... found
	checking for PCRE JIT support ... found
	checking for md5 in system md library ... not found
	checking for md5 in system md5 library ... not found
	checking for md5 in system OpenSSL crypto library ... found
	checking for sha1 in system md library ... not found
	checking for sha1 in system OpenSSL crypto library ... found
	checking for zlib library ... found
	 creating objs/Makefile

	Configuration summary
	  + using system PCRE library
	  + OpenSSL library is not used
	  + md5: using system crypto library
	  + sha1: using system crypto library
	  + using system zlib library
	
	  nginx path prefix: "/usr/local/nginx"
	  nginx binary file: "/usr/local/nginx/sbin/nginx"
	  nginx modules path: "/usr/local/nginx/modules"
	  nginx configuration prefix: "/usr/local/nginx/conf"
	  nginx configuration file: "/usr/local/nginx/conf/nginx.conf"
	  nginx pid file: "/usr/local/nginx/logs/nginx.pid"
	  nginx error log file: "/usr/local/nginx/logs/error.log"
	  nginx http access log file: "/usr/local/nginx/logs/access.log"
	  nginx http client request body temporary files: "client_body_temp"
	  nginx http proxy temporary files: "proxy_temp"
	  nginx http fastcgi temporary files: "fastcgi_temp"
	  nginx http uwsgi temporary files: "uwsgi_temp"
	  nginx http scgi temporary files: "scgi_temp"

#### make 编译配置文件（默认） ####
编译后如果只出现： `make[1]: Leaving directory `/root/nginx-1.10.1'` 可以直接安装。

#### 开放 80 端口 ####
对 Nginx 开放 80 端口，便于访问：

 	firewall-cmd --zone=public --add-port=80/tcp --permanent 
    firewall-cmd --permanent --zone=public --add-service=http
    firewall-cmd --reload
    firewall-cmd --list-all #查看开放服务、端口中是否有http服务和80端口。

端口开放前：

![端口发放前](https://i.imgur.com/HUoWcWv.png)

端口开放后：

![端口开放后](https://i.imgur.com/pEXvsle.png)

启动 Nginx 进行测试： `/usr/local/nginx/sbin/nginx` -- 默认配置，`/usr/local/nginx/conf/nginx.conf`

启动使用自定义配置：`/usr/local/nginx/sbin/nginx -C /<path>`

停止 Nginx `/usr/local/nginx/sbin/nginx -s quit`，然后进行网站配置。

#### Nginx 配置文件路径更改 ####
设置配置 ` vi  /usr/local/nginx/conf/nginx.conf`

	server {
    listen       80;
    server_name  localhost;
    location / {                  
        root  /home/weixin/httpdocs/;               #新的根目录
        index  index.html index.htm index.jpg;   #添加一张图片，测试用。
    }
	
	chmod  -R 755  /home/weixin/httpdocs/
	service nginx restart

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

P.S. 由于初次编译安装 PHP 踩了个大坑，忘记启用 PHP-fpm 导致浏览器无法解析，而编译前忘记记录日志，导致卸载 PHP 可能不完整，特记录：

	make >& LOG_make &
	make install >& LOG_install & 

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

生成配置文件，然后编译（以下没有启用php-fpm）：
	
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

错误示例：执行以上配置命令，我的虚拟机中反馈信息（缺失部分）：

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
运行配置后，根据提示错误提示补充依赖库，没问题后重新生成配置文件，然后编译 `make`，已经测试编译安装 `make test`。

1. 生成配置文件：
![生成配置文件](https://i.imgur.com/8BxaBcO.png)
可以暂时 `--without-pear --disable-phar ` ，因为phar 属于pear的一个库 ，所以不将phar关闭掉，同时还会报这个错误，同时需要使用 --disable-phar   编译参数编译安装后补充安装，修改后命令：

		./configure --prefix=/usr/local/php --with-config-file-path=/usr/local/php/etc  --with-libxml-dir=/usr  --with-iconv-dir --with-mhash --with-openssl --with-mysqli=shared,mysqlnd --with-pdo-mysql=shared,mysqlnd   --with-zlib --enable-zip --enable-inline-optimization --disable-debug --disable-rpath --enable-shared --enable-xml --enable-bcmath  --enable-shmop --enable-sysvsem --enable-mbregex  --enable-pcntl --enable-sockets --with-gettext --enable-session --without-pear --disable-phar
若需要启用 fpm 则需添加： `--enable-fpm --with-fpm-user=www --with-fpm-group=www`

2. 编译 `make`
![make error](https://i.imgur.com/CM6uWAL.png)
根据提示，补充 `--without-pear --disable-phar ` 参数，重新 `./configure --without-pear --disable-phar ` 然后编译。
二次错误：（第3点）


3. 编译安装测试 `make test`
	[Test Failure Report for ext/sockets/tests/mcast_ipv6_recv.phpt ('Multicast support: IPv6 receive options')](http://gcov.php.net/viewer.php?version=PHP_7_1&func=tests&file=ext%2Fsockets%2Ftests%2Fmcast_ipv6_recv.phpt "test Failure")
4. `make install`编译安装成功后，补充安装：

	    wget  http://pear.php.net/go-pear.phar 
	    /usr/local/bin/php go-pear.phar
5. 设置环境变量
	`vim /etc/profile`	添加如下信息到文件最后：

		PATH=$PATH:/usr/local/php/bin
		export PATH
保存文件，`source /etc/profile` 应用配置，测试PHP：
![PHP编译安装后测试](https://i.imgur.com/qHFKqNN.png)

### PHP-FPM 配置：浏览器访问 ###
在源码目录中复制配置文件到`/etc/` 中 `cp php.ini-production /etc/php.ini`

![PHP FPM](https://i.imgur.com/spG4jPr.png)

./configure --help 可以查看对应说明：

	./configure \
		--prefix=/usr/local/php \
		--with-config-file-path=/etc \
		--enable-fpm \
		--with-fpm-user=www  \
		--with-fpm-group=www \
		--enable-inline-optimization \
		--disable-debug \
		--disable-rpath \
		--enable-shared  \
		--enable-soap \
		--with-libxml-dir \
		--with-xmlrpc \
		--with-openssl \
		--with-mcrypt \
		--with-mhash \
		--with-pcre-regex \
		--with-sqlite3 \
		--with-zlib \
		--enable-bcmath \
		--with-iconv \
		--with-bz2 \
		--enable-calendar \
		--with-curl \
		--with-cdb \
		--enable-dom \
		--enable-exif \
		--enable-fileinfo \
		--enable-filter \
		--with-pcre-dir \
		--enable-ftp \
		--with-gd \
		--with-openssl-dir \
		--with-jpeg-dir \
		--with-png-dir \
		--with-zlib-dir  \
		--with-freetype-dir \
		--enable-gd-native-ttf \
		--enable-gd-jis-conv \
		--with-gettext \
		--with-gmp \
		--with-mhash \
		--enable-json \
		--enable-mbstring \
		--enable-mbregex \
		--enable-mbregex-backtrack \
		--with-libmbfl \
		--with-onig \
		--enable-pdo \
		--with-mysqli=mysqlnd \
		--with-pdo-mysql=mysqlnd \
		--with-zlib-dir \
		--with-pdo-sqlite \
		--with-readline \
		--enable-session \
		--enable-shmop \
		--enable-simplexml \
		--enable-sockets  \
		--enable-sysvmsg \
		--enable-sysvsem \
		--enable-sysvshm \
		--enable-wddx \
		--with-libxml-dir \
		--with-xsl \
		--enable-zip \
		--enable-mysqlnd-compression-support \
		--with-pear \
		--enable-opcache

#### 设置启动 PHP-FPM ####
正确安装完成后，执行如下命令：
	
	[root@ming ~]# cp /usr/local/php/etc/php-fpm.conf.default /usr/local/php/etc/php-fpm.conf
	[root@ming ~]# cp /usr/local/php/etc/php-fpm.d/www.conf.default /usr/local/php/etc/php-fpm.d/www.conf
	[root@ming ~]# cd php-7.2.15/
	[root@ming php-7.2.15]# cp php.ini-production /etc/php.ini
	[root@ming php-7.2.15]# cp sapi/fpm/init.d.php-fpm /etc/init.d/php-fpm
	[root@ming php-7.2.15]# chmod +x /etc/init.d/php-fpm
	[root@ming php-7.2.15]#

启动 php-fpm 程序： `service php-fpm start` 或 `/etc/init.d/php-fpm start`，报错则是因为前面忘记创建 `www` 用户导致的，因此需要添加 `www` 用户，然后重新启动 `php-fpm`：

	groupadd www
	useradd -g www www

## 参考学习文章 ##

1. [centOS下编译安装Nginx](https://www.jianshu.com/p/078083f76324 "centOS下编译安装Nginx")
2. [编译安装MySQL](https://blog.51cto.com/13643643/2132594 "编译安装MySQL5.7")
3. [编译安装PHP7](https://www.jianshu.com/p/fc69f47fb7b8 "编译安装PHP7")
4. [Centos7 编译安装PHP7](https://www.cnblogs.com/liubaoqing/p/9030277.html "Centos7 编译安装PHP7")

## 编译错误信息 ##
运行 `make test` 的错误信息：
 
IPv6 错误：

	FAILED TEST SUMMARY
	---------------------------------------------------------------------
	Multicast support: IPv6 receive options [ext/sockets/tests/mcast_ipv6_recv.phpt]
	file_get_contents() test using offset parameter out of range [ext/standard/tests/file/file_get_contents_error001.phpt]

	=====================================================================
	FAILED TEST SUMMARY
	---------------------------------------------------------------------
	pcntl: pcntl_sigprocmask(), pcntl_sigwaitinfo(), pcntl_sigtimedwait() [ext/pcntl    /tests/002.phpt] //删除后，再次忘记创建目录，创建后无该错误。
	Multicast support: IPv6 receive options [ext/sockets/tests/mcast_ipv6_recv.phpt]
	=====================================================================
