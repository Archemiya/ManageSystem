<?php
session_start();
include "link.php";
date_default_timezone_set('Asia/Shanghai');
$topic_main = $_POST['topic_main'];
$topic_schedule = $_POST['topic_schedule'];
$topic_ref = $_POST['topic_ref'];
$topic_machine = $_POST['topic_machine'];
$topic_space = $_POST['topic_space'];
$topic_timetable = $_POST['topic_timetable'];
$today = date('Y-m-d');


$sql = "INSERT INTO `task_book` 
(`id`,
 `teacher_id`, 
 `teacher_name`, 
 `student_id`,
 `student_name`,
 `topic_id`, 
 `topic_name`, 
 `topic_main`,
 `topic_schedule`,
 `topic_ref`,
 `topic_machine`,
 `topic_space`,
 `topic_timetable`,
 `create_time_stamp`) 
 VALUES 
 (NULL, 
 '{$_SESSION['user_id']}',
 '{$_SESSION['user_name']}',
 '{$_POST['student_id']}',
 '{$_POST['student_name']}',
 '{$_POST['topic_id']}',
 '{$_POST['topic_name']}',
 '{$topic_main}', 
 '{$topic_schedule}', 
 '{$topic_ref}', 
 '{$topic_machine}', 
 '{$topic_space}',
 '{$topic_timetable}', 
 '{$today}')";
 mysqli_query($link,$sql);
 echo "<script>alert('下达任务书成功！');history.go(-1)</script>";
?>