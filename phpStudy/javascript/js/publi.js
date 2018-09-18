//初始版本&version=1.0
window.onload = function(){
	createDiv();
};

//创建div对象
var createDiv = function(){
	var div = document.createElement('div');
	div.setAttribute('class','btn');
	div.innerHTML = "返回顶部";
	document.getElementsByTagName('footer').appendChild=div;
};
