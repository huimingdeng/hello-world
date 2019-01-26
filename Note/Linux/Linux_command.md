# Linux 常用命令汇总与实操笔记 #
因为最近在做Linux的试题，发现了自己许多不足之处，因此特创建该文档，对常用命令进行实操总结。

## CentOS ##
CentOS 操作记录（踩坑笔记）。

### yum 命令 ###
1. `yum update` 和 `yum upgrade` 的区别。
	
	因为日常工作中在 centos 中很少进行 `yum update` 和 `yum upgrade` 命令，只有在虚拟机中会使用这两个命令，一直认为两者区别不大，但实质上操作后发现 `yum update` 确实会更改系统内核信息，而 `yum upgrade` 没有变更内核信息，因此生产环境要慎用 `yum update` 命令。(o(╥﹏╥)o: 因为好奇，踩坑后的结论)

	`yum update` 升级所有包同时也升级软件和系统内核 ; `yum -y update` 命令会一直默认选择 `yes` ，不会看到询问信息。
	
	`yum upgrade` 只升级所有包，不升级软件和系统内核




## Linux 定时任务 ##
如何实现一个定时任务？

使用命令 `crontab -u <user> -e` 创建一个定时任务，然后编辑任务计划：键盘输入 `a` 或 `i` 进入编辑模式。例如：

	*/5 */1 * * * /usr/bin/python /home/weixin/httpdocs/test.py > /home/weixin/httpdocs/log.txt

`Esc` 退出 `shift + :` 输入 wq ，保存计划任务。 // 设置每65分钟执行一次

常用命令参数	：
	
	crontab -u <user> 指定用户，命令不指定用户无法执行
	crontab -l 查看定时任务
	crontab -e 创建定时任务 ，保存后会自动保存在 /tmp/crontab.<zFP6Rr>  <zFP6Rr>为随机字符
	crontab -r 删除用户的定时任务
	crontab -i 删除 crontab 文件前提醒用户
	... ...

![Linux crontab 定时任务参数](https://i.imgur.com/INVHTUb.png)

定时任务设置说明：

	# Example of job definition:
	# .---------------- minute (0 - 59) *：表示任意 */1: 表示每间隔1分钟 1,50: 第1分钟或50分钟 1-50: 一道50分钟
	# |  .------------- hour (0 - 23)
	# |  |  .---------- day of month (1 - 31)
	# |  |  |  .------- month (1 - 12) OR jan,feb,mar,apr ...
	# |  |  |  |  .---- day of week (0 - 6) (Sunday=0 or 7) OR sun,mon,tue,wed,thu,fri,sat
	# |  |  |  |  |
	# *  *  *  *  * user-name  command to be executed

![linux crontab 定时任务设置说明](https://i.imgur.com/kfHoZM3.png)

P.S. Linux  <EOT>：文本终结， 用 `CTRL+D` 键输入。