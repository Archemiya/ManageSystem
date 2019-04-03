<?php
$link = mysqli_connect("localhost", "root", "123456", "manasystem");
$sql_chose_record= "UPDATE `chose_topic_record` SET `final_flag` = '1' WHERE `topic_id`='{$_GET['topic']}' AND `student_id` = '{$_GET['id']}'";
mysqli_query($link, $sql_chose_record);
echo "<script>alert(\"操作成功！\");history.go(-1)</script>";
?>