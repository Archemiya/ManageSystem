<?php
include "../link.php";
$get = $_GET['func'];
switch ($get) {
    case "topic":
        $sql = "UPDATE `stu_func_control` SET `topic` = 1 WHERE `id` = 1";
        mysqli_query($link, $sql);
        echo "<script>alert('开启学生选题流程成功！');history.go(-1);</script>";
        break;
    case "first_report":
        $sql = "UPDATE `stu_func_control` SET `first_report` = 1 WHERE `id` = 1";
        mysqli_query($link, $sql);
        echo "<script>alert('开启学生开题流程成功！');history.go(-1);</script>";
        break;
    case "first_paper":
        $sql = "UPDATE `stu_func_control` SET `first_paper` = 1 WHERE `id` = 1";
        mysqli_query($link, $sql);
        echo "<script>alert('开启学生论文初稿流程成功！');history.go(-1);</script>";
        break;
    case "first_reply":
        $sql = "UPDATE `stu_func_control` SET `first_reply` = 1 WHERE `id` = 1";
        mysqli_query($link, $sql);
        echo "<script>alert('开启学生一次答辩流程成功！');history.go(-1);</script>";
        break;
    
}
