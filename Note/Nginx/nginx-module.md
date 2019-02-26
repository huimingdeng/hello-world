# Nginx 学习 #
编译安装学习，理解和学习各模块。 参考学习文章 [Nginx模块讲解](https://www.jianshu.com/p/921b238e51dd "Nginx模块讲解")、[nginx---模块介绍](https://blog.csdn.net/moonhmilyms/article/details/19838283 "nginx--模块介绍")

## 模块 ##
Nginx 编译模块学习： 模块 -- 作用

	--with-compat 
	--with-file-aio 
	--with-threads 
	--with-http_addition_module 
	--with-http_auth_request_module 
	--with-http_dav_module 
	--with-http_flv_module 
	--with-http_gunzip_module 
	--with-http_gzip_static_module 
	--with-http_mp4_module 
	--with-http_random_index_module 	用于随机主页设置
	--with-http_realip_module 
	--with-http_secure_link_module 
	--with-http_slice_module 
	--with-http_ssl_module 
	--with-http_stub_status_module 	主要用于展示当前处理链接的状态，用于监控链接信息
	--with-http_sub_module 	用于Nginx服务端在给客户端response内容的时候，进行HTTP内容更换
	--with-http_v2_module 
	--with-mail 
	--with-mail_ssl_module 
	--with-stream 
	--with-stream_realip_module 
	--with-stream_ssl_module 
	--with-stream_ssl_preread_module 


### http_stub_status_module 模块讲解 ###

	编译选项：--with-http_stub_status_module 
	作用：Nginx的客户端状态

主要用于展示当前处理链接的状态，用于监控链接信息，配置语法:
	
	Syntax：stub_status;
	Default：——
	Context：server,location

检查配置是否正确

	nginx -tc /etc/nginx/nginx.conf
	nginx -s reload -c /etc/nginx/nginx.conf //重启 Nginx 服务，查看客户端连接状态


### with-http_random_index_module 模块讲解 ###

	编译选项：--with-http_random_index_module
	作用：主目录中选一个随机主页

用于随机主页设置：（个人目前需求不大），语法：

	Syntax：random_index on | off;
	Default：random_index off;
	Context：location

注意：虽然nginx会将主目录下的文件作为随机主页，但是不会将隐藏文件包括在内，Linux的隐藏文件是指以点 . 开始的文件。

### with-http_sub_module 模块讲解 ###

	编译选项：--with-http_sub_module
	作用：HTTP内容替换
语法：

	Syntax: sub_filter string replacement; （string表示要替换的内容，replacement表示替换后的对象）
	Default: —
	Context: http, server, location
句法：

	句法： sub_filter_last_modified on | off;
	默认： sub_filter_last_modified off;
	语境： http，server，location```

**用于判断每次请求的服务端内容是否发生变化，当发生变化的时候返回给客户端，当没有发生变化的时候，不再返回内容。重要用于缓存**
