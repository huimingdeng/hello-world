jQuery(document).ready(function(B){B("form").submit(function(){var E=B(this).serialize();var C=B(this).find("input[type=checkbox]").is(":checked");var D="/phpStudy/cart_add.php?action=api";if(C){B.ajax({url:D,type:"GET",data:E,dataType:"json",success:function(F){if(F.status!="fail"){B(".cart_display .tip_title").text(F.status);B(".cart_display .cart_tip div.tip_cont").text(F.info);B(".cart_display").show();A(B(".cart_tip"))}else{B(".cart_display .tip_title").text(F.status);B(".cart_display .cart_tip div.tip_cont").text(F.info);B(".cart_display").show()}}});return false}else{console.log("Please select Product!")}return false});B(".cart_display .btn-close").click(function(){B(this).parents(".cart_display").hide()});var A=function(C){var D=B("body").height();var F=B(window).height();var E=B(C).height();B(C).css("top",(F-E)/2)}});