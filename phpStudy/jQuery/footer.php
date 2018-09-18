<?php //用于实现返回顶部的小功能?>
<aside class="back_to_top">
	<div>
		<a>Top</a>
	</div>
</aside>
<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript">
	$(function(){
		$(window).scroll(function(){
		    if($(window).scrollTop()>$('.custom_style_nav').height()){
		    	$(".custom_style_nav").css({
		        	"background-color":"#fff",
		        	"box-shadow":"0px 2px 2px #ccc",
		        	"border-radius":"3px"
		        }).addClass("navbar-fixed-top").children().addClass("container");
		    }
		    if($(window).scrollTop()>100){
		        $(".back_to_top").fadeIn(1500);
		    } else {
		        $(".back_to_top").fadeOut(1500);
		        $(".custom_style_nav").css({
		        	"background-color":"#fff",
		        	"box-shadow":"none",
		        	"border-radius":"0px"
		        }).removeClass("navbar-fixed-top").children().removeClass("container");
		    }
		});
		//当点击跳转链接后，回到页面顶部位置
		$(".back_to_top").click(function(){
		    $('body,html').animate({scrollTop:0},1000);
		    return false;
		});
	})
</script>