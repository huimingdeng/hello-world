# Win7 安装docker

[下载地址](http://mirrors.aliyun.com/docker-toolbox/windows/docker-toolbox/) ，我选择的是默认安装，当然也可以选择磁盘安装，遇到问题和下面解决方案一致，我这里下载的安装包是 `DockerToolbox-1.12.6.exe` 

## 安装

根据程序，不修改安装目录默认安装，默认安装路径为：

```powershell
C:\Program Files\Docker Toolbox
```

此时在 `cmd` 或 `git-bash` 窗口执行命令 `docker info` 会报错:

```shell
$ docker info
An error occurred trying to connect: Get http://%2F%2F.%2Fpipe%2Fdocker_engine/v1.24/info: open //./pipe/docker_engine: The system cannot find the file specified.
$ docker-machine.exe ls # 没找到default
NAME      ACTIVE   DRIVER       STATE     URL                         SWARM   DOCKER    ERRORS
```

是因为安装的 `docker-quickstart-terminal` 启动快捷方式无效，需要手动设置

1. 执行命令 `docker-machine env default` 如果提示没有 `default` 在需要手动创建

   1.  断网 —— 断开 win7 网络连接，`控制面板\网络和 Internet\网络连接` 将在使用的适配器禁用。
   2. `git-bash` 窗口执行下面命令执行：

   ```shell
   docker-machine create --driver virtualbox default
   ```

2. 每次启动 `cmd` 或 `git-bash` 都需要配置一下，否则报错：

   1. `cmd` 窗口执行

   ```powershell
   docker-machine env --shell cmd default #
   @FOR /f "tokens=*" %i IN ('docker-machine env --shell cmd default') DO @%i
   ```

   `git-bash` 窗口则执行

   ```shell
   docker-machine env default
   eval $("C:\Program Files\Docker Toolbox\docker-machine.exe" env default)
   ```


## 连接

默认的用户名和密码为

> user: docker
>
> pass: tcuser

```shell
ssh docker@192.168.99.100
```

![](images\docker-ok.png)

## 缺陷之系统盘超负荷

默认的虚拟机位置在如下位置:

```powershell
C:\Users\<YourName>\.docker\machine\machines
```

需要在`cmd` 或 `git-bash` 命令窗口，执行下面命令，停止`docker`服务

```shell
docker-machine stop default
```

![step-00](images\step-00.png)

![step-01](images\step-01.png)

![step-02](images\step-02.png)

![step-03](images\step-03.png)

```shell
docker-machine start default
docker-machine restart default # 重启命令
```



