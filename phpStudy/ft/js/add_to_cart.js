
function addlink(obj) {

    var href=jQuery(obj).attr('action');
    href+="?_utm=1&prt=1";
    jQuery(obj).attr('action',href);
    alert(href);
    return false;
    jQuery(obj).submit(function(){return false;});
}

jQuery(document).ready(function($){

    $('form').submit(function(e){

		if(/cart_add.php/.test($(this).attr('action'))){
			var data=$(this).serialize();
			var cat_no=$(this).find('input[type=checkbox]').is(":checked");
			var url='cart_add.php?action=api';
			if(cat_no){
				$.ajax({
					url:url,
					type:'GET',
					data:data,
					dataType:'json',
					success:function(msg){
						if(msg.status!='fail'){
                            $("#loginform").modal({
                                Top:150
                            });
                            /*var strHtml=msg.info;
                            strHtml+="Whether to enter the shopping cart.";
                            strHtml+='&nbsp;&nbsp;';
                            strHtml+="<a href='' class='btn btn-primary'>Yes</a>&nbsp;";
                            strHtml+='<a data-dismiss="modal" aria-hidden="true" class="btn btn-default">No</a>';
							$("#cart_tip").modal(
								$("#myModalLabel").text(msg.status),
								$("#cart_tip .modal-body").html(strHtml),
                                setTimeout(function(){$("#cart_tip").modal('hide')},3000)
							);*/
						}else{
							
							$("#cart_tip").modal(
							
								$("#myModalLabel").text(msg.status),
								$(".modal-body").text(msg.info)
							
							);
						}
					}	
				});
				return false;
			}else{
				console.log("Please select Product!");
			}
			return false;
		}
	});
	//关闭按钮
	$('.cart_display .btn-close').click(function(){
		$(this).parents('.cart_display').hide();
	});
	//设置居中显示
	/*var centerObj=function(e){
		var windowWidth = document.documentElement.clientWidth;  //alert(windowWidth);
		var windowHeight = document.documentElement.clientHeight;  
		var popupHeight = $(e).height();  
		var popupWidth = $(e).width();   
		$(e).css({  
			"position": "absolute",  
			"top": (windowHeight-popupHeight)/2+$(document).scrollTop(),  
			"left": (windowWidth-popupWidth)/2  
		});
		$('.cart_display').height($(document).height());
	}*/

});

