<?php
include "link.php";
if(isset($_GET['func'])){
    $get=$_GET['func'];
}else{
    echo "请求失败";
}
switch ($get){
    case "first_report":
    $sql = "UPDATE `t_func_control` set `first_report_deadline` = '{$_POST['deadline']}' ";
    mysqli_query($link,$sql);
    echo "<script>alert('设置开题报告截止时间成功！');history.go(-1)</script>";
    break;
    case "first_paper":
    $sql = "UPDATE `stu_func_control` set `first_paper_deadline` = '{$_POST['deadline']}' ";
    mysqli_query($link,$sql);
    echo "<script>alert('设置论文初稿截止时间成功！');history.go(-1)</script>";
    break;
}
?>