<?php
include "../link.php";
$get = $_GET['func'];
switch ($get) {
    case "topic":
        $sql_topic = "UPDATE `stu_func_control` SET `topic` = 1 WHERE `id` = 1";
        mysqli_query($link, $sql_topic);
        echo "<script>alert('开启学生选题流程成功！');history.go(-1);</script>";
        break;
    case "first_report":
        $sql_first_report = "UPDATE `stu_func_control` SET `first_report` = 1 WHERE `id` = 1";
        mysqli_query($link, $sql_first_report);
        echo "<script>alert('开启学生开题流程成功！');history.go(-1);</script>";
        break;
}
