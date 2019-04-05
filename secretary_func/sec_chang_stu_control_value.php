<?php
include "../link.php";
$get = $_GET['func'];
switch ($get) {
    case "topic":
        $sql = "UPDATE `stu_func_control` SET `topic` = 1 WHERE `id` = 1";
        mysqli_query($link, $sql);
        echo "<script>alert('开启学生选题流程成功！');history.go(-1);</script>";
        break;
    
}
