# Nginx note #
Nginx 学习/运维使用笔记。

## Nginx 安装 ##
Nginx学习笔记：安装 nginx-1.2.3 参考《Nginx高性能Web服务器详解》

1. 上传 nginx-1.2.3.tar.gz 到 VMware 中的 CentOS7 服务系统中。创建目录 `/Nginx_123/`,复制文件 `nginx-1.2.3.tar.gz` 到目录 `/Nginx_123`，并解压文件 `tar xf /Nginx_123/nginx-1.2.3.tar.gz` 进入目录 `/Nginx_123` 查看目录 `ls -l`:

	![nginux 解压后目录](https://i.imgur.com/hvoR4fU.png)
	
	
	- src 目录中存放了Nginx软件的所有源代码。
	- man 目录中存放了Nginx软件的帮助文档，Nginx安装完成后，使用man命令可以查看：
	    `man nginx`
	- html 目录和conf目录中存放的内容和Windows版本的同名目录相同。
	- auto 目录中存放了大量脚本文件，和configure脚本程序有关。
		- 进入 auto 目录
			- ![nginx-1.2.3/auto/-示例](https://i.imgur.com/8mt8Pbq.png)
		- 职能划分：
			- os/ 目录下的脚本负责检查环境。
			- modules/ 目录下的脚本负责检查模块。
			- options/ 目录下的脚本负责处理脚本参数。
			- 文件（have、nohave、make及install等）负责输出信息到生成文件。
			- feature 用于脚本自身服务。
	- configure 文件是 Nginx 软件的自动脚本程序。运行 configure 自动脚本一般会完成两项工作：一是检查环境，根据环境检查结果生成 C 代码；二是生成编译代码需要的 Makefile 文件。--参考：《Nginx高性能Web服务器详解》
		
	- CHANGES、LICENSE(zlib)、README 为版本说明

2. 执行命令 `./configure --prefix=/Nginx_123/Nginx_123_Compile` 生成 MakeFile 文件，根据信息是否需要额外引用库。如下图：是执行后发现 OpenSSL 库没有发现，因此要查找是否安装 OpenSSL。
![示例图](https://i.imgur.com/Af03sqF.png)
	- `which openssl` 得到安装路径 `/usr/bin/openssl`，因此，重新执行命令 `./configure --prefix=/Nginx_123/Nginx_123_Compile --with-openssl=/usr/bin/openssl` ,结果如下图：
![示例图2](https://i.imgur.com/EBLaRrT.png)

3. 执行编译安装，`make && make install`,然后进入 `/Nginx_123/Nginx_123_Compile` 工作目录，查看目录 <b style="color:red;">`ls *`</b> 如下图：
![安装完成后](https://i.imgur.com/9M4V4RF.png)

4. nginx 的启动和停止控制：
	- nginx 运行时，会存在一个主进程和多个工作进程。`ps -ef | grep "nginx"` 查找 nginx 是否运行，也可得到：root主进程pid:69309 ，可以使用 `kill SIGNAL PID <pid>` 关闭。
	- ![启动nginx](https://i.imgur.com/mafRlue.png)
	