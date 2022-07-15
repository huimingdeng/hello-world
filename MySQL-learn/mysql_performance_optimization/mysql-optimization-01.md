# MySQL 优化 #
记录学习 MySQL 优化的笔记，方便复习。

## mysql 术语 ##
`DML(data manipulation language)`:它们是 `SELECT、UPDATE、INSERT、DELETE`，就象它的名字一样，这4条命令是用来对数据库里的数据进行操作的语言

`DDL(data definition language)`:有 `CREATE、ALTER、DROP` 等，DDL主要是用在定义或改变表（TABLE）的结构，数据类型，表之间的链接和约束等初始化工作上，他们大多在建立表时使用

`DCL(data control language)`:设置或更改数据库用户或角色权限的语句，包括（`grant,deny,revoke`等）语句。在默认状态下，只有 `sysadmin`,`dbcreator`,`db_owner` 或 `db_securityadmin` 等人员才有权力执行DCL

## MySQL 工作原理 ##
mysql工作原理：连接请求->连接池存储->服务管理器等功能处理->SQL接口调用->解析SQL语句并预处理->执行和优化查询->读取缓存或字节流写入->按照引擎对文件进行操作。


mysql工作原理图：
![mysql原理](images/mysql-logic.png)

SQL执行过程示意：
![SQL执行](images/SQL-execute.png)

## MySQL事务处理 ##
保证操作的一致性。典型案例：支付订单，优惠卷等。当执行事务操作，会对当前操作表加锁，防止其它影响。(分布式事务)

### 事务特性：(ACID) ###

- 原子性(A atomicity)：当成一个最小单元来处理，要么全部成功，失败全部回滚
- 一致性(C consistency)：执行一个操作（崩溃），则数据操作不成功，回滚不被破坏；—— 不好影响数据库的完整性约束
- **隔离性**(I isolation)：类似面向对象编程，对A的操作不会影响B，但两者之间可通信；—— 事务之间的行为不相互影响
- 持久性(D durability)：mysql5.7 增加持久性一样，保存到磁盘，系统崩溃，事务不会出现问题；—— 将提交的事务持久化到磁盘，数据不会丢失

mysql数据库控制台重要操作：

1. start transaction //开始事务
2. savepoint 保存点名 //设置保存点 --> 可以指定
3. rollback to 保存点名 //回滚到保存点
4. rollback //取消全部事务
5. commit // 提交事务

### 事务隔离级别 ###
隔离级别：制定一些规则，限定事务的内外那些改变的可见度（可见和不可见）。不隔离：脏读(不是真实数据)，不可重复读(事务不完结，下一个无法进行， --修改)，幻读(虚读， --插入)：

1. 读未提交  -- 脏读|不可重复读|幻读  --> 事务 A 对数据进行的修改，A 没提交，对 B 也是可见的
2. 读已提交  -- x  |不可重复读|幻读   --> 事务 A 开启，读 C=100，事务 B 开启，C=200，B 提交；A再次读取，可以获取最新数据。 （默认级别）
3. 可重复读  -- x  |  x | 幻读       --> 事务 A 开启，读 C=100， 事务 B 开启，C=200，B提交；这个动作 A 无法看，所以产生幻读 (mysql默认级别) -- P.S. mysql5.7 innodb 不会存在幻读情况
4. 可串行化  -- x  |  x | x         --> 用到大量的锁操作，每一行数据都需要加锁，性能比较差。eg. 事务 A 完毕后 B才能执行。

级别越高，要求的性能也就越高，根据业务精确度决定隔离级别。

并发的情况下如何制定隔离级别？可重复读级别 (repeatable read)

mysql 操作：（要关闭事务自动提交）

	SELECT @@tx_isolation // 查看当前会话隔离级别
	select @@global.tx_isolation //查看系统当前隔离级别
	SHOW VARIABLES LIKE "autocommit"; //查看事务自动提交
	set @@autocommit = 0; // 设置关闭事务的自动提交

### 分布式事务 ###
在本地事务中，服务和资源在事务的包裹下可以看做是一体的。

原理：

资源管理器：


### innodb 行级锁 ###
死锁如何产生？

1. 数据库处理能力，自动避免死锁产生。
2. 多人做同一件事情，造成死锁。而多人操作的优先级一样，同时加锁。
3. 隔离级别从 Repeatable read 换成 Read commited；因为该级别不能重复读，如事务A无法查看事务B的操作。
4. 案例：Ta(事务a) 和 Tb(事务b) 在可重复读情况导致排它锁（相同几率）同时启动，形成死锁。
5. innodb 自动处理死锁
	1. 产生死锁后，一个事务释放锁并且回滚，另一个事务获得锁，继续完成事务操作。
	2. 存在表锁或外界锁，无法完全检测到死锁情况
		1. 数据库表设计和业务处理流程解决死锁问题
