<?php
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
include "../link.php";
$sql = "UPDATE `topic` SET 
`name`='{$topic_name}', 
`topic_type`='{$topic_type}', 
`topic_nature`='{$topic_nature}', 
`topic_source`='{$topic_source}', 
`topic_workload`='{$topic_workload}', 
`topic_difficulty`='{$topic_ease}', 
`introduction`='{$topic_intro}', 
`topic_request`='{$topic_request}', 
`topic_reference`='{$topic_ref}', 
`topic_otherteacher`='{$topic_other}', 
`topic_chosemode`='{$topic_chosemode}', 
`topic_application`='{$topic_app}', 
`topic_ispass`='3' 
WHERE 
`id` = '{$_GET['id']}'";
 
 
 

mysqli_query($link,$sql);
echo "<script>alert('课题修改成功！'); history.go(-1);</script>";
mysqli_close($link);
?>
