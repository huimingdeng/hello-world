# 面试集锦 #
感谢群内同学的分享，特收集整理。

## 试题（长沙） ##
一、 请描述 `PBAC` 权限设计的思路和表的设计

二、 请描述 `Laravel` 框架的生命周期

三、 无限极分类的表中，如分销系统中如何把数据显示出来，说两种方法的差异和原理

四、 `echo()`,`print()`,`print_r()`的区别

五、 很多表建立了索引字段，但有时候确无法命中，大概有哪些原因造成的

六、 请写一个符合 `Restfull API` 的接口规范示例，如用`User`模型

七、 在 api 接口的交互过程中怎样保证接口安全不被抓包盗用

八、 Redis 的默认数据类型有哪些？说出一个常见的应用场景。

redis基本数据类型 string list set zset hash

九、 Git 版本控制中，常见的命令有哪些？

十、 `Swoole` 和 `Workman` 有哪些异同
	
`Workman` 依赖php的扩展 `swoole` 是c和c++编写的一个PHP扩展，支持协程

swoole是C语言编写，不依靠php的扩展。
workman依赖php的扩展。
swoole的特性更丰富、稳定性好一些。
php通过swoole系列函数调用swoole的api，来启动swoole服务、注册回调函数等，swoole的事件驱动来执行对应的回调函数。
这完全区别于普通的php扩展只提供库函数，而对于swoole，php只是传递的作用，真正的程序控制权是swoole。
libevent是一个事件驱动库，php有对应的event扩展io复用和事件机制。
stream/sockets是网络通讯的工具
pcntl/posix是进程控制扩展
sysvmsg消息队

swoole并没有用libevent，所以不需要安装libevent。swoole并不依赖php的stream/sockets/pcntl/posix/sysvmsg等扩展