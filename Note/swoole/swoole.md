# swoole 学习笔记 #
因工作原因，落后太多，学习记录笔记，积累补充学习。[swoole入门指引](https://wiki.swoole.com/wiki/page/1.html "swoole入门指引")

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