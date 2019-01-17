# WordPress学习笔记 #
总结 WordPress 学习笔记和开发总结。

Author：huimingdeng

## 主题开发 ##
Jan 9,2019 主题开发笔记。

### 主题配置项 ###
对主题 `Mega Magazine` 配置自定义设置，配置信息保存在`wp_posts`表中`post_content`字段中，例如：（P.S. `mega-magazine::xxxx` 表示主题特有的，）

	{
	    "mega-magazine::top_menu": { //主题顶部菜单设置 如下面分析图序号1所示
	        "value": true,   // true：启用菜单
	        "type": "theme_mod",
	        "user_id": 1,  // 设置人员的ID
	        "date_modified_gmt": "2019-01-15 02:35:47" // 主题设置时间，发布时间
	    },
	    "mega-magazine::social_icons": { // 社交图标设置，顶部 如下面分析图序号2所示
	        "value": true,
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:35:47"
	    },
	    "mega-magazine::home_icon": { // 是否启用主题 Mega Magazine 的主页图标按钮 如下面分析图序号3所示
	        "value": true,
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:35:47"
	    },
	    "mega-magazine::show_search": { // 是否显示主题的搜索框 如下面分析图序号5所示
	        "value": true,
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:35:47"
	    },
	    "mega-magazine::breaking_news_cat": { // Mega Magazine 主题的首页的轮播文字新闻 效果如下面分析图序号4所示
	        "value": "3",
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:35:47"
	    },
	    "mega-magazine::hide_blog_post_cat": { // 设置隐藏文章目录，如下图7中设置的文章不显示分类目录
	        "value": true,
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:36:25"
	    },
	    "mega-magazine::social_link_1": {
	        "value": "https://www.csdn.net/",
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:36:43"
	    },
	    "mega-magazine::social_link_2": {
	        "value": "https://github.com/",
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:37:43"
	    },
	    "mega-magazine::cat_color_2": {
	        "value": "#dd0808",
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:38:06"
	    }
	}

分析示意图1
![Mega Magazine 主题配置分析](https://i.imgur.com/Q0ln8PM.png)

	{
	    "mega-magazine::blog_layout": { // 设置主页的布局，如上图的7号位置边导航在右边显示
	        "value": "right-sidebar",
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-17 08:05:49"
	    },
	    "mega-magazine::hide_blog_post_cat": { // 设置隐藏文章目录
	        "value": true,
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-17 08:05:49"
	    }
	}

每设置一次，若在`wp_posts` 中无法找到相关配置，则新生成。

	{
	    "blogdescription": { // 博客描述，value为空，则没有，一般为创建时候显示的:
	        "value": "",
	        "type": "option",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:32:45"
	    },
	    "mega-magazine::logo_type": { // 主题logo类型 title-desc:显示的是WordPress的站点标题和描述（站点副标），描述情况就是前一个设置值为空
	        "value": "title-desc",
	        "type": "theme_mod",
	        "user_id": 1,
	        "date_modified_gmt": "2019-01-15 02:32:45"
	    }
	}

### 主题小工具 ###
Jan 9,2019 主题小工具开发。

针对主题开发特定功能的小工具，例如: [Tools](https://github.com/huimingdeng/hello-world/blob/master/Note/Wordpress/Tools.md "WordPress小工具开发教程")


## 插件开发 ##
Jan 9,2019 插件开发笔记。

曾开发插件参考：[genecopoeia 库](https://github.com/huimingdeng/genecopoeia "插件案例")
