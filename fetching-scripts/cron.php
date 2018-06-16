<?php

$path = dirname(__FILE__);
$cron = $path . "/index.php";
echo exec("* * * * * php -q ".$cron." &> /dev/null");

?>