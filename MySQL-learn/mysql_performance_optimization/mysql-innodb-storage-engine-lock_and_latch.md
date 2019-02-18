# MySQL Innodb 引擎 #
读 姜承尧 《MySQL技术内幕——InnoDB存储引擎》 笔记。

## 锁 ##
数据库系统区别文件系统的关键特性。锁机制用于管理对共享资源的并发访问，提供数据的完整性和一致性。

### lock and latch ###
latch 闩锁（轻量级）—— 要求锁定时间必须非常短，时长则性能差。 mutex(互斥量) 和 rwlock(读写锁) —— 保证并发线程操作临界资源正确性，无死锁检测机制。

lock 对象是事务，用来锁定数据库中的对象，表、页、行。一般情况，lock对象仅在事务 commit 或 rollback 后释放（[隔离级别](https://github.com/huimingdeng/hello-world/blob/master/MySQL-learn/mysql_performance_optimization/mysql-optimization-01.md#%E4%BA%8B%E5%8A%A1%E9%9A%94%E7%A6%BB%E7%BA%A7%E5%88%AB "事务隔离级别")影响），lock 存在死锁检测机制。

![The comparison of lock and latch](https://i.imgur.com/jk5DrLl.png)

#### latch 信息查看 ####
InnoDB 存储引擎latch信息：

![show engine innodb mutex](https://i.imgur.com/6ULQvVd.png)

MySQL 的 DEBUG 版本 latch 详细信息：

![SHOW ENGINE INNODB MUTEX](https://i.imgur.com/h7zxJgG.jpg)

结果分析：
![结果分析](https://i.imgur.com/IuyF50s.jpg)



### 锁(LOCK)的类型 ###
共享锁(S Lock),允许事务读取一行数据。

排他锁(X Lock),允许事务删除或更新一行数据。


## 事务(Transactions) ##
是数据库区别文件系统的重要特性之一。

[事务特性](https://github.com/huimingdeng/hello-world/blob/master/MySQL-learn/mysql_performance_optimization/mysql-optimization-01.md#%E4%BA%8B%E5%8A%A1%E7%89%B9%E6%80%A7acid "事务特性ACID"):

- 原子性(A atomicity)
- 一致性(C consistency)
- 隔离性(I isolation) —— 前面的锁实现的是事务的隔离性
- 持久性(D durability)

1. 扁平事务 (Flat Transactions)
2. 带保存点扁平事务 (Flat Transactions with Savepoints)
3. 链事务 (Chained Transactions)
4. 嵌套事务 (Nested Transactions)
5. 分布式事务 (Distributed Transactions)

