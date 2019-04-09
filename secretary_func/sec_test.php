<?php
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');
header('Content-type:text/json');     
echo "今天是".$_POST['num']."天";
echo "<br>";
echo $today;
?>