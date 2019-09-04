# 腾讯云 ubuntu 升级Python

腾讯云 ubuntu 16.04 版本默认安装了 Python2.7.14 和 python3.5 ，但本人想使用 python3.6+ 因此进行升级操作。

参考 https://www.cnblogs.com/yjlch1016/p/8641910.html

## 更新python源与安装

`sudo add-apt-repository ppa:jonathonf/python-3.6`

系统响应返回：

```bash
 A plain backport of *just* Python 3.6. System extensions/Python libraries may or may not work.

Don't remove Python 3.5 from your system - it will break.
 More info: https://launchpad.net/~jonathonf/+archive/ubuntu/python-3.6
Press [ENTER] to continue or ctrl-c to cancel adding it

gpg: keyring `/tmp/tmp8zzspc18/secring.gpg' created
gpg: keyring `/tmp/tmp8zzspc18/pubring.gpg' created
gpg: requesting key F06FC659 from hkp server keyserver.ubuntu.com
gpg: /tmp/tmp8zzspc18/trustdb.gpg: trustdb created
gpg: key F06FC659: public key "Launchpad PPA for J Fernyhough" imported
gpg: Total number processed: 1
gpg:               imported: 1  (RSA: 1)
OK
```

`sudo apt-get update` 更新本地源列表

```puppet
 Hit:1 http://mirrors.tencentyun.com/ubuntu xenial InRelease
 Get:2 http://mirrors.tencentyun.com/ubuntu xenial-security InRelease [109 kB]
 Get:3 http://mirrors.tencentyun.com/ubuntu xenial-updates InRelease [109 kB]
 Get:4 http://mirrors.tencentyun.com/ubuntu xenial-security/main Sources [154 kB]
 Get:5 http://mirrors.tencentyun.com/ubuntu xenial-security/universe Sources [111 kB]
 Get:6 http://mirrors.tencentyun.com/ubuntu xenial-security/main amd64 Packages [732 kB]
 Get:7 http://mirrors.tencentyun.com/ubuntu xenial-security/main i386 Packages [587 kB]
 Get:8 http://mirrors.tencentyun.com/ubuntu xenial-security/main Translation-en [287 kB]
 Get:9 http://mirrors.tencentyun.com/ubuntu xenial-security/universe amd64 Packages [456 kB]
 Get:10 http://mirrors.tencentyun.com/ubuntu xenial-security/universe i386 Packages [395 kB]
 Get:11 http://mirrors.tencentyun.com/ubuntu xenial-security/universe Translation-en [186 kB]
 Get:12 http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu xenial InRelease [18.0 kB]
 Get:13 http://mirrors.tencentyun.com/ubuntu xenial-updates/main amd64 Packages [1,019 kB]
 Get:14 http://mirrors.tencentyun.com/ubuntu xenial-updates/main i386 Packages [854 kB]
 Get:15 http://mirrors.tencentyun.com/ubuntu xenial-updates/universe amd64 Packages [762 kB]
 Get:16 http://mirrors.tencentyun.com/ubuntu xenial-updates/universe i386 Packages [694 kB]
 Hit:17 http://ppa.launchpad.net/nginx/stable/ubuntu xenial InRelease
 Get:18 https://download.docker.com/linux/ubuntu xenial InRelease [66.2 kB]
 Hit:19 http://ppa.launchpad.net/ondrej/php/ubuntu xenial InRelease
 Get:20 https://download.docker.com/linux/ubuntu xenial/stable amd64 Packages [10.4 kB]
 Get:21 http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu xenial/main amd64 Packages [4,820 B]
 Get:22 http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu xenial/main i386 Packages [4,812 B]
 Get:23 http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu xenial/main Translation-en [2,148 B]
 Fetched 6,561 kB in 3s (2,038 kB/s)
 Reading package lists... Done
```

`sudo apt-get install -y python3.6` 安装 python3.6

