# [Nginx 静态文件服务配置及优化](https://segmentfault.com/a/1190000019276954 "Nginx 静态文件服务配置及优化") #
笔记转载自博客 [Nginx 静态文件服务配置及优化](https://segmentfault.com/a/1190000019276954 "Nginx 静态文件服务配置及优化")。

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

### 尝试几种选择 ###
`try_files` 指令可用于检查指定的文件或目录是否存在; NGINX 会进行内部重定向，如果没有，则返回指定的状态代码。例如，要检查对应于请求 URI 的文件是否存在，请使用 `try_files` 指令和 `$uri` 变量，如下所示：

	server {
	    root /www/data;
	
	    location /images/ {
	        try_files $uri /images/default.gif;
	    }
	}

该文件以 URI 的形式指定，使用在当前位置或虚拟服务器的上下文中设置的根或别名指令进行处理。在这种情况下，如果对应于原始 URI 的文件不存在，NGINX 会将内部重定向到最后一个参数指定的 URI，并返回 `/www/data/images/default.gif`。

最后一个参数也可以是状态代码（直接以等号开头）或位置名称。 在以下示例中，如果 `try_files` 指令的所有参数都不会解析为现有文件或目录，则会返回 404 错误。

	location / {
	    try_files $uri $uri/ $uri.html =404;
	}

在下一个示例中，如果原始 URI 和带有附加尾部斜杠的 URI 都不会解析为现有文件或目录，则会将请求重定向到指定位置，并将其传递给代理服务器。

	location / {
	    try_files $uri $uri/ @backend;
	}
	
	location @backend {
	    proxy_pass http://backend.example.com;
	}

有关更多信息，请观看内容缓存网络研讨会，了解如何显着提高网站性能，并深入了解 NGINX 的缓存功能。

## 优化服务内容的性能 ##
加载速度是提供任何内容的关键因素。 对 NGINX 配置进行微小优化可以提高生产力并帮助实现最佳性能。

### 启用 `sendfile` ###
默认情况下，NGINX 会自行处理文件传输，并在发送之前将文件复制到缓冲区中。 启用 `sendfile` 指令消除了将数据复制到缓冲区的步骤，并允许将数据从一个文件描述符直接复制到另一个文件描述符。或者，为了防止一个快速连接完全占用工作进程，可以使用 `sendfile_max_chunk` 指令限制单个 `sendfile()` 调用中传输的数据量（在本例中为1 MB）：

	location /mp3 {
	    sendfile           on;
	    sendfile_max_chunk 1m;
	    #...
	
	}

### 启用 `tcp_nopush` ###
将 `tcp_nopush` 指令与 `sendfile on;` 指令一起使用。这使得 NGINX 可以在 `sendfile()` 获取数据块之后立即在一个数据包中发送 HTTP 响应头。

	location /mp3 {
	    sendfile   on;
	    tcp_nopush on;
	    #...
	
	}

### 启用 `tcp_nodelay` ###
`tcp_nodelay` 指令允许覆盖 [Nagle](https://en.wikipedia.org/wiki/Nagle "Nagle") 的算法，该算法最初设计用于解决慢速网络中小数据包的问题。该算法将许多小数据包合并为一个较大的数据包，并以 200 毫秒的延迟发送数据包。如今，在提供大型静态文件时，无论数据包大小如何，都可以立即发送数据。延迟也会影响在线应用程序（ssh，在线游戏，在线交易等）。默认情况下，`tcp_nodelay` 指令设置为 on，这意味着禁用了 Nagle的算法。此指令仅用于 `keepalive` 连接：

	location /mp3  {
	    tcp_nodelay       on;
	    keepalive_timeout 65;
	    #...
	    
	}






