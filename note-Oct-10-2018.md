# 笔记 #
记录 Oct,10,2018 安装 VMware 15.x 版本及 CentOS7 遇到的问题和处理方法。（为了安装一个 VMware Tools，导致引发的一系列问题）

## VMware 安装 CentOS7 ##
详细安装步骤可参考博客：[VMware安装14.0安装CentOS7.2](https://blog.csdn.net/guo_ridgepole/article/details/78973763 "VMware安装14.0安装CentOS7.2") 

## 安装完CentOS7后遇到的问题 ##

1. 当前CentOS7系统没有安装 Perl，处理方法可参考：[CentOS7.4 安装 perl 环境](https://blog.csdn.net/fxbin123/article/details/80719621 "CentOS7.4 安装 perl 环境")。
2. wget 下载 Perl 发现没安装 wget，处理方法：` yum -y install wget ` ,发现 yum 报错。
3. yum 下载安装 wget 报错：cannot ... baseURL，处理方法可参考博客：[CentOS7用yum安装软件提示 cannot find a valid baseurl for repobase7x86_64](https://blog.csdn.net/qq_23212697/article/details/69305822 "CentOS7用yum安装软件提示 cannot find a valid baseurl for repobase7x86_64")。
4. 下载安装 Perl-5.26.1，
	1. 解压 `tar -zxvf perl-5.26.1.tar.gz -C /opt`；
	2. 进入目录 `cd /opt/perl-5.26.1/`；
	3. `[root@node1 perl-5.26.1]#  ./Configure -des -Dprefix=/opt/perl`；
	4. 注：如果运行会提示带有cc的语句 `yum -y install gcc`；
	5. 编译并检测： `make && make test` 报错 make: xxx No targets specified and no makefile found. Stop.，处理参考：[linux make报错make: *** No targets specified and no makefile found. Stop.解决方法](http://www.eqdh.com/index.php/archives/479 "linux make报错make: *** No targets specified and no makefile found. Stop.解决方法").
5. .... 编译 Perl `make && make test` 后，虚拟机挂掉了
6. 最终检测，原因是联网不成功，设置IP后，ping通网络后使用`yum install perl*` 成功安装 perl5 。
7. 安装 VMware tools，在 vmware-tools-distrib 目录执行 `./vmware-install.pl`，提示：The path "" is not a valid path to the ... ,处理：`yum -y install kernel-$(uname -r)` 
8. **扩容问题**：（P.S.也可参考[百度经验](https://jingyan.baidu.com/article/54b6b9c0fc8b0b2d583b47c6.html "Linux系统下增加LV（逻辑卷）容量")）
	1. 由安装的 30GB 扩展到 50GB ，（P.S. 只扩容，磁盘数不加） `df -h`命令查看空间
	2. `fdisk /dev/sda` 详细步骤参考：[VMware内CentOS7虚拟机硬盘扩容](https://blog.csdn.net/Wang_Xin_SH/article/details/77872885 "VMware内CentOS7虚拟机硬盘扩容")
	3. 重启后查看分区类型 `df -T /dev/sda1` 类型为xfs，与上面教程一致
	4. 在新磁盘上创建xfs文件系统 `mkfs.xfs /dev/sda3` 
	5. 创建PV `pvcreate /dev/sda3` WARNING: xfs signature detected on /dev/sda3 at offset 0. Wipe it? [y/n]:  （P.S. 输入 y）
	6. `pvdisplay` 会显示新的物理卷扩容数，我这里是 20 GB (***"/dev/sda3" is a new physical volume of "20.00 GiB"***)
	7. PV加入VG，vgextend后接VG Name，本例中为 centos 和教程中的 cl 不一样 `vgdisplay`
	8. `vgextend centos /dev/sda3` 显示 （***Volume group "centos" successfully extended***）
	9. VG加入LV `lvextend -l +5120 /dev/centos/root` 记住这里是 centos ，输入的是第7步中的VG Name，否则出错。（P.S.加入逻辑卷中，+2559：为 `vgdisplay`命令中显示的 Free PE/Size 字段，而我这边是 5120 ，/dev/cl/root:为 `lvdisplay` 命令显示中的 LV Path ）
	10. 调整文件系统大小，本例中是xfs文件系统使用xfs_growfs命令调整，若其他文件系统，如ext4使用resize2fs命令，注意区分： `xfs_growfs /dev/centos/root` （教程中：`xfs_growfs /dev/cl/root`）最终，我的数据块由6GB(7075840)更改为11GB(12318720)
	11. `df -h` 查看最终修改数据 显示47GB，加上已经使用的等各种数据，证明已经从30GB扩容到50GB。
	12. pv、lv、vg 详解：(P.S.参考：[Linx 卷管理详解--VG LV PV](https://blog.csdn.net/wuweilong/article/details/7565530 "Linx 卷管理详解--VG LV PV"))
		1. PV：物理卷（physicalvolume）；指硬盘分区或从逻辑上与磁盘分区具有同样功能的设备(如RAID)，是LVM的基本存储逻辑块，但和基本的物理存储介质（如分区、磁盘等）比较，却包含有与LVM相关的管理参数。
		2. LV:逻辑卷（logicalvolume）; LVM的逻辑卷类似于非LVM系统中的硬盘分区，在逻辑卷之上可以建立文件系统(比如/home或者/usr等)。
		3. VG：卷组（Volume Group）；LVM卷组类似于非LVM系统中的物理硬盘，其由物理卷组成。可以在卷组上创建一个或多个“LVM分区”（逻辑卷），LVM卷组由一个或多个物理卷组成。

Oct 10,2018:
<h3>最终发现只是处理解决了如下问题：</h3>

1. yum 安装成功
2. wget 安装成功
3. gcc 安装成功
4. 配置网络，yum 安装 Perl.(P.S.检测 yum 能否成功安装互联网资源)


P.S. 感谢各位 CSDN 的博主以及互联网上的无名工作者，虽然部分博客不能解决安装中具体遇到的问题，但提供比较好的相关知识，帮助理解和处理、储备知识。

## CentOS 安装 docker (以前面虚拟机中的CentOS为例) ##
docker 需要 CentOS 内核版本为 3.10 及以上。本地安装的CentOS7如图：
![eg.本地安装的CentOS7](https://i.imgur.com/RTOPp4M.png)
或使用 `uname -r` 可以直观的查看。

1. 更新 yum ：root 用户直接 `yum update`,其它用户在 sudo 组则 `sudo yum update`
2. 如果存在旧版本的 docker 则可以执行命令卸载 `sudo yum remove docker  docker-common docker-selinux docker-engine` 
3. 安装需要的软件包， yum-util 提供yum-config-manager功能，另外两个是devicemapper驱动依赖的 `sudo yum install -y yum-utils device-mapper-persistent-data lvm2`
4. 设置yum源 `sudo yum-config-manager --add-repo https://download.docker.com/linux/centos/docker-ce.repo` <br> ![设置yum](https://i.imgur.com/I1dnUyr.png)
5. 可以查看仓库中 docker 版本 `yum list docker-ce --showduplicates | sort -r` <br> ![2018.10.12-docker-version](https://i.imgur.com/Fq9KnGx.png) 
6. 开始安装 docker 了：<br> 
`sudo yum install docker-ce` 由于repo中默认只开启stable仓库，故这里安装的是最新稳定版 18.03.1 <br>
`sudo yum install <FQPN>` eg. `sudo yum install docker-ce-18.06.1.ce7` <br> 
这里采用了默认安装 <br> 
![默认安装docker最新版18.06.1.ce](https://i.imgur.com/ltViogP.png)
7. 启动并加入开机启动 <br> `sudo systemctl start docker` <br> `sudo systemctl enable docker`
8. 验证是否成功安装 docker： <br> 
**`docker version`** <br>
<br>![安装docker验证](https://i.imgur.com/fKZJAQF.png)

## CentOS7 安装 ftp服务器(vsftpd) ##

1. `witch vsftpd`或`rpm -aq vsftpd` 发现虚拟机中的 centOS7 系统没有安装服务器，使用命令 `yum update`更新 yum; `yum -y install vsftpd`命令安装ftp服务器。
2. 配置 vsftpd 服务器，`vim /etc/vsftpd/vsftpd.conf` 关闭匿名用户 **`anonymous_enable=ON`**，测试的时候则开启；设置两项为： yes 
<br> 
**`anon_upload_enable=YES`**<br> 
和 **`anon_mkdir_write_enable=YES`**；<br><br> 
同时可以设置 vsftpd 为开机启动<br>![sudo systemctl enable vsftpd.service](https://i.imgur.com/ExI0d5Y.png)**图1** <br>
重启ftp服务器 `sudo systemctl restart vsftpd.service`。<br>

3. 查看当前安装ftp的状态：`sudo getsebool -a|grep ftp` <br> ![sudo getsebool -a|grep ftp](https://i.imgur.com/8589w9n.png)**图2** <br> 然后设置 `ftpd_full_access ` 和 `tftp_home_dir` 为开启状态 `on` ；<br> 
执行命令`sudo setsebool -P allow_ftpd_full_access on` 和`sudo setsebool -P tftp_home_dir on` <br> 
![sudo setsebool -P allow_ftpd_full_access on](https://i.imgur.com/yW6f8oe.png) **图3** <br> 
![sudo setsebool -P tftp_home_dir on](https://i.imgur.com/spqSP8Y.png) **图4**
4. 或使用 `sudo systemctl status vsftpd.service` 查看ftp状态；接着在本地安装ftp进行测试：`sudo yum -y install ftp`,<br> 
测试能否链接使用：`ftp <username>`<br> 如图： 状态码：220和登陆后的状态码为：230表示连接成功。<br>
![ftp 测试](https://i.imgur.com/6Y0TUxa.png)**图5**
5. 这是后如果使用 Filezilla 等ftp工具连接虚拟机，发现连接不了，why? <br> 
是因为防火墙的问题了，需要写入规则，允许通过防火墙，不然外部无法访问。
6. 防火墙设置：<br> 选项：
	1. 开发21端口：`sudo firewall-cmd --zone=public --add-port=21/tcp --permanent`
	2. 永久开放21端口：`sudo firewall-cmd --add-service=ftp --permanent`
	3. 关闭ftp服务：`sudo firewall-cmd --remove-service=ftp --permanent`
	4. 不改变状态下，重新加载防火墙：`sudo firewall-cmd --reload`

7. 可能在使用到的命令（P.S.以下命令在非root用户请加上 `sudo`，若加了`sudo`提示没有在用户组中，则添加到`sudo`用户组）：<br>
`systemctl start firewalld`     启动防火墙服务 <br> 
`firewall-cmd --add-service=ftp`     暂时开放ftp服务 
<br> 
`firewall-cmd --add-service=ftp --permanent`    永久开放ftp服務<br>
`firewall-cmd --remove-service=ftp --permanent`    永久关闭ftp服務<br>
`systemctl restart firewalld`    重启firewalld服务<br>
`firewall-cmd --reload`    重载配置文件<br>
`firewall-cmd --query-service ftp`    查看服务的启动状态<br>
`firewall-cmd --list-all`    显示防火墙应用列表<br>
`firewall-cmd --add-port=8001/tcp`    添加自定义的开放端口<br>
`iptables -L -n | grep 21`    查看设定是否生效<br>
`firewall-cmd --state`    检测防火墙状态<br>
`firewall-cmd --permanent --list-port`    查看端口列表

8. 补充权限设置说明：<br>![权限设置-图1](https://i.imgur.com/MAcMpne.png)<br>其它配置项说明：
<br>
**anonymous_enable=YES** #允许匿名登陆 
<br>
**local_enable=YES** #启动home目录 
<br>
**write_enable=YES** #ftp写的权限 
<br>
**local_umask=022** 
<br>
**dirmessage_enable=YES** #连接打印的消息 
<br>
**connect_from_port_20=YES** #20端口 
<br>
**xferlog_std_format=YES**
<br>
**idle_session_timeout=600**
<br>
**data_connection_timeout=300** 
<br>
**accept_timeout=60** 
<br>
**connect_timeout=60** 
<br>
**ascii_upload_enable=YES** #上传 
<br>
**ascii_download_enable=YES** #下载 
<br>
**chroot_local_user=NO** #是否限制用户在主目录活动 
<br>
**chroot_list_enable=YES** #启动限制用户的列表 
<br>
**chroot_list_file=/etc/vsftpd/chroot_list** #每行一个用户名 
<br>
**allow_writeable_chroot=YES** #允许写 
<br>
**listen=NO**
<br>
**listen_ipv6=YES** 
<br>
**pasv_min_port=50000** 允许ftp工具访问的端口起止端口 
<br>
**pasv_max_port=60000** 
<br>
**pam_service_name=vsftpd** #配置虚拟用户需要的 
<br>
**userlist_enable=NO** #配置yes之后，user_list的用户不能访问ftp 
<br>
**tcp_wrappers=YES** 
<br>
**chroot_list** 文件需要自己建,内容一行一个用户名字 
<br>
**anon_root=/data/ftp/public** #修改匿名用户的访问路径
<br>

----------
#### 测试： ####
**上传前：**<br>
![完成链接测试](https://i.imgur.com/tGyq2Ke.png)
<br>**上传后：**<br>
![上传后](https://i.imgur.com/21bP7GT.png)
**Linux 上面的目录：**<br>
![linux 查找目录](https://i.imgur.com/B92be1H.png)

**P.S. 完成测试，可以链接到虚拟机系统上的FTP，进行上传和下载**   —— Oct,16,2018

 

 





