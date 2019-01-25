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



