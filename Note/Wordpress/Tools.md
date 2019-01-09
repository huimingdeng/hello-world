# 小工具开发 #
记录如何开发或二次开发一个主题小工具或者WordPress系统小工具。

如何开发小工具参考文章 [创建你的第一个WordPress小工具](https://www.wpdaxue.com/creat-your-first-wordpress-widget.html "创建你的第一个WordPress小工具")

或参考 [一步步创建你的第一个 WordPress 小工具](https://www.wpdaxue.com/series/creating-your-first-wordpress-widget/ "一步步创建你的第一个 WordPress 小工具") 系列文章。

## Mega-Magazine 主题二次开发 ##
因需求，需要进行 **`Mega Magazine`** 主题的二次开发，需要添加一个广告工具。当前主题为 1.1.0,可以下载主题研究学习。

### MM:AD Tool ###
开发 **`MM:AD`** 广告挂件。

在主题 `mega-magazine` 目录中，找到 `function.php` 查看小工具初始化函数：

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	function mega_magazine_widgets_init() {
		register_sidebar( array(
			'name'          => esc_html__( 'Sidebar', 'mega-magazine' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'mega-magazine' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
	
		... ...
	
		register_sidebar( array(
			'name'          => esc_html__( 'Header Advertisement', 'mega-magazine' ),
			'id'            => 'advertisement-1',
			'description'   => esc_html__( 'Add widgets here.', 'mega-magazine' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) );
		// 可以在后面添加新区域
	}
	add_action( 'widgets_init', 'mega_magazine_widgets_init' );

在 function.php 中找到路径；详细的小工具开发位置为 `mega-magazine/inc/widgets/` 目录下：

![WordPress widgets development](https://i.imgur.com/Tk0nDme.png)