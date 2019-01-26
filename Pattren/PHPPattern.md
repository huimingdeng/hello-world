# 设计模式 #
《23种设计模式》、《设计模式之禅》 等设计模式的书籍都是针对 Java 语言进行编写的书籍。因为 Java 是强类型语言，而 PHP 是弱类型语言，因此两者之间的设计模式不能完全照搬，因为部分设计模式对 PHP 来说是无意义的，且 PHP 通过底层已经实现了很多模式。

模式是为了提高代码重用，可扩展性，解决代码更容易（以人思维处理问题）—— 解决方案 （solve、solution）

1. 为什么使用 OOP 编程？ —— 将问题模块化（继承、复用等），解决问题更容易 --> 多态 继承 封装 OOP 三大特性。
2. 为什么使用设计模式？ —— 更深入理解 OOP 思想；更容易让代码升级；可扩展性更高；面试知识。
3. 怎么学习设计模式？—— 业务典型场景--> 问题 --> 解决方案
4. 不同语言设计模式的差距 —— 思想一样 --> 实现代码不一样，eg. php 本身就实现了很多设计模式
5. 不是为了实现设计模式去写代码，是为了解决问题而使用设计模式。
6. 如何学习设计模式？ —— 学习框架源码，结合 UML 类图学习。

设计模式：（解决方案）—— 同样需求，同样方案抽象化的过程，形成了具体的方案。  -- UML 类图（相当于接口规范）。

项目必需：详细设计文档、类图、时序图、用例图等（大型项目）。

用例图：必需涵盖功能总体流程，一个生命周期或多个生命周期。

## 单例模式 ##
一个类最多只能创建出一个对象实例（三私一公）。

框架中 `kernel::single('system_item_info)` PSR-4: 根据文件夹名称和下划线分割，重写 `spl_autoload_register` 实现。 类似 `TPSHOP` 的 service 图层。

1. 为什么要这样做？—— 解决多线程并发访问的问题；节约系统内存，提交系统运行的效率，提高系统性能。
2. 静态属性数组？—— 常驻内存，直到页面关闭。

示例：把所有实例化对象的动作都封掉，只有一个门进出，且只实例化一次。

应用场景：加载配置、数据库链接
	
	class Single{
		//私有的成员静态变量(属性)，保存自身实例化对象
		private static $single;
		// 私有化构造方法，子类、其它类不能实例化等
		private function __construct(){ ... }
		// 防止对象的克隆
		private function __clone(){ ... }
		// 定义一个方法，实现 Single 类只能定义一次，作为入口
		public static function getInstance( $classname ){
			//定义一个静态属性保存实例对象
			// 如果不是指实现自身，则根据参数 $classname （类名和路径）用于实现自动加载
			... ... 
			if(self::$single){
			}else{//对象不存在
				self::$single = new Single();
			}
			return self::$single;
		}
		// 统计类的数量或其它操作
		... ...
	}
	$singleObj = Single::getInstance();

在实际开发中，可能存在大量使用 单例模式的，因此可能 成员变量  $single 是一个数组。

TP: input 获取参数， Laravel： request 获取参数，然后传金 single 类中。


## 简单工厂模式 ##
是属于创建型模式，又叫做静态工厂方法（Static Factory Method）模式，不属于23种GOF设计模式之一；简单工厂模式是由一个工厂对象决定创建出哪一种产品类的实例。

接口和抽象类的区别？

参考框架 DB 类（TP5 用 PDO），模仿示例：

	interface DB{
		protected function parseDsn();
		... ...
	}
	
	class Pgsql implements DB{
		protected function parseDsn(){
		}
	}

	class Oracle implements DB{
		protected function parseDsn(){
		}
	}

	class Factory{
		static $db = NULL;
		public static function getConnect( $type ){
			//根据 $type 实例化不同对象
			if( $type == 'Pgsql'){
				self::$db = new $type();
			}
			... ...
			return self::$db;
		}
	}



