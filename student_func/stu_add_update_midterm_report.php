<?php
include "../link.php";
session_start();
if (isset($_GET['func']) && $_GET['func'] == 'update') {
    $current_status = $_POST['current_status'];
    $need_to_complete = $_POST['need_to_complete'];
    $current_problems_and_solutions = $_POST['current_problems_and_solutions'];
    $postwork_schedule = $_POST['postwork_schedule'];
    $sql = "UPDATE `midterm_report` set 
        `current_status` = '{$current_status}', 
        `need_to_complete` = '{$need_to_complete}', 
        `current_problems_and_solutions` = '{$current_problems_and_solutions}',
        `postwork_schedule` = '{$postwork_schedule}', 
        `instructions` = NULL,
        `midterm_report_annex_name` = NULL,
        `annex_flag` = 0,
        `final_flag` = 0
        where
        `student_id` = '{$_SESSION['user_id']}'
    ";

 } else {
    $user = $_SESSION['user_name'];
    $id = $_SESSION['user_id'];
    $teacher_id = $_POST['teacher_id'];
    $teacher_name = $_POST['teacher_name'];
    $topic_id = $_POST['topic_id'];
    $topic_name = $_POST['topic_name'];
    $current_status = $_POST['current_status'];
    $need_to_complete = $_POST['need_to_complete'];
    $current_problems_and_solutions = $_POST['current_problems_and_solutions'];
    $postwork_schedule = $_POST['postwork_schedule'];
    $sql = "INSERT INTO `midterm_report` (
        `topic_id`, 
        `topic_name`, 
        `student_id`,
        `student_name`,
        `teacher_id`,
        `teacher_name`, 
        `current_status`, 
        `need_to_complete`, 
        `current_problems_and_solutions`,
        `postwork_schedule`, 
        `instructions`,
        `midterm_report_annex_name`, 
        `annex_flag`, 
        `final_flag`
        ) 
        VALUES (
        '{$topic_id}', 
        '{$topic_name}', 
        '{$id}', 
        '{$user}', 
        '{$teacher_id}', 
        '{$teacher_name}', 
        '{$current_status}', 
        '{$need_to_complete}', 
        '{$current_problems_and_solutions}', 
        '{$postwork_schedule}', 
        NULL,
        NULL,
        '0', 
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
