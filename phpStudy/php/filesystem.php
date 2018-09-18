<!DOCTYPE html>
<html>
<head>
	<title>php函数——文件系统函数</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header><h1>PHP文件系统函数 <small>——php基础函数之文件系统函数<sup>节选</sup></small></h1></header>
		<main>
			<?php require_once("navbar.php"); navbar(basename(__FILE__));?>
			<div class="row">
				<div class="col-xs-6">
					<p><b>1.<code>basename(path,suffix)</code></b>:返回路径的文件名部分</p>		
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">basename</i>(<i class="orange">__FILE__</i>)."&lt;br&gt;";<br> <i class="green">echo</i> <i class="blue">basename</i>(<i class="orange">__FILE__</i>,".php"); <em class="red">?&gt;</em></pre>
					<p class="text-success">当前文件的名称（含后缀）：<br><kbd><?php echo basename(__FILE__)."<br>不含后缀：<br>";
					echo basename(__FILE__,".php");?></kbd></p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>path</td><td>必需。规定要检查的路径。</td></tr>
							<tr><td>suffix</td><td>可选。规定文件扩展名。如果文件有名有文件扩展名，将不会显示这个扩展名。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>2.<code>dirname(path)</code></b>:返回路径中的目录名称部分。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">dirname</i>(<i class="orange">__FILE__</i>); <em class="red">?&gt;</em></pre>
					<p class="text-success">返回当前文件路径：<kbd><?php echo dirname(__FILE__); ?></kbd></p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>path</td><td>必需。规定要检查的路径。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>3.<code>feof(file)</code></b>:检查是否已到达文件末尾（EOF）。</p>
					<p class="text-danger">示例效果见<code>fgetc()</code>函数中。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th>描述</th></tr></thead>
						<tbody>
							<tr><td>file</td><td>必需。规定要检查的打开文件。</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<p><b>4.<code>file(path,include_path,context)</code></b>:把整个文件读入一个数组中。</p>
					<p class="text-warning">数组中的每个元素都是文件中相应的一行，包括换行符在内。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">path</i>="globals/file.txt"; //or dirname(<__FILE__)."/globals/file.txt"<br> <i class="blue">print_r</i>(<i class="blue">file</i>(<i class="green">$</i><i class="blue">path</i>));<em class="red">?&gt;</em></pre>
					<p><kbd><?php $path="globals/file.txt";//or dirname(__FILE__)."/globals/file.txt"
						print_r(file($path));
					?></kbd></p>
					<p class="text-danger">从 PHP 4.3 开始，该函数是二进制安全的。（意思是二进制数据（如图像）和字符数据都可以使用此函数写入。）</p>
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>参数</th>
								<th width="80%">描述</th>
							</tr>
						</thead>
						<tbody>
							<tr><td>path</td><td>必需。规定要读取的文件。</td></tr>
							<tr><td>include_path</td><td>可选。如果您还想在 include_path（在 php.ini 中）中搜索文件的话，请设置该参数为 '1'。</td></tr>
							<tr><td>context</td><td>可选。规定文件句柄的环境。context 是一套可以修改流的行为的选项。若使用 NULL，则忽略。</td></tr>
						</tbody>
					</table>

				</div>
				<div class="col-xs-4">
					<p><b>5.<code>fgetc(file)</code></b>:从打开的文件中返回一个单一的字符。</p>
					<p class="text-warning">该函数处理大文件非常缓慢，所以它不用于处理大文件。如果您需要从一个大文件依次读取一个字符，请使用 fgets() 依次读取一行数据，然后使用 fgetc() 依次处理行数据。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">file</i>=<abbr class="blue" title="打开文件资源，一般和fclose()一起使用">fopen</abbr>("globals/file.txt","r");<br> <i class="green">while</i>(!<abbr class="blue" title="用于判断文件是否结束">feof</abbr>(<i class="green">$</i><i class="blue">file</i>))<br> <i class="green">echo</i> <i class="blue">fgetc</i>(<i class="green">$</i><i class="blue">file</i>);<br> <abbr class="blue" title="关闭文件资源,一般和fopen()一起使用">fclose</abbr>(<i class="green">$</i><i class="blue">file</i>);<em class="red">?&gt;</em></pre>
					<p class="text-success">对globals目录的file.txt文件操作：<br><kbd><?php $file=fopen("globals/file.txt","r");
					while(!feof($file))
					echo fgetc($file);
					fclose($file);?></kbd></p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th>描述</th></tr></thead>
						<tbody>
							<tr><td>file</td><td>必需。规定要检查的文件。</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>6.<code>fopen(filename,mode,include_path,context)</code></b>:打开一个文件或 URL</p>
					<p class="text-danger">如果 fopen() 失败，它将返回 FALSE 并附带错误信息。您可以通过在函数名前面添加一个 '@' 来隐藏错误输出。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>filename</td><td>必需。规定要打开的文件或 URL。</td></tr>
							<tr><td>mode</td>
								<td>必需。规定您请求到该文件/流的访问类型。<br>
									可能的值：
									<ul class="list-style">
										<li>"r" （只读方式打开，将文件指针指向文件头）</li>
										<li>"r+" （读写方式打开，将文件指针指向文件头）</li>
										<li>"w" （写入方式打开，清除文件内容，如果文件不存在则尝试创建之）</li>
										<li>"w+" （读写方式打开，清除文件内容，如果文件不存在则尝试创建之）</li>
										<li>"a" （写入方式打开，将文件指针指向文件末尾进行写入，如果文件不存在则尝试创建之）</li>
										<li>"a+" （读写方式打开，通过将文件指针指向文件末尾进行写入来保存文件内容）</li>
										<li>"x" （创建一个新的文件并以写入方式打开，如果文件已存在则返回 FALSE 和一个错误）</li>
										<li>"x+" （创建一个新的文件并以读写方式打开，如果文件已存在则返回 FALSE 和一个错误）</li>
									</ul>
								</td>
							</tr>
							<tr><td>include_path</td><td>可选。如果您还想在 include_path（在 php.ini 中）中搜索文件的话，请设置该参数为 '1'。</td></tr>
							<tr><td>context</td><td>可选。规定文件句柄的环境。context 是一套可以修改流的行为的选项。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>7.<code>fclose(file)</code></b>:关闭打开的文件。</p>
					<p class="text-warning">该函数如果成功则返回 TRUE，如果失败则返回 FALSE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>file</td><td>必需。规定要关闭的文件。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>8.<code>filectime(filename)</code></b>:返回文件上次修改时间——如果成功，该函数将以 Unix 时间戳形式返回文件的上次修改时间。如果失败，则返回 FALSE。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">date</i>("Y-m-d H:i:s",<i class="blue">filectime</i>(<i class="green">$</i><i class="blue">path</i>));<em class="red">?&gt;</em></pre>
					<p class="text-success">file.txt文件上次修改时间：<kbd><?php echo date("Y-m-d  H:i:s",filectime($path)); ?></kbd><b class="text-danger">PHP 5.5.38没有报错，低于这个版本date()函数报错</b></p>
					<table class="table table-bordered">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr><td>filename</td><td>必需。规定要检查的文件。</td></tr></tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>9.<code>clearstatcache()</code></b>:清除文件状态缓存</p>
					<p class="text-danger">PHP 会缓存某些函数的返回信息，以便提供更高的性能。但是有时候，比如在一个脚本中多次检查同一个文件，而该文件在此脚本执行期间有被删除或修改的危险时，你需要清除文件状态缓存，以便获得正确的结果。要做到这一点，请使用 <code>clearstatcache()</code>函数</p>
					<p class="text-warning">会进行缓存的函数，即受 clearstatcache() 函数影响的函数：</p>
					<ul class="list-inline">
						<li>stat()</li>
						<li>lstat()</li>
						<li>file_exists()</li>
						<li>is_writable()</li>
						<li>is_readable()</li>
						<li>is_executable()</li>
						<li>is_file()</li>
						<li>is_dir()</li>
						<li>is_link()</li>
						<li>filectime()</li>
						<li>fileatime()</li>
						<li>filemtime()</li>
						<li>fileinode()</li>
						<li>filegroup()</li>
						<li>fileowner()</li>
						<li>filesize()</li>
						<li>filetype()</li>
						<li>fileperms()</li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>10.<code>fgetss(file,length,tags)</code></b>:从打开的文件中返回一行，并过滤掉 HTML 和 PHP 标签。</p>
					<p class="text-danger">fgetss() 函数会在到达指定长度或读到文件末尾（EOF）时（以先到者为准），停止返回一个新行。如果失败该函数返回 FALSE。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">ht</i>=<i class="blue">fopen</i>("globals/me.htm","r");<br> <i class="green">while</i>(!<i class="blue">feof</i>(<i class="green">$</i><i class="blue">ht</i>))<br> <i class="green">echo</i> <i class="blue">fgetss</i>(<i class="green">$</i><i class="blue">ht</i>); <br> <i class="blue">fclose</i>(<i class="green">$</i><i class="blue">ht</i>);<em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php
					$ht=fopen("globals/me.htm","r");
					while(!feof($ht))
					echo fgetss($ht); 
					fclose($ht);?></kbd></p>
					<p>例2：<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">ht</i>=<i class="blue">fopen</i>("globals/me.htm","r");<br> <i class="green">while</i>(!<i class="blue">feof</i>(<i class="green">$</i><i class="blue">ht</i>))<br> <i class="green">echo</i> <i class="blue">fgetss</i>(<i class="green">$</i><i class="blue">ht</i>,1024,"&lt;p&gt;,&lt;b&gt;"); <br> <i class="blue">fclose</i>(<i class="green">$</i><i class="blue">ht</i>);<em class="red">?&gt;</em></pre><?php
					$ht=fopen("globals/me.htm","r");
					while(!feof($ht))
					echo fgetss($ht,1024,"<p>,<b>"); 
					fclose($ht);?></p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>file</td><td>必需。规定要检查的文件。</td></tr>
							<tr><td>length</td><td>可选。规定要读取的字节数。默认是 1024 字节。<b>注意：</b>该参数在<em class="label label-danger">PHP 5</em>之前的版本是必需的。</td></tr>
							<tr><td>tags</td><td>可选。指定哪些标记不被去掉。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>11.<code>fgets(file,length)</code></b>:从打开的文件中返回一行。</p>
					<p>fgets() 函数会在到达指定长度或读到文件末尾（EOF）时（以先到者为准），停止返回一个新行。如果失败该函数返回 FALSE。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">dh</i>=<i class="blue">fopen</i>("globals/file.txt","r");<br> <i class="green">echo</i> <i class="blue">fgets</i>(<i class="green">$</i><i class="blue">dh</i>); <br> <i class="blue">fclose</i>(<i class="green">$</i><i class="blue">dh</i>);<em class="red">?&gt;</em></pre>
					<p><kbd><?php 
						$dh=fopen('globals/file.txt','r');
						echo fgets($dh);
						fclose($dh)
					?></kbd></p>
					<p>例2：<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">ht</i>=<i class="blue">fopen</i>("globals/me.htm","r");<br> <i class="green">while</i>(!<i class="blue">feof</i>(<i class="green">$</i><i class="blue">ht</i>))<br> <i class="green">echo</i> <i class="blue">fgetss</i>(<i class="green">$</i><i class="blue">ht</i>,1024,"&lt;p&gt;,&lt;b&gt;"); <br> <i class="blue">fclose</i>(<i class="green">$</i><i class="blue">ht</i>);<em class="red">?&gt;</em></pre><?php
					$ht=fopen("globals/me.htm","r");
					while(!feof($ht))
					echo fgets($ht,1024); 
					fclose($ht);?></p>
					<table class="table table-bordered">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>file</td><td>必需。规定要读取的文件</td></tr>
							<tr><td>length</td><td>可选。规定要读取的字节数。默认是 1024 字节。</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<p><b>12.<code>file_exists(path)</code></b>:检查文件或目录是否存在。</p>
					<pre><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">file_exists</i>("globals/file.txt"); <em class="red">?&gt;</em></pre>
					<p>文件是否存在，存在返回TRUE，否则FALSE。<kbd><?php echo file_exists("globals/file.txt");?></kbd></p>
					<table class="table table-bordered">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>path</td><td>必需。规定要检查的路径。</td></tr></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>13.<code>file_get_contents(path,include_path,context,start,max_length)</code></b>:把整个文件读入一个字符串中。</p>
					<pre><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">file_get_contents</i>("globals/file.txt");<em class="red">?&gt;</em></pre>
					<p>输出结果：<kbd><?php echo file_get_contents("globals/file.txt");?></kbd></p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>path</td><td>必需。规定要检查的路径。</td></tr></tr>
							<tr><td>include_path</td><td>可选。如果您还想在 include_path（在 php.ini 中）中搜索文件的话，请设置该参数为 '1'。</td></tr>
							<tr><td>context</td><td>可选。规定文件句柄的环境。context 是一套可以修改流的行为的选项。若使用 NULL，则忽略。</td></tr>
							<tr><td>start</td><td>可选。规定在文件中开始读取的位置。该参数是 <em class="label label-warning">PHP 5.1</em> 中新增的。</td></tr>
							<tr><td>max_length</td><td>可选。规定读取的字节数。该参数是 <em class="label label-warning">PHP 5.1</em> 中新增的。</td></tr>
						</tbody>
					</table>
					<p><b>提示</b>：该函数是二进制安全的。（意思是二进制数据（如图像）和字符数据都可以使用此函数写入。）</p>
				</div>
				<div class="col-xs-6">
					<p><b>14.<code>file_put_contents(file,data,mode,context)</code></b>:把一个字符串写入文件中。</p>
					<p>该函数访问文件时，遵循以下规则：</p>
					<ol>
						<li>如果设置了 FILE_USE_INCLUDE_PATH，那么将检查 *filename* 副本的内置路径</li>
						<li>如果文件不存在，将创建一个文件</li>
						<li>打开文件</li>
						<li>如果设置了 LOCK_EX，那么将锁定文件</li>
						<li>如果设置了 FILE_APPEND，那么将移至文件末尾。否则，将会清除文件的内容</li>
						<li>向文件中写入数据</li>
						<li>关闭文件并对所有文件解锁</li>
					</ol>
					<p>如果成功，该函数将返回写入文件中的字符数。如果失败，则返回 False。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">file_put_contents</i>("file.txt","Hello World. Testing!"); <em class="red">?&gt;</em></pre>
					<p>返回值：<kbd><?php echo file_put_contents("file.txt","Hello World. Testing!",LOCK_EX);?></kbd></p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>file</td><td>必需。规定要写入数据的文件。如果文件不存在，则创建一个新文件。</td></tr></tr>
							<tr><td>data</td><td>必需。规定要写入文件的数据。可以是字符串、数组或数据流。</td></tr>
							<tr><td>mode</td>
								<td>可选。规定如何打开/写入文件。可能的值：
									<ul>
										<li>FILE_USE_INCLUDE_PATH</li>
										<li>FILE_APPEND</li>
										<li>LOCK_EX</li>
									</ul>
								</td>
							</tr>
							<tr><td>context</td><td>可选。规定文件句柄的环境。context 是一套可以修改流的行为的选项。</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-7">
					<p><b>15.<code>filesize(filename)</code></b>:返回指定文件的大小。</p>
					<p>如果成功，该函数返回文件大小的字节数。如果失败，则返回 FALSE。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">filesize</i>('file.txt'); <em class="red">?&gt;</em><kbd>//文件大小：<?php echo filesize('file.txt');?></kbd></pre>
					<table class="table table-bordered">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>filename</td><td>	必需。规定要检查的文件。</td></tr>
						</tbody>
					</table>
				</div>
				<!-- end filesize on 20171019 and begin on 20171020 new func -->
				<div class="col-xs-6">
					<p><b>16.<code>fputcsv(file,fields,seperator,enclosure)</code></b>:将行格式化为 CSV 并写入一个打开的文件中。该函数返回写入字符串的长度。如果失败，则返回 FALSE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>file</td><td>必需。规定要写入的打开文件。</td></tr>
							<tr><td>fields</td><td>必需。规定要从中获得数据的数组。</td></tr>
							<tr><td>separate</td><td>可选。设置字段分界符（只允许一个字符），默认值为逗号（ , ）。</td></tr>
							<tr><td>enclosure</td><td>可选。设置字段环绕符（只允许一个字符），默认值为双引号（ " ）。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">list</i>=<i class="orange">array</i>(<br> "Peter,Griffin,Oslo,Norway",<br> "Glenn,Quagmire,Oslo,Norway",<br>);<br> <i class="green">$</i><i class="blue">csv</i>=<i class="blue">fopen</i>("file.csv","w");<br> <i class="green">foreach</i>(<i class="green">$</i><i class="blue">list</i> <i class="green">as</i> <i class="green">$</i><i class="blue">line</i>){<br> &nbsp; <i class="blue">fputcsv</i>(<i class="green">$</i><i class="blue">csv</i>,<i class="blue">explode</i>(',',<i class="green">$</i><i class="blue">line</i>));<br> }<br> <i class="blue">fclose</i>(<i class="green">$</i><i class="blue">csv</i>); <em class="red">?&gt;</em></pre>
					<p class="text-success">如果无file.csv文件，则创建并写入，存在则直接写入。
					<?php /*$list=array(
					 "Peter,Griffin,Oslo,Norway",
					 "Glenn,Quagmire,Oslo,Norway",
					);
					 $csv=fopen("file.csv","w");
					 foreach($list as $line){
					 	fputcsv($csv,explode(',',$line));
					 }
					 fclose($csv);*/ ?>
					</p>	
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>17.<code>fgetcsv(file,length,separator,enclosure)</code></b>:从打开的文件中解析一行，校验 CSV 字段。</p>
					<p>fgetcsv() 函数会在到达指定长度或读到文件末尾（EOF）时（以先到者为准），停止返回一个新行。</p>
					<p>该函数如果成功则以数组形式返回 CSV 字段，如果失败或者到达文件末尾（EOF）则返回 FALSE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>file</td><td>必需。规定要检查的文件。</td></tr>
							<tr><td>length</td><td>可选。规定行的最大长度。必须大于 CSV 文件内最长的一行。如果忽略该参数（或者设置为 0），那么行长度就没有限制，不过可能会影响执行效率。<br><b>注意</b>:该参数在 <em class="label label-danger">PHP 5</em> 之前的版本是必需的。</td></tr>
							<tr><td>separate</td><td>可选。设置字段分界符（只允许一个字符），默认值为逗号（ , ）。</td></tr>
							<tr><td>enclosure</td><td>可选。设置字段环绕符（只允许一个字符），默认值为双引号（ " ）。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">file</i>=<i class="blue">fopen</i>("file.csv","r");<br> <i class="blue">print_r</i>(<i class="blue">fgetcsv</i>(<i class="green">$</i><i class="blue">file</i>));<br> <i class="blue">fclose</i>(<i class="green">$</i><i class="blue">file</i>); <em class="red">?&gt;</em></pre>
					<p class="text-success">直接打印<code>fgetcsv($file)</code>:<br>
						<kbd><?php $file=fopen("file.csv","r");
 							print_r(fgetcsv($file));
 							fclose($file); ?></kbd> <br>最终只打印文件中的一行。
					</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">file</i>=<i class="blue">fopen</i>("file.csv","r");<br> <i class="green">while</i>(!<i class="blue">feof</i>(<i class="green">$</i><i class="blue">file</i>))<br> <i class="blue">print_r</i>(<i class="blue">fgetcsv</i>(<i class="green">$</i><i class="blue">file</i>));<br> <i class="blue">fclose</i>(<i class="green">$</i><i class="blue">file</i>); <em class="red">?&gt;</em></pre>
					<p class="text-success">循环打印整份文件直到文件末尾：<br>
						<kbd><?php $file=fopen("file.csv","r");
							while(!feof($file))
 							print_r(fgetcsv($file));
 							fclose($file); ?></kbd>
					</p>
					<p>该函数可用于开发批量处理联系用户等功能。</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-5">
					<p><b>18.<code>fstat(file)</code></b>:返回关于一个打开的文件的信息。</p>
					<p>该函数将返回一个包含下列元素的数组：</p>
					<ul>
						<li>[0] 或 [dev] - 设备编号</li>
						<li>[1] 或 [ino] - inode 编号</li>
						<li>[2] 或 [mode] - inode 保护模式</li>
						<li>[3] 或 [nlink] - 连接数目</li>
						<li>[4] 或 [uid] - 所有者的用户 ID</li>
						<li>[5] 或 [gid] - 所有者的组 ID</li>
						<li>[6] 或 [rdev] - inode 设备类型</li>
						<li>[7] 或 [size] - 文件大小的字节数</li>
						<li>[8] 或 [atime] - 上次访问时间（Unix 时间戳）</li>
						<li>[9] 或 [mtime] - 上次修改时间（Unix 时间戳）</li>
						<li>[10] 或 [ctime] - 上次 inode 改变时间（Unix 时间戳）</li>
						<li>[11] 或 [blksize] - 文件系统 IO 的块大小（如果支持）</li>
						<li>[12] 或 [blocks] - 所占据块的数目</li>
					</ul>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr><td>file</td><td>必需。规定要检查的打开文件。</td></tr></tbody>
					</table>
					<p><b>注释</b>:从这个函数返回的结果与服务器到服务器的结果是不相同的。这个数组包含了数字索引、名称索引或同时包含上述二者。</p>
					<p><b>提示</b>:fstat() 函数与 stat() 函数大致类似。唯一的不同点就是，fstat()函数在使用时，文件必须已经打开。</p>
				</div>
				<div class="col-xs-7">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">file</i>=<i class="blue">fopen</i>("globals/file.txt","r");<br> <i class="blue">print_r</i>( <i class="blue">fstat</i>( <i class="green">$</i><i class="blue">file</i> ) );<br> <i class="blue">fclose</i>(<i class="green">$</i><i class="blue">file</i>);<br> <em class="red">?&gt;</em> </pre>
					<p class="text-success">
						<kbd><?php
						 $file=fopen("globals/file.txt","r");
						 print_r( fstat( $file ) );
						 fclose($file);
						 ?></kbd>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-4">
					<p><b>19.<code>is_file(file)</code></b>:检查指定的文件是否是常规的文件。如果文件是常规的文件，该函数返回 TRUE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr><td>file</td><td>必需。规定要检查的文件。</td></tr></tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">file</i> = "file.txt";<br> <i class="green">if</i>(<i class="blue">is_file</i>(<i class="green">$</i><i class="blue">file</i>)){<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is a regular file"); <br> }else{<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is not a regular file");<br> }<em class="red">?&gt;</em></pre>
					<p class="text-success">结果：
						<kbd><?php $file = "file.txt";
						if(is_file($file))
						{
						echo ("$file is a regular file");
						}
						else
						{
						echo ("$file is not a regular file");
						}?></kbd>
					</p>
				</div>
				<div class="col-xs-4">
					<p><b>20.<code>is_dir(file)</code></b>:检查指定的文件是否是一个目录。如果目录存在，该函数返回 TRUE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr><td>file</td><td>必需。规定要检查的文件。</td></tr></tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">dir</i> = "globals";<br> <i class="green">if</i>(<i class="blue">is_dir</i>(<i class="green">$</i><i class="blue">dir</i>)){<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">dir</i> is a directory"); <br> }else{<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">dir</i> is not a directory");<br> }<em class="red">?&gt;</em></pre>
					<p class="text-success">结果：
						<kbd><?php $dir = "globals";
						if(is_dir($dir))
						{
						echo ("$dir is a directory");
						}
						else
						{
						echo ("$dir is not a directory");
						}?></kbd>
					</p>
				</div>
				<div class="col-xs-4">
					<p><b>21.<code>is_executable(file)</code></b>:检查指定的文件是否可执行。如果文件可执行，该函数返回 TRUE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr><td>file</td><td>必需。规定要检查的文件。</td></tr></tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">file</i> = "file.csv";<br> <i class="green">if</i>(<i class="blue">is_executable</i>(<i class="green">$</i><i class="blue">file</i>)){<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is executable"); <br> }else{<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is not executable");<br> } <em class="red">?&gt;</em></pre>
					<p class="text-success">结果：
						<kbd><?php $file = "file.csv";
						if(is_executable($file))
						{
						echo ("$file is executable");
						}
						else
						{
						echo ("$file is not executable");
						}?></kbd>
					</p>
				</div>
				<div class="col-xs-4">
					<p><b>22.<code>is_writable(file)</code></b>:检查指定的文件是否可写。</p>
					<p><b>注意</b>：该函数的结果会被缓存。请使用 clearstatcache() 来清除缓存。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr><td>file</td><td>必需。规定要检查的文件。</td></tr></tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">file</i> = "file.txt";<br> <i class="green">if</i>(<i class="blue">is_writable</i>(<i class="green">$</i><i class="blue">file</i>)){<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is writeable"); <br> }else{<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is not writeable");<br> }<em class="red">?&gt;</em></pre>
					<p class="text-success">结果：
						<kbd><?php $file = "file.txt";
						if(is_writable($file))
						{
						echo ("$file is writeable");
						}
						else
						{
						echo ("$file is not writeable");
						}?></kbd>
					</p>
				</div>
				<div class="col-xs-4">
					<p><b>23.<code>is_writeable(file)</code></b>:检查指定的文件是否可写;如果文件可写，该函数返回 TRUE。is_writable() 的别名。</p>
					<p><b>注意</b>：该函数的结果会被缓存。请使用 clearstatcache() 来清除缓存。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr><td>file</td><td>必需。规定要检查的文件。</td></tr></tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">file</i> = "file.txt";<br> <i class="green">if</i>(<i class="blue">is_writeable</i>(<i class="green">$</i><i class="blue">file</i>)){<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is writeable"); <br> }else{<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is not writeable");<br> }<em class="red">?&gt;</em></pre>
					<p class="text-success">结果：
						<kbd><?php $file = "file.txt";
						if(is_writeable($file))
						{
						echo ("$file is writeable");
						}
						else
						{
						echo ("$file is not writeable");
						}?></kbd>
					</p>
				</div>
				<div class="col-xs-4">
					<p><b>24.<code>is_readable(file)</code></b>:检查指定的文件是否可读;如果文件可读，该函数返回 TRUE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr><td>file</td><td>必需。规定要检查的文件。</td></tr></tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">file</i> = "file.txt";<br> <i class="green">if</i>(<i class="blue">is_readable</i>(<i class="green">$</i><i class="blue">file</i>)){<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is readable"); <br> }else{<br> <i class="green">echo</i> ("<i class="green">$</i><i class="blue">file</i> is not readable");<br> }<em class="red">?&gt;</em></pre>
					<p class="text-success">结果：
						<kbd><?php $file = "file.txt";
						if(is_readable($file))
						{
						echo ("$file is readable");
						}
						else
						{
						echo ("$file is not readable");
						}?></kbd>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>25.<code>popen(command,mode)</code></b>:使用 command 参数打开进程文件指针。如果出错，该函数返回 FALSE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>command</td><td>必需。规定要执行的命令。</td></tr>
							<tr><td>mode</td><td>必需。规定连接模式。可能的值：<ul><li>r: 只读。</li>
							<li>w: 只写（打开并清空已有文件或创建一个新文件）</li></ul></td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>26.<code>pclose(pipe)</code></b>:关闭由 popen() 打开的进程。如果失败，该函数返回 FALSE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>pipe</td><td>必需。规定由 popen() 打开的进程。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">file</i> = <i class="blue">popen</i>("/bin/ls","r"); //some code to be executed <br><i class="blue">pclose</i>(<i class="green">$</i><i class="blue">file</i>); <em class="red" >?&gt;</em></pre>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>27.<code>mkdir(path,mode,recursive,context)</code></b>:创建目录。如果成功该函数返回 TRUE，如果失败则返回 FALSE。</p>
					<p class="text-danger">mode 参数在 Windows 平台上被忽略。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>path</td><td>必需。规定要创建的目录的名称。</td></tr>
							<tr><td>mode</td>
								<td>可选。规定权限。默认是 0777（允许全局访问）。<br>
									mode 参数由四个数字组成：
									<ul>
										<li>第一个数字通常是 0</li>
										<li>第二个数字规定所有者的权限</li>
										<li>第三个数字规定所有者所属的用户组的权限</li>
										<li>第四个数字规定其他所有人的权限</li>
									</ul>
									可能的值（如需设置多个权限，请对下面的数字进行总计）：<br>
									<ul>
										<li>1 = 执行权限</li>
										<li>2 = 写权限</li>
										<li>4 = 读权限</li>
									</ul>
								</td>
							</tr>
							<tr><td>recursive</td><td>可选。规定是否设置递归模式。（PHP 5 中新增的）</td></tr>
							<tr><td>context</td><td>可选。规定文件句柄的环境。context 是一套可以修改流的行为的选项。（PHP 5 中新增的）</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">if</i>(!<i class="blue">file_exists</i>("testing")) <i class="blue">mkdir</i>("testing"); <br><i class="green">else</i> <i class="blue">rmdir</i>("testing");<em class="red">?&gt;</em></pre>
					<p><?php if(!file_exists("testing")) mkdir("testing"); else rmdir("testing");?></p>
					<p><b>28.<code>rmdir(dir,context)</code></b>:删除空的目录。如果成功，该函数返回 TRUE。如果失败，则返回 FALSE。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>dir</td><td>必需。规定要删除的目录。</td></tr>
							<tr><td>context</td><td>可选。规定文件句柄的环境。context 是一套可以修改流的行为的选项。</td></tr>
						</tbody>
					</table>
					<p class="text-warning">示例如上面代码所示，不存在则创建testing目录，存在则删除testing目录</p>
					<p><b>29.<code>move_uploaded_file(file,newloc)</code></b>:把上传的文件移动到新位置。如果成功该函数返回 TRUE，如果失败则返回 FALSE。</p>
					<p><b>注释</b>:该函数仅用于通过 HTTP POST 上传的文件。如果目标文件已经存在，将会被覆盖。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>file</td><td>必需。规定要移动的文件。</td></tr>
							<tr><td>newloc</td><td>必需。规定文件的新位置。</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-xs-8">
					<p>文件上传案例:图片上传</p>
					<form action="upload_file.php" method="post" enctype="multipart/form-data">
					    <div class="form-group">
						    <label for="file">文件名：</label>
						    <input type="file" name="file" id="file">
					    </div>
					    <input type="submit" class="btn btn-primary" name="submit" value="提交">
					</form>
					<p class="text-success form-msg"></p>
				</div>
			</div>
		</main>
		<footer>&copy; by dhm &nbsp;,&nbsp; 20171019-20171020 ,&nbsp;&nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST']; ?></a></footer>
		<?php require_once("footer.php");?>
	</div>
	<script type="text/javascript" src="globals/jquery-3.2.1.js"></script>
</body>
</html>