<?php
include "../link.php";
$sql = "SELECT * FROM `topic` WHERE `topic`.`teacher_id` = '{$_SESSION['user_id']}'"; //判断当前老师的课题数
$sql_islook_task = "SELECT * FROM `task_book` WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `islook_flag` = 1"; //用于判断当前是否有学生查看任务书
$result = mysqli_query($link, $sql);
$result_islook_task = mysqli_query($link, $sql_islook_task);
$num_islool_task = mysqli_num_rows($result_islook_task);

function table_first_report_echo($result, $link)
{
    $height = mysqli_num_rows($result);
    for ($i = 0; $i < $height; $i++) { //根据该老师的课题数进行循环输出
        $row = mysqli_fetch_array($result, MYSQLI_BOTH); //依次查询每个课题的详细信息
        echo <<< Archemiya
        <tr>
        <td class="td-height"> {$row['name']}</td>
        <td class="td-height td-title-center"> 
        <a href="./tutor.php?func=topic&id={$row['id']}" class="btn btn-primary" role="button">查看课题详情</a>
        </td>
Archemiya;
        $sql_chose_final_flag = "SELECT * FROM `chose_topic_record` 
        WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `topic_id` = '{$row['id']}' AND `final_flag` = 1"; //查询当前课题所选的学生信息
        $result_chose_final_flag = mysqli_query($link, $sql_chose_final_flag);
        $row_chose_final_flag = mysqli_fetch_array($result_chose_final_flag, MYSQLI_BOTH);
        $sql_first_report = "SELECT * FROM `first_report` WHERE `topic_id` = '{$row['id']}'"; //查询当前课题学生提交的开题报告信息
        $result_first_report = mysqli_query($link, $sql_first_report);
        $row_first_report = mysqli_fetch_array($result_first_report, MYSQLI_BOTH);
        $num_first_report = mysqli_num_rows($result_first_report);
        echo <<< Archemiya
            <td class="td-height td-title-center alert alert-info" role="alert">
                {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
            </td>
            <td class="td-height td-title-center">     
Archemiya;
        echo "<a href='../uploaded_file/{$row_first_report['first_report_annex_name']}' class='btn btn-default' role='button'>下载附件</a>";
        echo "</td>";
    }
    echo "</tr>";
}
?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <?php
    if ($num_islool_task == 0) {
        echo "<br/>";
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
        echo "<strong>尚无学生确认任务书！</strong>";
        echo "</div>";
    } else {
        echo <<< archemiya
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar" data-pagination="true" data-page-list="[10, 25, 50, 100, 200, All]" >
            <thead>
                <tr>
                    <th class="col-md-6 th-title-topic-chs">课题名称</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">查看课题</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">指导学生</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作</th>
                </tr>
            </thead>
            <tbody>
archemiya;
        table_first_report_echo($result, $link);
        echo <<< archemiya
            </tbody>
        </table>
    </div>
archemiya;
    }
    ?>

</body>

</html>