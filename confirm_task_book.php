<?php
session_start();
$link = mysqli_connect("localhost", "root", "123456", "manasystem");
$sql = "UPDATE `task_book` SET `islook_flag` = '1' WHERE `student_id` = '{$_SESSION['user_id']}' ";
mysqli_query($link,$sql);
echo "<script>alert('确认成功！点击确定返回上一页');history.go(-1);</script>";
?>