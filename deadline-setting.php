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
    case "midterm":
    $sql = "UPDATE `stu_func_control` set `midterm_deadline` = '{$_POST['deadline']}' ";
    mysqli_query($link,$sql);
    echo "<script>alert('设置中期报告截止时间成功！');history.go(-1)</script>";
    break;
    case "first_paper":
    $theday = strtotime($_POST['deadline']);
    $thedayarray = getdate($theday);
    $delay_reply_deadline = date("Y-m-d", mktime(0,0,0,$thedayarray['mon'],$thedayarray['mday']+1,$thedayarray['year']));
    $sql = "UPDATE `stu_func_control` set `first_paper_deadline` = '{$_POST['deadline']}',`delay_reply_deadline` = '{$delay_reply_deadline}' ";
    mysqli_query($link,$sql);
    echo "<script>alert('设置论文初稿截止时间成功！');history.go(-1)</script>";
    break;
}
?>