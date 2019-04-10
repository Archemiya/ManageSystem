<?php
include "../link.php";
$teacher_num = 0;
$teacher_id_index = "t_" . $teacher_num . "_id";
$teacher_name_index = "t_" . $teacher_num . "_name";
for ($i = 1;; $i++) {
    if ($i == 1) {
        if (!isset($_POST["t_tleader_id"])) {
            $teacher_num = 0;
            break;
        }
    } elseif (!isset($_POST["t_" . $i . "_id"])) {
        $teacher_num = $i - 1;
        break;
    }
}
$student_num = 0;
$student_id_index = "stu_" . $student_num . "_id";
$student_name_index = "stu_" . $student_num . "_name";
for ($i = 1;; $i++) {
    if (!isset($_POST["stu_" . $i . "_id"])) {
        $student_num = $i - 1;
        break;
    }
}
$sql = "SELECT * FROM `reply_schedule` WHERE `group_id` = '{$_POST['group_id']}'";
$result = mysqli_query($link, $sql);
$num = mysqli_fetch_array($result);
if (!$num) {
    for ($i = 1; $i <= ($teacher_num); $i++) {
        if ($i == 1) {
            $sql = "INSERT INTO `reply_schedule` (`id`,`name`,`major`,`group_id`,`special`) 
        VALUE (
        '{$_POST["t_tleader_id"]}',
        '{$_POST["t_tleader_name"]}',
        '计算机专业',
        '{$_POST['group_id']}',
        NULL
        )";
        } else {
            $sql = "INSERT INTO `reply_schedule` (`id`,`name`,`major`,`group_id`,`special`) 
        VALUE (
        '{$_POST["t_" . $i . "_id"]}',
        '{$_POST["t_" . $i . "_name"]}',
        '计算机专业',
        '{$_POST['group_id']}',
        NULL
        )";
        }
        mysqli_query($link, $sql);
    }
    for ($i = 1; $i <= ($student_num); $i++) {
        $sql = "INSERT INTO `reply_schedule` (`id`,`name`,`major`,`group_id`,`special`) 
        VALUE (
        '{$_POST["stu_" . $i . "_id"]}',
        '{$_POST["stu_" . $i . "_name"]}',
        '计算机专业',
        '{$_POST['group_id']}',
        NULL
        )";
        mysqli_query($link, $sql);
    }
}
