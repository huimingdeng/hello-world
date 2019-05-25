# [Nginx 静态文件服务配置及优化](https://segmentfault.com/a/1190000019276954 "Nginx 静态文件服务配置及优化") #
笔记转载自博客。

## 根目录和索引文件 ##
`root` 指令指定将用于搜索文件的根目录。 为了获取所请求文件的路径，`NGINX` 将请求 `URI` 附加到 `root` 指令指定的路径。该指令可以放在 `http {}`，`server {}` 或 `location {}` 上下文中的任何级别。在下面的示例中，为虚拟服务器定义了 `root` 指令。 它适用于未包含根指令的所有`location {}` 块，以显式重新定义根：

	server {
	    root /www/data;
	
	    location / {
	    }
	
	    location /images/ {
	    }
	
	    location ~ \.(mp3|mp4) {
	        root /www/media;
	    }
	}

在这里，`NGINX` 针对 `/images/` 开头的 `URI` 将在文件系统的 `/www/` `data/images/` 目录中搜索相应文件。 如果 `URI` 以 `.mp3` 或 `.mp4` 扩展名结尾，则 `NGINX` 会在 `/www/media/` 目录中搜索该文件，因为它是在匹配的位置块中定义的。