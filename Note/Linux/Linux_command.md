# Linux 常用命令汇总与实操笔记

因为最近在做Linux的试题，发现了自己许多不足之处，因此特创建该文档，对常用命令进行实操总结。

## CentOS

CentOS 操作记录（踩坑笔记）。

### yum 命令

1. `yum update` 和 `yum upgrade` 的区别。
   
    因为日常工作中在 centos 中很少进行 `yum update` 和 `yum upgrade` 命令，只有在虚拟机中会使用这两个命令，一直认为两者区别不大，但实质上操作后发现 `yum update` 确实会更改系统内核信息，而 `yum upgrade` 没有变更内核信息，因此生产环境要慎用 `yum update` 命令。(o(╥﹏╥)o: 因为好奇，踩坑后的结论)
   
    `yum update` 升级所有包同时也升级软件和系统内核 ; `yum -y update` 命令会一直默认选择 `yes` ，不会看到询问信息。
   
    `yum upgrade` 只升级所有包，不升级软件和系统内核

### rsync 命令

使用 `rsync` 进行同步和更新文件。[参考](https://www.linuxprobe.com/how-linux-rsync.html)

**Example**

1. 同步本地文件到远程服务器并删除已经存在的同名文件和目录

```bash
rsync -avz --delete /home/local/httpdocs/mystaticsite/ remote@www.example.org:/home/remote/httpdocs/
```

2. 远程同步到本地服务器

```bash
rsync -avz reomote@www.example.org:192.168.1.4:/home/remote/httpdocs/ /home/local/httpdocs/mystaticsitez/
```

### tar 命令

压缩与解压命令。

| 参数             | 参数描述                            |
| -------------- | ------------------------------- |
| -c             | 创建新的档案文件                        |
| -C             | 指定到要解压到的目录。注意：该目录必须存在           |
| -f             | 指定打包的文件名。在f之后要立即接打包文件名！不要再加参数！  |
| -x             | 解压                              |
| -O             | 将文件解压到标准输出                      |
| -p             | 使用原文件的原来属性                      |
| -P             | 创建归档文件，使用绝对路径                   |
| -t             | 列出档案文件中的内容                      |
| -r             | 向压缩归档文件末尾追加文件                   |
| -u             | 更新原压缩包中的文件                      |
| -v             | 显示详细过程                          |
| -z             | 使用gzip压缩，一般格式为xx.tar.gz或xx. tgz |
| -Z             | 有compress                       |
| -j             | 使用bzip2压缩，一般格式为xxx.tar.bz2      |
| --exclude      | 在压缩过程中，排除某个文件                   |
| --remove-files | 在完成打包后，删除原文件夹                   |

**Example:**

1. 压缩文件并删除原文件

```bash
tar -zcvf function.dis.tar.gz function.dis.* --remove-files
```

2. 压缩所有类似的文件，但排除某文件

```bash
tar -zcvf function.dis.tar.gz function.dis.* --exclude=function.dis.php
```

3. 解压压缩包中的所有文件：

```bash
tar -zxvf function.dis.tar.gz
```

4. 解压压缩包中的一个文件(使用原文件的原来属性)：

```bash
tar -xpvf function.dis.tar.gz function.dis.php # 使用原文件的原来属性
tar -xvf function.dis.tar.gz function.dis.php # 也可解压
```

**P.S.** 测试同时使用 `--remove-files` 和 `--exclude` 参数，则 `--exclude` 失效

```bash
tar -zcvf function.dis.tar.gz function.dis.* --remove-files --exclude=function.dis.php
```

## Linux 定时任务

如何实现一个定时任务？

使用命令 `crontab -u <user> -e` 创建一个定时任务，然后编辑任务计划：键盘输入 `a` 或 `i` 进入编辑模式。例如：

    */5 */1 * * * /usr/bin/python /home/weixin/httpdocs/test.py > /home/weixin/httpdocs/log.txt

`Esc` 退出 `shift + :` 输入 wq ，保存计划任务。 // 设置每65分钟执行一次

常用命令参数    ：

```bash
crontab -u <user> #指定用户，命令不指定用户无法执行
crontab -l #查看定时任务
crontab -e #创建定时任务 ，保存后会自动保存在 /tmp/crontab.<zFP6Rr>  <zFP6Rr>为随机字符
crontab -r #删除用户的定时任务
crontab -i #删除 crontab 文件前提醒用户
... ...
```

![Linux crontab 定时任务参数](https://i.imgur.com/INVHTUb.png)

定时任务设置说明：

```bash
# Example of job definition:
# .---------------- minute (0 - 59) *：表示任意 */1: 表示每间隔1分钟 1,50: 第1分钟或50分钟 1-50: 一道50分钟
# |  .------------- hour (0 - 23)
# |  |  .---------- day of month (1 - 31)
# |  |  |  .------- month (1 - 12) OR jan,feb,mar,apr ...
# |  |  |  |  .---- day of week (0 - 6) (Sunday=0 or 7) OR sun,mon,tue,wed,thu,fri,sat
# |  |  |  |  |
# *  *  *  *  * user-name  command to be executed
```

![linux crontab 定时任务设置说明](https://i.imgur.com/kfHoZM3.png)

P.S. Linux  <EOT>：文本终结， 用 `CTRL+D` 键输入。

### Crontab 使用教程

命令规则编写可使用工具： [crontab 在线工具](https://www.pppet.net/ "在线Cron表达式生成器")

#### Cron 和 Crontab 区别

Cron Linux系统内置系统进程。

Crontab Cron的配置文件，作业列表；在作业列表设定计划实现任务。
