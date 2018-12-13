<?php 
$pageTitle = "jQuery —— replaceWidth()和replaceAll()";
$filename = basename(__FILE__);
require_once('header.php'); 
$createTime = date('Y-m-d',filectime($filename));
?>
	<main>
		<div class="row">
			<div class="col-xs-8">
				<p>之前学习了节点的内插入、外插入以及删除方法，这节会学习替换方法replaceWith</p>
				<p><b>.replaceWith( newContent )：</b>用提供的内容替换集合中所有匹配的元素并且返回被删除元素的集合</p>
				<p>简单来说：用$()选择节点A，调用replaceWith方法，传入一个新的内容B（HTML字符串，DOM元素，或者jQuery对象）用来替换选中的节点A</p>
				<p>看个简单的例子：一段HTML代码</p>
				<pre>&lt;div&gt;<br>&lt;p&gt;第一段&lt;/p&gt;<br>&lt;p&gt;第二段&lt;/p&gt;<br>&lt;p&gt;第三段&lt;/p&gt;<br>&lt;/div&gt;</pre>
				<p>替换第二段的节点与内容</p>
				<pre>$("p:eq(1)").replaceWith('&lt;a style="color:red">替换第二段的内容&lt;/a>')</pre>
				<p>通过jQuery筛选出第二个p元素，调用replaceWith进行替换，结果如下</p>
				<pre>&lt;div&gt;<br>&lt;p&gt;第一段&lt;/p&gt;<br>&lt;a style="color:red"&gt;第二段&lt;/a&gt;<br>&lt;p&gt;第三段&lt;/p&gt;<br>&lt;/div&gt;</pre>
				<p><b>.replaceAll( target ) ：</b>用集合的匹配元素替换每个目标元素</p>
				<p>.replaceAll()和.replaceWith()功能类似，但是目标和源相反，用上述的HTML结构，我们用replaceAll处理</p>
				<pre>$('&lt;a style="color:red">替换第二段的内容&lt;/a>').replaceAll('p:eq(1)')</pre>
				<p>总结：</p>
				<ul>
					<li>.replaceAll()和.replaceWith()功能类似，主要是目标和源的位置区别</li>
					<li>.replaceWith()与.replaceAll() 方法会删除与节点相关联的所有数据和事件处理程序</li>
					<li>.replaceWith()方法，和大部分其他jQuery方法一样，返回jQuery对象，所以可以和其他方法链接使用</li>
					<li>.replaceWith()方法返回的jQuery对象引用的是替换前的节点，而不是通过replaceWith/replaceAll方法替换后的节点</li>
				</ul>
			</div>
		</div>
		<div class="row">
			<h2>replaceWith()和replaceAll()</h2>
            <div class="aaron1 col-xs-3">
                <div class="thumbnail max-height-3">
                    <a href="javascript:void(0);" class="thumbnail bt1" title="replaceWith()"><img class="img-responsive img-circle" src="images/nv01.jpg" alt="replaceWith()"></a>
                    <div class="caption">
                        <h3>replaceWith()</h3>
                        <p>replaceWith()</p>
                    </div>
                </div>
            </div>
            <div class="aaron2 col-xs-3">
                <div class="thumbnail max-height-3">
                    <a href="javascript:void(0);" class="thumbnail bt2" title="replaceAll()"><img class="img-responsive img-circle" src="images/nv02.jpg" alt="replaceAll()"></a>
                    <div class="caption">
                        <h3>replaceAll()</h3>
                        <p>replaceAll()</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
		    <div class="right">
		        <div>
		            <p>第一段</p>
		            <p>第二段</p>
		            <p>第三段</p>
		        </div>
		        <div>
		            <p>第四段</p>
		            <p>第五段</p>
		            <p>第六段</p>
		        </div>
		    </div>
		    <script type="text/javascript">
		    //只克隆节点
		    //不克隆事件
		    $(".bt1").on('click', function() {
		        //找到内容为第二段的p元素
		        //通过replaceWith删除并替换这个节点
		        $(".right > div:first p:eq(1)").replaceWith($(this).clone())
		    })
		    </script>
		    <script type="text/javascript">
		    //找到内容为第六段的p元素
		    //通过replaceAll删除并替换这个节点
		    $(".bt2").on('click', function() {
		        $($(this).clone()).replaceAll('.right > div:last p:last');
		    })
		    </script>
        </div>
	</main>
<?php include_once("footer.php");?>
	