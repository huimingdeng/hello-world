<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document -- error --意义不大</title>
	<link rel="stylesheet" type="text/css" href="../jQuery/css/bootstrap.css">
	<script type="text/javascript" src="../jQuery/js/jquery.js"></script>
</head>
<body>
	<div class="container">
		<header><h1>Form 表单封装</h1></header>
		<form id="tempForm">
			<div class="row">
				<label>系统编码:</label> 
				<input type="text" name="invSys">
			</div>
			<div class="row">
				<label>系统名称:</label> 
				<input type="text" name="sysName">
			</div>
			<div class="row">
				<label>系统类型:</label> 
				<input type="text" name="sysType">
			</div>
			<div class="row">
				<label>状 态:</label> <select name="state">
					<option value="1">有效</option>
					<option value="0">无效</option>
				</select>
			</div>
			<div class="row">
				<label>定义人员:</label> 
				<input type="text" name="confStaff">
			</div>
			<div class="row">
				<label>操作时间:</label> 
				<input type="text" name="confDate">
			</div>
			<div class="row">
				<input value="保存" type="button" onclick="update();">
			</div>
		</form>
	</div>
	<script type="text/javascript">
		function serializeForm(a) {// 参数为form标签  
		    var resultJson = {};// 要传递给后台的对象数据  
		    var array = a.serializeArray();// 序列化表单内容  
		    $(array).each(function() {  
		        resultJson[this.name] = this.value.trim();  
		    });  
		    return resultJson;
		}
		function update(){
			var form = $("#tempForm");
			var res=serializeForm(form);
			// var res=form.serialize();
			$.ajax({
				type:"post",
				url:"ajax/jsform.php?api=ajax",
				data:res,
				success:function(res){
					console.log(res);
				}
			});

		}
	</script>
</body>
</html>