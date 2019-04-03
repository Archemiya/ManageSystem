<?php
session_start();
$user = $_POST['account'];
$psw = $_POST['passwd'];
if (!isset($user) || !isset($psw)) {
    echo "<script>alert('请输入用户名或密码！'); history.go(-1);</script>";
} else {
    $link = mysqli_connect("localhost", "root", "123456", "manasystem");
    $sql = "SELECT * FROM `user` WHERE `id` = \"{$user}\" AND `password` = \"{$psw}\" ";
    $result = mysqli_query($link, $sql);
    if ($result && mysqli_num_rows($result)) {
        $row = mysqli_fetch_array($result, MYSQLI_BOTH);
        $_SESSION['user_permission'] = $row['permission'];
        $_SESSION['user_special']= $_row['special'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['name'];
        switch ($row["permission"]) {
            case "student":
                header("Location: ./student.php");
                break;
            case "tutor":
                header("Location: ./tutor.php");
                break;
            case "secretary":
                header("Location: ./secretary.php");
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
?>
