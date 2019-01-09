# widgets（小工具）开发 #
记录如何开发或二次开发一个主题小工具或者WordPress系统小工具。
本教程仅是个人开发总结，其它详细学习文章可以观看：

如何开发小工具参考文章 [创建你的第一个WordPress小工具](https://www.wpdaxue.com/creat-your-first-wordpress-widget.html "创建你的第一个WordPress小工具")

或参考 [一步步创建你的第一个 WordPress 小工具](https://www.wpdaxue.com/series/creating-your-first-wordpress-widget/ "一步步创建你的第一个 WordPress 小工具") 系列文章。

## Mega-Magazine 主题二次开发 widgets ##
因需求，需要进行 **`Mega Magazine`** 主题的二次开发，需要添加一个广告工具。当前主题为 1.1.0,可以下载主题研究学习。以下为开发引导教程：

### MM:Advertisement widget ###
开发 **`MM:Advertisement`** 广告挂件。该广告插件要求可以修改宽高，以及选择类型，可以选择图片并设置链接等功能。



### 主题 widgets 分析 ###

1、在主题 `mega-magazine` 目录中，找到 `function.php` 查看小工具初始化函数：

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

2、`mega_magazine_widgets_init` 函数实现功能说明（P.S. **示意图红色矩形区域**，**蓝色矩形部分**为 widgets 目录实现工具类后显示的效果。）：

![mega_magazine_widgets_init 函数说明](https://i.imgur.com/NCaUQZX.png)


3、在 function.php 中找到路径；详细的小工具开发位置为 `mega-magazine/inc/widgets/` 目录下：

![WordPress widgets development](https://i.imgur.com/Tk0nDme.png)

4、 `mega-magazine/inc/widgets/widgets.php` 文件为引入实现的具体工具类，该文件让 WordPress 激活当前主题后调用，实现后的效果如 2 中蓝色矩形部分。

5、主题 widgets 分析使用设置效果：

![widget-analyze](https://i.imgur.com/Jqg0sW1.png)

#### 例子： MM: Double Column News 分析学习 ####
以 `double-columns.php` 文件也就是类 `Mega_Magazine_Double_Columns`（部分代码见下面） 分析和继承的类 `WP_Widget` 学习。

	if ( ! class_exists( 'Mega_Magazine_Double_Columns' ) ) :

		class Mega_Magazine_Double_Columns extends WP_Widget {
			function __construct(){
				... ... // 该部分见下面序号 1、
			}
			... ...  
		}
	
	endif;

1、类 `Mega_Magazine_Double_Columns` 构造函数调用了父类 `WP_Widget` 中的构造函数 `__construct()` (此类中还保留着 PHP4 的构造函数：`WP_Widget` ，以下只分析`__construct()`,因为两者功能一样。)

	// Mega_Magazine_Double_Columns 类的构造函数
	function __construct() {
		$opts = array(
			// classname : 为前端HTML中 css 的class名
			'classname'   => 'double-news',
			// description : 为下面示意图中的红色矩形橙色高亮描述，图1
			'description' => esc_html__( 
				'Widget to display first two posts with large thumbnail and other with small thumbnail in double column', 
				'mega-magazine' 
			),
		);
		//调用了 WP_Widget 类的构造函数
		parent::__construct( 
			'mega-magazine-double-news', //Optional Base ID for the widget
			esc_html__( 'MM: Double Column News', 'mega-magazine' ), //后台显示名称，图1红色矩形黑色粗体
			$opts // 配置信息
		);
	}

![widget 构造函数配置项说明示例](https://i.imgur.com/eTrTiRN.png "图1")

### MM:Advertisement 开发 ###
1、在 `mega-magazine/inc/widgets/` 目录新建 PHP 文件 `advertisement.php` ,定义类 `Mega_Magazine_Advertisement` ，然后在该类中实现方法。

2、`Mega_Magazine_Advertisement` 类实现后再在 `widgets.php` 中引入 advertisement.php 文件。
并在函数 `mega_magazine_custom_widgets()` 中注册类 `Mega_Magazine_Advertisement`

