# WordPress 插件开发 #
插件开发知识点，以及插件开发过程中可能会用到的函数或钩子(hook)

## 数据表创建 ##
实现插件首次激活，创建数据表中，用到的 `hook` ： `dbdelta_create_queries` ，以及函数 `add_filter`; eg. 

	add_filter('dbdelta_create_queries', array($this, 'filter_dbdelta_queries'));

### `add_filter()` 函数 ###
将函数或方法挂钩到特定的过滤器操作. WordPress提供了过滤器挂钩，允许插件在运行时修改各种类型的内部数据。

插件可以通过将回调绑定到过滤器挂钩来修改数据。当稍后应用过滤器时，将按优先级顺序运行每个绑定回调，并提供通过返回新值来修改值的机会。

	add_filter( string $tag, callable $function_to_add, int $priority = 10, int $accepted_args = 1 )
	
	$tag
		 (string) (必填的) 将调用 $function_to_add 函数应用的过滤器名称
	$function_to_add
		(callable) (必须的) 应用过滤器是调用的函数
	$priority
		(int) (可选的) 用于指定与特定操作关联的函数执行的顺序。 
		值越低执行优先级越高，数值相同则按照添加时候的顺序执行， 默认为 10
	$accepted_args
		(int) (可选的) 函数接受的参数个数。 默认为 1 ，一个参数。

官网示例：

	function example_callback( $example ) {
	    // Maybe modify $example in some way.
	    return $example;
	}
	add_filter( 'example_filter', 'example_callback' );


### `dbdelta_create_queries` 钩子 ###
过滤用于创建表或数据库的 `dbDelta` SQL查询。通过这个钩子可以过滤的查询包含 `CREATE TABLE` 或 `CREATE DATABASE`。 

原文：

	Filters the dbDelta SQL queries for creating tables and/or databases.
	Queries filterable via this hook contain "CREATE TABLE" or "CREATE DATABASE".

### `dbDelta` 函数 ###
根据指定的SQL语句修改数据库。 用于创建新表和将现有表更新为新结构。

	dbDelta( string[]|string $queries = '', bool $execute = true )
	
	$queries
		(string[]|string) (可选) 要运行的查询。可以是数组中的多个查询，也可以是用分号分隔的查询字符串。
	$execute
		(bool) 是否立即执行查询。默认为 true
	
	RETURN 
		(array) 包含各种更新查询结果的字符串。

案例 `1` -- 单独创建一张数据表 (以 MyFAQs 插件数据表为例)：
	
	$sql = <<<EOF
	CREATE TABLE `_faq_categories` (
		`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
		`name` varchar(255) NOT NULL COMMENT '分类名',
		`slug` varchar(255) NOT NULL COMMENT '别名,必须英文',
		`pubdate` datetime NOT NULL COMMENT '发布时间',
		`editdate` datetime NOT NULL COMMENT '修改时间',
		`sumfaq` int(10) unsigned NOT NULL COMMENT '统计当前分类faq数量',
		`parent` int(10) DEFAULT NULL COMMENT '父级分类',
		PRIMARY KEY (`id`),
		UNIQUE KEY `name` (`name`)
	) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
	EOF;
	dbDelta( 'CREATE TABEL ' ,true);

案例 `2` -- 创建多张表 （结合钩子 `dbdelta_create_queries` 和函数 `add_filter` 的案例，还是 MyFAQs 的数据表为例）：


## 插件激活，弃用和卸载 ##
一般在安装插件后首次激活安装数据表，设置配置信息等。插件弃用则修改配置信息的可用状态，而卸载则删除配置信息，删除创建的数据表。分别： `register_activation_hook`、`register_deactivation_hook` 和 `register_uninstall_hook`

### `register_activation_hook` ###
注册后，在插件激活的时候会执行的函数。

### `register_deactivation_hook` ###
注册后，在插件弃用使用会执行的回调函数。

### `register_uninstall_hook` ###
注册后，在卸载插件时候执行的回调函数。该函数目前无法在类的内部调用，只能在类外部调用

如果存在命名空间：  `register_uninstall_hook(__FILE__, array('MyFAQs\MyFAQs', 'deactivate'));`-- 命名空间\类名

不存在命名空间: `register_uninstall_hook(__FILE__, array('MyFAQs', 'deactivate'));` --类名

## `add_meta_box()` ##
给插件开发者添加 Meta模块 到管理界面。

	add_meta_box( string $id, string $title, callable $callback, 
		string|array|WP_Screen $screen = null, string $context = 'advanced', 
		string $priority = 'default', array $callback_args = null )
	$id
		（string）（必需）Meta模块的 HTML“ID”属性
	$title
		(string)（必需）Meta模块的标题，对用户可见
	$callback
		(callback) （必需）为Meta模块输出 HTML代码的函数
	$screen
		(mixed)（必需）显示Meta模块的文章类型，可以是文章（post）、页面（page）、链接（link）、附件（attachment） 或 自定义文章类型（自定义文章类型的别名）
	$context 
		(string) （可选）Meta模块的显示位置（’normal’,’advanced’, 或 ‘side’）
	$priority
		(string) （可选）Meta模块显示的优先级别（’high’, ‘core’, ‘default’or ‘low’）
	$callback_args
		(array) （可选）传递到 callback 函数的参数。callback 函数将接收 $post 对象和其他由这个变量传递的任何参数。