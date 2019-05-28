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
		... 

对应 wordpress 后台编辑页面中的`页面属性`，如果一套主题没有模板，那么 Page 的页面属性就没有模板选项，剩下`父级`和`排序`选项。



## WooCommerce 插件主题 ##
配套管理用户订单信息插件：[Custom My Account for Woocommerce](https://cn.wordpress.org/plugins/custom-my-account-for-woocommerce/ "Custom My Account for Woocommerce")
