# MySQL Innodb 引擎 #
读 姜承尧 《MySQL技术内幕——InnoDB存储引擎》 笔记。

## lock and latch ##
latch 闩锁（轻量级）—— 要求锁定时间必须非常短，时长则性能差。 mutex(互斥量) 和 rwlock(读写锁) —— 保证并发线程操作临界资源正确性，无死锁检测机制。

lock 对象是事务，用来锁定数据库中的对象，表、页、行。一般情况，lock对象仅在事务 commit 或 rollback 后释放（[隔离级别](https://github.com/huimingdeng/hello-world/blob/master/MySQL-learn/mysql_performance_optimization/mysql-optimization-01.md#%E4%BA%8B%E5%8A%A1%E9%9A%94%E7%A6%BB%E7%BA%A7%E5%88%AB "事务隔离级别")影响），lock 存在死锁检测机制。

![The comparison of lock and latch](https://i.imgur.com/jk5DrLl.png)

