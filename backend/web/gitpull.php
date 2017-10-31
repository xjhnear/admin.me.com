<?php 
ini_set('display_errors',1);
$op = exec("git pull", $out);
var_dump($out);
echo($op);
?>
