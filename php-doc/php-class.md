# PHP 类(对象)知识 #
日常开发中不注意的冷门知识汇总。

## PHP中`new self()`和`new static()`的区别探究 ##
参考博客：[PHP中new self()和new static()的区别探究](https://www.cnblogs.com/jytblog/p/7743527.html "PHP中new self()和new static()的区别探究")

`new static()` 由调用者决定，如： `class A extends B` 那么 `new static()` 是 A 对象。
`new self()` 则是 B 对象。

	class B {
	    public function getNewFather()
	    {
	        return new self();
	    }
	
	    public function getNewCaller()
	    {
	        return new static();
	    }
	}
	
	class A extends B {}
	
	$a = new A();
	echo get_class($a->getNewCaller());
	echo "\n";
	echo get_class($a->getNewFather());

