<?php
include "../link.php";
$id = $_POST['id'];
$sql = "SELECT * FROM `user` WHERE `id` = '{$id}'";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_array($result);
if(!$row['name']){
    echo "查无此人";
}else{
    echo $row['name'];
}
mysqli_close($link);
?>