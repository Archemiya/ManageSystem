<?php
include "../link.php";
$id = $_POST['id'];
$sql = "SELECT * FROM `user` WHERE `id` = '{$id}'";
$sql_isgroup = "SELECT * FROM `reply_schedule` WHERE `id` ='{$id}'";
$result = mysqli_query($link,$sql);
$result_isgroup = mysqli_query($link,$sql_isgroup);
$row = mysqli_fetch_array($result);
$num_isgroup = mysqli_fetch_array($result_isgroup);
if(!$row['name']){
    echo "查无此人";
}elseif($num_isgroup){
    echo "已分配小组";
}else{
    echo $row['name'];
}
mysqli_close($link);
?>