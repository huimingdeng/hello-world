<?php
$a = 1;
xdebug_debug_zval('a');
echo PHP_EOL;
$b = $a;
xdebug_debug_zval('a');
echo PHP_EOL;
 
$c = &$a;
xdebug_debug_zval('a');
echo PHP_EOL;
 
xdebug_debug_zval('b');
echo PHP_EOL;
