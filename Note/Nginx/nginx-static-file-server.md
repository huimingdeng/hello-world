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

如果请求以 / 结尾，则 NGINX 将其视为对目录的请求，并尝试在目录中查找索引文件。`index` 指令定义索引文件的名称（默认值为 index.html）。要继续该示例，如果请求 URI 是 `/images/some/path/`，则 NGINX 会返回文件 `/www/data/images/some/path/index.html`（如果存在）。如果没有，NGINX 默认返回 HTTP 404 错误（未找到）。要配置 NGINX 以返回自动生成的目录列表，请在 `autoindex` 指令中包含 on 参数：

	location /images/ {
    	autoindex on;
	}

你可以在 index 指令中列出多个文件名。 NGINX按指定的顺序搜索文件并返回它找到的第一个文件。

	location / {
	    index index.$geo.html index.htm index.html;
	}

这里使用的 `$geo` 变量是通过 `geo` 指令设置的自定义变量。变量的值取决于客户端的 IP 地址。

要返回索引文件，NGINX 会检查它是否存在，然后对通过将索引文件的名称附加到基础 URI 上获得的新 URI 进行内部重定向。内部重定向导致对位置的新搜索，并且可能最终位于另一个位置，如以下示例所示：

	location / {
	    root /data;
	    index index.html index.php;
	}
	
	location ~ \.php {
	    fastcgi_pass localhost:8000;
	    #...
	
	}

这里，如果请求中的 URI 是 `/path/`，并且 `/data/path/index.html` 不存在但 `/data/path/index.php` 存在，则内部重定向到 `/path/index.php` 将映射到第二个位置。结果，请求被代理。