<?php
include "../link.php";
// include "../secretary_func/sec_query_t_control.php";
session_start();
$user = $_SESSION['user_name'];
$id = $_SESSION['user_id'];
$teacher_id = $_POST['teacher_id'];
$teacher_name = $_POST['teacher_name'];
$topic_id = $_POST['topic_id'];
$topic_name = $_POST['topic_name'];
$paper_main = $_POST['paper_main'];
// if (isset($_GET['index']) && $_GET['index'] == 'final') {
$sql = "INSERT INTO `first_paper_record` (
    `record_id`,
    `topic_id`, 
    `topic_name`, 
    `student_id`,
    `student_name`,
    `teacher_id`,
    `teacher_name`, 
    `paper_main`, 
    `first_paper_annex_name`, 
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
    '{$paper_main}', 
    '0', 
    NULL, 
    '0'
)";

if ($result = mysqli_query($link, $sql, MYSQLI_USE_RESULT)) {

    /* Note, that we can't execute any functions which interact with the
       server until result set was closed. All calls will return an
       'out of sync' error */
    if (!mysqli_query($link, "SET @a:='this will not work'")) {
        printf("Error: %s\n", mysqli_error($link));
    }
}
echo "<script>alert('上传论文初稿成功！'); history.go(-1);</script>";
mysqli_close($link);