```bash
Reading package lists... Done
Building dependency tree
Reading state information... Done
The following additional packages will be installed:
  libpython3.6-minimal libpython3.6-stdlib python3.6-minimal
Suggested packages:
  python3.6-venv python3.6-doc binfmt-support
The following NEW packages will be installed:
  libpython3.6-minimal libpython3.6-stdlib python3.6 python3.6-minimal
0 upgraded, 4 newly installed, 0 to remove and 192 not upgraded.
1 not fully installed or removed.
Need to get 4,481 kB of archives.
After this operation, 23.0 MB of additional disk space will be used.
Get:1 http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu xenial/main amd64 libpython3.6-minimal amd64 3.6.8-1~16.04.york1 [578 kB]
Get:2 http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu xenial/main amd64 python3.6-minimal amd64 3.6.8-1~16.04.york1 [1,689 kB]
Get:3 http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu xenial/main amd64 libpython3.6-stdlib amd64 3.6.8-1~16.04.york1 [1,968 kB]
Get:4 http://ppa.launchpad.net/jonathonf/python-3.6/ubuntu xenial/main amd64 python3.6 amd64 3.6.8-1~16.04.york1 [246 kB]
Fetched 4,481 kB in 1min 20s (55.8 kB/s)
Selecting previously unselected package libpython3.6-minimal:amd64.
(Reading database ... 70262 files and directories currently installed.)
Preparing to unpack .../libpython3.6-minimal_3.6.8-1~16.04.york1_amd64.deb ...
Unpacking libpython3.6-minimal:amd64 (3.6.8-1~16.04.york1) ...
Selecting previously unselected package python3.6-minimal.
Preparing to unpack .../python3.6-minimal_3.6.8-1~16.04.york1_amd64.deb ...
Unpacking python3.6-minimal (3.6.8-1~16.04.york1) ...
Selecting previously unselected package libpython3.6-stdlib:amd64.
Preparing to unpack .../libpython3.6-stdlib_3.6.8-1~16.04.york1_amd64.deb ...
Unpacking libpython3.6-stdlib:amd64 (3.6.8-1~16.04.york1) ...
Selecting previously unselected package python3.6.
Preparing to unpack .../python3.6_3.6.8-1~16.04.york1_amd64.deb ...
Unpacking python3.6 (3.6.8-1~16.04.york1) ...
Processing triggers for man-db (2.7.5-1) ...
Processing triggers for mime-support (3.59ubuntu1) ...
Setting up docker-ce (5:19.03.1~3-0~ubuntu-xenial) ...
A dependency job for docker.service failed. See 'journalctl -xe' for details.
invoke-rc.d: initscript docker, action "start" failed.
● docker.service - Docker Application Container Engine
   Loaded: loaded (/lib/systemd/system/docker.service; enabled; vendor preset: enabled)
   Active: active (running) since Wed 2019-05-15 12:36:33 CST; 3 months 20 days ago
     Docs: https://docs.docker.com
 Main PID: 26052 (dockerd)
    Tasks: 12
   Memory: 106.7M
      CPU: 43min 53.998s
   CGroup: /system.slice/docker.service
           └─26052 /usr/bin/dockerd -H unix://

Sep 04 09:19:11 VM-0-4-ubuntu systemd[1]: Dependency failed for Docker Appli....
Sep 04 09:19:11 VM-0-4-ubuntu systemd[1]: docker.service: Job docker.service....
Warning: Journal has been rotated since unit was started. Log output is incomplete or unavailable.
Hint: Some lines were ellipsized, use -l to show in full.
dpkg: error processing package docker-ce (--configure):
 subprocess installed post-installation script returned error exit status 1
Setting up libpython3.6-minimal:amd64 (3.6.8-1~16.04.york1) ...
Setting up python3.6-minimal (3.6.8-1~16.04.york1) ...
Setting up libpython3.6-stdlib:amd64 (3.6.8-1~16.04.york1) ...
Setting up python3.6 (3.6.8-1~16.04.york1) ...
Errors were encountered while processing:
 docker-ce
E: Sub-process /usr/bin/dpkg returned an error code (1)
```

## 设置优先级

`sudo update-alternatives --install /usr/bin/python3 python3 /usr/bin/python3.5 1`  更改 python3.5 的优先级

```bash
update-alternatives: using /usr/bin/python2 to provide /usr/bin/python (python) in auto mode
```

更改python3优先级

`sudo update-alternatives --install /usr/bin/python3 python3 /usr/bin/python3.6 2`

```bash
update-alternatives: using /usr/bin/python3 to provide /usr/bin/python (python) in auto mode
```



### 设置默认python

输入 `python` 默认的是 python2 , 因此更改为新安装的 python3.6 为 python3.

```bash
ubuntu@VM-0-4-ubuntu:~$ python

Python 2.7.12 (default, Nov 12 2018, 14:36:49)

[GCC 5.4.0 20160609] on linux2

Type "help", "copyright", "credits" or "license" for more information.

>>>
KeyboardInterrupt
>>>
```

更改 默认：python

`sudo update-alternatives --install /usr/bin/python python /usr/bin/python2 100`

`sudo update-alternatives --install /usr/bin/python python /usr/bin/python3 150`

变更后：

```bash
ubuntu@VM-0-4-ubuntu:~$ python
Python 3.6.8 (default, May  7 2019, 14:58:50)
[GCC 5.4.0 20160609] on linux
Type "help", "copyright", "credits" or "license" for more information.
>>>

```


