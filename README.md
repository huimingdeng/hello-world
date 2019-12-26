# hello-world 初始 git 仓库，学习使用 #
学习使用git工具创建的仓库。

## FIX_HTTPS TOOL ##
一个简易脚本，用于修改脚本所在目录下文件中的 http 协议，替换成 https 协议。

## HyperDown ##
[HyperDown](https://github.com/huimingdeng/hello-world/tree/master/HyperDown "md 文件解析PHP类") 为下载第三方的一个解析 *.MD 文件的一个 PHP 类，先该目录有两个文件，分别是 `Parser_old.php` 和 `parser.php`；其中 `Parser_old.php` 为第三方原版类库，`parser.php` 为自己修改的文件，根据自己的需求添加一些小功能。

## Java ##
java 代码，利用Java代码学习PHP。

## MySQL-learn ##
[MySQL-learn](https://github.com/huimingdeng/hello-world/tree/master/MySQL-learn "MySQL类库和学习程序") 目录下为以前编写的一些数据库连接类，和学习 mysql 的程序。

## NN ##
深度学习，神经网络图谱，笔记等。

这里面的脚本在jupyter notebook中执行可以，目前自定义配置的sublime中的Python执行会抛出弃用警告 **`DeprecationWarning: the imp module is deprecated in favour of importlib; see the module's documentation for alternative uses import imp`**

## Note ##
日常运维和学习笔记。

1. [note-Oct-10-2018.md](https://github.com/huimingdeng/hello-world/blob/master/Note/note-Oct-10-2018.md "note-Oct-10-2018") CentOS7 安装，docker 安装，vsftp 安装与配置。

## [PHPinterview](https://github.com/huimingdeng/hello-world/tree/master/PHPinterview "PHP面试") ##
php 面试题目，面试经历，面试解答。

## [Pattren](https://github.com/huimingdeng/hello-world/tree/master/Pattren "设计模式") ##
Java 和 PHP 的设计模式学习笔记和案例。

## php-doc ##
php 日常使用函数和案例，进入 [php-doc](https://github.com/huimingdeng/hello-world/tree/master/php-doc)


## phpStudy 小笔记 ##
该目录保存的是日常复习和学习 PHP 知识的小笔记形成的一个项目（包含JavaScript等）。---- Sep 18,2018.


## 其它文件 ##
罗列当前库中非目录文件说明。

1. 2048.py python编写的2048小游戏，使用 cmd 命令执行，可使用键盘操作。
2. 20482.py Python编写的2048小游戏，未修改完成。
3. HubSpot API.docx Hubspot 的API接口文档，不完整。
4. PHP复习进阶.txt 罗列了 PHP 进阶在京东可以购买的书籍链接。
5. huarongdao.class.php 根据 CSDN Java源码改编，目前程序未优化，需要消耗大量内存，而且容易死循环。
6. learn more study less.txt 《如何高效学习》一书的笔记，没有编写完整。
7. resolve2.py 一个测试回调函数，处理多层结构的 json 数据，处理方法没有编写，该方案也是一个未完成版本。


P.S. Markdown Pad2 在 Windows10 无法渲染问题，国外镜像下载：`To fix this issue, please try installing the Awesomium 1.6.6 SDK.`


### 同一台机器如何配置多个GitHub账号
参考 [Tom-php/python](https://github.com/tom-php/python)

#### 第一步：创建新的 SSH key

```bash
sshkey -t rsa -b 4096 -C "your_email@host.com"
eval "$(ssh-agent -s)"
ssh-add ~/.ssh/your_name  //eg. Tom-php
// Test
ssh -T git@github.com
```

#### 第二步：配置config文件
在 `~/.ssh/` 目录下创建 `config` 文件，写入如下信息：

```bash
Host	your_host_alias
HostName	github.com
User	git
IdentityFile	~/.ssh/your_ssh_private_key_file
```

#### 第三步：修改仓库远程的源地址
```bash
git remote set-url origin your_host_alias:your_github_username/your_repository.git
```

