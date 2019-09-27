# git

git 操作知识点备忘录

centos7 搭建git私有云 https://www.jianshu.com/p/77bc755a3328

## git remote

项目本地仓库和远程仓库的关联。

创建项目 [commission](https://gitee.com/huimingdeng/commission "commission") 关联 gitee.com 中的远程仓库：

    git init //本地初始化
    git remote add origin git@gitee.com:huimingdeng/commission.git // 添加 origin 映射 ssh 地址
    git fetch origin master // 拉取远程主分支
    git merge origin/master // 合并本地和远程主分支

以上两个命令相当于 git pull ,但使用两个命令这样避免错误信息（本地分支文件都 commit 后）：
![错误信息](https://i.imgur.com/I2Y2hh3.png)

    git push -u origin master // 推送分支到远程仓库

### 分支创建

常用命令 `git checkout -b dev` ：创建分支`dev`并切换到分支`dev`中，相当于：

    git brach dev // 创建分支
    git checkout dev // 切换到分支

### 分支合并

常用命令 `git merge dev` ： 将`dev`分支合并到当前分支；注意要切换到非`dev`分支。

一般不确定情况,可以本地分支和远程分支比对：`git diff dev origin/dev`

### 分支重命名

远程分支的重命名一般是下载到本地，然后删除远程分支，将重命名后的本地分支重新推送。

    git branch -m dev dev-develop
    git push origin --delete dev 
    git branch -a //查看删除后效果
    git push origin dev-develop //推送重命名后的分支，需要切换到 dev-develop 分支进行推送

![删除远程分支](https://i.imgur.com/PGOerWL.png)

![查看远程分支删除后效果](https://i.imgur.com/8B0M0Gj.png)

    git branch -d dev //删除本地分支，注意不要在 dev 分支中进行，切换到主分支进行

## 历史版本

查看历史版本 `git log` 

### 对比差异

对比文件历史版本中的差异：`git diff`, 假设当前分支的历史版本如下：

    A --> B --> C --> D --> E(HEAD)

1. 对比当前和上一历史版本的差异（E和D的差异）：`git diff HEAD^ -- <filename>`
2. 对比当前和上一历史版本的再上一版本的差异（E和C的差异）：`git diff HEAD^ -- <filename>`
3. 对比当前和 B 历史版本的差异: `git diff HEAD^^^ -- <filename>`
4. 对比当前和 A 历史版本的差异: `git diff HEAD~4 -- <filename>`

历史版本中新增文件修改，但未执行`git add`，历史版本为 `F'`:

    A --> B --> C --> D --> E --> F'(HEAD)

1. 执行 `git diff <filename>` 或 `git diff HEAD -- <filename>` 可以查看 `F'` 和 `E` 版本的差异。
   
   ![版本F'和E的差别](https://i.imgur.com/EgiWhzB.png)
2. 执行 `git diff HEAD^ -- <filename>` 则显示的是 `F'` 和 `D` 的差异
   
   ![版本F'和D的差别](https://i.imgur.com/8MjapML.png)

如果执行了`git add` 后，但未执行 `git commit` 则查看当前和上一版本的差异只能使用 `git diff HEAD -- <filename>` 而 `git diff <filename>` 失效。

### 回退操作

日常需要回退操作的命令记录，如果下，未执行 `git commit` 已经执行 `git add` 操作：

    A --> B --> C --> D --> E --> F'(HEAD)

执行：

1. `git reset --hard` 回滚到最近一次的代码，到未add.状态，回复代码为原来状态
2. `git reset --mixed` 回到add状态 == --hard
3. `git reset HEAD`

如下，已经执行`git commit`命令

    A --> B --> C --> D --> E(HEAD)

想还原到 `git add` 操作：

1. `git reset --soft HEAD^` 回滚最近一次的 commit,到add.状态
2. `git reset --soft HEAD~3` 回滚最近三次的 commit

P.S. 处理 windows 中 git add 中的警告信息：[https://blog.csdn.net/unityoxb/article/details/20768687](https://blog.csdn.net/unityoxb/article/details/20768687 "windows使用git时出现：warning: LF will be replaced by CRLF")

### 历史版本commit详情查看

如果想查看某一次commit有哪些文件可以使用如下命令：

1. 查看最近几次commit信息 `git log -n --stat`
2. 查看某次commit详细信息 `git show <commit-id> --stat`

## git issue

1. 用于任务管理
2. bug 报告

参考 [Github issues的使用](https://blog.csdn.net/Wuzihui___/article/details/79952068 "Github issues的使用")
