# Composer #
composer 笔记； 学习来源：[composer中文网](https://www.phpcomposer.com/ "composer 中文网") 或后盾人的视频教程：[PHP Composer 视频教程](http://www.php.cn/course/677.html "PHP Composer 视频教程")

## 安装 ##
composer 安装，参考 composer 中文网（官网）安装，Linux 建议全局安装，便于使用。

版本需求，`PHP5.3+` `OPENSSL` 必须开启。 

## composer 访问的原理 ##
composer 命令执行，访问 composer 的应用市场，应用市场搜索应用，然后访问 GitHub 的代码，然后下载返回用户。

![composer 访问原理](https://i.imgur.com/lsw16yv.png)


### 镜像源修改命令 ###
因为国外镜像延迟问题，可以使用国内镜像

1. 国外镜像源：[https://repo.packagist.org/](https://repo.packagist.org/ "国外镜像源")
2. 国内镜像源：[https://packagist.phpcomposer.com/](https://packagist.phpcomposer.com "国内镜像源")

全局修改，官方推荐方式：

	composer config -g repo.packagist composer https://packagist.phpcomposer.com

修改项目中的 `composer.json` 文件的镜像源

	composer config repo.packagist composer https://packagist.phpcomposer.com

## GitHub 项目仓库 ##
上传项目到 GitHub 上

### 创建 composer.json ###
composer.json 文件创建，管理应用。
