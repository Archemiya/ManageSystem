<?php
//此页面为答辩秘书的审核请求处理页面

include "../link.php";

//使用second_reply来表示状态，0表示一辩 1表示二辩 -1表示延期毕业
if (isset($_GET['func'])) {
    switch ($_GET['func']) {
        case "agree":
            $sql = "UPDATE `reply_schedule` set `reply_delay` = 1 where `id` = '{$_GET['id']}'";
            $sql2 = "UPDATE `reply_schedule` set `second_reply` = 1 where `id` = '{$_GET['id']}'";
            mysqli_query($link, $sql);
            mysqli_query($link, $sql2);
            echo "<script>alert('审核成功！');history.go(-1)</script>";
            break;
        case "refuse":
            $sql = "UPDATE `reply_schedule` set `reply_delay` = -1 where `id` = '{$_GET['id']}'";
            $sql2 = "UPDATE `reply_schedule` set `second_reply` = -1 where `id` = '{$_GET['id']}'";
            mysqli_query($link, $sql);
            mysqli_query($link, $sql2);
            echo "<script>alert('审核成功！');history.go(-1)</script>";
            break;
    }
}
