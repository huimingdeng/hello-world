<!DOCTYPE html>
<html>
<head>
	<title>php函数——数组函数</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="globals/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="globals/public.css">
</head>
<body>
	<div class="container">
		<header><h1>PHP数组函数 <small>——php基础函数之数组函数<sub>(节选)</sub></small></h1></header>
		<main>
			<?php require("navbar.php"); $name=basename(__FILE__); navbar($name);?>
			<p class="in2em">php基础函数，数组函数的使用与举例说明，左侧是php代码片段，而右侧是php输出的结果。（<em class="label label-success">P.S.右侧如尽人皆知的则忽略了.</em>）</p>
			<div class="row">
				<div class="col-xs-10">
					<p><b>1.数组函数之array()</b>:用于创建数组.</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <i class="green">$</i><i class="blue">arr</i>=<i class="orange">array</i>(); <em class="red">?&gt;</em></pre>
				</div>
			</div>
			<!-- end array -->
			<div class="row">
				<div class="col-xs-6">
					<p><b>2.array_chunk(array,size,preserve_keys)</b>:把一个数组分割成另一个数组块。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <br/><i class="green">$</i><i class="blue">arr</i>=<i class="orange">array</i>('m','a','e','x');<br/><i class="blue">print_r</i>(<i class="blue">array_chunk</i>(<i class="green">$</i><i class="blue">arr</i>,2));<br/><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>array</td><td>必需。规定要使用的数组。</td></tr>
							<tr><td>size</td><td>必需。一个整数，规定每个新数组块包含多少个元素。</td></tr>
							<tr><td>preserve_keys</td><td>可选，可能的值：
									<ul>
										<li>true-保留原始数组的键名。</li>
										<li>false-每个新数组块使用从零开始的索引。</li>
									</ul>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p>左侧的打印结果如下：<?php $arr=array('m','a','e','x');?><br/>
					<kbd><?php print_r(array_chunk($arr,2));?></kbd></p>
				</div>
			</div>
			<!-- end array_chunk -->
			<div class="row">
				<div class="col-xs-6">
					<p><b>3.array_change_key_case(array,case)</b>:返回其键均为大写或小写的数组。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <br/> <i class="green">$</i><i class="blue">age</i>=<i class="orange">array</i>('Petter'=>'35','Ben'=>'30','joe'=>'50');<br/><i class="blue"> print_r</i>(<i class="blue">array_change_key_case</i>(<i class="green">$</i><i class="blue">age</i>,CASE_UPPER)); <br/> <i class="blue">print_r</i>(<i class="blue">array_change_key_case</i>(<i class="green">$</i><i class="blue">age</i>,CASE_LOWER)); <br/><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead>
							<tr><th>参数</th><th width="80%">描述</th></tr>
						</thead>
						<tbody>
							<tr><td>array</td><td>必须。规定要使用的数组</td></tr>
							<tr><td>case</td><td>可选，可能的值：
									<ul>
										<li class="active">CASE_LOWER-默认值。将数组的键转换为小写字母。</li>
										<li>CASE_UPPER-将数组的键转换为大写字母.</li>
									</ul>
								</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p>key值转换成大写：<br/><?php $age=array('Petter'=>'35','Ben'=>'30','joe'=>'50');?>
					<kbd><?php print_r(array_change_key_case($age,CASE_UPPER));?></kbd></p>
					<p>key值转换成小写：<br/>
					<kbd><?php print_r(array_change_key_case($age,CASE_LOWER));?></kbd>
					</p>
				</div>
			</div>
			<!-- end array_change_key_case -->
			<div class="row">
				<div class="col-xs-7">
					<p><b>4.array_column(array,column_key,index_key)</b>:返回输入数组中某个单一列的值。例如用户组：</p>
					<pre class="pre-scrollable"><em class="red">&lt;php </em><br/> <i class="green">$</i><i class="blue">user</i>=<i class="orange">array</i>(<br/> &nbsp;&nbsp;<i class="orange">array</i>('id'=>110,'first_name'=>'Peter','last_name'=>'Griffin'),<br/> &nbsp;&nbsp;<i class="orange">array</i>('id'=>119,'first_name'=>'Ben','last_name'=>'Smith'),<br/> &nbsp;&nbsp;<i class="orange">array</i>('id'=>'120','first_name'=>'Joe','last_name'=>'Doe')<br/>);<br/><i class="green">$</i><i class="blue">last_names</i>=<i class="blue">array_column</i>(<i class="green">$</i><i class="blue">user</i>,'last_name');<br/><i class="blue">print_r</i>(<i class="green">$</i><i class="blue">last_names</i>); <br/><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr><td>array</td><td>必需。指定要使用的多维数组（记录集）.</td></tr>
							<tr><td>column_key</td><td>必需。需要返回值的列。可以是索引数组的列的整数索引，或者是关联数组的列的字符串键值。该参数也可以是 NULL，此时将返回整个数组（配合index_key 参数来重置数组键的时候，非常管用）</td></tr>
							<tr><td>index_key</td><td>可选。作为返回数组的索引/键的列。</td></tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-5">
					<p>
						<em class="text-success">结果如下所示：</em><br/>
						<kbd><?php 
						 $user=array(
						   array('id'=>110,'first_name'=>'Peter','last_name'=>'Griffin'),
						   array('id'=>119,'first_name'=>'Ben','last_name'=>'Smith'),
						   array('id'=>'120','first_name'=>'Joe','last_name'=>'Doe')
						);
						$last_names=array_column($user,'last_name');
						print_r($last_names);
						?></kbd>
					</p>
					
				</div>
			</div>
			<!-- end array_column -->
			<div class="row">
				<div class="col-xs-6">
					<p><b>5.array_combine(keys,values)</b>:通过合并两个数组（一个为键名数组，一个为键值数组）来创建一个新数组。<sup class="badge badge-warning">php 5.x.x+</sup></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em> <br/><i class="green">$</i><i class="blue">fname</i>=<i class="orange">array</i>('Peter','Ben','Joe'); <br/><i class="green">$</i><i class="blue">age</i>=<i class="orange">array</i>(35,30,50); <br/><i class="green">$</i><i class="blue">c</i>=<i class="blue">array_combine</i>(<i class="green">$</i>fname,<i class="green">$</i>age); <br/><i class="blue">print_r</i>(<i class="green">$</i>c);<br/><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody>
							<tr>
								<td>keys</td>
								<td>必需。规定数组的键名。</td>
							</tr>
							<tr>
								<td>values</td>
								<td>必需。规定数组的键值。</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><em class="text-success">数组合并案例结果：</em><br/>
					<kbd><?php $fname=array('Peter','Ben','Joe'); $age=array(35,30,50); $c=array_combine($fname,$age); print_r($c);?></kbd></p>
				</div>
			</div>
			<!-- end array_combine -->
			<div class="row">
				<div class="col-xs-6">
					<p><b>6.array_count_values(array)</b>:函数用于统计数组中所有值出现的次数。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br/> <i class="green">$</i><i class="blue">a</i>=<i class="orange">array</i>("A","a","B","b","C","E","E","F","F","a");<br/> <i class="blue">print_r</i>(<i class="blue">array_count_values</i>(<i class="green">$</i><i class="blue">a</i>));<br/><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr>
							<th>参数</th>
							<th width="80%">描述</th>
						</tr></thead>
						<tbody><tr>
							<td>array</td>
							<td>必需。规定需要统计数组中所有值出现次数的数组。</td>
						</tr></tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><em class="text-success">函数运行结果：</em><br/>
					<kbd><?php $a=array("A","a","B","b","C","E","E","F","F","a"); print_r(array_count_values($a));?></kbd></p>
				</div>
			</div>
			<!-- end array_count_values -->
			<div class="row">
				<div class="col-xs-6">
					<p><b>7.array_diff(array1,array2,array3...)</b>:函数用于比较两个（或更多个）数组的<b>键值</b>，并返回差集。<sup class="badge badge-warning">php 4.0.1+</sup>（P.S.只比较键值）。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php </em> <br/> <i class="green">$</i><i class="blue">a1</i>=<i class="orange">array</i>("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");<br/> <i class="green">$</i><i class="blue">a2</i>=<i class="orange">array</i>("e"=>"red","f"=>"green","g"=>"blue");<br/> <i class="green">$</i><i class="blue">result</i>=<i class="blue">array_diff</i>(<i class="green">$</i><i class="blue">a1</i>,<i class="green">$</i><i class="blue">a2</i>);<br/> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">result</i>);<br/> <em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr>
							<th>参数</th>
							<th width="80%">描述</th>
						</tr></thead>
						<tbody><tr>
							<td>array1</td>
							<td>必需。与其他数组进行比较的第一个数组。</td>
						</tr>
						<tr>
							<td>array2</td>
							<td>必需。与第一个数组进行比较的数组。</td>
						</tr>
						<tr>
							<td>array3</td>
							<td>可选。与第一个数组进行比较的其他数组。</td>
						</tr></tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><em class="text-success">函数运行结果：</em><br>
					<kbd><?php $a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
						$a2=array("e"=>"red","f"=>"green","g"=>"blue");
						$result=array_diff($a1,$a2);
						print_r($result);
						?></kbd></p>
				</div>
			</div>
			<!-- end  array_diff -->
			<div class="row">
				<div class="col-xs-6">
					<p><b>8.array_diff_assoc(array1,array2,array3...)</b>:函数用于比较两个（或更多个）数组的<b>键名和键值</b>，并返回差集。<sup class="badge badge-warning">php 4.3.x+</sup>（P.S.比较键名和键值）。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br/> <i class="green">$</i><i class="blue">a1</i>=<i class="blue">array</i>("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");<br/> <i class="blue">$</i><i class="blue">a2</i>=<i class="orange">array</i>("a"=>"red","b"=>"green","c"=>"blue");<br/> <i class="green">$</i><i class="blue">result</i>=<i class="blue">array_diff_assoc</i>(<i class="green">$</i><i class="blue">a1</i>,<i class="green">$</i><i class="blue">a2</i>);<br/> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">result</i>); <br/><em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead><tr><th>参数</th><th width="80%">描述</th></tr></thead>
						<tbody><tr>
							<td>array1</td>
							<td>必需。与其他数组进行比较的第一个数组。</td>
						</tr>
						<tr>
							<td>array2</td>
							<td>必需。与第一个数组进行比较的数组。</td>
						</tr>
						<tr>
							<td>array3</td>
							<td>可选。与第一个数组进行比较的其他数组。</td>
						</tr></tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><em class="text-success">函数运行结果：</em><br>
						<kbd><?php
							$a1=array("a"=>"red","b"=>"green","c"=>"blue","d"=>"yellow");
							$a2=array("a"=>"red","b"=>"green","c"=>"blue");
							$result=array_diff_assoc($a1,$a2);
							print_r($result);
							?></kbd>
					</p>
				</div>
			</div>
			<!-- end array_diff_assoc -->
			<div class="row">
				<div class="col-xs-6">
					<p><b>9.array_diff_key(array1,array2,array3...)</b>:函数用于比较两个(或多个)数组的<b>键名</b>，返回两个数组的差集<sup class="badge badge-warning">php5.1.x+</sup>（P.S.只比较键名）。</p>
					<pre class="pre-scrollable"><em class="red">&lt;?php </em><br/> <i class="green">$</i><i class="blue">a1</i>=<i class="orange">array</i>("a"=>"red","b"=>"green","c"=>"blue");<br/> <i class="green">$</i><i class="blue">a2</i>=<i class="orange">array</i>("a"=>"red","c"=>"blue","d"=>"pink");<br> <i class="green">$</i><i class="blue">result</i>=<i class="blue">array_diff_key</i>(<i class="green">$</i><i class="blue">a1</i>, <i class="green">$</i><i class="blue">a2</i>);<br> <i class="blue">print_r</i>(<i class="blue">$</i><i class="blue">result</i>);<br/><em class="red"> ?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>参数</th>
								<th width="80%">描述</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>array1</td>
								<td>必需。与其他数组进行比较的第一个数组。</td>
							</tr>
							<tr>
								<td>array2</td>
								<td>必需。与第一个数组进行比较的数组。</td>
							</tr>
							<tr>
								<td>array3</td>
								<td>可选。与第一个数组进行比较的其他数组。</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><em class="text-success">左侧代码结果如下：</em></p>
					<p><kbd><?php $a1=array("a"=>"red","b"=>"green","c"=>"blue"); $a2=array("a"=>"red","c"=>"blue","d"=>"pink"); $result=array_diff_key($a1, $a2); print_r($result);?></kbd></p>
				</div>
			</div>
			<!-- end array_diff_key -->
			<div class="row">
				<div class="col-xs-6">
					<p><b>10.array_fill(index,number,value)</b>:函数用给定的键值填充数组。<sup class="badge badge-warning">php 4.2.x+</sup></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">a1</i>=<i class="blue">array_fill</i>(3,2,'yellow');<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">a1</i>);<br><em class="red"> ?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>参数</th>
								<th width="80%">描述</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>index</td>
								<td>必需。规定返回数组的起始索引。</td>
							</tr>
							<tr>
								<td>number</td>
								<td>必需。规定填充的元素的数量，其值必须大于 0。</td>
							</tr>
							<tr>
								<td>value</td>
								<td>必需。规定用于填充数组的键值。</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><em class="text-success">示例代码运行结果如下：</em></p>
					<p><kbd><?php $a1=array_fill(3,2,'yellow'); print_r($a1);?></kbd></p>
				</div>
			</div>
			<!-- end array_fill -->
			<div class="row">
				<div class="col-xs-6">
					<p><b>11.array_fill_keys(keys,value)</b>:用给定的指定键名的键值填充数组。<sup class="badge badge-warning">php5.2.x+</sup></p>
					<pre class="pre-scrollable"><em class="red">&lt;?php</em><br> <i class="green">$</i><i class="blue">keys</i>=<i class="orange">array</i>("a","b","c","d");<br> <i class="green">$a1</i>=<i class="blue">array_fill_keys</i>(<i class="green">$</i><i class="blue">keys</i>,"yellow");<br> <i class="blue">print_r</i>(<i class="green">$</i><i class="blue">a1</i>);<br> <em class="red">?&gt;</em></pre>
					<table class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>参数</th>
								<th width="80%">描述</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>keys</td>
								<td>必须。数组，其值将被用于填充数组的键名。</td>
							</tr>
							<tr>
								<td>value</td>
								<td>必需。规定用于填充数组的键值。</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-xs-6">
					<p><em class="text-success">代码运行结果：</em></p>
					<p><kbd><?php $keys=array("a","b","c","d"); $a1=array_fill_keys($keys,'yellow'); print_r($a1);?></kbd></p>
				</div>
			</div>
			<!-- end array_fill_keys -->
		</main>
		<footer>&copy; by dhm &nbsp;,&nbsp; 20171016 &nbsp;,&nbsp;<a href="/"><?php echo $_SERVER['HTTP_HOST'];?></a></footer>
		<?php require_once("footer.php");?>
	</div>
</body>
</html>