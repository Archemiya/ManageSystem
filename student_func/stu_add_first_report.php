<?php
include "../link.php";
session_start();
$user = $_SESSION['user_name'];
$id = $_SESSION['user_id'];
$teacher_id = $_POST['teacher_id'];
$teacher_name = $_POST['teacher_name'];
$topic_id = $_POST['topic_id'];
$topic_name = $_POST['topic_name'];
$topic_source = $_POST['topic_source'];
$topic_purpose = $_POST['topic_purpose'];
$topic_research_status = $_POST['topic_research_status'];
$topic_main = $_POST['topic_main'];
$topic_difficulty = $_POST['topic_difficulty'];
$topic_schedule = $_POST['topic_schedule'];
$topic_ref = $_POST['topic_ref'];
if ($_GET['index'] == 'final') {
    $sql = "INSERT INTO `first_report_record` (
        `record_id`,
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
        NULL,
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
        '4'
    )";
} else {
    $sql = "INSERT INTO `first_report_record` (
        `record_id`,
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
        NULL,
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
}
if ($result = mysqli_query($link, $sql, MYSQLI_USE_RESULT)) {

    /* Note, that we can't execute any functions which interact with the
       server until result set was closed. All calls will return an
       'out of sync' error */
    if (!mysqli_query($link, "SET @a:='this will not work'")) {
        printf("Error: %s\n", mysqli_error($link));
    }
}
echo "<script>alert('上传开题报告成功！'); history.go(-1);</script>";
mysqli_close($link);
