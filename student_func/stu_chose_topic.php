<?php
session_start();
include "../link.php";
if (isset($_GET["func"])) {
    $get = $_GET["func"];
}
$sql = "SELECT * FROM `topic` WHERE  `topic`.`id` = '{$get}'";
$sql_chose = "SELECT * FROM `chose_topic` WHERE  `chose_topic`.`topic_chose_id` = '{$get}'";
$result = mysqli_query($link,$sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
$sql_chose_record = "INSERT INTO `chose_topic_record` (`recode_id`, `topic_id`, `topic_name`, `teacher_id`, `teacher_name`, `student_id`, `student_name`, `final_flag`) VALUES (NULL, '{$get}', '{$row['name']}', '{$row['teacher_id']}', '{$row['teacher_name']}', '{$_SESSION['user_id']}', '{$_SESSION['user_name']}', '0')";
mysqli_query($link, $sql_chose_record);
echo "<script>alert('恭喜选题成功，请耐心等待老师审核！点击确定返回上一页');history.go(-1);</script>";
?>