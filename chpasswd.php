<?php
session_start();
$user_id = $_POST['account'];
$user_oldpasswd = $_POST['oldpasswd'];
$user_newpasswd = $_POST['newpasswd'];
$user_newpasswd2 = $_POST['newpasswd2'];
include "link.php";
$sql = "SELECT * FROM `user` WHERE `id` = \"{$user_id}\" AND `password` = \"{$user_oldpasswd}\" ";
$result = mysqli_query($link, $sql);
if($user_oldpasswd == $user_newpasswd){
    echo "<script>alert('新密码与原密码一致！请重新输入'); history.go(-1);</script>";
}else if($user_newpasswd != $user_newpasswd2){
    echo "<script>alert('两次输入的密码不一致！请重新输入'); history.go(-1);</script>";
}else if ($result && mysqli_num_rows($result)) {
    $sql_chpasswd = "UPDATE `user` SET `password` = '{$user_newpasswd}' WHERE `user`.`id` = '{$user_id}'";
    mysqli_query($link,$sql_chpasswd);
    echo "<script>alert('密码修改成功！'); window.location.href=\"logout.php\";</script>";
} else {
    echo "<script>alert('用户名或原密码错误！请重新输入'); history.go(-1);</script>";
}
?>

