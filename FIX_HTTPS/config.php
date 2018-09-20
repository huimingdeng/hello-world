<?php 
return array(
	'IS_TEST' => TRUE,//是否测试，TRUE:测试则不修改原文件，生成新文件 *_new.php
	'ALLOWEDEXT' => array(//允许执行 替换 http 的类型文件
		'php',
		'html'
	),
	'DISALLOWEDFILES' => array(//不允许执行的文件
		'config.php'
	),
	'DISALLOWEDFLOOR' => array(//不允许执行的目录
		'test3'
	),
);