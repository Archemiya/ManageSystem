<?php
session_start();
$user = $_SESSION['user_name'];
$id = $_SESSION['user_id'];
$topic_name = $_POST['topic_name'];
$topic_type = $_POST['topic_type'];
$topic_nature = $_POST['topic_nature'];
$topic_source = $_POST['topic_source'];
$topic_ease = $_POST['topic_ease'];
$topic_intro = $_POST['topic_intro'];
$topic_request = $_POST['topic_request'];
$topic_ref = $_POST['topic_ref'];
$topic_other = $_POST['topic_other'];
$topic_chosemode = $_POST['topic_chosemode'];
$topic_app = $_POST['topic_app'];
$topic_workload = $_POST['topic_workload'];
include "link.php";
$sql = "INSERT INTO `topic` (`id`, 
`name`, 
`topic_type`, 
`topic_nature`, 
`topic_source`, 
`topic_workload`, 
`topic_difficulty`, 
`teacher_name`, 
`teacher_id`, 
`student_name`, 
`student_id`, 
`create_time`, 
`introduction`, 
`topic_request`, 
`topic_reference`, 
`topic_otherteacher`, 
`topic_chosemode`, 
`topic_application`, 
`topic_chosen`) 
VALUES (NULL, 
'{$topic_name}', 
'{$topic_type}', 
'{$topic_nature}', 
'{$topic_source}', 
'{$topic_workload}', 
'{$topic_ease}', 
'{$user}', 
'{$id}', 
NULL, 
NULL, 
NULL, 
'{$topic_intro}', 
'{$topic_request}', 
'{$topic_ref}', 
'{$topic_other}', 
'{$topic_chosemode}', 
'{$topic_app}', 
'0')";
mysqli_query($link,$sql);
echo "<script>alert('课题创建成功！'); history.go(-1);</script>";
mysqli_close($link);
?>
