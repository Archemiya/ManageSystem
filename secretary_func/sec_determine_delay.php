<?php
//此页面为答辩秘书的审核请求处理页面
include "../link.php";

if (isset($_GET['func'])) {
    switch ($_GET['func']) {
        case "agree":
            $sql = "UPDATE `reply_schedule` set `reply_delay` = 1 where `id` = '{$_GET['id']}'";
            mysqli_query($link, $sql);
            echo "<script>alert('审核成功！');history.go(-1)</script>";
        break;
        case "refuse":
            $sql = "UPDATE `reply_schedule` set `reply_delay` = -1 where `id` = '{$_GET['id']}'";
            mysqli_query($link, $sql);
            echo "<script>alert('审核成功！');history.go(-1)</script>";
        break;
    }
}