6. 如何避免死锁的产生？
	1. 设置锁等待时间
	2. 控制事务的大小（占用时间越长，越可能发生死锁）
	3. 数据的检索尽量通过索引完成，尽量避免表级锁定
	4. 尽量使用低级别的事务隔离；但不绝对，要考虑业务场景。（自身网站产品，天猫等第三方平台）
	5. 合理使用索引，在索引上加锁更准确；
	6. 在业务允许的情况下，尽量使用低级别事务隔离
	7. 在容易产生死锁的业务，调高隔离级别，串行处理 或 使用表级锁；
	8. 尽量减少范围的筛选，过滤更多记录，避免锁定重要信息。（如何筛选?)

如何测试死锁，人为制造：编写脚本查询，并修改记录，产生了死锁就会报错。

线程1 添加条记录

线程2 添加相同记录->返回报错信息

### innodb 日志 ###
没有配置则 innodb 数据与日志都保存在一个文件中。

二进制文件日志：所有查询等操作可以在二进制文件中查找。eg. 慢查询

数据文件：存储保存的数据

数据库设定了隔离级别后，可以自己变更
	
	// 设置当前会话隔离级别
	set session transaction isolation level repeatable read;
	// 设置系统当前隔离级别
	set global transaction isolation level repeatable read;

或者根据业务需求，单独部署一台服务器设置高/低级别的隔离级别 


## 存储过程 ##
函数：PHP 调用函数，用SQL语句 `SELECT <functionname>`

	日期函数
	自定义函数

存储过程，要用PHP代码调用，不能写在SQL语句里面

优点：

1. 根据存储过程名字调用，内部代码修改，不影响调用(无需修改PHP调用的业务代码)，不需要重启服务，相当于调用接口
2. 执行速度快
3. 减少(不需要)网络传输量，安全
4. 适用后台管理系统，财务报表，数据统计(热门商品等)

缺点：

1. 不能使用缓存，所有动作都在存储过程中，性能堪忧
2. 不能处理复杂业务
3. 移植性不好（困难），数据库语法区别不同
4. 不利于分库分表
5. 不利于调试(SQL过多，无注释)

### 存储引擎的创建 ###

	create procedure <procedure_name>(arvg1,...)
	begin
		delete <variablename> type;
		exec statement
	end
	$$
	
	call <procedure_name>(arvg1,...)

存储过程执行，预编译不知在创建后已经进行，后面调用者直接进入了 optimizer 部分。

#### 三种参数类型 ####
in 调用存储过程时指定，不能被返回，默认值
out 可以被改变，可以返回
inout 调用时指定，可以被改变和返回

#### 存储过程中数据类型 ####
数值类型： int、float、double、decimal

日期类型： timestamp、date、year

字符串： char、varchar、text（容易产生慢查询，单独获取对应类型的字段）

#### 存储过程的注释 ####
因为存储过程代码大量且混乱，因此编写注释是必要的，方便后续的维护工作。

#### 存储过程的调用 ####
php 调用：
	
	$sql = 'call test(4);';
	$resource = mysql_query($sql);
	$result = mysql_fetch_array($resource);
	var_dump($result);

### 游标与指针 ###
类似数组指针的操作。指针从上往下移动，取出数组中的数据。定义游标获取查询数据，取到某一个位置，则添加一个标志，方便灵活的操作获取数据的结果集。-- 结合存储过程、函数、触发器等使用。

游标的声明添加(消耗 MySQL 性能)：

	DECLARE <cursor name> CURSOR FOR <ResultSet>
	
	OPEN <cursor name> // 开启游标，资源操作有对应的关闭操作
	CLOSE <cursor name> // 关闭游标
	DECLARE CONTINUE HANDLER FOR <...> NOT FOUND // 设置句柄，结果集查询不到数据自动跳出

以上建议简易业务使用，复杂业务不用；示例：

	CREATE procedure test1()
	BEGIN
	DECLARE res_status INT DEFAULT 200;
	DECLARE a INT; // 声明变量 a
	DECLARE b VARCHAR(20); // 声明变量 b 对应表 tb 字段 b
	DECLARE test_cursor CURSOR FOR SELECT a,b FROM tb;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET res_status = 404;
	OPEN test_cursor;
		loop_label:loop
		FETCH test_cursor INTO a,b;// 获取数据
		... ... // 业务操作
		IF res_status = 404 THEN
		leave loop_label // 跳出循环
		END IF;
		end loop; //结束循环
	CLOSE test_cursor;
	END;

游标的好处：不满足条件可以弃用数据。

P.S. 结果存储在临时表，不用每次查询获取。

### 创建视图 ###
MySQL视图：提高重用性，类似于函数；数据库重构不影响程序运行；提高安全性，针对不同用户；数据更清晰。

视图本质是通过视图（虚拟表）定义更新操作基本表；可进行更新操作的叫可更新视图。

**使用场景**：

优点：

1. 基于权限提供数据
2. 方便数据读取
3. 简化 SQL 语句

缺点：

1. 修改表结构，需要手动维护数据
2. 大量 SQL 影响性能

语法：

	CREATE view <view name>	 AS ( SELECT ...	)
	ALTER view <view name> AS ( SELECT ... )
	DROP view <view name>

多个结果集存放在临时表，提供组合的结果。
