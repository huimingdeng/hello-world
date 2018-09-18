jQuery(document).ready(function($){
	$('form').submit(function(){
		var data=$(this).serialize();
		var cat_no=$(this).find('input[type=checkbox]').is(":checked");
		var url='/phpStudy/cart_add.php?action=api';
		if(cat_no){
			$.ajax({
				url:url,
				type:'GET',
				data:data,
				dataType:'json',
				success:function(msg){
					if(msg.status!='fail'){
						$('.cart_display .tip_title').text(msg.status);
						$('.cart_display .cart_tip div.tip_cont').text(msg.info);
						$(".cart_display").show();
						centerObj($('.cart_tip'));
					}else{
						$('.cart_display .tip_title').text(msg.status);
						$('.cart_display .cart_tip div.tip_cont').text(msg.info);
						$(".cart_display").show();
					}
				}	
			});
			return false;
		}else{
			console.log("Please select Product!");
		}
		return false;
	});
	//关闭按钮
	$('.cart_display .btn-close').click(function(){
		$(this).parents('.cart_display').hide();
	});
	//设置居中显示
	var centerObj=function(e){
		var bh=$('body').height();
		var wh=$(window).height();
		var ch=$(e).height();
		$(e).css('top',(wh-ch)/2);
	}
});

