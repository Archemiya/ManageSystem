<?php
include "../link.php";
$sql ="UPDATE `topic` SET `topic_suggestion` = '{$_POST['topic_suggestion']}', `topic_ispass` = 2 WHERE `topic`.`id` = '{$_GET['id']}' ";
mysqli_query($link,$sql);
echo "<script>alert('提交修改意见成功！');history.go(-1)</script>";
?>