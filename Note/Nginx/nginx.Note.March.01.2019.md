# Nginx 编译安装后补充 #
CentOS7 补充在 `/etc/init.d/nginx` 执行的脚本：

	#!/bin/sh
	# nginx - this script starts and stops the nginx daemin
	#
	# chkconfig:   - 85 15
	
	# description:  Nginx is an HTTP(S) server, HTTP(S) reverse \
	#               proxy and IMAP/POP3 proxy server
	
	# processname: nginx
	# config:      /usr/local/nginx/conf/nginx.conf
	# pidfile:     /usr/local/nginx/logs/nginx.pid
	
	# Source function library.
	
	. /etc/rc.d/init.d/functions
	
	# Source networking configuration.
	
	. /etc/sysconfig/network
	
	# Check that networking is up.
	
	[ "$NETWORKING" = "no" ] && exit 0
	
	nginx="/usr/local/nginx/sbin/nginx"
	
	prog=$(basename $nginx)
	
	NGINX_CONF_FILE="/usr/local/nginx/conf/nginx.conf"
	
	lockfile=/var/lock/subsys/nginx
	
	start() {
	
	    [ -x $nginx ] || exit 5
	
	    [ -f $NGINX_CONF_FILE ] || exit 6
	
	    echo -n $"Starting $prog: "
	
	    daemon $nginx -c $NGINX_CONF_FILE
	
	    retval=$?
	
	    echo
	
	    [ $retval -eq 0 ] && touch $lockfile
	
	    return $retval
	
	}
	
	stop() {
	
	    echo -n $"Stopping $prog: "
	
	    killproc $prog -QUIT
	
	    retval=$?
	
	    echo
	
	    [ $retval -eq 0 ] && rm -f $lockfile
	
	    return $retval
	
	}
	
	restart() {
	
	    configtest || return $?
	
	    stop
	
	    start
	
	}
	
	reload() {
	
	    configtest || return $?
	
	    echo -n $"Reloading $prog: "
	
	    killproc $nginx -HUP
	
	    RETVAL=$?
	
	    echo
	
	}
	
	force_reload() {
	
	    restart
	
	}
	
	
	configtest() {
	
	  $nginx -t -c $NGINX_CONF_FILE
	
	}
	
	
	
	rh_status() {
	
	    status $prog
	
	}
	
	
	rh_status_q() {
	
	    rh_status >/dev/null 2>&1
	
	}
	
	case "$1" in
	
	    start)
	
	        rh_status_q && exit 0
	        $1
	        ;;
	
	    stop)
	
	
	        rh_status_q || exit 0
	        $1
	        ;;
	
	    restart|configtest)
	        $1
	        ;;
	
	    reload)
	        rh_status_q || exit 7
	        $1
	        ;;
	
	
	    force-reload)
	        force_reload
	        ;;
	    status)
	        rh_status
	        ;;
	
	
	    condrestart|try-restart)
	
	        rh_status_q || exit 0
	            ;;
	
	    *)
	
	        echo $"Usage: $0 {start|stop|status|restart|condrestart|try-restart|reload|force-reload|configtest}"
	        exit 2
	
	esac 



## Nginx 配置 ##
对Nginx 添加 vhosts.conf 的配置（多服务），参考博客文章：[nginx配置文件nginx.conf超详细讲解](https://www.cnblogs.com/liang-wei/p/5849771.html "nginx配置文件nginx.conf超详细讲解")

	cat /usr/local/nginx/conf/nginx.conf | grep vhosts 查看虚拟配置是否重复

Nginx 配置 vhosts.conf 失效：vhosts 中的配置无法覆盖 nginx.conf 中的配置，导致访问出错或访问nginx默认页面。

nginx.conf:

	...
	server {
        listen       80;
        server_name  localhost;

        #charset koi8-r;

        #access_log  logs/host.access.log  main;
        root /usr/local/nginx/html;

        location / {
            #root   html;
            index  index.html index.htm;
    	}
		... ...
		error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }
		... ...
		location ~ \.php$ {
        #    root           html;
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            include        fastcgi_params;
        }
		... ...
	include vhosts.conf;
	}

vhosts.conf 配置：

	server{
        listen 80;
        server_name     192.168.159.128;

        #charset koi8-r;

        #access_log     logs/host.access.log    main;
        root    /home/weixin/httpdocs;

        location / {
                index   index.html      index.htm       index.php       1.php;
                autoindex       on;
                try_files       $uri    $uri/   /index.php?$query_string;
        }
        #error_page 404         /404.html;

        # redirect server error pages to the static page /50x.html
        #
        error_page      500 502 503 504 /50x.html;
        location        =       /50x.html {
                root    html;
        }
		location ~ \.php(.*)$  {
            fastcgi_pass   127.0.0.1:9000;
            fastcgi_index  index.php;
            fastcgi_split_path_info  ^((?U).+\.php)(/?.+)$;
            fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
            fastcgi_param  PATH_INFO  $fastcgi_path_info;
            fastcgi_param  PATH_TRANSLATED  $document_root$fastcgi_path_info;
            include        fastcgi_params;
        }
	}

## centos7 yum 安装 nginx ##
直接执行 `yum install -y nginx` 会显示如下信息；

	Loaded plugins: fastestmirror
	Loading mirror speeds from cached hostfile
	 * base: mirrors.njupt.edu.cn
	 * extras: mirrors.163.com
	 * updates: mirrors.163.com
	No package nginx available.
	Error: Nothing to do

因为 centos 无镜像包，需到 nginx 网站上查找设置 `rpm -Uvh http://nginx.org/packages/centos/7/noarch/RPMS/nginx-release-centos-7-0.el7.ngx.noarch.rpm`

	-U : {-U|--upgrade}
	-v : Print verbose information - normally routine  progress  messages will be displayed.
	-h :  Print 50 hash marks as the package  archive  is  unpacked.   Use with -v|--verbose for a nicer display.
	
使用命令 `yum search nginx` 查看镜像源是否安装，存在后则执行`yum -y install nginx` 命令，等待安装。

### 开机启动 ###

启动测试：`systemctl {start|stop|restart} nginx.service`
创建快捷方式：`systemctl enable nginx.service` 

nginx   启动

nginx -t  测试命令

nginx -s relaod 修改nginx.conf之后，可以重载

	ps -ef|grep nginx
	firewall-cmd --zone=public --add-port=80/tcp --permanent //开放80端口
	systemctl stop firewalld.service
	systemctl start firewalld.service
	firewall-cmd --reload //systemctl 命令失败则使用