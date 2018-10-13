<?php 
return array(
	'IS_TEST' => false,//是否测试，TRUE:测试则不修改原文件，生成新文件 *_new.php
	'IS_BACK' => FALSE,//true：在 IS_TEST=false的情况，修改原文件并生成备份修改前的文件
	'ALLOWEDEXT' => array(//允许执行 替换 http 的类型文件
		'php',
		'html'
	),
	'DISALLOWEDFILES' => array(//不允许执行的文件
		'config.php'
	),
	'DISALLOWEDFLOOR' => array(//不允许执行的目录
		// 'test3'
	),
	'ALLOWEDFLOOR' => array(//运行执行的目录和子目录
		'test2',
		'test'
	),
);