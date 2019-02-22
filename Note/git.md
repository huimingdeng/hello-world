# git #
git 操作知识点备忘录

## git remote ##
项目本地仓库和远程仓库的关联。

创建项目 [commission](https://gitee.com/huimingdeng/commission "commission") 关联 gitee.com 中的远程仓库：

	git init //本地初始化
	git remote add origin git@gitee.com:huimingdeng/commission.git // 添加 origin 映射 ssh 地址
	git fetch origin master // 拉取远程主分支
	git merge origin/master // 合并本地和远程主分支
	
以上两个命令相当于 git pull ,但使用两个命令这样避免错误信息（本地分支文件都 commit 后）：
![错误信息](https://i.imgur.com/I2Y2hh3.png)

	git push -u origin master // 推送分支到远程仓库


### 分支创建 ###
常用命令 `git checkout -b dev` ：创建分支`dev`并切换到分支`dev`中，相当于：

	git brach dev // 创建分支
	git checkout dev // 切换到分支

### 分支合并 ###
常用命令 `git merge dev` ： 将`dev`分支合并到当前分支；注意要切换到非`dev`分支。

一般不确定情况,可以本地分支和远程分支比对：`git diff dev origin/dev`