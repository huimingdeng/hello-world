<?php //获取当前文件下所有的文件
function navbar($name){
	require_once("../un.php");
 	$dir=dirname(__FILE__);
	$file_arr=scandir($dir,0);//scandir函数，获取目录
	if(!empty($file_arr)){
	 	$nav_list=array();
	 	foreach ($file_arr as $k => $v) {
	 		if(is_file($dir.'/'.$v)&&!in_array($v,$not_show_display)) $nav_list[]=$v;
	 	}
	}
	if(!empty($nav_list)){
 	//$dir=basename($dir);//获取父目录名称，用于组装url
 	//$name=basename(__FILE__);
?>
<nav class="navbar nav-justified custom_style_nav">
	<ul class="nav nav-pills">
	<?php foreach ($nav_list as $k => $v) {
		if($name==$v){?>
		<li role="presentation" class="active disabled"><a href="javascript:void(0);"><?php echo preg_replace('/\.[a-z]+/','',$v);?></a></li>
	<?php }else{?>
		<li role="presentation"><a href="<?php echo $v;?>"><?php echo preg_replace('/\.[a-z]+/', '', $v);?></a></li>
	<?php }
	}?>
	</ul>
</nav>
<?php }
}?>