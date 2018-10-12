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