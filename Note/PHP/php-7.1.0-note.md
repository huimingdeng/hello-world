# 编译安装PHP7.1.0 #
需要安装依赖库：

	yum -y install gcc gcc-c++ libxml2 libxml2-devel bzip2 bzip2-devel libmcrypt libmcrypt-devel openssl openssl-devel libcurl-devel libjpeg-devel libpng-devel freetype-devel readline readline-devel libxslt-devel perl perl-devel psmisc.x86_64 recode recode-devel libtidy libtidy-devel 
	mcrypt mhash

## 下载与安装 ##

`wget http://cn2.php.net/distributions/php7.1.0.tar.gz`

解压：`tar -zxvf php7.1.0.tar.gz`

进入解压目录进行编译：`cd php7.1.0`

	./configure --prefix=$HOME/php7/book/php-7.1.0/output --enable-fpm
	make && make install