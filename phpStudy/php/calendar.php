<!DOCTYPE html>
<html>
<head>
	<title>PHP函数——Calendar日历函数</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header><h1>PHP日历函数 <small>——php基础函数之日历函数<sub>(节选)</sub></small></h1></header>
		<main>
			<?php require("navbar.php"); navbar(basename(__FILE__));?>
			<article>
				<p>日历扩展包含了简化不同日历格式间的转换的函数。为了让这些函数能够工作，必须通过 --enable-calendar 编译 PHP。PHP 的 Windows 版本已内建了对日历扩展的支持。因此，Calendar 函数会自动工作。</p>
				<div class="row">
					<div class="col-xs-5">
						<div class="row">
							<div class="col-xs-12">
								<p><b>1.cal_days_in_month(calendar,month,year)</b>:针对指定的年份和历法，返回一个月中的天数<sup class="badge badge-warning">php4.1.x+</sup>。</p>
								<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">echo</i> <i class="blue">cal_days_in_month</i>(<i class="orange">CAL_JULIAN</i>, 8, 2017);<br><em class="red">?&gt;</em><br> <kbd>//输出：<?php echo cal_days_in_month(CAL_JULIAN, 8, 2017);?></kbd></pre>
								<p>参数说明列表：</p>
								<table class="table table-bordered table-hover table-striped">
									<thead><tr>
										<th>参数</th>
										<th width="80%">描述</th>
									</tr></thead>
									<tbody>
										<tr>
											<td>calendar</td>
											<td>必需。规定要使用的历法。</td>
										</tr>
										<tr>
											<td>month</td>
											<td>必需。规定选定历法中的月</td>
										</tr>
										<tr>
											<td>year</td>
											<td>必需。规定选定历法中的年</td>
										</tr>
										<tr>
											<td>返回值：</td>
											<td>针对给定的年份和历法，返回选定月份中的天数。</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12">
								<p><b>2.cal_from_jd(jd,calendar)</b>:把儒略日计数转换为指定历法的日期。<sup class="badge badge-warning">php4.1.x+</sup></p>
								<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">d</i>=<abbr class="blue" title="将Unix时间戳转换为Julian Day">unixtojd</abbr>(<abbr class="blue" title="取得一个日期的 Unix 时间戳-mktime(int hour,minute,second,month,day,year);">mktime</abbr>(0,0,0,<?php echo date('m');?>,<?php echo date('d');?>,<?php echo date('Y');?>));<br> <i class="blue">print_r</i>(<i class="blue">cal_from_jd</i>(<i class="green">$</i><i class="blue">d</i>,<i class="orange">CAL_GREGORIAN</i>));<br> <em class="red">?&gt;</em></pre>
								<p><kbd>//打印结果：<br><?php $d=unixtojd(mktime(0,0,0,date('m'),date('d'),date('Y'))); print_r(cal_from_jd($d,CAL_GREGORIAN)); ?></kbd></p>
								<p>参数说明列表：</p>
								<table class="table table-bordered table-hover table-striped">
									<thead>
										<tr>
											<th>参数</th>
											<th width="80%">描述</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>jd</td>
											<td>必需。一个数字（儒略日计数）。</td>
										</tr>
										<tr>
											<td>calendar</td>
											<td>必需。规定要使用的历法。可以使用下面这些常量：
												<ul>
													<li>CAL_GREGORIAN</li>
													<li>CAL_JULIAN</li>
													<li>CAL_JEWISH</li>
													<li>CAL_FRENCH</li>
												</ul>
											</td>
										</tr>
										<tr>
											<td>返回值：</td>
											<td>返回包含如下日历信息的数组：
												<ul>
													<li>日期，形式为 "月/日/年"</li>
													<li>月</li>
													<li>年</li>
													<li>一周中的几天</li>
													<li>工作日和月的缩写和全名</li>
												</ul>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col-xs-12">
								<p><b>3.cal_info(calendar):</b>返回有关指定历法的信息<sup class="badge badge-warning">php4.1.x</sup></p>
								<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="blue">print_r</i>(<i class="blue">cal_info</i>(0)); <em class="red">?&gt;</em><br></pre>
								<p><kbd><?php print_r(cal_info(0));?></kbd></p>
								<p>参数说明列表：</p>
								<table class="table table-bordered table-hover table-striped">
									<thead>
										<tr>
											<th>参数</th>
											<th width="80%">描述</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>calendar</td>
											<td>可选。规定一个表示要使用的历法的数字。可以使用下面这些常量：
												<ul>
													<li>0 = CAL_GREGORIAN</li>
													<li>1 = CAL_JULIAN</li>
													<li>2 = CAL_JEWISH</li>
													<li>3 = CAL_FRENCH</li>
												</ul>
												<b>提示：</b>如果 calendar 参数被省略，cal_info() 返回有关所有历法的信息。
											</td>
										</tr>
										<tr>
											<td>返回值：</td>
											<td>返回包含如下日历元素的数组：
												<ul>
													<li>calname</li>
													<li>calsymbo</li>
													<li>month</li>
													<li>abbrevmonth</li>
													<li>maxdaysinmonth</li>
												</ul>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
					<div class="col-xs-7">
						<p class="text-success">日期函数常用的常量列表：</p>
						<table class="table table-bordered table-hover table-striped">
							<thead>
								<tr>
									<th width="20%">常量</th>
									<th width="10%">类型</th>
									<th width="20%">PHP版本</th>
									<th width="50%">说明(网上无此项)</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>CAL_GREGORIAN</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td>混合日历（格里高利等）</td>
								</tr>
								<tr>
									<td>CAL_JULIAN</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_JEWISH</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_FRENCH</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_NUM_CALS</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_DOW_DAYNO</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_DOW_SHORT</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_DOW_LONG</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_MONTH_GREGORIAN_SHORT</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_MONTH_GREGORIAN_LONG</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_MONTH_JULIAN_SHORT</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_MONTH_JULIAN_LONG</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_MONTH_JEWISH</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_MONTH_FRENCH</td>
									<td>Integer</td>
									<td><em class="label label-success">PHP4</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_EASTER_DEFAULT</td>
									<td>Integer</td>
									<td><em class="label label-primary">PHP4.3</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_EASTER_ROMAN</td>
									<td>Integer</td>
									<td><em class="label label-primary">PHP4.3</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_EASTER_ALWAYS_GREGORIAN</td>
									<td>Integer</td>
									<td><em class="label label-primary">PHP4.3</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_EASTER_ALWAYS_JULIAN</td>
									<td>Integer</td>
									<td><em class="label label-primary">PHP4.3</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_JEWISH_ADD_ALAFIM_GERESH</td>
									<td>Integer</td>
									<td><em class="label label-danger">PHP5.0</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_JEWISH_ADD_ALAFIM</td>
									<td>Integer</td>
									<td><em class="label label-danger">PHP5.0</em></td>
									<td></td>
								</tr>
								<tr>
									<td>CAL_JEWISH_ADD_GERESHAYIM</td>
									<td>Integer</td>
									<td><em class="label label-danger">PHP5.0</em></td>
									<td></td>
								</tr>
							</tbody>
						</table>
						<div class="col-xs-12">
							<p><b>案例：</b></p>
							<?php //31天的月份
							$m31=array(1,3,5,7,8,10,12);
							for($i=0;$i<12;$i++){?>
								<div class="col-xs-6" >
									<table class="table table-bordered">
										<thead>
											<tr><th colspan="7"><?php echo date("Y")."年".($i+1);?>月</th></tr>
											<tr><?php for($j=0;$j<7;$j++){?><td>周<?php echo $j+1;?></td><?php }?></tr>
										</thead>
										<tbody>
											<?php 
											if(in_array($i+1,$m31)){$len=31;}elseif($i+1==2){}?>
											<tr>
												<td><?php //echo date("Y".$i+1."$z");?></td>
											</tr>
										</tbody>
									</table>
								</div>
							<?php }
							?>
						</div>
					</div>
				</div>
			</article>
		</main>
		<footer>&copy; by dhm &nbsp;,&nbsp; 20171017 &nbsp;,&nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST'];?></a></footer>
	</div>
	<?php require_once("footer.php") ?>
</body>
</html>