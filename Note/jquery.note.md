# 日常问题 #
该笔记为 jQuery 中日常的一些问题汇总。

## modal() 冲突 ##
modal（模态框方法冲突）：参考了bootstrap的模态弹窗 和CKEditor的模态弹窗冲突问题；也就是添加了判断条件，如代码所示：判断 CKEditor 是否有类 `cke_dialog_ui_input_text`; jquery.simplemodal.js 的modal 方法冲突也可以参考解决，避免使用 bootstrap 的 modal() 导致其他弹窗出现。

	// 重新定义 modal() 方法，解决 jquery.simplemodal 中的modal方法和bootstrap的modal方法冲突
	$.fn.modal.Constructor.prototype.enforceFocus = function () {     
		modal_this = this ;             
		$(document).on('focusin.modal', function (e) {  
			if (modal_this.$element[0] !== e.target 
			&& !modal_this.$element.has(e.target).length && 
			!$(e.target.parentNode).hasClass('cke_dialog_ui_input_select') 
			&& !$(e.target.parentNode).hasClass('cke_dialog_ui_input_text')) { 
				modal_this.$element.focus();                 
			} 
		});
	};
P.S. 目前问题是自动加载的弹窗无法出现，点击事件的弹窗还可以使用。


