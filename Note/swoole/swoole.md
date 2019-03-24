# swoole 学习笔记 #
因工作原因，落后太多，学习 swoole 记录笔记，积累补充学习。[swoole入门指引](https://wiki.swoole.com/wiki/page/1.html "swoole入门指引")

## swoole 安装 ##
目前下载的 swoole 版本为 swoole-4.2.13  `wget  https://pecl.php.net/get/swoole-4.2.13.tgz`

腾讯云安装 swoole ，因为是初次使用，所以按照 swoole 新手编译安装 swoole。（第一次使用ubuntu新手编译安装）

	tar -zxf swoole-4.2.13.tgz
	cd swoole-4.2.13
	sudo phpize (ubuntu 没有安装phpize可执行命令：sudo apt-get install php-dev来安装phpize)
	sudo ./configure
	sudo make 
	make test // 查看是否完全支持编译安装
	sudo make install

目前编译安装错误：

	Thank you for helping to make PHP better.
	Makefile:134: recipe for target 'test' failed
	make: *** [test] Error 1

追踪错误信息：`sudo make test >> test.log` 输出错误信息，方便跟踪

切换方式，按照官方文档下载 GitHub 中的 swoole-4.2.13 进行编译安装。

	git clone https://github.com/swoole/swoole-src.git 

使用 git 下载，默认是最新版本，目前为 swoole-alpha-3.0 版本，新手简易安装，可以使用
	

P.S. docker 安装lnmp+swoole:(windows10家庭版 docker 需要安装DockerToolbox)

### 虚拟机安装 swoole ###
因为腾讯云编译安装 swoole 失败而默认安装了 `swoole-alpha-3.0` 版本，学习不是很方便，因此笔记本安装了 lnmp 环境后，扩展编译安装 swoole . -- March 24,2019

安装swoole 官网，使用新手安装，以后深入学习后可以重新编译安装更新。`./configure`执行后，发现提示警告信息：

	... ...
	configure: WARNING: You will need re2c 0.13.4 or later if you want to regenerate PHP parsers.
	... ... 
	configure: creating ./config.status
	config.status: creating config.h

参考[处理方案](https://www.phpsong.com/2220.html "处理方案") ：

	wget https://sourceforge.net/projects/re2c/files/0.16/re2c-0.16.tar.gz   // 目前查看有了1.0.1版本 https://sourceforge.net/projects/re2c/files/1.0.1/re2c-1.0.1.tar.gz 采用的是该版本
	tar zxf re2c-0.16.tar.gz && cd re2c-0.16
	./configure 
	make && make install

个人在执行处理方案中，安装 re2c1.0.1 编译 `make && make test` 过程中，再次出现警告信息。 `make test` 无测试，可忽略警告信息按照参考处理执行 `make && make install`

#### 不忽略情况： ####
亦可以根据反馈信息如下，进一步按照提示修改 

	Reconfigure to rebuild docs: ./configure --enable-docs
	make[1]: Leaving directory `/root/re2c-1.0.1'

添加执行 `./configure --enable-docs` 后，提示配置错误:

	configure: error: need rst2man or rst2man.py for --enable-docs 

#### 处理了 swoole 警告后： ####
再次切换到 swoole 的目录，执行 `./configure`:

![swoole 配置 OK](https://i.imgur.com/NVe1mCR.png)

执行`make` 命令：

	Libraries have been installed in:
   /root/swoole-4.3.0/modules

	If you ever happen to want to link against installed libraries
	in a given directory, LIBDIR, you must either use libtool, and
	specify the full pathname of the library, or use the `-LLIBDIR'
	flag during linking and do at least one of the following:
	   - add LIBDIR to the `LD_LIBRARY_PATH' environment variable
	     during execution
	   - add LIBDIR to the `LD_RUN_PATH' environment variable
	     during linking
	   - use the `-Wl,--rpath -Wl,LIBDIR' linker flag
	   - have your system administrator add LIBDIR to `/etc/ld.so.conf'
	
	See any operating system documentation about shared libraries for
	more information, such as the ld(1) and ld.so(8) manual pages.
	----------------------------------------------------------------------

	Build complete.
	Don't forget to run 'make test'.

执行 `make test` 提示：

	swoole_feature: cross_close: full duplex [tests/swoole_feature/cross_close/full_duplex.phpt]
	swoole_feature: cross_close: full duplex and close by server [tests/swoole_feature/cross_close/full_duplex_by_server.phpt]
	swoole_feature: cross_close: stream [tests/swoole_feature/cross_close/stream.phpt]
	{{test_name}}: {{test_intro}} [tests/template.phpt]

	You may have found a problem in PHP.
	This report can be automatically sent to the PHP QA team at
	http://qa.php.net/reports and http://news.php.net/php.qa.reports
	This gives us a better understanding of PHP's behavior.
	If you don't want to send the report immediately you can choose
	option "s" to save it.  You can then email it to qa-reports@lists.php.net later.

	Warning: fsockopen(): unable to connect to qa.php.net:80 (Connection timed out) in /root/swoole-4.3.0/run-tests.php on line 1053

	The test script was unable to automatically send the report to PHP's QA Team
	Please send /root/swoole-4.3.0/php_test_results_20190307_0612.txt to qa-reports@lists.php.net manually, thank you.
	make: *** [test] Error 1

忽略`make test`执行`make install`

	[root@localhost swoole-4.3.0]# make install
	Installing shared extensions:     /usr/local/php/lib/php/extensions/no-debug-non-zts-20170718/
	Installing header files:          /usr/local/php/include/php/
	[root@localhost swoole-4.3.0]#

## swoole 心跳检测 ##
心跳：判断事物生死的标准，判断一个连接是否正常还是断开。

涉及到4层协议(应用层/传输层/网络层/数据链路层)
![TCP/IP协议族](https://i.imgur.com/n2Zr1Ua.png)

### tcp 粘包处理 ###
发送方：发送需要等缓冲区满才发送，造成粘包

接收方：

1. 手动处理
2. EOF 结束协议
3. 

## swoole server&client ##


## swoole--March,7 ##
swoole 进程图

	master
	manager
	worker worker ...
	task task ...

1. 主进程/线程往epoll内核事件中注册socket上的就绪事件。
2. 主进程/线程调用 epoll_wait 等待socket上有数据可读。
3. 当socket 

### swoole 类 nginx ###
多进程Reactor，也存在多线程。

平滑重启服务：
swoole 常驻内存（减少文件加载），主进程需要发送，worker 进程进行重启。`kill` 终止可能会中断代码执行，swoole 保证执行代码完毕再终止。`kill -USR1 |-10 master_pid` 重启所有 worker 进程。

    kill -SIGTERM|-15 master_pid //终止Swoole ，平滑终止。

## swoole--March,9 ##
inotify 安装，监视进程，处理僵尸进程；调用 swoole_event_add ，在关闭时需要关闭该事件，如果没有关闭，造成事件不断监听。`ctrl+c` 关闭服务后需删除事件： `swoole_event_del($this->watch_fd)`

SIGINI `CTRL+C`

### task ###
异步任务，实现 `task` ，掌握消息队列，进程间通信。 `task_worker`

## docker ##
win10家庭版安装 docker 的坑，需要使用 dockertoolbox 安装 docker ；但该工具安装 docker 启动后报错：

![docker-win10 errors](https://i.imgur.com/8qUv8EG.png)

### docker 处理 ###