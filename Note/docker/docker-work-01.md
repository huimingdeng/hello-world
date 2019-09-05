# 作业操作笔记01

1. Redis 性能优化01 docker 基础，基于 centos 手动创建nginx服务。

2. 测试指令，修改docker容器内部的centos的源

## 操作记录

`docker pull contos` 拉取最新版本 centos 系统。

运行 `docker run -itd --name nginx-centos-2 centos`

进入容器 `docker attach f22b73076209`

```bash
# 安装库
yum install make wget tar gzip passwd openssh-server gcc pcre-devel openssl-devel net-tools vim -y
rm -rf /etc/yum.repos.d/*
# 更新源
wget -P /etc/yum.repos.d/ http://mirrors.163.com/.help/CentOS7-Base-163.repo
# 下载 nginx
wget -P /tmp/ http://nginx.org/download/nginx-1.14.2.tar.gz
# 切换临时目录，解压 nginx 
cd /tmp/
tar xzf nginx-1.14.2.tar.gz
# 切换到解压目录，替换服务器版本号信息等
cd nginx-1.14.2
sed -i -e 's/1.14.2//g' -e 's/nginx\//WS/g' -e 's/"NGINX"/"WS"/g' src/core/nginx.h
# 编译 安装 nginx
./configure --prefix=/usr/local/nginx --with-http_stub_status_module --with-http_ssl_module
make
make install
```

安装库：

![ZnTadF39l4Urs5x](https://i.loli.net/2019/09/05/ZnTadF39l4Urs5x.png)

更新源：

![UIAMibJkWPmKNDy](https://i.loli.net/2019/09/05/UIAMibJkWPmKNDy.png)

下载，解压，编译 nginx：

![msOS4lKVeZav83F](https://i.loli.net/2019/09/05/msOS4lKVeZav83F.png)

安装 `make && make install`  

![RbNckVTs4gWPlov](https://i.loli.net/2019/09/05/RbNckVTs4gWPlov.png)

启动失败：

![DnC7FaiguSA8TZU](https://i.loli.net/2019/09/05/DnC7FaiguSA8TZU.png)
