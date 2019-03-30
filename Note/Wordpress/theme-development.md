# WordPress 主题开发 #
模仿 `twentyfifteen` 等默认主题进行学习，同时当前 wordpress 最新版本为 5.1.1 必须是 `php7.3` + `mysql5.6/mariadb10.0+` 不小心生成环境升级踩坑 -- March,29,2019

## 主题模板 ##
WordPress 中一套主题首页可以设置最新文章或默认首页的方式显示。而默认首页一般要在后台中创建 Page 然后选择对应模板。

`mega-magazine` 主题为例：

	mega-magazine/
		assets/
		inc/
		template-parts/
		templates/
			home.php -- 为后台首页模板，因此开发主题模板在主题目录上的templates目录中创建模板
