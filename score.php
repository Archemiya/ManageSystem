<?php
include "link.php";
if(isset($_GET['func'])){
    $get = $_GET['func'];
}
switch ($get){
    case "first_report":
    $sql = "INSERT INTO `student_grade` 
    (`id`,`topic_id`, `student_id`, `student_name`, `first_report_grade`, `fp_grade_description`,`student_grade`) 
    VALUES (NULL,'{$_POST['topic_id']}' ,'{$_POST['student_id']}', '{$_POST['student_name']}', '{$_POST['first_report_grade']}', '{$_POST['grade_description']}' ,NULL)";
    $sql_final = "UPDATE `first_report_record` set `final_flag` = 1 where `student_id` = '{$_POST['student_id']}' and `final_flag` = 4";
    mysqli_query($link,$sql);
    mysqli_query($link,$sql_final);
    echo "<script>alert('评分成功！');history.go(-1)</script>";
}
?>