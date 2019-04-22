<?php
include "../link.php";
include "../secretary_func/sec_query_stu_control.php";

/*查询此学生是否具有申请延期答辩资格:
    无需完成论文初稿！
*/
$sql_ispass = "SELECT * from `first_paper_record` where `student_id` = '{$_SESSION['user_id']}' AND `final_flag` = 1 ";
$result_ispass = mysqli_query($link, $sql_ispass);
$num_ispass = mysqli_num_rows($result_ispass);

$sql_delay_1 = "SELECT * from `reply_schedule` where `id` = '{$_SESSION['user_id']}' AND `reply_delay` = 1 "; //为0表示未申请延期 为1表示申请成功 为2表示申请未通过
$result_delay_1 = mysqli_query($link, $sql_delay_1);
$num_delay_1 = mysqli_num_rows($result_delay_1);
?>

<body>

    <?php
    if (!$num_ispass) {
        echo <<< archemiya
        <br/>
        <div class='alert alert-danger' role='alert'>
            当前尚未提交论文初稿，请在
            <strong>{$row_control['first_paper_deadline']}</strong>
            前完成
        </div>
archemiya;
    } elseif ($num_delay_1) {
        echo <<< archemiya
        <br/>
        <div class='alert alert-danger' role='alert'>
            您已申请延期答辩，请等待重新分组
        </div>
archemiya;
    } 
    ?>
</body>