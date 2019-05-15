# Docker

以前在 centos 上安装过 docker 但没有创建一份专门记录 docker 使用经验的文档（P.S. 因最近需要用到 docker 了）

## win10 安装 docker

win10 家庭版安装 docker 很坑，特升级到专业版后安装的 docker for window （因为需要专业版或企业版才能安装，要么家庭版装 dockertoolbox ，本人的安装出错，所以升级到企业版）

### docker 配置（windows 版）

双击docker 图标启动 docker 后，右键启动后的docker 图标，然后选择 setting 进入 daemon 模块，勾选 Advance ，输入 [http://f1361db2.m.daocloud.io](http://f1361db2.m.daocloud.io "国内镜像地址") 切换镜像地址，点击 apply 等待 docker 重启完成设置。

![Daemon 设置](https://i.imgur.com/D3f78SP.png)

windows `cmd` 中输入 `docker version` 查看是否正确安装。

![查看版本](https://i.imgur.com/azihbXA.png)

### docker 常用命令

经常使用的命令备忘：

    docker run <images> 创建并运行容器
    docker create <images> 创建容器但不运行
    docker ps|docker ps -a 查找运行中的容器|查找所有容器
    docker rm -[f|l|v] <containername> 删除容器
    docker rmi <images> 删除本地镜像，不在使用状态的
    docker <command> --help 命令帮助查看
    ... ...

P.S. 命令详细请查看菜鸟 docker 教程查找——[docker 命令大全](http://www.runoob.com/docker/docker-command-manual.html "docker命令大全")

## [ubuntu 安装 docker](https://docs.docker.com/install/linux/docker-ce/ubuntu/)

Docker需要64的操作系统。此外你的kernel内核至少要在3.10版本之上。

![内核信息](https://i.loli.net/2019/05/15/5cdb7fb49ccb720351.png "内核信息")

更新 `apt `源 `sudo apt-get update`

`sudo apt-get install apt-transport-https ca-certificates` apt 使用 https 协议工作，安装 ca 证书 或  `sudo apt-get install -y apt-transport-https ca-certificates curl software-properties-common`

查找docker-ce和docker-ce-cli版本，安装稳定版：apt-cache madison <docker-ce|docker-ce-cli>

```
sudo apt-get install docker-ce=<VERSION_STRING> docker-ce-cli=<VERSION_STRING> containerd.io
eg. sudo apt-get install docker-ce=5:18.09.0~3-0~ubuntu-xenial docker-ce-cli=5:18.09.0~3-0~ubuntu-xenial containerd.io
```

执行 `sudo docker run hello-world` 

![docker](https://i.loli.net/2019/05/15/5cdb9e304b3ae73265.png)

卸载docker `sudo apt-get purge docker-ce`

删除docker文件 `sudo rm -rf /var/lib/docker`

## docker 安装 mysql

docker 下载MySQL `docker pull mysql:5.7` 或 `sudo docker pull mysql:5.7`。

创建MySQL容器：

    docker run -d -v E:/docker-setting/conf/mysql-log:/var/log/mysql -v E:/docker-setting/conf/mysql-conf:/etc/mysql/conf.d -p 3306:3306 -e MYSQL_ROOT_PASSWORD=root --name mysql57 mysql:5.7
    -d: 后台运行容器
    -v: 绑定挂载到指定盘符位置
    -p: 设置端口,将容器中的端口发布到该容器（mysql）
    -e: 设置环境变量

## docker 安装 php

docker 下载 PHP `docker pull php:7.2.15-fpm`

    docker run -d -v E:/docker-setting/www:/var/www/html -p 9000:9000 --link mysql57:mysql --name php72 php:7.2.15-fpm  
    -d 让容器在后台运行
    -v 添加目录映射
    -p 添加宿主机到容器的端口映射(宿主机端口:容器端口)
    --link 与另外一个容器建立起联系 
    –name 容器的名字

运行 php72 进入Linux 安装MySQL扩展：

    docker exec -ti php72 /bin/bash //root,进入docker Linux
    root@cc073b681e2c:/# docker-php-ext-install pdo_mysql    
    root@cc073b681e2c:/# docker-php-ext-install mysqli 
    root@cc073b681e2c:/# php-m // 查看扩展安装情况

## docker 安装 nginx

使用 docker 安装 nginx `docker pull nginx:1.10.3 `

    docker run -d -p 80:80 -v E:/docker-setting/www:/var/www/html --link php72:phpfpm --name nginx110 nginx:1.10.3  
    -d 让容器在后台运行
    -v 添加目录映射(这里的宿主路径一定要与php的一致)
    -p 添加宿主机到容器的端口映射(宿主机端口:容器端口)
    --link 与另外一个容器建立起联系 
    –name 容器的名字

进入配置 nginx

    docker exec -it nginx110 /bin/bash
    root@cc73b681e2c:/# vim /etc/nginx/conf.d/default.conf

P.S. docker 可能没装 vim 编辑器，需要更新一下源，然后安装 `apt-get update` `apt-get -y install vim` --  Unable to locate package vim

修改配置文件：

     root@cc073b681e2c:/# /etc/init.d/nginx reload  //配置完后重启 nginx

若在 localhost 中启动没有打开 phpinfo() 信息则 default.conf 配置错误

## docker 安装 centos7

因为在 docker 中分别启动 php7 mysql5.7 nginx 等服务，在不熟悉参数情况下映射目标，没有达到自身想要的结果，因此使用 d`ocker pull centos7` 下载.

运行镜像，生成容器

    docker run -it centos:7 /bin/bash

在 centos7 中 `yum update` 更新源，然后安装各中库，编译安装 lnmp 环境：

    [root@92c2211a9b36 ~]# yum -y install gcc automake autoconf libtool make
    [root@92c2211a9b36 ~]# yum -y install gcc gcc-c++ glibc

P.S. 退出后可执行 `docker attach 92c2211a9b36 ` 再次进入

[基于docker，lnmp+https搭建](https://segmentfault.com/a/1190000018729523 "基于docker, 快速搭建Nginx+Php+https本地开发环境, 免于手动安装PHP扩展")
