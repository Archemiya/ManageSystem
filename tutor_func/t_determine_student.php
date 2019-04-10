<?php
include "../link.php";
$sql_user = "SELECT * FROM `user` WHERE `id` = '{$_GET['id']}' ";
$result_user = mysqli_query($link,$sql_user);
$row_user = mysqli_fetch_array($result_user,MYSQLI_BOTH);
$sql_chose_record= "UPDATE `chose_topic_record` SET `final_flag` = '1' WHERE `topic_id`='{$_GET['topic']}' AND `student_id` = '{$_GET['id']}'";
$sql_topic = "UPDATE `topic` SET `student_id` = '{$_GET['id']}',`student_name` = '{$row_user['name']}' WHERE `id`='{$_GET['topic']}'";
mysqli_query($link, $sql_chose_record);
mysqli_query($link, $sql_topic);
mysqli_close($link);
echo "<script>alert(\"操作成功！\");history.go(-1)</script>";
