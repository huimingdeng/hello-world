<!DOCTYPE html>
<html>
<head>
	<title>php函数——时间函数</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header><h1>PHP时间函数 <small>——php基础函数之时间函数<sup>节选</sup></small></h1></header>
		<main>
			<?php require_once("navbar.php"); navbar(basename(__FILE__));?>
			<div class="row">
				<div class="col-xs-6">
					<p><b>1.<code>date(format,timestamp)</code></b>:格式化本地日期和时间，并返回格式化的日期字符串<sup class="badge badge-warning">php4.x.x+</sup>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">date</i>("Y-m-d-w-W-z-S-l-L-h-a-g"); <em class="red">?&gt;</em><br><kbd><?php echo date("Y-m-d-w-W-z-S-l-L-h-a-g"); ?></kbd></pre>
					<table class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>参数</th>
								<th width="80%">描述</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>format</td>
								<td>必需。规定输出日期字符串的格式。可使用下列字符：
									<ul>
										<li class="list-group-item-success">d - 一个月中的第几天（从 01 到 31）<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>("d");?&gt;</code><kbd><?php echo date("d");?></kbd></li>
										<li>D - 星期几的文本表示（用三个字母表示）</li>
										<li>j - 一个月中的第几天，不带前导零（1 到 31）</li>
										<li>l（'L' 的小写形式）- 星期几的完整的文本表示</li>
										<li>N - 星期几的 ISO-8601 数字格式表示（1 表示 Monday[星期一]，7 表示 Sunday[星期日]）</li>
										<li>S - 一个月中的第几天的英语序数后缀（2 个字符：st、nd、rd 或 th。与 j 搭配使用）</li>
										<li>w - 星期几的数字表示（0 表示 Sunday[星期日]，6 表示 Saturday[星期六]）</li>
										<li>z - 一年中的第几天（从 0 到 365）</li>
										<li>W - 用 ISO-8601 数字格式表示一年中的星期数字（每周从 Monday[星期一]开始）</li>
										<li>F - 月份的完整的文本表示（January[一月份] 到 December[十二月份]）</li>
										<li class="list-group-item-success">m - 月份的数字表示（从 01 到 12）</li>
										<li class="list-group-item-warning">M - 月份的短文本表示（用三个字母表示）</li>
										<li>n - 月份的数字表示，不带前导零（1 到 12）</li>
										<li class="list-group-item-danger">t - 给定月份中包含的天数</li>
										<li>L - 是否是闰年（如果是闰年则为 1，否则为 0）</li>
										<li>o - ISO-8601 标准下的年份数字</li>
										<li class="list-group-item-success">Y - 年份的四位数表示</li>
										<li class="list-group-item-danger">y - 年份的两位数表示</li>
										<li>a - 小写形式表示：am 或 pm</li>
										<li>A - 大写形式表示：AM 或 PM</li>
										<li>B - Swatch Internet Time（000 到 999）</li>
										<li>g - 12 小时制，不带前导零（1 到 12）</li>
										<li>G - 24 小时制，不带前导零（0 到 23）</li>
										<li class="list-group-item-success">h - 12 小时制，带前导零（01 到 12）</li>
										<li class="list-group-item-danger">H - 24 小时制，带前导零（00 到 23）</li>
										<li class="list-group-item-info">i - 分，带前导零（00 到 59）</li>
										<li class="list-group-item-warning">s - 秒，带前导零（00 到 59）</li>
										<li>u - 微秒（<em class="label label-success">PHP 5.2.2</em>中新增的）</li>
										<li>e - 时区标识符（例如：UTC、GMT、Atlantic/Azores）</li>
										<li>I（i 的大写形式）- 日期是否是在夏令时（如果是夏令时则为 1，否则为 0）</li>
										<li>O - 格林威治时间（GMT）的差值，单位是小时（实例：+0100）</li>
										<li>P - 格林威治时间（GMT）的差值，单位是 hours:minutes（<em class="label label-danger">PHP 5.1.3</em>中新增的）</li>
										<li>T - 时区的简写（实例：EST、MDT）</li>
										<li>Z - 以秒为单位的时区偏移量。UTC 以西时区的偏移量为负数（-43200 到 50400）</li>
										<li>c - ISO-8601 标准的日期（例如 2013-05-05T16:34:42+00:00）</li>
										<li>r - RFC 2822 格式的日期（例如 Fri, 12 Apr 2013 12:01:05 +0200）</li>
										<li>U - 自 Unix 纪元（January 1 1970 00:00:00 GMT）以来经过的秒数.</li>
									</ul>
									<p class="text-success">同时，也可使用下列预定义常量（从<em class="label label-primary">PHP 5.1.0</em> 开始可用）：</p>
									<ul>
										<li>DATE_ATOM - Atom（例如：<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_ATOM);?&gt;</code><kbd><?php echo date(DATE_ATOM);?></kbd>）</li>
										<li>DATE_COOKIE - HTTP Cookies（例如：<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_COOKIE);?&gt;</code><kbd><?php echo date(DATE_COOKIE);?></kbd>）</li>
										<li>DATE_ISO8601 - ISO-8601（例如：<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_ISO8601);?&gt;</code><kbd><?php echo date(DATE_ISO8601);?></kbd>）</li>
										<li>DATE_RFC822 - RFC 822（例如：<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_RFC822);?&gt;</code><kbd><?php echo date(DATE_RFC822);?></kbd>）</li>
										<li>DATE_RFC850 - RFC 850（例如：<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_RFC850);?&gt;</code><kbd><?php echo date(DATE_RFC850);?></kbd>）</li>
										<li>DATE_RFC1036 - RFC 1036（例如：<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_RFC1036);?&gt;</code><kbd><?php echo date(DATE_RFC1036);?></kbd>）</li>
										<li>DATE_RFC1123 - RFC 1123（例如：<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_RFC1123);?&gt;</code><kbd><?php echo date(DATE_RFC1123);?></kbd>）</li>
										<li>DATE_RFC2822 - RFC 2822例如：<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_RFC2822);?&gt;</code><kbd><?php echo date(DATE_RFC2822);?></kbd>）</li>
										<li>DATE_RFC3339 - 与 DATE_ATOM 相同（从<em class="label label-danger">PHP 5.1.3</em>开始）</li>
										<li>DATE_RSS - RSS（<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_RSS);?&gt;</code><kbd><?php echo date(DATE_RSS);?></kbd>）</li>
										<li>DATE_W3C - 万维网联盟（<code>&lt;?php <i class="green">echo</i> <i class="blue">date</i>(DATE_W3C);?&gt;</code><kbd><?php echo date(DATE_W3C);?></kbd>）</li>
									</ul>
								</td>
							</tr>
							<tr>
								<td>timestamp</td>
								<td>可选。规定一个整数的 Unix 时间戳。默认是当前的本地时间（time()）。</td>
							</tr>
							<tr>
								<td>返回值：</td>
								<td>如果成功则返回格式化的日期字符串，如果失败则报 E_WARNING 错并返回 FALSE。</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>2.<code>time()</code></b>:返回自 Unix 纪元（January 1 1970 00:00:00 GMT）起的当前时间的秒数<sup class="badge badge-warning">php4.x.x+</sup>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">time</i>(); <em class="red">?&gt;</em><br><kbd><?php echo time(); ?></kbd></pre>
					<table class="table table-bordered table-striped table-hover">
						<tbody>
							<tr>
								<td>返回值：</td>
								<td>返回一个包含当前时间的 Unix 时间戳的整数。</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>3.<code>strtotime(time,now)</code></b>:将任何英文文本的日期或时间描述解析为 Unix 时间戳（自 January 1 1970 00:00:00 GMT 起的秒数）<sup class="badge badge-warning">php4.x.x+</sup></p>
					<p><b>注意</b>：如果年份表示使用两位数格式，则值 0-69 会映射为 2000-2069，值 70-100 会映射为 1970-2000。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">echo</i> <i class="blue">strtotime</i>("18 October 2017 15:45")."&lt;br&gt;";<br> <i class="green">echo</i> <i class="blue">strtotime</i>("+5 hour")."&lt;br&gt;"; <br> <i class="green">echo</i> <i class="blue">strtotime</i>("next Monday"); <em class="red">?&gt;</em></pre>
					<p class="text-success">运行结果：</p>
					<p><kbd><?php echo strtotime("18 October 2017 15:45")."<br>"; echo strtotime("+5 hour")."<br>"; echo strtotime("next Monday"); ?></kbd></p>
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr><th>参数</th><th width="80%">描述</th></tr>
						</thead>
						<tbody>
							<tr>
								<td>time</td>
								<td>必需。规定日期/时间字符串。</td>
							</tr>
							<tr>
								<td>now</td>
								<td>可选。规定用来计算返回值的时间戳。如果省略该参数，则使用当前时间。</td>
							</tr>
							<tr>
								<td>返回值：</td>
								<td>成功则返回时间戳，失败则返回 FALSE。</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><b>4.<code>localtime(timestamp,is_assoc)</code></b>:返回本地时间<sup class="badge badge-warning">php4.x.x+</sup>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="blue">print_r</i>(<i class="blue">localtime</i>());<br> <i class="blue">print_r</i>(<i class="blue">localtime</i>(<i class="blue">time</i>(),<i class="orange">true</i>));<br><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>参数</th>
								<th width="80%">描述</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>timestamp</td>
								<td>可选。规定 Unix 时间戳。如果未规定 timestamp，则默认为当前的本地时间 time()。</td>
							</tr>
							<tr>
								<td>is_assoc</td>
								<td><p>可选。规定返回关联数组还是数值数组。如果为 FALSE，则返回数值数组。如果为 TRUE，则返回关联数组。默认为 FALSE。</p>
								<p>关联数组的键名如下所示：</p>
								<ul>
									<li>[tm_sec] - 秒数</li>
									<li>[tm_min] - 分钟数</li>
									<li>[tm_hour] - 小时</li>
									<li>[tm_mon] - 年份中的第几个月，从 0 开始表示一月份</li>
									<li>[tm_year] - 年份，从 1900 开始</li>
									<li>[tm_wday] - 星期中的第几天 (Sunday=0)</li>
									<li>[tm_yday] - 年中的第几天</li>
									<li>[tm_isdst] - 夏令时当前是否生效</li>
								</ul>
								</td>
							</tr>
							<tr>
								<td>返回值</td>
								<td>返回包含 Unix 时间戳组件的数组。</td>
							</tr>
						</tbody>
					</table>
					<p class="text-success text-shadow"><code>localtime()函数</code>返回值：</p>
					<p><kbd><?php print_r(localtime());echo "<br>"; print_r(localtime(time(),true));?></kbd></p>
				</div>
				<div class="col-xs-6">
					<p><b>5.<code>mktime(hour,minute,second,month,day,year,is_dst)</code></b>:返回一个日期的 UNIX 时间戳<sup class="badge badge-warning">php4.x.x+</sup>。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">mktime</i>(<i class="blue">date</i>("H"),<i class="blue">date</i>("i"),<i class="blue">date</i>("s"),<i class="blue">date</i>("m"),<i class="blue">date</i>("d"),<i class="blue">date</i>("y")); <br><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover table-striped">
						<thead>
							<tr>
								<th>参数</th>
								<th width="80%">描述</th>
							</tr>
						</thead>
						<tbody>
							<tr><td>hour</td><td>可选。规定小时。</td></tr>
							<tr><td>minute</td><td>可选。规定分。</td></tr>
							<tr><td>second</td><td>可选。规定秒。</td></tr>
							<tr><td>month</td><td>可选。规定月。</td></tr>
							<tr><td>day</td>
								<td>可选。规定天。</td></tr>
							<tr><td>year</td>
								<td>可选。规定年。</td></tr>
							<tr><td>is_dst</td>
								<td>可选。如果时间在夏令时期间，则设置为 1，否则设置为 0，若未知则设置为 -1（默认）。如果未知，PHP 会试图找到自己（可能产生意外的结果）。 <em class="text-danger">注意：该参数在 PHP 5.1.0 中被废弃</em>。取而代之使用的是新的时区处理特性。</td></tr>
							<tr><td>返回值：</td>
								<td>返回一个整数 Unix 时间戳，如果错误则返回 FALSE</td>
							</tr>
						</tbody>
					</table>
					<p class="text-success"><code>mktime()</code>函数返回当前时间运行结果：</p>
					<p><kbd><?php 
 							echo mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("y")); 
							?></kbd></p>
				</div>
			</div>
		</main>
		<footer>&copy; by dhm &nbsp;,&nbsp; 20171018 ,&nbsp;&nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST']; ?></a></footer>
		<?php require_once("footer.php");?>
	</div>
</body>
</html>