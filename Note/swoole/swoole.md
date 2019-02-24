# swoole 学习笔记 #
因工作原因，落后太多，学习记录笔记，积累补充学习。

## swoole 安装 ##
腾讯云安装 swoole 

docker 安装lnmp+swoole:(windows10家庭版 docker 需要安装DockerToolbox)

## swoole 心跳检测 ##
心跳：判断事物生死的标准，判断一个连接是否正常还是断开。

涉及到4层协议(应用层/传输层/网络层/数据链路层)
![TCP/IP协议族](https://i.imgur.com/n2Zr1Ua.png)

### tcp 粘包处理 ###
发送方：发送需要等缓冲区满才发送，造成粘包

接收方：

1. 手动处理
2. EOF 结束协议
3. 

## swoole server&client ##




## docker ##
win10家庭版安装 docker 的坑，需要使用 dockertoolbox 安装 docker ；但该工具安装 docker 启动后报错：

![docker-win10 errors](https://i.imgur.com/8qUv8EG.png)

### docker 处理 ###