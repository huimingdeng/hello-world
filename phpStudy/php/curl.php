<!DOCTYPE html>
<html>
<head>
	<title>curl函数</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>CURL函数</h1>
		</header>
		<main>
			<?php include_once("navbar.php"); navbar(basename(__FILE__));?>
			<div class="row">
				<div class="col-xs-6">
					<p><b>1.<code>curl_init()</code></b>:初始化一个cURL会话，如果成功，返回一个cURL句柄，出错返回 FALSE。</p>
					<pre class="pre-scrollable"> <em class="red">&lt;?php</em> // 创建一个新cURL资源<br> <i class="green">$</i><i class="blue">ch</i> = <i class="blue">curl_init</i>();<br>// 设置URL和相应的选项<br> <i class="blue">curl_setopt</i>(<i class="green">$</i><i class="blue">ch</i>, CURLOPT_URL, "https://www.baidu.com/");<br> <i class="blue">curl_setopt</i>(<i class="green">$</i><i class="blue">ch</i>,CURLOPT_SSL_VERIFYPEER, <i class="orange">false</i>);//https专用<br> <i class="blue">curl_setopt</i>(<i class="green">$</i><i class="blue">ch</i>, CURLOPT_HEADER, 0);<br> // 抓取URL并把它传递给浏览器<br> <i class="green">$</i><i class="blue">html</i>=<i class="blue">curl_exec</i>(<i class="green">$</i><i class="blue">ch</i>);<br> // 关闭cURL资源，并且释放系统资源<br> <i class="blue">curl_close</i>(<i class="green">$</i><i class="blue">ch</i>);<br> var_dump(<i class="green">$</i><i class="blue">html</i>);<br> <em class="red">?&gt;</em></pre>
					<p class="text-success">案例：<a href="example/curl_example_one.php" target="_blank">案例1:curl获取 https://www.baidu.com</a></p>
				</div>
				<div class="col-xs-6">
					<p class="text-success">案例：iframe显示</p>
					<pre class="pre-scrollable">&lt;<i class="blue">iframe</i> src="example/curl_example_one.php"&gt;&lt;/<i class="blue">iframe</i>&gt;</pre>
					<iframe width="100%" height="250" id="exam1" scrolling="no" noResize="200" frameborder="0" src="example/curl_example_one.php"></iframe>
					<a class="btn btn-warning" onclick="fresh('exam1','example/curl_example_one.php');">刷新</a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>2.bool<code> curl_setopt ( resource $ch , int $option , mixed $value )</code></b>:为给定的cURL会话句柄设置一个选项。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>ch</td><td>由 curl_init() 返回的 cURL 句柄。</td></tr>
							<tr><td>option</td><td>需要设置的CURLOPT_XXX选项。</td></tr>
							<tr><td>value</td><td>将设置在option选项上的值。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>3.<code>curl_exec ( resource $ch )</code></b>:执行给定的cURL会话。函数应该在初始化一个cURL会话并且全部的选项都被设置后被调用。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>ch</td><td>由 curl_init() 返回的 cURL 句柄。</td></tr>
							<tr><td>返回值</td><td>成功时返回 TRUE， 或者在失败时返回 FALSE。 然而，如果 <b>CURLOPT_RETURNTRANSFER</b>选项被设置，函数执行成功时会返回执行的结果，失败时返回 FALSE 。</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>4.<code>resource curl_copy_handle ( resource $ch )</code></b>:复制一个cURL句柄和它的所有选项。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">ch</i>=<i class="blue">curl_init</i>();<br> <i class="blue">curl_setopt</i>(<i class="green">$</i><i class="blue">ch</i>,CURLOPT_URL,"http://www.myblog.com");<br> <i class="blue">curl_setopt</i>(<i class="green">$</i><i class="blue">ch</i>,CURLOPT_HEADER,0);<br> <i class="green">$</i><i class="blue">ch2</i>=<i class="blue">curl_copy_handle</i>(<i class="green">$</i><i class="blue">ch</i>);<br> //爬取并把它传递给浏览器<br> <i class="blue">curl_exec</i>(<i class="green">$</i><i class="blue">ch2</i>);<br> <i class="blue">curl_close</i>(<i class="green">$</i><i class="blue">ch2</i>);<br> <i class="blue">curl_close</i>(<i class="green">$</i><i class="blue">ch</i>);<br><em class="red">?&gt;</em></pre>
				</div>
				<div class="col-xs-6">
					<pre class="pre-scrollable">&lt;<i class="blue">iframe</i> src="example/curl_example_two.php" width="100%" height="250" id="exam2" scrolling="no" noResize="200" frameborder="0"&gt;&lt;/<i class="blue">iframe</i>&gt;</pre>
					<iframe width="100%" height="250" id="exam2" scrolling="no" noResize="200" frameborder="0" src="example/curl_example_two.php"></iframe>
					<a class="btn btn-warning" onclick="fresh('exam2','example/curl_example_two.php');">刷新</a>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-7">
					<p><b>5.<code>curl_errno ( resource $ch )</code></b>:返回最后一次的错误号</p>
					<p><b>6.string<code> curl_error ( resource $ch )</code></b>:返回一条最近一次cURL操作明确的文本的错误信息。</p>
					<pre class="pre-scrollable"><?php $fp=fopen("example/curl_example_three.php","rb");
					while (!feof($fp)) {
						echo str_replace("<?php","<em class='red'>&lt;?php</em>",fgets($fp));
					}fclose($fp);?></pre>
					<p class="text-success"></p>
				</div>
				<div class="col-xs-5">
					<pre class="pre-scrollable">&lt;<i class="blue">iframe</i> src="example/curl_example_three.php" width="100%" height="250" scrolling="no" noResize="200" frameborder="0"&gt;&lt;/<i class="blue">iframe</i>&gt;</pre>
					<iframe width="100%" height="250" scrolling="no" noResize="200" frameborder="0" src="example/curl_example_three.php"></iframe>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>7.<code>curl_escape ( resource $ch , string $str )</code></b>:对给定的字符串进行URL编码,返回编码字符串，或者在失败时返回 FALSE。</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-10">
					<p class="text-success">CURLOPT_XXX选项列表：</p>
					<table class="table table-hover table-bordered table-striped table-color">
                    	<thead><tr><th>选项</th><th>可选<em class="reset">value</em>值</th><th>备注</th></tr></thead>
         				<tbody class="tbody">
				          <tr><td ><strong>CURLOPT_AUTOREFERER</strong></td>
				           <td >当根据<em>Location:</em>重定向时，自动设置header中的<em>Referer:</em>信息。</td><td rowspan="16"></td></tr>
				          <tr><td ><strong>CURLOPT_BINARYTRANSFER</strong></td>
				           <td >在启用<strong>CURLOPT_RETURNTRANSFER</strong>的时候，返回原生的（Raw）输出。</td></tr>
				          <tr><td ><strong>CURLOPT_COOKIESESSION</strong></td>
				           <td >启用时curl会仅仅传递一个session cookie，忽略其他的cookie，默认状况下cURL会将所有的cookie返回给服务端。session cookie是指那些用来判断服务器端的session是否有效而存在的cookie。</td></tr>
				          <tr><td ><strong>CURLOPT_CRLF</strong></td><td >启用时将Unix的换行符转换成回车换行符。</td></tr>
				          <tr><td ><strong>CURLOPT_DNS_USE_GLOBAL_CACHE</strong></td>
				           <td >启用时会启用一个全局的DNS缓存，此项为线程安全的，并且默认启用。</td></tr>
				          <tr><td ><strong>CURLOPT_FAILONERROR</strong></td>
				           <td >显示HTTP状态码，默认行为是忽略编号小于等于400的HTTP信息。
				           </td></tr>
				          <tr><td ><strong>CURLOPT_FILETIME</strong></td>
				           <td >启用时会尝试修改远程文档中的信息。结果信息会通过curl_getinfo()函数的<em class="reset">CURLINFO_FILETIME</em>选项返回。curl_getinfo().</td></tr>
				          <tr><td ><strong>CURLOPT_FOLLOWLOCATION</strong></td><td >启用时会将服务器服务器返回的<em>"Location: "</em>放在header中递归的返回给服务器，使用<strong>CURLOPT_MAXREDIRS</strong>可以限定递归返回的数量。</td></tr>
				          <tr><td><strong>CURLOPT_FORBID_REUSE</strong></td>
				           <td >在完成交互以后强迫断开连接，不能重用。</td></tr>
				          <tr><td ><strong>CURLOPT_FRESH_CONNECT</strong></td>
				           <td>强制获取一个新的连接，替代缓存中的连接。</td></tr>
				          <tr><td><strong>CURLOPT_FTP_USE_EPRT</strong></td><td>
				            启用时当FTP下载时，使用EPRT (或 LPRT)命令。设置为<strong>FALSE</strong>时禁用EPRT和LPRT，使用PORT命令only.</td></tr>
				          <tr><td><strong>CURLOPT_FTP_USE_EPSV</strong></td><td >
				            启用时，在FTP传输过程中回复到PASV模式前首先尝试EPSV命令。设置为<strong>FALSE</strong>时禁用EPSV命令。</td></tr>
				          <tr><td><strong>CURLOPT_FTPAPPEND</strong></td><td >启用时追加写入文件而不是覆盖它。</td></tr>
				          <tr><td><strong>CURLOPT_FTPASCII</strong></td>
				           <td><strong>CURLOPT_TRANSFERTEXT</strong>的别名。</td></tr>
				          <tr><td><strong>CURLOPT_FTPLISTONLY</strong></td>
				           <td >启用时只列出FTP目录的名字。</td></tr>
				          <tr><td ><strong>CURLOPT_HEADER</strong></td>
				           <td >启用时会将头文件的信息作为数据流输出。</td></tr>
				           <!-- 3列-->
				          <tr><td><strong>CURLINFO_HEADER_OUT</strong></td>
				           <td>启用时追踪句柄的请求字符串。</td><td >从 PHP 5.1.3 开始可用。<strong>CURLINFO_</strong>前缀是故意的(intentional)。</td>
				          </tr>
				          <tr><td><strong>CURLOPT_HTTPGET</strong></td>
				           <td>启用时会设置HTTP的method为GET，因为GET是默认是，所以只在被修改的情况下使用。</td><td rowspan="6"></td></tr>
				          <tr><td ><strong>CURLOPT_HTTPPROXYTUNNEL</strong></td>
				           <td >启用时会通过HTTP代理来传输。</td></tr>
				          <tr><td ><strong>CURLOPT_MUTE</strong></td><td >启用时将cURL函数中所有修改过的参数恢复默认值。
				           </td></tr>
				          <tr><td><strong>CURLOPT_NETRC</strong></td>
				           <td >在连接建立以后，访问<var class="filename">~/.netrc</var>文件获取用户名和密码信息连接远程站点。</td></tr>
				          <tr><td ><strong>CURLOPT_NOBODY</strong></td><td >启用时将不对HTML中的BODY部分进行输出。</td></tr>
				          <tr><td ><strong>CURLOPT_NOPROGRESS</strong></td><td ><p class="para">启用时关闭curl传输的进度条，此项的默认设置为启用。</p><blockquote class="note"><strong class="note">Note</strong>: 
				             <p class="para">PHP自动地设置这个选项为<strong>TRUE</strong>，这个选项仅仅应当在以调试为目的时被改变。</p></blockquote>
				            </td></tr>
							<!-- 3列 -->
				          <tr><td ><strong>CURLOPT_NOSIGNAL</strong></td>
				           <td >启用时忽略所有的curl传递给php进行的信号。在SAPI多线程传输时此项被默认启用。</td><td >cURL 7.10时被加入。</td></tr>
				          <tr><td ><strong>CURLOPT_POST</strong></td><td >启用时会发送一个常规的POST请求，类型为：<em>application/x-www-form-urlencoded</em>，就像表单提交的一样。
				           </td><td rowspan="3"></td></tr>
				          <tr><td ><strong>CURLOPT_PUT</strong></td><td >启用时允许HTTP发送文件，必须同时设置<strong>CURLOPT_INFILE</strong>和<strong>CURLOPT_INFILESIZE</strong>。</td></tr>
				          <tr><td ><strong>CURLOPT_RETURNTRANSFER</strong></td><td>TRUE,将curl_exec()获取的信息以文件流的形式返回，而不是直接输出。</td></tr>
				          <tr><td ><strong>CURLOPT_SSL_VERIFYPEER</strong></td><td >
				            禁用后cURL将终止从服务端进行验证。使用<strong>CURLOPT_CAINFO</strong>选项设置证书使用<strong>CURLOPT_CAPATH</strong>选项设置证书目录
				            如果<strong>CURLOPT_SSL_VERIFYPEER</strong>(默认值为2)被启用，<strong>CURLOPT_SSL_VERIFYHOST</strong>需要被设置成<strong>TRUE</strong>否则设置为<strong>FALSE</strong>。</td><td >
				            自cURL 7.10开始默认为<strong>TRUE</strong>。从cURL 7.10开始默认绑定安装。</td></tr>
				          <tr><td ><strong>CURLOPT_TRANSFERTEXT</strong></td>
				           <td>启用后对FTP传输使用ASCII模式。对于LDAP，它检索纯文本信息而非HTML。在Windows系统上，系统不会把<em>STDOUT</em>设置成binary模式。</td>
				           <td rowspan="4"></td></tr>
				          <tr><td><strong>CURLOPT_UNRESTRICTED_AUTH</strong></td><td>在使用<strong>CURLOPT_FOLLOWLOCATION</strong>产生的header中的多个locations中持续追加用户名和密码信息，即使域名已发生改变。
				           </td></tr>
				          <tr><td ><strong>CURLOPT_UPLOAD</strong></td><td >启用后允许文件上传。</td></tr>
				          <tr><td><strong>CURLOPT_VERBOSE</strong></td>
				           <td>启用时会汇报所有的信息，存放在<em>STDERR</em>或指定的<strong>CURLOPT_STDERR</strong>中。</td></tr>
		         		</tbody>
       				</table>
				</div>
			</div>
		</main>
		<footer>&copy; by dhm &nbsp; &nbsp; 2017,11,02 &nbsp; <a href="/"><?php $_SERVER['HTTP_HOST'];?></a></footer>
		<?php include_once("footer.php");?>
	</div>
	<script type="text/javascript">
		function fresh(id,src){
			document.getElementById(id).src=src;
		}
	</script>
</body>
</html>