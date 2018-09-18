<?php //用于实现返回顶部的小功能?>
<aside class="back_to_top">
	<div>
		<a>Top</a>
	</div>
</aside>
<script type="text/javascript" src="globals/jquery-3.2.1.js"></script>
<script type="text/javascript" src="globals/bootstrap.js"></script>
<script type="text/javascript">
	$(function(){
		$(window).scroll(function(){
		    if ($(window).scrollTop()>120){
		        $(".back_to_top").fadeIn(1500);
		    } else {
		        $(".back_to_top").fadeOut(1500);
		    }
		});
		//当点击跳转链接后，回到页面顶部位置
		$(".back_to_top").click(function(){
		    $('body,html').animate({scrollTop:0},1000);
		    return false;
		});
	})
</script>