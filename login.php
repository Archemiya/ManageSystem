<?php
session_start();
$user = $_POST['account'];
$psw = md5($_POST['passwd']);

if (!isset($user) || !isset($psw)) {
    echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
} else {
    include "link.php";
    $sql = "SELECT * FROM `user` WHERE `id` = \"{$user}\" AND `password` = \"{$psw}\" ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    if ($user == $row['id'] && $psw == $row['password']) {
        $_SESSION['user_permission'] = $row['permission'];
        $_SESSION['user_special'] = $row['special'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        switch ($row["permission"]) {
            case "student":
                header("Location: student_func/student.php");
                break;
            case "tutor":
                header("Location: tutor_func/tutor.php");
                break;
            case "secretary":
                header("Location: secretary_func/secretary.php");
                break;
            case "supermanager":
                header("Location: ./supermanager.php");
                break;
        }
    } else {
        echo "<script>alert('用户名或密码错误！请重新输入'); history.go(-1);</script>";
    }
    mysqli_close($link);
}
