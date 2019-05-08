<?php
$sql_control = "SELECT * FROM `t_func_control`" ;
$result_control = mysqli_query($link,$sql_control);
$row_control = mysqli_fetch_array($result_control,MYSQLI_BOTH);
?>