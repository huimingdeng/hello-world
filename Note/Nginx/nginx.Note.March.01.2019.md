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

