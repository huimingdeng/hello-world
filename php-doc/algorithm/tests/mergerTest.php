<?php 
require __DIR__.'/../src/merger.php';

use algorithm\merger;

$startTime = microtime(1);

$arr = range(10, 20);
shuffle($arr);

$merger = new merger();

echo "before sort: ", implode(', ', $arr), "\n";
// $sortArr = $merger->run();
// echo "after sort: ", implode(', ', $sortArr), "\n";

// echo "use time: ", microtime(1) - $startTime, "s\n";


echo "after sort ", implode(', ', $merger->set($arr)->run()), "\n";