# win10-ubuntu 使用总结笔记 #
win10 子系统功能： Linux 安装了 Ubuntu 子系统。

## 设置步骤 ##
win10 打开控制面板->程序->程序或功能->启用或关闭window功能->适用于Linux的Windows子系统(勾选这一项)->提示重启电脑(重启)->win10应用商店搜索->选择安装Linux(个人安装Ubuntu)->等待->启用和设置密码->可在cmd:bash开启。

![win10子系统](https://i.imgur.com/OXgbj58.png)
![win10子系统Linux](https://i.imgur.com/9LKuh8U.png)

若这样还不够详细，请百度学习。

## Ubuntu 安装宝塔图形界面 ##
因为软件需要用到 python ，而本机已经装了 python3 可以安装 python2.7 `sudo apt install python`

因为镜像在国外，速度会很慢，备份文件，切换为国内镜像，参考阿里云文章：[windows10 安装wsl子系统 ubuntu进行php开发与调试](https://yq.aliyun.com/articles/548794# "windows10 安装wsl子系统 ubuntu进行php开发与调试")

如果是 python 有问题，需安装如下的python软件，这样宝塔才安装正确。

	sudo apt-get install python-dateutil python-docutils python-feedparser python-gdata python-jinja2 python-ldap python-libxslt1 python-lxml python-mako python-mock python-openid python-psycopg2 python-psutil python-pybabel python-pychart python-pydot python-pyparsing python-reportlab python-simplejson python-tz python-unittest2 python-vatnumber python-vobject python-webdav python-werkzeug python-xlwt python-yaml python-zsi

错误示例：
![错误示例](https://i.imgur.com/h3uU0uj.png)

安装成功：
![宝塔安装成功，显示账号和密码](https://i.imgur.com/XZBsLEm.png)

登陆界面：http://127.0.0.1:8888 ，选择 lnmp 或 lamp 部署，本人选择了 lnmp 部署；然后就是等待了（网络好就等待短，本人宿舍网络慢，因此等到天长地久 /(ㄒoㄒ)/~~）—— 后续因为无法安装，极速安装和编译安装都无法，所以卸载掉了。
![lnmp安装](https://i.imgur.com/HGowgHP.png)

详细教程：[BT.Cn/宝塔Linux面板的安装脚本+教程](https://www.gigsgigscloud.com/cn/tutorials/article/bt-panel/ "BT.Cn/宝塔Linux面板的安装脚本+教程")

	wget http://download.bt.cn/install/bt-uninstall.sh
	sudo sh bt-uninstall.sh //卸载宝塔面板和服务


## Hyer-V ##
微软的虚拟化技术，安装 docker 需要启用 Hyper-V 否则无法使用，如果启用 Hyper-V 但使用 VMware 虚拟机，则会报错：

	VMware Workstation 与 Device/Credential Guard 不兼容。在禁用 Device/Credential Guard 后，可以运行 VMware Workstation。

因此，目前 docker 和 VMware 只能使用其中一款，推荐使用 docker 不过若使用 VMware 则要关闭 Hyper-V 弃用 win10 的 docker 了。

VMware12.5 以上版本才会出现这种问题，因为最近想从 win7 迁移虚拟机到 win10 系统，而 win10 中已经开启了 Hyper-V 并安装了 docker ，从而导致迁移后的虚拟机无法使用。如图，取消 Hyper-V 重启电脑，测试能否使用 VMware.

![Hyper-V 和 VMware 冲突](https://i.imgur.com/Ozo4TJI.png)

### Hyper-V 安装 CentOS ###
因为需要使用 docker 和虚拟机技术，因此启用 Hyper-V 弃用 VMware ，用Hyper-V 安装 CentOS7 ，搭建 lnmp 环境。


#### 网络配置 ####
安装好 centos 后配置网络，使之可以通信。

1. 查看本机的IP地址: `ifconfig`
![查看本机IP](https://i.imgur.com/Is1rm6T.png)
2. 修改虚拟机网络配置: `vi /etc/sysconfig/network-scripts/ifcfg-eth0`
![修改虚拟机IP](https://i.imgur.com/EG7MK8u.png)
3. 重启网络配置: `systemctl restart network`
4. 测试互联网通信状态: `ping -c 3 baidu.com` -c 捉取包的个数，如果没有这个需要 `CTRL+C` 中断 `ping` 指令


