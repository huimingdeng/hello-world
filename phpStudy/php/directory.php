<!DOCTYPE html>
<html>
<head>
	<title>php函数——目录函数</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header><h1>PHP目录函数 <small>——php基础函数之目录函数<sup>节选</sup></small></h1></header>
		<main>
			<?php require_once("navbar.php"); navbar(basename(__FILE__));?>
			<div class="row">
				<div class="col-xs-6">
					<p><b>1.<code>dir(directory,context)</code></b>:返回 Directory 类的实例<sup class="badge badge-warning">php4.0.x+</sup>。该函数用于读取一个目录，包含如下：</p>
					<ul class="list-styled">
						<li class="list-group-item-text">给定的要打开的目录</li>
						<li class="list-group-item-text">dir() 的 handle 和 path 两个属性是可用的</li>
						<li class="list-group-item-text">handle 和 path 属性有三个方法：read()、rewind() 和 close()</li>
					</ul>
					<pre class="pre-scrollable"><em class="red">&lt;?php </em><br> <i class="green">$</i><i class="blue">d</i>=<i class="blue">dir</i>(<i class="blue">getcwd</i>());<br> <i class="green">echo</i> "Handle:".<i class="green">$</i><i class="blue">d</i><i class="orange">-></i><i class="blue">handle</i>."&lt;br&gt;";<br> <i class="green">echo</i> "Path".<i class="green">$</i><i class="blue">d</i><i class="orange">-></i><i class="blue">path</i>."&lt;br&gt;";<br> <i class="green">while</i>((<i class="green">$</i><i class="blue">file</i>=<i class="green">$</i><i class="blue">d</i><i class="orange">-></i>read()) !== <i class="orange">false</i> ){<br> &nbsp; <i class="green">echo</i> "filename:".<i class="green">$</i><i class="blue">file</i>."&lt;br&gt;"; <br> }<br> <i class="green">$</i><i class="blue">d</i><i class="orange">-></i>close(); <br><em class="red">?&gt;</em></pre>
					<p class="text-success">示例运行结果：<br><kbd><?php 
					$d=dir(getcwd());
					echo "Handle:".$d->handle."<br>";
					echo "Path:".$d->path."<br>";
					while(($file=$d->read())!==false){
						echo "filename:".$file."<br>";
					}
					$d->close();
					?></kbd></p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>directory</td><td>必需。规定要打开的目录。</td></tr>
							<tr><td>context</td><td>可选</td></tr>
							<tr><td>返回值：</td><td>返回 Directory 类的实例。失败则返回 FALSE。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b id="opendir">2.<code>opendir(path,context)</code></b>:打开目录句柄<sup class="badge badge-warning">php4.0.x+</sup>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">dir</i>= <i class="blue">dirname</i>(<i class="orange">__FILE__</i>)."/globals";<br> <i class="green">if</i>(<i class="blue">is_dir</i>(<i class="green">$</i><i class="blue">dir</i>)){<br>  &nbsp;  <i class="green">if</i>(<i class="green">$</i><i class="blue">dh</i>=<i class="blue">opendir</i>(<i class="green">$</i><i class="blue">dir</i>)){<br> &nbsp; &nbsp; &nbsp; <i class="green">while</i> ((<i class="green">$</i><i class="blue">file</i> = <a href="#readdir"><abbr class="blue" title="见本章函数-readdir()">readdir</abbr></a>(<i class="green">$</i><i class="blue">dh</i>)) !== <i class="orange">false</i>){<br> &nbsp; &nbsp; &nbsp; &nbsp; <i class="green">if</i>(<i class="blue">is_file</i>(<i class="green">$</i><i class="blue">dir</i>.'/'.<i class="green">$</i><i class="blue">file</i>))<br> &nbsp; &nbsp; &nbsp; &nbsp; <i class="green">echo</i> "filename:" . <i class="green">$</i><i class="blue">file</i> . "&lt;br&gt;";<br> &nbsp; &nbsp; &nbsp; }<br> &nbsp; &nbsp; &nbsp; <a href="#closedir"><abbr class="blue" title="见本章函数-closedir()">closedir</abbr></a>(<i class="green">$</i><i class="blue">dh</i>);<br> &nbsp; &nbsp; }<br> } <em class="red">?&gt;</em></pre>
					<p class="text-success">返回结果如下：<br>
					<kbd><?php $dir=dirname(__FILE__)."/globals";
						if(is_dir($dir)){
							if($dh=opendir($dir)){
								while (($file = readdir($dh)) !== false){
									if(is_file($dir.'/'.$file))
									echo "filename:" . $file . "<br>";
								}
								closedir($dh);
							}
						}?></kbd></p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>path</td><td>必需。规定要打开的目录路径。</td></tr>
							<tr><td>context</td><td>可选。规定目录句柄的环境。context 是可修改目录流的行为的一套选项。</td></tr>
							<tr><td>返回值：</td><td>成功则返回目录句柄资源。失败则返回 FALSE。如果路径不是合法目录，或者由于许可限制或文件系统错误导致的目录不能打开，则抛出 E_WARNING 级别的错误。您可以通过在函数名称前添加 '@' 来隐藏 opendir() 的错误输出。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>3.<code>getcwd()</code></b>:返回当前工作目录<sup class="badge badge-warning">php4.0.x+</sup>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">getcwd</i>();<em class="red">?&gt;</em></pre>
					<p class="text-success">上述代码运行结果：<kbd><?php echo getcwd();?></kbd></p>
					<table class="table table-bordered table-hover table-striped">
						<tbody>
							<tr><td>返回值：</td><td>成功则返回当前工作目录。失败则返回 FALSE。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>4.<code>chdir(directory)</code></b>:改变当前的目录<sup class="badge badge-warning">php4.0.x+</sup>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">getcwd</i>()."&lt;br&gt;";<br> <i class="blue">chdir</i>("..");<br> <i class="green">echo</i> <i class="blue">getcwd</i>(); <br><em class="red">?&gt;</em></pre>
					<p class="text-success"><?php echo "当前目录路径：<kbd>".getcwd()."</kbd><br>"; chdir(".."); echo "修改后目录路径：<kbd>".getcwd()."</kbd>";?></p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>directory</td><td>必需。规定新的当前目录。</td></tr>
							<tr><td>返回值：</td><td>成功则返回 TRUE。失败则返回 FALSE，且抛出 E_WARNING 级别的错误。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b id="readdir">5.<code>readdir(dir_handle)</code></b>:返回目录中下一个文件的文件名<sup class="badge badge-warning">php4.0.x+</sup>。</p>
					<p class="text-success">函数例子如<a href="#opendir"><code>opendir()</code></a>函数中</p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>dir_handle</td><td>可选。指定之前由 opendir() 打开的目录句柄资源。如果该参数未指定，则使用最后一个由 opendir() 打开的链接。</td></tr>
							<tr><td>返回值：</td><td>成功则返回文件名，失败则返回 FALSE。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b id="closedir">6.<code>closedir(dir_handle)</code></b>:关闭目录句柄<sup class="badge badge-warning">php4.0.x+</sup>。</p>
					<p class="text-success">函数例子如<a href="#opendir"><code>opendir()</code></a>函数中</p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>dir_handle</td><td>可选。指定之前由 opendir() 打开的目录句柄资源。如果该参数未指定，则使用最后一个由 opendir() 打开的链接。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>7.<code>rewinddir(dir_handle)</code></b>:重置由 opendir() 创建的目录句柄<sup class="badge badge-warning">php4.0.x+</sup>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">dir</i>= <i class="blue">dirname</i>(<i class="orange">__FILE__</i>)."/globals";<br> <i class="green">if</i>(<i class="blue">is_dir</i>(<i class="green">$</i><i class="blue">dir</i>)){<br>  &nbsp;  <i class="green">if</i>(<i class="green">$</i><i class="blue">dh</i>=<i class="blue">opendir</i>(<i class="green">$</i><i class="blue">dir</i>)){<br> &nbsp; &nbsp; &nbsp; <i class="green">while</i> ((<i class="green">$</i><i class="blue">file</i> = <a href="#readdir"><abbr class="blue" title="见本章函数-readdir()">readdir</abbr></a>(<i class="green">$</i><i class="blue">dh</i>)) !== <i class="orange">false</i>){<br> &nbsp; &nbsp; &nbsp; &nbsp; <i class="green">if</i>(<i class="blue">is_file</i>(<i class="green">$</i><i class="blue">dir</i>.'/'.<i class="green">$</i><i class="blue">file</i>))<br> &nbsp; &nbsp; &nbsp; &nbsp; <i class="green">echo</i> "filename:" . <i class="green">$</i><i class="blue">file</i> . "&lt;br&gt;";<br> &nbsp; &nbsp; &nbsp; }<br> &nbsp; &nbsp; &nbsp; <i class="green">echo</i> '--------------rewinddir()-------------'."&lt;br&gt;";<br> &nbsp; &nbsp; &nbsp; <i class="blue">rewinddir</i>();<br> &nbsp; &nbsp; &nbsp; <i class="green">while</i>( (<i class="green">$</i><i class="blue">file</i> = <i class="blue">readdir</i>(<i class="green">$</i><i class="blue">dh</i>)) !== <i class="orange">false</i> ){<br> &nbsp; &nbsp; &nbsp; &nbsp; <i class="green">echo</i> "filename:" . <i class="green">$</i><i class="blue">file</i> . "&lt;br&gt;";<br> &nbsp; &nbsp; &nbsp; }<br> &nbsp; &nbsp; &nbsp; <a href="#closedir"><abbr class="blue" title="见本章函数-closedir()">closedir</abbr></a>(<i class="green">$</i><i class="blue">dh</i>);<br> &nbsp; &nbsp; }<br> } <em class="red">?&gt;</em></pre>
					<p class="text-success">上述代码运行结果：<br><kbd><?php $dir= dirname(__FILE__)."/globals";
						 if(is_dir($dir)){
						     if($dh=opendir($dir)){
						       while (($file = readdir($dh)) !== false){
						         if(is_file($dir.'/'.$file))
						         echo "filename:" . $file . "<br>";
						       }
						       echo '--------------rewinddir()-------------'."<br>";
						       rewinddir();
						       while( ($file = readdir($dh)) !== false ){
						         echo "filename:" . $file . "<br>";
						       }
						       closedir($dh);
						     }
						 } ?></kbd></p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>dir_handle</td><td>可选。指定之前由 opendir() 打开的目录句柄资源。如果该参数未指定，则使用最后一个由 opendir() 打开的链接。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>8.<code>scandir(directory,sorting_order,context)</code></b>:返回指定目录中的文件和目录的数组<sup class="badge badge-warning">php5.0.x+</sup>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">dir</i>=<i class="blue">dirname</i>(<i class="orange">__FILE__</i>)."/globals/";<br> <i class="green">$</i><i class="blue">a</i>=<i class="blue">scandir</i>(<i class="green">$</i><i class="blue">dir</i>);<br> <i class="green">$</i><i class="blue">b</i>=<i class="blue">scandir</i>(<i class="green">$</i><i class="blue">dir</i>,1);<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">a</i>);<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">b</i>); <br><em class="red">?&gt;</em><br>上述代码运行结果：<br><kbd><?php
					 $dir=dirname(__FILE__)."/globals";
					 $a=scandir($dir);
					 $b=scandir($dir,1);
					 print_r($a);
					 print_r($b); 
					?></kbd></pre>
					<table class="table table-bordered table-hover table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>directory</td><td>必需。规定要扫描的目录。</td></tr>
							<tr><td>sorting_order</td><td>可选。规定排列顺序。默认是 0，表示按字母升序排列。如果设置为 SCANDIR_SORT_DESCENDING 或者 1，则表示按字母降序排列。如果设置为 SCANDIR_SORT_NONE，则返回未排列的结果。<em class="text-danger">PHP 5.4：新增 sorting_order 常量</em></td></tr>
							<tr><td>context</td><td>可选。规定目录句柄的环境。context 是可修改目录流的行为的一套选项。</td></tr>
							<tr><td>返回值：</td><td>成功则返回文件和目录的数组。失败则返回 FALSE。如果 directory 不是一个目录，则抛出 E_WARNING 级别的错误。</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>9.<code>chroot(directory)</code></b>:改变当前进程的根目录为 directory，并把当前工作目录改为 "/"<sup class="badge badge-warning">php4.0.5+</sup>。</p>
					<p><b>注意</b>：该函数需要 root 权限，且仅在 GNU 和 BSD 系统上仅当使用 CLI、CGI、嵌入式 SAPI 时可用。<em class="text-danger">该函数没有在 Windows 平台上实现</em>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="blue">chroot</i>("/path/to/chroot/");<br> <i class="green">echo</i> <i class="blue">getcwd</i>(); <br><em class="red">?&gt;</em></pre>
					<p class="text-success">修改成功后：<kbd>/</kbd></p>
					<table class="table table-bordered table-striped table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>directory</td><td>必需。规定新的根目录路径。</td></tr>
							<tr><td>返回值：</td><td>成功则返回 TRUE，失败则返回 FALSE。</td></tr>
						</tbody>
					</table>
				</div>
			</div>
		</main>
		<footer>&copy; by dhm &nbsp;,&nbsp; 20171018 ,&nbsp;&nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST']; ?></a></footer>
		<?php require_once("footer.php"); ?>
	</div>
</body>
</html>