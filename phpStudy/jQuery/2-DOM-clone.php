<?php 
$pageTitle = "jQuery基础DOM篇——拷贝clone()";
$filename = basename(__FILE__);
require_once('header.php');
$createTime = date('Y-m-d',filectime($filename));?>
    <main>
        <h2>通过clone克隆元素</h2>
        <div class="row">
            <div class="col-xs-8">
                <p>克隆节点是DOM的常见操作，jQuery提供一个clone方法，专门用于处理dom的克隆</p>
                <div>
                    <pre align="left">.clone()方法深度 复制所有匹配的元素集合，包括所有匹配元素、匹配元素的下级元素、文字节点。</pre>
                </div>
                <p>clone方法比较简单就是克隆节点，但是需要注意，如果节点有事件或者数据之类的其他处理，我们需要通过<code>clone(ture)</code>传递一个布尔值ture用来指定，这样不仅仅只是克隆单纯的节点结构，还要把附带的事件与数据给一并克隆了</p>
                <pre>HTML部分<br>&lt;div&gt;&lt;/div&gt;
                <br>JavaScript部分 <br>$(&quot;div&quot;).on(&#39;click&#39;, function() {//执行操作})
                <br>//clone处理一<br>$(&quot;div&quot;).clone()   //只克隆了结构，事件丢失<br>//clone处理二<br>$(&quot;div&quot;).clone(true) //结构、事件与数据都克隆</pre>
            </div>
        </div>
        <div class="row">
            <p>使用上就是这样简单，使用克隆的我们需要额外知道的细节：</p>
            <ul>
                <li>clone()方法时，在将它插入到文档之前，我们可以修改克隆后的元素或者元素内容，如下边代码 $(this).clone().css('color','red') 增加了一个颜色</li>
                <li>通过传递true，将所有绑定在原始元素上的事件处理函数复制到克隆元素上</li>
                <li>clone()方法是jQuery扩展的，只能处理通过jQuery绑定的事件与数据</li>
                <li>元素数据（data）内对象和数组不会被复制，将继续被克隆元素和原始元素共享。深复制的所有数据，需要手动复制每一个</li>
            </ul>
        </div>
        <div class="row">
            <div class="aaron1 col-xs-3">
                <div class="thumbnail max-height-3">
                    <a href="javascript:void(0);" class="thumbnail" title="点击,clone浅拷贝"><img class="img-responsive img-circle" src="images/nv01.jpg" alt="点击,clone浅拷贝"></a>
                    <div class="caption">
                        <h3>点击,clone浅拷贝</h3>
                        <p>拷贝的对象，没有拷贝当前对象的事件。</p>
                    </div>
                </div>
            </div>
            <div class="aaron2 col-xs-3">
                <div class="thumbnail max-height-3">
                    <a href="javascript:void(0);" class="thumbnail" title="点击,clone深拷贝,可以继续触发创建"><img class="img-responsive img-circle" src="images/nv02.jpg" alt="点击,clone深拷贝,可以继续触发创建"></a>
                    <div class="caption">
                        <h3>点击,clone深拷贝,可以继续触发创建</h3>
                        <p>拷贝的对象和对象的事件。</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row nv01">
            <div class="left col-xs-12"><div class="clearfix"></div></div>
        </div>
    </main>

    <script type="text/javascript">
        //只克隆节点
    	//不克隆事件
	    $(".aaron1").on('click', function() {
	        $(".left").append( $(this).clone().css({"background-color":"#485712"}) )
	    })
    </script>

    <script type="text/javascript">
    	//克隆节点
    	//克隆事件
	    $(".aaron2").on('click', function() {
            console.log(1)
	        $(".left").append( $(this).clone(true).css({"background-color":"#423b12"}) )
	    })
    </script>

<?php include_once("footer.php");?>