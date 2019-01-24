# 笔试题01 #
题目由呼和浩特的孤鹰提供。

## 题目 ##
1. PHP 实现一个双向队列
	1. 队列实现参考：[exam/Dique.php](https://github.com/huimingdeng/hello-world/blob/master/PHPinterview/exam/Dique.php "双向队列")
2. PHP 的垃圾回收机制？
3. 如何解决 PHP 开发中的异常处理
4. PHP 开发中的需要关注的安全问题以及防护方法
5. 使用正则提出一个网页的所有链接？
6. MySQL 存储引擎有哪些？有什么区别？
7. MySQL的优化？
8. MySQL中锁的理解？
9. 简述秒杀功能的实现？
10. 写一个每天定时4点给数据库备份的shell脚本？


## 解答 ##
来源均为互联网提供。

### 垃圾回收机制 ###
参考 [垃圾回收机制](http://php.net/manual/zh/features.gc.php "PHP 垃圾回收机制") 、GitHub上的 [PHP7内核剖析](https://github.com/pangudashu/php7-internal "PHP7内核剖析") 5.2 垃圾回收 和 《PHP7底层设计与源码实现》 的 9.5 内存回收 一小节。

变量存储在 PHP 的 `zval` 容器中，结构如下：

![MM](https://i.imgur.com/yzhxPY3.png)

调试案例：

![xdebug](https://i.imgur.com/5dkbp5J.png)




[十个目前最流行的基于MVC设计模式的PHP框架](https://blog.csdn.net/xiejianghui_/article/details/23882975 "十个目前最流行的基于MVC设计模式的PHP框架")



