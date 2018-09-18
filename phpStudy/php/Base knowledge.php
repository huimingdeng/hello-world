<?php namespace MyProject;?>
<!DOCTYPE html>
<html>
<head>
	<title>基础知识1</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container w980">
		<header><h1>PHP基本知识</h1></header>
		<main>
			<?php require_once("navbar.php"); navbar(basename(__FILE__));?>
			<article>
				<h2>1.超全局变量</h2>
				<p>——请具体详细的编写案例熟悉使用和注意事项。</p>
				<div class="row">
					<div class="col-xs-10">
						<table class="table table-bordered table-hover table-striped">
							<thead><tr><th>变量</th><th width="80%">描述</th></tr></thead>
							<tbody>
								<tr><td>$GLOBALS</td><td>是PHP的一个超级全局变量组，在一个PHP脚本的全部作用域中都可以访问。是一个包含了全部变量的全局组合数组。变量的名字就是数组的键。</td></tr>
								<tr><td>$_REQUEST</td><td>用于收集HTML表单提交的数据。</td></tr>
								<tr><td>$_POST</td><td>被广泛应用于收集表单数据，在HTML form标签的指定该属性："method="post"。</td></tr>
								<tr><td>$_GET</td><td>同样被广泛应用于收集表单数据，在HTML form标签的指定该属性："method="get"。</td></tr>
								<tr><td>$_FILES</td><td>通过 HTTP POST 方法传递的已上传文件项目组成的数组（二维数组）。是自动全局变量。 包含上传文件的文件信息。</td></tr>
								<tr><td>$_EVN</td><td>在解析器运行时，这些变量从环境变量转变为 PHP 全局变量名称空间（namespace）。它们中的许多都是由 PHP 所运行的系统决定。完整的列表是不可能的。请查看系统的文档以确定其特定的环境变量。 其它环境变量（包括 CGI 变量），无论 PHP 是以服务器模块或是以 CGI 处理方式运行，都在这里列出了。</td></tr>
								<tr><td>$_COOKIE</td><td>通过 HTTP cookies 传递的变量组成的数组。是自动全局变量。</td></tr>
								<tr><td>$_SESSION</td><td>包含当前脚本中 session 变量的数组。</td></tr>
								<tr><td>$_SERVER</td><td>服务器变量是一个包含了诸如头信息(header)、路径(path)、以及脚本位置(script locations)等等信息的数组。这个数组中的项目由 Web 服务器创建。不能保证每个服务器都提供全部项目；服务器可能会忽略一些，或者提供一些没有在这里列举出来的项目。<ul>
									<li>PHP_SELF:当前正在执行脚本的文件名，与 document root 相关。举例来说，在 URL 地址为 http://example.com/test.php/foo.bar 的脚本中使用 $_SERVER['PHP_SELF'] 将会得到 /test.php/foo.bar 这个结果。__FILE__ 常量包含当前（例如包含）文件的绝对路径和文件名。</li>
									<li>argv:传递给该脚本的参数。当脚本运行在命令行方式时，argv 变量传递给程序 C 语言样式的命令行参数。当调用 GET 方法时，该变量包含请求的数据。</li>
									<li>argc:包含传递给程序的命令行参数的个数（如果运行在命令行模式）。 </li>
									<li>GATEWAY_INTERFACE:服务器使用的 CGI 规范的版本。例如，“CGI/1.1”。 </li>
									<li>SERVER_NAME:当前运行脚本所在服务器主机的名称。如果该脚本运行在一个虚拟主机上，该名称是由那个虚拟主机所设置的值决定。</li>
									<li>SERVER_SOFTWARE:服务器标识的字串，在响应请求时的头信息中给出。 </li>
									<li>... ... </li>
									<li>SCRIPT_URI:URI 用来指定要访问的页面。例如 "/index.html"。</li>
								</ul></td></tr>
							</tbody>
						</table>
					</div>
				</div>
				<h2>2.魔术变量</h2>
				<p>——有八个魔术常量它们的值随着它们在代码中的位置改变而改变。</p>
				<div class="row">
					<div class="col-xs-8">
						<ul class="custom_style_ul">
							<li><b>__LINE__</b> 文件中的当前行号。<kbd><?php echo __LINE__;?></kbd></li>
							<li><b>__FILE__</b> 文件的完整路径和文件名。如果用在被包含文件中，则返回被包含的文件名。<kbd><?php echo __FILE__;?></kbd></li>
							<li><b>__DIR__</b> 文件所在的目录。如果用在被包括文件中，则返回被包括的文件所在的目录。等价于 dirname(__FILE__)。除非是根目录，否则目录中名不包括末尾的斜杠。<em class="label label-warning">php5.3</em> <kbd><?php echo __DIR__;?></kbd></li>
							<li><b>__FUNCTION__</b> 函数名称（PHP 4.3.0 新加）。自 PHP 5 起本常量返回该函数被定义时的名字（区分大小写）。在 PHP 4 中该值总是小写字母的。<pre class="pre-scrollable"><em class="red">&lt;?php</em> <b class="red">function</b> func(){<i class="green">echo</i> <i class="orange">__FUNCTION__</i>;} func();<em class="red">?&gt;</em></pre><kbd><?php function func(){
								echo __FUNCTION__;
								} 
								func();?></kbd></li>
							<li><b>__CLASS__</b> 类的名称（PHP 4.3.0 新加）。自 PHP 5 起本常量返回该类被定义时的名字（区分大小写）<pre class="pre-scrollable"><em class="red">&lt;?php</em> <b class="orange">class</b> <i class="blue">className</i>{<br> <b class="red">function</b> <i class="blue">__construct</i>(){ <i class="green">echo</i> <i class="orange">__CLASS__</i>;} } <br> <i class="green">$</i><i class="blue">test</i>=<i class="red">new</i> className(); <em class="red">?&gt;</em></pre><kbd><?php 
							class className{ 
								function __construct(){ 
									echo __CLASS__;
								} 
							} 
							$test=new className();
							?></kbd></li>
							<li><b>__TRAIT__</b> Trait 的名字（PHP 5.4.0 新加）。自 PHP 5.4.0 起，PHP 实现了代码复用的一个方法，称为 traits。</li>
							<li><b>__METHOD__</b> 类的方法名（PHP 5.0.0 新加）。返回该方法被定义时的名字（区分大小写）</li>
							<li><b>__NAMESPACE__</b> 当前命名空间的名称（区分大小写）。此常量是在编译时定义的（PHP 5.3.0 新增）<kbd><?php echo  __NAMESPACE__;?></kbd></li>
						</ul>
					</div>
				</div>
				<div class="row">
					
					<h2>3.命名空间(namespace)</h2>
					<p>——PHP 命名空间可以解决以下两类问题：</p>
					<ul>
						<li>用户编写的代码与PHP内部的类/函数/常量或第三方类/函数/常量之间的名字冲突</li>	
						<li>为很长的标识符名称(通常是为了缓解第一类问题而定义的)创建一个别名（或简短）的名称，提高源代码的可读性</li>
					</ul>
					<h3>定义命名空间</h2>
					<p>默认情况下，所有常量、类和函数名都放在全局空间下，就和PHP支持命名空间之前一样。</p>
					<p>命名空间通过关键字namespace 来声明。如果一个文件中包含命名空间，它必须在其它所有代码之前声明命名空间。</p>
					<p>在声明命名空间之前唯一合法的代码是用于定义源文件编码方式的 declare 语句。所有非 PHP 代码包括空白符都不能出现在命名空间的声明之前。</p>
					<h3>子命名空间</h3>
					<p>与目录和文件的关系很象，PHP 命名空间也允许指定层次化的命名空间的名称。因此，命名空间的名字可以使用分层次的方式定义</p>
					<h3>命名空间使用</h3>
					<p>PHP 命名空间中的类名可以通过三种方式引用：</p>
					<ul>
						<li><b>非限定名称，或不包含前缀的类名称，</b>例如 <code>$a=new foo();</code> 或 <code>foo::staticmethod();</code>。如果当前命名空间是 currentnamespace，foo 将被解析为 currentnamespace\foo。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，则 foo 会被解析为foo。 <span class="text-warning">警告：如果命名空间中的函数或常量未定义，则该非限定的函数名称或常量名称会被解析为全局函数名称或常量名称。</span></li>
						<li><b>限定名称,或包含前缀的名称，</b>例如 <code>$a = new subnamespace\foo();</code> 或 <code>subnamespace\foo::staticmethod();</code>。如果当前的命名空间是 currentnamespace，则 foo 会被解析为 <code>currentnamespace\subnamespace\foo</code>。如果使用 foo 的代码是全局的，不包含在任何命名空间中的代码，foo 会被解析为subnamespace\foo。</li>
						<li><b>完全限定名称，或包含了全局前缀操作符的名称，</b>例如，<code>$a = new \currentnamespace\foo();</code> 或 <code>\currentnamespace\foo::staticmethod();</code>。在这种情况下，foo 总是被解析为代码中的文字名<code>(literal name)currentnamespace\foo</code>。</li>
					</ul>
				</div>
			</article>
		</main>
		<footer>&copy;by dhm &nbsp;,&nbsp; 20171023 ,&nbsp;&nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST']; ?></a></footer>
		<?php require_once("footer.php");?>
	</div>
</body>
</html>