# 日常问题 #
该笔记为 jQuery 中日常的一些问题汇总。

## modal() 冲突 ##
modal（模态框方法冲突）

	// 重新定义 modal() 方法，解决 jquery.simplemodal 中的modal方法和bootstrap的modal方法冲突
	$.fn.modal.Constructor.prototype.enforceFocus = function () {     
		modal_this = this ;             
		$(document).on('focusin.modal', function (e) {  
			if (modal_this.$element[0] !== e.target && !modal_this.$element.has(e.target).length && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') && !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) { 
				modal_this.$element.focus();                 
			} 
		});
	};

