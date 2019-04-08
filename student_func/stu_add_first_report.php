<?php
include "../link.php";
session_start();
echo $user = $_SESSION['user_name'];
echo $id = $_SESSION['user_id'];
echo $teacher_id = $_POST['teacher_id'];
echo $teacher_name = $_POST['teacher_name'];
echo $topic_id = $_POST['topic_id'];
echo $topic_name = $_POST['topic_name'];
echo $topic_source = $_POST['topic_source'];
echo $topic_purpose = $_POST['topic_purpose'];
echo $topic_research_status = $_POST['topic_research_status'];
echo $topic_main = $_POST['topic_main'];
echo $topic_difficulty = $_POST['topic_difficulty'];
echo $topic_schedule = $_POST['topic_schedule'];
echo $topic_ref = $_POST['topic_ref'];

$sql = "INSERT INTO `first_report` (
`topic_id`, 
`topic_name`, 
`student_id`,
`student_name`,
`teacher_id`,
`teacher_name`, 
`topic_source`, 
`topic_purpose`, 
`topic_research_status`,
`topic_main`, 
`topic_difficulty`, 
`topic_schedule`,
`topic_ref`,
`first_report_annex_name`, 
`modify_suggestion`, 
`final_flag`
) 
VALUES (
'{$topic_id}', 
'{$topic_name}', 
'{$id}', 
'{$user}', 
'{$teacher_id}', 
'{$teacher_name}', 
'{$topic_source}', 
'{$topic_purpose}', 
'{$topic_research_status}', 
'{$topic_main}', 
'{$topic_difficulty}', 
'{$topic_schedule}', 
'{$topic_ref}',
'0', 
NULL, 
'0'
)";
mysqli_query($link,$sql);
echo "<script>alert('上传开题报告成功！'); history.go(-1);</script>";
mysqli_close($link);
?>
