# WordPress 6.0.1 源码阅读

因长期维护低版本WordPress，但没认值研究过源码，特记录阅读笔记

## 目录文件结构

```shell
$ ls -l
total 324
-rw-r--r-- 1 huimingdeng 197121   405  9月  3 07:28 index.php
-rw-r--r-- 1 huimingdeng 197121 19915  9月  3 07:28 license.txt
-rw-r--r-- 1 huimingdeng 197121    38  9月  3 07:49 nginx.htaccess
-rw-r--r-- 1 huimingdeng 197121   483  9月  3 07:28 readme.md
-rw-r--r-- 1 huimingdeng 197121  7165  9月  3 07:28 wp-activate.php
drwxr-xr-x 1 huimingdeng 197121     0  9月  3 07:28 wp-admin/
-rw-r--r-- 1 huimingdeng 197121   351  9月  3 07:28 wp-blog-header.php
-rw-r--r-- 1 huimingdeng 197121  2338  9月  3 07:28 wp-comments-post.php
-rw-r--r-- 1 huimingdeng 197121  3282  9月  3 07:30 wp-config.php
-rw-r--r-- 1 huimingdeng 197121  3001  9月  3 07:28 wp-config-sample.php
drwxr-xr-x 1 huimingdeng 197121     0  9月 11 09:17 wp-content/
-rw-r--r-- 1 huimingdeng 197121  3943  9月  3 07:28 wp-cron.php
drwxr-xr-x 1 huimingdeng 197121     0  9月  3 07:28 wp-includes/
-rw-r--r-- 1 huimingdeng 197121  2494  9月  3 07:28 wp-links-opml.php
-rw-r--r-- 1 huimingdeng 197121  3973  9月  3 07:28 wp-load.php
-rw-r--r-- 1 huimingdeng 197121 48498  9月  3 07:28 wp-login.php
-rw-r--r-- 1 huimingdeng 197121  8577  9月  3 07:28 wp-mail.php
-rw-r--r-- 1 huimingdeng 197121 23706  9月  3 07:28 wp-settings.php
-rw-r--r-- 1 huimingdeng 197121 32051  9月  3 07:28 wp-signup.php
-rw-r--r-- 1 huimingdeng 197121  4748  9月  3 07:28 wp-trackback.php
-rw-r--r-- 1 huimingdeng 197121  3236  9月  3 07:28 xmlrpc.php
```

## 入口文件

`index.php`

```php
/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define( 'WP_USE_THEMES', true );

/** Loads the WordPress Environment and Template */
require __DIR__ . '/wp-blog-header.php';
```

### 作用

- 定义了常量`WP_USE_THEMES`，默认为`true`
- 引入环境及模板

## 博客头文件

`wp-blog-header.php`

```php
/**
 * Loads the WordPress environment and template.
 *
 * @package WordPress
 */

if ( ! isset( $wp_did_header ) ) {

	$wp_did_header = true;

	// Load the WordPress library.
	require_once __DIR__ . '/wp-load.php';

	// Set up the WordPress query.
	wp();

	// Load the theme template.
	require_once ABSPATH . WPINC . '/template-loader.php';

}
```

### 作用

- 定义博客头变量`$wp_did_header`
- 加载WordPress库`wp-load.php`
- 设置查询
- 加载模板`template-loader.php`

下面先看加载库文件`wp-load.php`

### wp-load.php

打开进入`wp-load.php`文件

```php
/** Define ABSPATH as this file's directory */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}
```

首先判断是否定义常量`ABSPATH`，为项目文件的目录。

```php
if ( function_exists( 'error_reporting' ) ) {
	/*
	 * Initialize error reporting to a known set of levels.
	 *
	 * This will be adapted in wp_debug_mode() located in wp-includes/load.php based on WP_DEBUG.
	 * @see http://php.net/manual/en/errorfunc.constants.php List of known error levels.
	 */
	error_reporting( E_CORE_ERROR | E_CORE_WARNING | E_COMPILE_ERROR | E_ERROR | E_WARNING | E_PARSE | E_USER_ERROR | E_USER_WARNING | E_RECOVERABLE_ERROR );
}
```

接着定义了函数`error_reporting`，用于启用`PHP`错误调试等级。

```php
if ( file_exists( ABSPATH . 'wp-config.php' ) ) {

	/** The config file resides in ABSPATH */
	require_once ABSPATH . 'wp-config.php';

} elseif ( @file_exists( dirname( ABSPATH ) . '/wp-config.php' ) && ! @file_exists( dirname( ABSPATH ) . '/wp-settings.php' ) ) {

	/** The config file resides one level above ABSPATH but is not part of another installation */
	require_once dirname( ABSPATH ) . '/wp-config.php';

} else {
	...
}
```

最后，判断项目根目录是否存在`wp-config.php`，存在则加载数据库及网站配置信息；否则需要创建`wp-config.php`文件，并且运行程序安装WordPress。

#### 安装Wordpress

```php
// A config file doesn't exist.
define( 'WPINC', 'wp-includes' );
require_once ABSPATH . WPINC . '/load.php';
```

定义常量`WPINC`，存储字符串'wp-includes'，为目录名称。

```php
// Standardize $_SERVER variables across setups.
wp_fix_server_vars();
require_once ABSPATH . WPINC . '/functions.php';
$path = wp_guess_url() . '/wp-admin/setup-config.php';
```

PS. 后续将用思维导图记录。