# docker 安装nginx

基于centos系统在docker搭建nginx。

## docker 拉取相关镜像

全部默认拉取，不具体到某一版本。

1. `docker pull centos`

2. `docker pull nginx`

![pfPyb3NRFqleZWC](https://i.loli.net/2019/09/05/pfPyb3NRFqleZWC.png)

## 搭建环境

1. `docker run -itd --name nginx-centos centos` 运行构建 centos 容器，命名为 `nginx-centos`.

2. 进入容器 `nginx-centos`: `docker attach 8a0611aa9854`
   
   1. 内部 `centos` 系统安装 `docker` : `yum install -y docker`
   
   2. ![dIF6HkWYl3iDmva](https://i.loli.net/2019/09/05/dIF6HkWYl3iDmva.png)
   
   3. 更改 `docker` 的镜像源：
      
      1. 首先安装一下 `vim`  `yum -y install vim`
      
      2. 编辑更改`docker`源：`vim /etc/docker/daemon.json`
      
      3. ```json
         {
             "registry-mirrors":["http://hub-mirror.c.163.com"]
         }
         ```
      
      4. 重启 `docker`: `systemctl restart docker`
      
      5. 重启失败：因为这是基于docker，而不是基于宿主机，所以无法连接到镜像源？还是因为权限问题？
         
         1. 参考解决方案：[配置centos7解决 docker Failed to get D-Bus connection 报错](https://blog.csdn.net/xiaochonghao/article/details/64438246)
         
         2. 退出容器，尝试处理。

3. 安装`nginx` ：
   
   1. 




