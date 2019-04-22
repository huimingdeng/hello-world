# PHP函数-日常使用集锦 #
该文档为日常开发中遇到的PHP内置函数，记录其用法示例。(此文档没有进行划分，可能时间函数没有放在一起，今后可能会进行一定的整理。)

## String 字符串函数 ##
### <i style="color:red;">`strcmp(string1,string2)`</i> 函数 ###
比较两个字符串,区分大小写。
<table cellspacing='0' cellpadding='0' border='0'>
	<thead>
		<tr>
			<th>参数</th>
			<th>描述</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>string1</td>
			<td>必需。规定要比较的第一个字符串。</td>
		</tr>
		<tr>
			<td>string2</td>
			<td>必需。规定要比较的第二个字符串。</td>
		</tr>
		<tr>
			<td>返回值</td>
			<td> 0 - 如果两个字符串相等<br> 
 				 <0 - 如果 string1 小于 string2<br> 
 				 >0 - 如果 string1 大于 string2<br>
			</td>
		</tr>
		<tr>
			<td>PHP 版本:</td>
			<td>4+</td>
		</tr>
	</tbody>
</table>

	<?php 
		echo strcmp("Hello","Hello"); // return 0
		echo "\n";
		echo strcmp("Hello","hELLo"); // return -1
		echo "\n";
		echo strcmp("Hello","HEllo"); // return 1
	疑问解答：
		1.如何比较 string1 和 string2 大小计算的呢？
		 例如：上面返回 -1 的例子：
		 ord('H') 的ASCII码为：72; 
		 ord('h') 的ASCII码为：104，
		 则字符串第一个字母比较大小，string1[0] < string2[0] return -1

### <i style="color:red;">`strcasecmp(string1,string2)`</i> 函数 ###
比较两个字符串，不区分大小写。
<table cellspacing='0' cellpadding='0' border='0'>
	<thead>
		<tr>
			<th>参数</th>
			<th>描述</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>string1</td>
			<td>必需。规定要比较的第一个字符串。</td>
		</tr>
		<tr>
			<td>string2</td>
			<td>必需。规定要比较的第二个字符串。</td>
		</tr>
		<tr>
			<td>返回值</td>
			<td> 0 - 如果两个字符串相等<br> 
 				 <0 - 如果 string1 小于 string2<br> 
 				 >0 - 如果 string1 大于 string2<br>
			</td>
		</tr>
		<tr>
			<td>PHP 版本:</td>
			<td>4+</td>
		</tr>
	</tbody>
</table>

## 面向对象链式操作 ##
`__call` 和 `call_user_func` 等函数实现。 参考[PHP 三种方式实现链式操作](https://blog.csdn.net/cain_123456/article/details/54632574 "PHP 三种方式实现链式操作")