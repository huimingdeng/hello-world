## Docker目录说明

当前目录目前记录了学习 `docker` 操作中遇到的问题和笔记.

### 文档指引

- [docker-nginx.md](./docker-nginx.md) 学习Redis 性能优化docker操作作业衍生的错误配置记录笔记。

- [docker-work-01.md](./docker-work-01.md)  学习 Redis 性能优化作业操作笔记 01
  
  - 作业参考：[Dockerfile基于Centos7安装nginx容器](https://blog.51cto.com/msiyuetian/2345072?source=dra)

#### P.S. 普通用户可用 docker

```bash
groupadd docker # 创建 docker 用户组
sudo gpasswd -a ${USER} docker # 添加当前用户，如果是在sudo用户在
[root@localhost] gpasswd -a <user> docker # 切换 root 用户，执行设置非当前用户
chmod a+rw /var/run/docker.sock # 增加权限给非sudo用户组的普通用户，不报警告或错误信息
```


