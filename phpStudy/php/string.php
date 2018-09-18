<!DOCTYPE html>
<html>
<head>
	<title>字符串函数</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header>
			<h1>PHP字符串函数 <small>——php基础函数之字符串函数<sup>节选</sup></small></h1>
		</header>
		<main>
			<?php include_once("navbar.php"); navbar(basename(__FILE__));?>
			<div class="row">
				<div class="col-xs-7">
					<p><b>1.<code>addcslashes(str, charlist)</code></b>:返回在指定的字符前添加反斜杠的字符串<sub class="badge badge-warning">php 4.x.x+</sub></p>
					<table class="table table-bordered table-hover table-responsive">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>str</td><td>必需，规定要转义的字符串。</td></tr>
							<tr><td>charlist</td><td>必需，规定要转义的字符或字符范围</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-5">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">str</i>="Welcome to my humble Homepage!";<br> <i class="green">echo $</i><i class="blue">str</i>."&lt;br&gt;"; <i class="green">echo</i> <i class="blue">addcslashes</i>("<i class="green">$</i><i class="blue">str</i>",'A..Z');<br> <i class="green">echo</i> <i class="blue">addcslashes</i>("<i class="green">$</i><i class="blue">str</i>",'a..z');<em class="red">?&gt;</em></pre>
					<p class="text-success">结果：<kbd><?php $str = "Welcome to my humble Homepage!"; echo $str."<br>"; echo addcslashes("$str","'A..Z")."<br>"; echo addcslashes("$str","'a..z");?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-7">
					<p><b>2.<code>addslashes(string)</code></b>:返回在预定义的字符前添加反斜杠的字符串。</p>
					<p>预定义字符是：<span class="text-success">单引号（'）</span>、<span class="text-info">双引号（"）</span>、<span class="text-danger">反斜杠（\）</span>、<span class="text-warning">NULL</span></p>
					<pre class="pre-scrollable"><em class="red">&lt;php</em> <i class="blue">addcslashes</i>("Who's Peter Griffin?"); <em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr><td>string</td><td>必需。规定要转义的字符串。</td></tr></tbody>
					</table>
					<p class="text-success">结果：<kbd><?php echo addslashes("Who's Peter Griffin?");?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>3.<code>bin2hex(string)</code></b>:把 ASCII 字符的字符串转换为十六进制值。字符串可通过使用 pack() 函数再转换回去。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">bin2hex</i>(<i class="green">$</i><i class="blue">str</i>); <em class="red">?&gt;</em></pre>
					<p class="text-success">结果：bin2hex-<kbd><?php echo bin2hex($str);?></kbd><br>pack-<kbd><?php echo pack("H*",bin2hex($str));?></kbd> </p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tr><td>string</td><td>必需。规定要转换的字符串。</td></tr>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>4.<code>hex2bin(string)</code></b>:把十六进制值的字符串转换为 ASCII 字符。<sup class="badge badge-warning">php 5.4.0+</sup></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">hex2bin</i>(<i class="green">$</i><i class="blue">str</i>); <em class="red">?&gt;</em></pre>
					<p class="text-success"><?php echo hex2bin(bin2hex($str)); ?></p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。要转换的十六进制值。</td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<p class="text-warning">以下函数效果，必须查看源代码方可看到肉眼可见的效果</p>
				<div class="col-xs-3">
					<p><b>5.<code>chop(string,charlist)</code></b>:移除字符串右侧的空白字符或其他预定义字符。<sup class="badge badge-warning">php 4.x.x+</sup></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>= "Hello World!<i class="orange">\n\n</i>";<br> <i class="green">echo $</i><i class="blue">str</i>;<br> <i class="green">echo</i> <i class="blue">chop</i>(<i class="green">$</i><i class="blue">str</i>);<br> <em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要检查的字符串。</td></tr>
							<tr><td>charlist</td>
								<td>可选。规定从字符串中删除哪些字符。<br>
									如果 charlist 参数为空，则移除下列字符：
									<ul>
										<li>"\0" - NULL</li>
										<li>"\t" - 制表符</li>
										<li>"\n" - 换行</li>
										<li>"\x0B" - 垂直制表符</li>
										<li>"\r" - 回车</li>
										<li>" " - 空格</li>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
					<p class="text-success"><kbd><?php $str = "Hello World!\n\n";
					echo $str;
					echo chop($str);?></kbd></p>		
				</div>
				<div class="col-xs-3">
					<p><b>6.<code>ltrim(string,charlist)</code></b>:移除字符串左侧的空白字符或其他预定义字符。<sup class="badge badge-warning">php 4.x.x+</sup></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="Hello World! ";<br> <i class="green">echo $</i><i class="blue">str</i>."&lt;br&gt;";<br> <i class="green">echo</i> <i class="blue">ltrim</i>(<i class="green">$</i><i class="blue">str</i>,"Hello"); <br><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要检查的字符串。</td></tr>
							<tr><td>charlist</td>
								<td>可选。规定从字符串中删除哪些字符。
									如果 charlist 参数为空，则移除下列字符：
									<ul>
										<li>"\0" - NULL</li>
										<li>"\t" - 制表符</li>
										<li>"\n" - 换行</li>
										<li>"\x0B" - 垂直制表符</li>
										<li>"\r" - 回车</li>
										<li>" " - 空格</li>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
					<p class="text-success"><kbd><?php
					$str = "Hello World! ";
					echo $str . "<br>";
					echo ltrim($str,"Hello");
					?></kbd></p>
				</div>
				<div class="col-xs-3">
					<p><b>7.<code>rtrim(string,charlist)</code></b>:移除字符串右侧的空白字符或其他预定义字符。<sup class="badge badge-warning">php 4.x.x+</sup></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="Hello World!";<br> <i class="green">echo $</i><i class="blue">str</i>."&lt;br&gt;";<br> <i class="green">echo</i> <i class="blue">rtrim</i>(<i class="green">$</i><i class="blue">str</i>,"World"); <br><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要检查的字符串。</td></tr>
							<tr><td>charlist</td>
								<td>可选。规定从字符串中删除哪些字符。
									如果 charlist 参数为空，则移除下列字符：
									<ul>
										<li>"\0" - NULL</li>
										<li>"\t" - 制表符</li>
										<li>"\n" - 换行</li>
										<li>"\x0B" - 垂直制表符</li>
										<li>"\r" - 回车</li>
										<li>" " - 空格</li>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
					<p class="text-success"><kbd><?php
					$str = "Hello World!";
					echo $str . "<br>";
					echo rtrim($str,"World!");
					?></kbd></p>
				</div>
				<div class="col-xs-3">
					<p><b>8.<code>trim(string,charlist)</code></b>:移除字符串两侧的空白字符或其他预定义字符。<sup class="badge badge-warning">php 4.x.x+</sup></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="  Hello World!  ";<br> <i class="green">echo $</i><i class="blue">str</i>."&lt;br&gt;";<br> <i class="green">echo</i> <i class="blue">trim</i>(<i class="green">$</i><i class="blue">str</i>,"World"); <br><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要检查的字符串。</td></tr>
							<tr><td>charlist</td>
								<td>可选。规定从字符串中删除哪些字符。
									如果 charlist 参数为空，则移除下列字符：
									<ul>
										<li>"\0" - NULL</li>
										<li>"\t" - 制表符</li>
										<li>"\n" - 换行</li>
										<li>"\x0B" - 垂直制表符</li>
										<li>"\r" - 回车</li>
										<li>" " - 空格</li>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
					<p class="text-success"><kbd><?php
					$str = "  Hello World!  ";
					echo $str . "<br>";
					echo trim($str);
					?></kbd></p>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col-xs-6">
					<p><b>9.<code>html_entity_decode(string,flags,character-set)</code></b>:把 HTML 实体转换为字符。是 <code>htmlentities()</code> 函数的反函数。<sup class="badge badge-warning">php 4.3.0+</sup></p>
					<table class="table table-hover table-bordered">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要解码的字符串。</td></tr>
							<tr><td>flags</td>
								<td>可选。规定如何处理引号以及使用哪种文档类型。可用的引号类型：
									<ul>
										<li>ENT_COMPAT - 默认。仅解码双引号。</li>
										<li>ENT_QUOTES - 解码双引号和单引号。</li>
										<li>ENT_NOQUOTES - 不解码任何引号。</li>
									</ul>
									规定使用的文档类型的附加 flags：
									<ul>
										<li>ENT_HTML401 - 默认。作为 HTML 4.01 处理代码。</li>
										<li>ENT_HTML5 - 作为 HTML 5 处理代码。</li>
										<li>ENT_XML1 - 作为 XML 1 处理代码。</li>
										<li>ENT_XHTML - 作为 XHTML 处理代码。</li>
									</ul>
								</td>
							</tr>
							<tr><td>character-set</td>
								<td>可选。一个规定了要使用的字符集的字符串。
								允许的值：
								<ul>
									<li>UTF-8 - 默认。ASCII 兼容多字节的 8 位 Unicode</li>
									<li>ISO-8859-1 - 西欧</li>
									<li>ISO-8859-15 - 西欧（加入欧元符号 + ISO-8859-1 中丢失的法语和芬兰语字母）</li>
									<li>cp866 - DOS 专用 Cyrillic 字符集</li>
									<li>cp1251 - Windows 专用 Cyrillic 字符集</li>
									<li>cp1252 - Windows 专用西欧字符集</li>
									<li>KOI8-R - 俄语</li>
									<li>BIG5 - 繁体中文，主要在台湾使用</li>
									<li>GB2312 - 简体中文，国家标准字符集</li>
									<li>BIG5-HKSCS - 带香港扩展的 Big5</li>
									<li>Shift_JIS - 日语</li>
									<li>EUC-JP - 日语</li>
									<li>MacRoman - Mac 操作系统使用的字符集</li>
								</ul>
								<b>注意</b>:在 <em class="label label-danger">PHP 5.4</em> 之前的版本，无法被识别的字符集将被忽略并由 <b class="label label-warning">ISO-8859-1</b> 替代。自 <em class="label label-danger">PHP 5.4</em> 起，无法被识别的字符集将被忽略并由 UTF-8 替代。
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><abbr class="blue" title="这里使用 htmlentities()函数输出">str</abbr>="<?php echo htmlentities("&lt;&copy; W3CS&ccedil;h&deg;&deg;&brvbar;&sect;&gt;");?>";<br> <i class="green">echo</i> <i class="blue">html_entity_decode</i>(<i class="green">$</i><i class="blue">str</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">输出结果： 
						<kbd><?php $str = "&lt;&copy; W3CS&ccedil;h&deg;&deg;&brvbar;&sect;&gt;"; echo html_entity_decode($str); ?></kbd>
					</p>
					<p>例2：</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">html_entity_decode</i>("<?php echo htmlentities("&lt;kbd&gt;kbd_string_to_entity&lt;/divkbd&gt;");?>");<br> <em class="red">?&gt;</em></pre>
					<p class="text-success">输出结果，使用php函数输<em class="label label-danger">&lt;kbd&gt;</em>标签--<?php echo html_entity_decode("&lt;kbd&gt;kbd_string_to_entity&lt;/divkbd&gt;");?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>10.<code>htmlentities(string,flags,character-set,double_encode)</code></b>:把字符转换为 HTML 实体。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要转换的字符串。</td></tr>
							<tr><td>flags</td>
								<td>可选。规定如何处理引号、无效的编码以及使用哪种文档类型。可用的引号类型：
									<ul>
										<li>ENT_COMPAT - 默认。仅编码双引号。</li>
										<li>ENT_QUOTES - 编码双引号和单引号。</li>
										<li>ENT_NOQUOTES - 不编码任何引号。</li>
									</ul>
								无效的编码：
									<ul>
										<li>ENT_IGNORE - 忽略无效的编码，而不是让函数返回一个空的字符串。应尽量避免，因为这可能对安全性有影响。</li>
										<li>ENT_SUBSTITUTE - 把无效的编码替代成一个指定的带有 Unicode 替代字符 U+FFFD（UTF-8）或者 &#FFFD; 的字符，而不是返回一个空的字符串。</li>
										<li>ENT_DISALLOWED - 把指定文档类型中的无效代码点替代成 Unicode 替代字符 U+FFFD（UTF-8）或者 &#FFFD;</li>
									</ul>
									规定使用的文档类型的附加 flags：
									<ul>
										<li>ENT_HTML401 - 默认。作为 HTML 4.01 处理代码。</li>
										<li>ENT_HTML5 - 作为 HTML 5 处理代码。</li>
										<li>ENT_XML1 - 作为 XML 1 处理代码。</li>
										<li>ENT_XHTML - 作为 XHTML 处理代码</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>character-set</td>
								<td>
									可选。一个规定了要使用的字符集的字符串。允许的值：
									<ul>
										<li>UTF-8 - 默认。ASCII 兼容多字节的 8 位 Unicode</li>
										<li>ISO-8859-1 - 西欧</li>
										<li>ISO-8859-15 - 西欧（加入欧元符号 + ISO-8859-1 中丢失的法语和芬兰语字母）</li>
										<li>cp866 - DOS 专用 Cyrillic 字符集</li>
										<li>cp1251 - Windows 专用 Cyrillic 字符集</li>
										<li>cp1252 - Windows 专用西欧字符集</li>
										<li>KOI8-R - 俄语</li>
										<li>BIG5 - 繁体中文，主要在台湾使用</li>
										<li>GB2312 - 简体中文，国家标准字符集</li>
										<li>BIG5-HKSCS - 带香港扩展的 Big5</li>
										<li>Shift_JIS - 日语</li>
										<li>EUC-JP - 日语</li>
										<li>MacRoman - Mac 操作系统使用的字符集</li>
									</ul>
									<b>注意</b>:在 <em class="label label-danger">PHP 5.4</em> 之前的版本，无法被识别的字符集将被忽略并由 <b class="label label-warning">ISO-8859-1</b> 替代。自 <em class="label label-danger">PHP 5.4</em> 起，无法被识别的字符集将被忽略并由 UTF-8 替代。
								</td>
							</tr>
							<tr><td>double_encode</td>
								<td>可选。一个规定了是否编码已存在的 HTML 实体的布尔值。
									<ul>
										<li>TRUE - 默认。将对每个实体进行转换。</li>
										<li>FALSE - 不会对已存在的 HTML 实体进行编码。</li>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="<© W3CSçh°°¦§>";<br> <i class="green">echo</i> <i class="blue">htmlentities</i>(<i class="green">$</i><i class="blue">str</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">字符串转成实体：----<br>
						<kbd><?php $str="<© W3CSçh°°¦§>"; echo htmlentities($str);?></kbd><br>
						效果请查看源代码，对比效果。
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-8">
					<p><b>11.<code>get_html_translation_table(function,flags,character-set)</code></b>:返回 <code>htmlentities()</code> 和 <code>htmlspecialchars()</code> 函数使用的翻译表。</p>
					<table class="table table-hover table-bordered">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>function</td>
								<td>可选。规定返回哪个翻译表。可能的值：
									<ul>
										<li>HTML_SPECIALCHARS - 默认。翻译某些需要 URL 编码的字符，以便正确地显示在 HTML 页面上</li>
										<li>HTML_ENTITIES - 翻译所有需要 URL 编码的字符，以便正确地显示在 HTML 页面上</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>flags</td>
								<td>可选。规定翻译表将包含哪种引号以及翻译表用于哪种文档类型。可用的引号类型：
									<ul>
										<li>ENT_COMPAT - 默认。翻译表包含双引号实体，不包含单引号实体</li>
										<li>ENT_QUOTES - 翻译表包含双引号实体和单引号实体</li>
										<li>ENT_NOQUOTES - 翻译表不包含双引号实体和单引号实体</li>
									</ul>
									规定翻译表适用的文档类型的附加 flags：
									<ul>
										<li>ENT_HTML401 - 默认。HTML 4.01 的翻译表。</li>
										<li>ENT_HTML5 - HTML 5 的翻译表。</li>
										<li>ENT_XML1 - XML 1 的翻译表。</li>
										<li>ENT_XHTML - XHTML 的翻译表。</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>character-set</td>
								<td>
									可选。一个规定了要使用的字符集的字符串。允许的值：
									<ul>
										<li>UTF-8 - 默认。ASCII 兼容多字节的 8 位 Unicode</li>
										<li>ISO-8859-1 - 西欧</li>
										<li>ISO-8859-15 - 西欧（加入欧元符号 + ISO-8859-1 中丢失的法语和芬兰语字母）</li>
										<li>cp866 - DOS 专用 Cyrillic 字符集</li>
										<li>cp1251 - Windows 专用 Cyrillic 字符集</li>
										<li>cp1252 - Windows 专用西欧字符集</li>
										<li>KOI8-R - 俄语</li>
										<li>BIG5 - 繁体中文，主要在台湾使用</li>
										<li>GB2312 - 简体中文，国家标准字符集</li>
										<li>BIG5-HKSCS - 带香港扩展的 Big5</li>
										<li>Shift_JIS - 日语</li>
										<li>EUC-JP - 日语</li>
										<li>MacRoman - Mac 操作系统使用的字符集</li>
									</ul>
									<b>注意</b>:在 <em class="label label-danger">PHP 5.4</em> 之前的版本，无法被识别的字符集将被忽略并由 <b class="label label-warning">ISO-8859-1</b> 替代。自 <em class="label label-danger">PHP 5.4</em> 起，无法被识别的字符集将被忽略并由 UTF-8 替代。
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-4">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="blue">print_r</i>(<i class="blue">get_html_translation_table</i>());<br><em class="red">?&gt;</em></pre>
					<p class="text-success">使用foreach循环+<code>htmlentities()</code>函数输出例子中的打印效果：<br>
						<kbd><?php echo "Array(<br>\r\n";
						foreach (get_html_translation_table() as $k => $v) {
							echo "[".$k."]=>".htmlentities($v)."<br>\r\n";
						} echo ")";?></kbd>
					</p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>12.<code>explode(separator,string,limit)</code></b>:使用一个字符串分割另一个字符串，并返回由字符串组成的数组。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>spearator</td><td>必需。规定在哪里分割字符串。</td></tr>
							<tr><td>string</td><td>必需。规定在哪里分割字符串。</td></tr>
							<tr><td>limit</td><td>可选。规定所返回的数组元素的数目。可能的值：
								<ul>
									<li>大于 0 - 返回包含最多 limit 个元素的数组</li>
									<li>小于 0 - 返回包含除了最后的 -limit 个元素以外的所有元素的数组</li>
									<li>0 - 会被当做 1, 返回包含一个元素的数组</li>
								</ul>
							</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="blue">var_dump</i>(<i class="blue">explode</i>(".",<i class="green">$</i><i class="blue">_SERVER</i>["HTTP_HOST"])); <br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php var_dump(explode(".",$_SERVER["HTTP_HOST"]));?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>13.<code>implode(separator,array)</code></b>:返回一个由数组元素组合成的字符串。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>separator</td><td>可选。规定数组元素之间放置的内容。默认是 ""（空字符串）。</td></tr>
							<tr><td>array</td><td>必需。要组合为字符串的数组。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">implode</i>(",",<i class="blue">explode</i>(".",<i class="green">$</i><i class="blue">_SERVER</i>["HTTP_HOST"])); <br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo implode(",",explode(".",$_SERVER["HTTP_HOST"])); ?></kbd></p>
					<div class="col-xs-12">
						<p><b>14.<code>join(separator,array)</code></b>:返回一个由数组元素组合成的字符串。implode()函数的别名</p>
						<table class="table table-bordered table-hover">
							<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
							<tbody>
								<tr><td>separator</td><td>可选。规定数组元素之间放置的内容。默认是 ""（空字符串）。</td></tr>
								<tr><td>array</td><td>必需。要组合为字符串的数组。</td></tr>
							</tbody>
						</table>
						<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">join</i>(",",<i class="blue">explode</i>(".",<i class="green">$</i><i class="blue">_SERVER</i>["HTTP_HOST"])); <br><em class="red">?&gt;</em></pre>
						<p class="text-success"><kbd><?php echo join(",",explode(".",$_SERVER["HTTP_HOST"])); ?></kbd></p>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>15.<code>md5(string,raw)</code></b>：计算字符串的 MD5 散列。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要计算的字符串。</td></tr>
							<tr><td>raw</td><td>可选。规定十六进制或二进制输出格式：<ul>
								<li>TRUE - 原始 16 字符二进制格式</li>
								<li>FALSE - 默认。32 字符十六进制数</li>
							</ul></td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">md5</i>("13570313864",<i class="orange">TRUE</i>);<br> <i class="green">echo</i> <i class="blue">md5</i>("13570313864");<br><em class="red">?&gt;</em></pre>
					<p class="text-success">案例结果：<kbd><?php echo md5("13570313864",TRUE)."<br>"; echo md5("13570313864");?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>16.<code>md5_file(file,raw)</code></b>:计算文件内容的 MD5 散列。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要计算的文件。</td></tr>
							<tr><td>raw</td><td>可选。规定十六进制或二进制输出格式：<ul>
								<li>TRUE - 原始 16 字符二进制格式</li>
								<li>FALSE - 默认。32 字符十六进制数</li>
							</ul></td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">file</i>="file.txt";<br> <i class="green">echo</i> <i class="blue">md5_file</i>(<i class="green">$</i>file); <br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php $file="file.txt"; $md5file=md5_file($file); echo $md5file;?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>17.<code>nl2br(string,xhtml)</code></b>:在字符串中的每个新行（\n）之前插入 HTML 换行符（&lt;br&gt; 或 &lt;br /&gt;）</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要检查的字符串。</td></tr>
							<tr><td>xhtml</td><td>可选。一个表示是否使用兼容 XHTML 换行的布尔值：
								<ul>
									<li>TRUE- 默认。插入&lt;br /&gt;</li>
									<li>FALSE - 插入&lt;br&gt;</li>
								</ul>
							</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">nl2br</i>("One line.\nAnother line.");<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo nl2br("One line.\nAnother line.");?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>18.<code>str_getcsv(string,separator,enclosure,escape)</code></b>:解析 CSV 格式字段的字符串，并返回一个包含所读取字段的数组。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要解析的字符串。</td></tr>
							<tr><td>separator</td><td>可选。设置字段分界符（只允许一个字符），默认值为逗号（ , ）</td></tr>
							<tr><td>enclosure</td><td>可选。设置字段环绕符（只允许一个字符），默认值为双引号（ " ）</td></tr>
							<tr><td>escape</td><td>可选。设置转义字符（只允许一个字符），默认值为反斜线（ \ ）</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="blue">var_dump</i>(<i class="blue">str_getcsv</i>("g,4,3")); <br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php var_dump(str_getcsv("g,4,3"));?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>19.<code>str_ireplace(find,replace,string,count)</code></b>:替换字符串中的一些字符（不区分大小写）</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>find</td><td>必需。规定要查找的值。</td></tr>
							<tr><td>replace</td><td>必需。规定替换 find 中的值的值</td></tr>
							<tr><td>string</td><td>必需。规定被搜索的字符串</td></tr>
							<tr><td>count</td><td>可选。一个变量，对替换数进行计数。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">arr</i>=<i class="orange">array</i>("blue","red","green","yellow");<br> <i class="blue">var_dump</i>(<i class="blue">str_ireplace</i>("RED","pink",<i class="green">$</i><i class="blue">arr</i>,<i class="green">$</i><i class="blue">i</i>));<br> <i class="green">echo</i> "Replacements : <i class="green">$</i><i class="blue">i</i>";<br> <em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php $arr = array("blue","red","green","yellow"); var_dump(str_ireplace("RED","pink",$arr,$i)); echo "Replacements : $i";?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>20.<code>str_replace(find,replace,string,count)</code></b>:替换字符串中的一些字符（区分大小写）</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>find</td><td>必需。规定要查找的值。</td></tr>
							<tr><td>replace</td><td>必需。规定替换 find 中的值的值</td></tr>
							<tr><td>string</td><td>必需。规定被搜索的字符串</td></tr>
							<tr><td>count</td><td>可选。一个变量，对替换数进行计数。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">arr</i>=<i class="orange">array</i>("blue","red","green","yellow");<br> <i class="blue">var_dump</i>(<i class="blue">str_replace</i>("red","pink",<i class="green">$</i><i class="blue">arr</i>,<i class="green">$</i><i class="blue">i</i>));<br> <i class="green">echo</i> "Replacements : <i class="green">$</i><i class="blue">i</i>";<br> <em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php $arr = array("blue","red","green","yellow"); var_dump(str_replace("red","pink",$arr,$i)); echo "Replacements : $i";?></kbd></p>
				</div>
			</div>	
			<div class="row">
				<div class="col-xs-6">
					<p><b>21.<code>str_repeat(string,repeat)</code></b>:把字符串重复指定的次数。</p>
					<table class="table table-hover table-bordered">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要重复的字符串。</td></tr>
							<tr><td>repeat</td><td>必需。规定字符串将被重复的次数。必须大于等于 0。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">str_repeat</i>("--_--||",8); <br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo str_repeat("--_--||",8);?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>22.<code>str_rot13(string)</code></b>:对字符串执行 ROT13 编码。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要编码的字符串</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">str_rot13</i>("DengHuiMing");<br> <i class="green">echo</i> <i class="blue">str_rot13</i>("QratUhvZvat"); <br> <em class="red">?&gt;</em></pre>
					<p class="text-success">案例结果：<br><kbd><?php echo str_rot13("DengHuiMing")."<br>"; echo str_rot13("QratUhvZvat");?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>23.<code>str_shuffle(string)</code></b>:随机地打乱字符串中的所有字符</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要打乱的字符串</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">str_shuffle</i>("1234567890"); <em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo str_shuffle("1234567890");?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>24.<code>str_split(string,length)</code></b>:把字符串分割到数组中</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要分割的字符串</td></tr>
							<tr><td>length</td><td>可选。规定每个数组元素的长度。默认是 1</td></tr>
							<tr><td>返回值</td><td>如果 length 小于 1，str_split() 函数将返回 FALSE。 如果 length 大于字符串的长度，整个字符串将作为数组的唯一元素返回。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="blue">var_dump</i>(<i class="blue">str_split</i>("DengHui Ming",4)); <em class="red">?&gt;</em></pre>
					<p class="text-success">案例结果：<br><kbd><?php var_dump(str_split("DengHui Ming",4));?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>23.<code>str_word_count(string,return,char)</code></b>:计算字符串中的单词数。</p>
					<table class="table table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要检查的字符串</td></tr>
							<tr><td>return</td><td>可选。规定 str_word_count() 函数的返回值。可能的值：
								<ul>
									<li>0 - 默认。返回找到的单词的数目</li>
									<li>1 - 返回包含字符串中的单词的数组</li>
									<li>2 - 返回一个数组，其中的键名是单词在字符串中的位置，键值是实际的单词</li>
								</ul>
							</td></tr>
							<tr><td>char</td><td>可选。规定被认定为单词的特殊字符。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">str_word_count</i>("Hello world!");<br> <em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo str_word_count("Hello world!");?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>24.<code>strcasecmp(string1,string2)</code></b>:比较两个字符串——是二进制安全的，且不区分大小写</p>
					<table class="table table-bordered table-hover">
						<thead>
							<tr><th>参数</th><th width="80%">描述</th></tr>
						</thead>
						<tbody>
							<tr><td>string1</td><td>必需。规定要比较的第一个字符串。</td></tr>
							<tr><td>string2</td><td>必需。规定要比较的第二个字符串。</td></tr>
							<tr><td>返回值</td><td>该函数返回：<ul><li>0 - 如果两个字符串相等</li>
							<li><0 - 如果 string1 小于 string2</li>
							<li>>0 - 如果 string1 大于 string2</li></ul></td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">strcasecmp</i>("Hello world!","HELLO WORLD!"); <br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo strcasecmp("Hello world!","HELLO WORLD!");?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>25.<code>printf(format,arg1,arg2,arg++)</code></b>:输出格式化的字符串。——arg1、arg2、++ 参数将被插入到主字符串中的百分号（%）符号处。该函数是逐步执行的。在第一个 % 符号处，插入 arg1，在第二个 % 符号处，插入 arg2，依此类推。</p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>format</td><td>必需。规定字符串以及如何格式化其中的变量。可能的格式值：
							<ul>
								<li>%% - 返回一个百分号 %</li>
								<li>%b - 二进制数</li>
								<li>%c - ASCII 值对应的字符</li>
								<li>%d - 包含正负号的十进制数（负数、0、正数）</li>
								<li>%e - 使用小写的科学计数法（例如 1.2e+2）</li>
								<li>%E - 使用大写的科学计数法（例如 1.2E+2）</li>
								<li>%u - 不包含正负号的十进制数（大于等于 0）</li>
								<li>%f - 浮点数（本地设置）</li>
								<li>%F - 浮点数（非本地设置）</li>
								<li>%g - 较短的 %e 和 %f</li>
								<li>%G - 较短的 %E 和 %f</li>
								<li>%o - 八进制数</li>
								<li>%s - 字符串</li>
								<li>%x - 十六进制数（小写字母）</li>
								<li>%X - 十六进制数（大写字母）</li>
							</ul>
							附加的格式值。必需放置在 % 和字母之间（例如 %.2f）：
							<ul>
								<li>+ （在数字前面加上 + 或 - 来定义数字的正负性。默认情况下，只有负数才做标记，正数不做标记）</li>
								<li>' （规定使用什么作为填充，默认是空格。它必须与宽度指定器一起使用。例如：%'x20s（使用 "x" 作为填充））</li>
								<li>- （左调整变量值）</li>
								<li>[0-9] （规定变量值的最小宽度）</li>
								<li>.[0-9] （规定小数位数或最大字符串长度）</li>
							</ul>
							<b>注意：</b>如果使用多个上述的格式值，它们必须按照上面的顺序进行使用，不能打乱。
							</td></tr>
							<tr><td>arg1</td><td>必需。规定插到 format 字符串中第一个 % 符号处的参数。</td></tr>
							<tr><td>arg2</td><td>可选。规定插到 format 字符串中第二个 % 符号处的参数。</td></tr>
							<tr><td>arg++</td><td>可选。规定插到 format 字符串中第三、四等等 % 符号处的参数。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">number</i>=9;<br> <i class="green">$</i><i class="blue">str</i>="BeiJing";<br> <i class="blue">printf</i>("There are %u million bicycles in %s.",<i class="green">$</i><i class="blue">number</i>,<i class="green">$</i><i class="blue">str</i>);<br> <em class="red">?&gt;</em></pre>
					<p class="text-success"><?php
						$number=9; $str="BeiJing";
						printf("There are <kbd>%u</kbd> million bicycles in <kbd>%s</kbd>.",$number,$str);?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>26.<code>quoted_printable_encode(string)</code></b>:把 8 位字符串转换为 quoted-printable 字符串.<sup class="badge badge-warning">php 5.3.0+</sup></p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要转换的 8 位字符串。</td></tr>
							<tr><td>返回值</td><td>返回已转换的字符串</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo $</i><i class="blue">str</i>=<i class="blue">quoted_printable_encode</i>("Hello<i class="red">\n\t</i>world"); <br><em class="red">?&gt;</em></pre>
					<p class="text-success"><?php echo $str=quoted_printable_encode("Hello\n\tworld");?></p>
				</div>
				<div class="col-xs-6">
					<p><b>27.<code>quoted_printable_decode(string)</code></b>: 对经过 quoted-printable 编码后的字符串进行解码，返回 8 位的 ASCII 字符串</p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要解码的 quoted-printable 字符串。</td></tr>
							<tr><td>返回值</td><td>返回 8 位的 ASCII 字符串</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">quoted_printable_decode</i>(<i class="green">$</i><i class="blue">str</i>);<br> <em class="red">?&gt;</em></pre>
					<p class="text-success"><?php echo quoted_printable_decode($str);?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>28.<code>quotemeta(string)</code></b>:在字符串中某些预定义的字符前添加反斜杠。——该函数可用于转义拥有特殊意义的字符，比如 SQL 中的 ( )、[ ] 以及 * 。</p>
					<p>预定义的字符：</p>
					<ul>
						<li>句号（.）</li>
						<li>反斜杠（\）</li>
						<li>加号（+）</li>
						<li>星号（*）</li>
						<li>问号（?）</li>
						<li>方括号（[]）</li>
						<li>脱字号（^）</li>
						<li>美元符号（$）</li>
						<li>圆括号（()）</li>
					</ul>
				</div>
				<div class="col-xs-6">
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要检查的字符串。</td></tr>
							<tr><td>返回值</td><td>返回引用元字符的字符串。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="Hello world. (can you hear me?)";<br> <i class="green">echo</i> <i class="blue">quotemeta</i>(<i class="green">$</i><i class="blue">str</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><?php $str = "Hello world. (can you hear me?)";
					echo quotemeta($str);?></p>
				</div>
			</div>
			<hr>
			<hr>
			<div class="row">
				<div class="col-xs-4">
					<p><b>29.<code>strchr(string,search,before_search)</code></b>：搜索字符串在另一字符串中的第一次出现。<code>strstr()</code> 的别名</p>
					<table class="table table-striped table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定被搜索的字符串。</td></tr>
							<tr><td>search</td><td>必需。规定所搜索的字符串。如果该参数是数字，则搜索匹配该数字对应的 ASCII 值的字符。</td></tr>
							<tr><td>before_search</td><td>可选。一个默认值为 "false" 的布尔值。如果设置为 "true"，它将返回 search 参数第一次出现之前的字符串部分。</td></tr>
							<tr><td>返回值</td><td>返回字符串的其余部分（从匹配点）。如果未找到所搜索的字符串，则返回 FALSE</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">strchr</i>("hello world","wo");<br><em class="red">?&gt;</em></pre>
					<p class="text-success">输出查找字符“wo"第一次出现后的所有字符：<br><kbd><?php echo strchr("hello world","wo");?></kbd></p>
				</div>
				<div class="col-xs-4">
					<p><b>30.<code>stristr(string,search,before_search)</code></b>：搜索字符串在另一字符串中的第一次出现。函数不区分大小写，若区分大小写搜索，请使用 <code>strstr()</code> 函数</p>
					<table class="table table-striped table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定被搜索的字符串。</td></tr>
							<tr><td>search</td><td>必需。规定所搜索的字符串。如果该参数是数字，则搜索匹配该数字对应的 ASCII 值的字符。</td></tr>
							<tr><td>before_search</td><td>可选。一个默认值为 "false" 的布尔值。如果设置为 "true"，它将返回 search 参数第一次出现之前的字符串部分。</td></tr>
							<tr><td>返回值</td><td>返回字符串的其余部分（从匹配点）。如果未找到所搜索的字符串，则返回 FALSE</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">stristr</i>("hello world!","WO",<i class="orange">true</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">输出查找字符“wo"第一次出现后的之前所有字符：<br><kbd><?php echo stristr("hello world!","WO",true);?></kbd></p>
				</div>
				<div class="col-xs-4">
					<p><b>31.<code>strstr(string,search,before_search)</code></b>：搜索字符串在另一字符串中的第一次出现。</p>
					<table class="table table-striped table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定被搜索的字符串。</td></tr>
							<tr><td>search</td><td>必需。规定所搜索的字符串。如果该参数是数字，则搜索匹配该数字对应的 ASCII 值的字符。</td></tr>
							<tr><td>before_search</td><td>可选。一个默认值为 "false" 的布尔值。如果设置为 "true"，它将返回 search 参数第一次出现之前的字符串部分。</td></tr>
							<tr><td>返回值</td><td>返回字符串的其余部分（从匹配点）。如果未找到所搜索的字符串，则返回 FALSE</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">strstr</i>("hello world!","wo",<i class="orange">true</i>);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">输出查找字符“wo"第一次出现后的之前所有字符：<br><kbd><?php echo strstr("hello world!","wo",true);?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>32.<code>strrchr(string,char)</code></b>:查找字符串在另一个字符串中最后一次出现的位置，并返回从该位置到字符串结尾的所有字符。</p>
					<table class="table table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定被搜索的字符串。</td></tr>
							<tr><td>char</td><td>必需。规定要查找的字符。如果该参数是数字，则搜索匹配数字 ASCII 值的字符。</td></tr>
							<tr><td>返回值</td><td>返回从某个字符串在另一个字符串中最后一次出现的位置到主字符串结尾的所有字符。如果没有找到字符，则返回 FALSE。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">strrchr</i>("hello world!",111);<br><em class="red">?&gt;</em></pre>
					<p class="text-success">输出查找字符“o"--ASCII值：111,第一次出现后的所有字符：<br><kbd><?php echo strrchr("hello world!",111);?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>33.<code>strrev(string)</code></b>:反转字符串。</p>
					<table class="table table-bordered">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要反转的字符串。</td></tr>
							<tr><td>返回值</td><td>返回已反转的字符串。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">strrev</i>("hello world!"); <em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo strrev("hello world!");?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>34.<code>strripos(string,find,start)</code></b>:查找字符串在另一字符串中最后一次出现的位置（不区分大小写）。</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定被搜索的字符串。</td></tr>
							<tr><td>find</td><td>必需。规定要查找的字符。</td></tr>
							<tr><td>start</td><td>可选。规定开始搜索的位置。</td></tr>
							<tr><td>返回值</td><td>返回字符串在另一字符串中最后一次出现的位置，如果没有找到字符串则返回 FALSE。注释： 字符串位置从 0 开始，不是从 1 开始。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="Hello world. (can you hear me?)";<br> <i class="green">echo</i> <i class="blue">strripos</i>(<i class="green">$</i><i class="blue">str</i>,"can");<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo strripos($str, "can");?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>35.<code>stripos(string,find,start)</code></b>:查找字符串在另一字符串中第一次出现的位置（不区分大小写）</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定被搜索的字符串。</td></tr>
							<tr><td>find</td><td>必需。规定要查找的字符。</td></tr>
							<tr><td>start</td><td>可选。规定开始搜索的位置。</td></tr>
							<tr><td>返回值</td><td>	返回字符串在另一字符串中第一次出现的位置，如果没有找到字符串则返回 FALSE。注释：字符串位置从 0 开始，不是从 1 开始。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="Hello world. (can you hear me?)";<br> <i class="green">echo</i> <i class="blue">stripos</i>(<i class="green">$</i><i class="blue">str</i>,"o");<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php $str="Hello world. (can you hear me?)"; echo stripos($str, "o");?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>36.<code>strpos(string,find,start)</code></b>:查找字符串在另一字符串中第一次出现的位置（区分大小写）</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定被搜索的字符串。</td></tr>
							<tr><td>find</td><td>必需。规定要查找的字符。</td></tr>
							<tr><td>start</td><td>可选。规定开始搜索的位置。</td></tr>
							<tr><td>返回值</td><td>	返回字符串在另一字符串中<b class="green">第一次</b>出现的位置，如果没有找到字符串则返回 FALSE。注释：字符串位置从 0 开始，不是从 1 开始。</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="Hello wOrld. (can you hear me?)";<br> <i class="green">echo</i> <i class="blue">strpos</i>(<i class="green">$</i><i class="blue">str</i>,"O");<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php $str="Hello wOrld. (can you hear me?)"; echo strpos($str, "O");?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>37.<code>strrpos(string,find,start)</code></b>:查找字符串在另一字符串中最后一次出现的位置（区分大小写）</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定被搜索的字符串。</td></tr>
							<tr><td>find</td><td>必需。规定要查找的字符。</td></tr>
							<tr><td>start</td><td>可选。规定开始搜索的位置。</td></tr>
							<tr><td>返回值</td><td>	返回字符串在另一字符串中<b class="red">最后一次</b>出现的位置，如果没有找到字符串则返回 FALSE。注释： 字符串位置从 0 开始，不是从 1 开始。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="Hello world. (can you hear me?)";<br> <i class="green">echo</i> <i class="blue">strrpos</i>(<i class="green">$</i><i class="blue">str</i>,"o");<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php $str="Hello world. (can you hear me?)"; echo strrpos($str, "o");?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>38.<code>substr(string,start,length)</code></b>:返回字符串的一部分。如果 start 参数是负数且 length 小于或等于 start，则 length 为 0。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="Hello world. (can you hear me?)";<br> <i class="green">echo</i> <i class="blue">substr</i>(<i class="green">$</i><i class="blue">str</i>,6);<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo substr($str,6);?></kbd></p>
					<table class="table table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要返回其中一部分的字符串。</td></tr>
							<tr><td>start</td><td>必需。规定在字符串的何处开始。<ul><li>正数 - 在字符串的指定位置开始</li>
							<li>负数 - 在从字符串结尾的指定位置开始</li>
							<li>0 - 在字符串中的第一个字符处开始</li></ul></td></tr>
							<tr><td>length</td><td>可选。规定要返回的字符串长度。默认是直到字符串的结尾。<ul><li>正数 - 从 start 参数所在的位置返回</li>
							<li>负数 - 从字符串末端返回</li></ul></td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>39.<code>substr_compare(string1,string2,startpos,length,case)</code></b>:从指定的开始位置比较两个字符串。(区分大小写)</p>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string1</td><td>必需。规定要比较的第一个字符串。</td></tr>
							<tr><td>string2</td><td>必需。规定要比较的第二个字符串。</td></tr>
							<tr><td>startpos</td><td>必需。规定在 string1 中的何处开始比较。如果为负数，则从字符串末端开始计数。</td></tr>
							<tr><td>length</td><td>可选。规定在 string1 中参与比较的字符数。</td></tr>
							<tr><td>case</td><td>可选。一个布尔值，规定是否执行区分大小写的比较：<ul><li>FALSE - 默认。区分大小写</li>
							<li>TRUE - 不区分大小写</li></ul></td></tr>
							<tr><td>返回值</td><td>该函数返回：<ul><li>0 - 如果两字符串相等</li>
							<li>&lt;0 - 如果 string1 （从开始位置 startpos）小于 string2</li>
							<li>&gt;0 - 如果 string1 （从开始位置 startpos）大于 string2</li></ul>如果 length 大于或等于 string1 的长度，则该函数返回 FALSE</td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">substr_compare</i>("Hello Dhm","Dhm",0); <br> <i class="green">echo</i> <i class="blue">substr_compare</i>("Hello Dhm","dhm",0); <br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo substr_compare("Hello Dhm", "Dhm", 0)."<br>"; echo substr_compare("Hello Dhm", "dhm", 0);?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>40.<code>substr_count(string,substring,start,length)</code></b>:计算子串在字符串中出现的次数。子串是区分大小写的,该函数不计数重叠的子串，如果 start 参数加上 length 参数大于字符串长度，该函数则生成一个警告</p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要检查的字符串。</td></tr>
							<tr><td>substring</td><td>必需。规定要检索的字符串。</td></tr>
							<tr><td>start</td><td>可选。规定在字符串中何处开始搜索。</td></tr>
							<tr><td>length</td><td>可选。规定搜索的长度。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>例1：</b></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="abcabcab";<br> <i class="green">echo</i> <i class="blue">substr_count</i>(<i class="green">$</i><i class="blue">str</i>,"abcab");<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php $str = "abcabcab"; 
					echo substr_count($str,"abcab");?></kbd></p>
					<p><b>例2：</b></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">str</i>="This is nice";<br> <i class="green">echo</i> <i class="blue">substr_count</i>(<i class="green">$</i><i class="blue">str</i>,"is",3,9);<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php $str = "This is nice"; 
					echo substr_count($str,"is",3,9);?></kbd></p>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-6">
					<p><b>41.<code>substr_replace(string,replacement,start,length)</code></b>:把字符串的一部分替换为另一个字符串。</p>
					<table class="table table-bordered table-hover table-striped">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>string</td><td>必需。规定要检查的字符串。</td></tr>
							<tr><td>replacement</td><td>必需。规定要插入的字符串。</td></tr>
							<tr><td>start</td><td>必需。规定在字符串的何处开始替换。<ul>
								<li>正数 - 在字符串的指定位置开始</li>
								<li>负数 - 在从字符串结尾的指定位置开始</li>
								<li>0 - 在字符串中的第一个字符处开始</li>
							</ul></td></tr>
							<tr><td>length</td><td>可选。规定要替换多少个字符。默认是与字符串长度相同。<ul>
								<li>正数 - 被替换的字符串长度</li>
								<li>负数 - 从字符串末端开始的被替换字符数</li>
								<li>0 - 插入而非替换</li>
							</ul></td></tr>
						</tbody>
					</table>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">substr_replace</i>("Hello world","earth",6);<br><em class="red">?&gt;</em></pre>
					<p class="text-success"><kbd><?php echo substr_replace("Hello world","earth",-5);?></kbd></p>
				</div>
			</div>
		</main>
		<footer>
			&copy; by dhm &nbsp;,&nbsp; 2017年10月30日-11月01日 ,&nbsp;&nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST']; ?></a>
		</footer>
		<?php include_once("footer.php");//引入，报错警告?>
	</div>
</body>
</html>