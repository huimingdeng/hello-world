<?php 
$f = fopen("hello.sh", "w");
fwrite($f, "echo \"hello world!\"");
fclose($f);
exec("chmod 777 hello.sh");
sleep(3);
#exec(" hello.sh");
passthru("sh hello.sh");
