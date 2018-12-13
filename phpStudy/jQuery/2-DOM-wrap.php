<?php 
$pageTitle = "jQuery —— wrap方法和unwrap()方法";
$filename = basename(__FILE__);
require_once('header.php'); 
$createTime = date('Y-m-d',filectime($filename));
?>
	<main>
		<div class="row">
			<div class="col-xs-7">
				<h2>DOM包裹wrap()方法</h2>
				<p>如果要将元素用其他元素包裹起来，也就是给它增加一个父元素，针对这样的处理，JQuery提供了一个wrap方法</p>
				<p><b>.wrap( wrappingElement )</b>：在集合中匹配的每个元素周围包裹一个HTML结构</p>
				<p>简单的看一段代码：</p>
				<pre>&lt;p>p元素&lt;/p></pre>
				
				<p>给p元素增加一个div包裹</p>
				<pre>$('p').wrap('&lt;div>&lt;/div>')</pre>
				<p>最后的结构，p元素增加了一个父div的结构</p>
				<pre>&lt;div><br>    &lt;p>p元素&lt;/p><br>&lt;/div></pre>
				<p><b>.wrap( function )</b> ：一个回调函数，返回用于包裹匹配元素的 HTML 内容或 jQuery 对象</p>
				<p>使用后的效果与直接传递参数是一样，只不过可以把代码写在函数体内部，写法不同而已</p>
				<p>以第一个案例为例：</p>
				<pre>$('p').wrap(function() {<br>    return '&lt;div>&lt;/div>';   //与第一种类似，只是写法不一样<br>})</pre>
				<p><b>注意</b>:</p>
				<p>.wrap()函数可以接受任何字符串或对象，可以传递给$()工厂函数来指定一个DOM结构。这种结构可以嵌套了好几层深，但应该只包含一个核心的元素。每个匹配的元素都会被这种结构包裹。该方法返回原始的元素集，以便之后使用链式方法。</p>
				<hr>
				<h2>DOM包裹unwrap()方法</h2>
				<p>我们可以通过wrap方法给选中元素增加一个包裹的父元素。相反，如果删除选中元素的父元素要如何处理 ?</p>
				<p>jQuery提供了一个<code>unwrap()</code>方法 ，作用与wrap方法是相反的。将匹配元素集合的父级元素删除，保留自身（和兄弟元素，如果存在）在原来的位置。</p>
				<p>看一段简单案例：</p>
				<pre>&lt;div><br>    &lt;p>p元素&lt;/p><br>&lt;/div></pre>
				<p>我要删除这段代码中的div，一般常规的方法会直接通过remove或者empty方法</p>
				<pre>$('div').remove();</pre>
				<p>但是如果我还要保留内部元素p，这样就意味着需要多做很多处理，步骤相对要麻烦很多，为了更便捷，jQuery提供了unwrap方法很方便的处理了这个问题</p>
				<pre>$('p').unwrap();</pre>
				<p>找到p元素，然后调用unwrap方法，这样只会删除父辈div元素了</p>
				<p>结果：</p>
				<pre>&lt;p>p元素&lt;/p></pre>
				<p>这个方法比较简单，也不接受任何参数，注意参考下案例的使用即可</p>
			</div>
			<div class="col-xs-5">
				<article>
					<h2>案例：添加父容器</h2>
                    <div class="aaron1">
                        <a href="javascript:void(0);" class="thumbnail bt1" title="wrap()"><img class="img-responsive img-circle" src="images/nv01.jpg" alt="wrap()"></a>
                    </div>
                    <div class="aaron2">
                        <a href="javascript:void(0);" class="thumbnail bt2" title="wrap(function)"><img class="img-responsive img-circle" src="images/nv02.jpg" alt="wrap(function)"></a>
                    </div>
                    <hr>
                    <h2>案例：删除父容器</h2>
                    <div class="row">
                    	<div class="col-xs-12">
                    		<div class="col-xs-10">
                    			<div class="col-xs-8">
                    				<div class="col-xs-6">
                    					<div class="col-xs-4">
                    						<div class="col-xs-2">
                    							<div class="aaron3">
							                        <a href="javascript:void(0);" class="thumbnail bt1" title="unwrap()"><img class="img-responsive img-circle" src="images/nv03.jpg" alt="unwrap()"></a>
							                    </div>
                    						</div>
                    					</div>
                    				</div>
                    			</div>
                    		</div>
                    	</div>
                    </div>
				</article>
            </div>
            <script type="text/javascript">
            	$(".aaron1").on("click",function(){
            		$(this).wrap('<div class="col-xs-8" style="border:1px solid red;"></div>');
            	});
            	$(".aaron2").on("click",function(){
            		$(this).wrap(function(){
            			return '<div class="col-xs-12" style="border:1px solid blue;">'+$(this).text()+'</div>';
            		})
            	})
            	$(".aaron3").on("click",function(){
            		$(this).unwrap('<div></div>');
            	});
            </script>
		</div>
	</main>
		
<?php include_once("footer.php");?>
