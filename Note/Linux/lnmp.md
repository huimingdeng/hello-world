# LNMP #
搭建 LNMP ，虚拟机搭建，用于测试或开发。

## CentOS7 ##
使用 centos 编译搭建 lnmp。

必要安装包安装：

1. make: `yum -y install gcc automake autoconf libtool make` 编译库
2. gc++: `yum -y install gcc gcc-c++ glibc` 编译库
3. openssl: `yum -y install openssl openssl-devel cyrus-sasl-md5` nginx 依赖 
4. 

### Nginx 搭建 ###

命令：

	./configure --prefix=/usr/local/nginx  // nginx 安装到的目录 
				--with-http_ssl_module 		// 安装 ssl 模块，ssl证书等
				--with-pcre=../pcre-8.39    // pcre: Perl Compatible Regular Expressions
				--with-zlib=../zlib-1.2.8	// 压缩包 


	