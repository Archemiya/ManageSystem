<?php
include "../link.php";
include "../secretary_func/sec_query_t_control.php";

$sql_stu_control = "SELECT * from `stu_func_control` where `id` = 1";
$result_stu_control = mysqli_query($link, $sql_stu_control);
$row_stu_control = mysqli_fetch_array($result_stu_control,MYSQLI_BOTH);

//当前服务器时间
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');

//判断当前老师的课题数
$sql = "SELECT * FROM `topic` WHERE `topic`.`teacher_id` = '{$_SESSION['user_id']}'";
$result = mysqli_query($link, $sql);

//用于判断当前是否有学生提交中期报告
$sql_midterm = "SELECT * FROM `midterm_report` WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `final_flag` = 1";
$result_midterm = mysqli_query($link, $sql_midterm);
$num_midterm = mysqli_num_rows($result_midterm);

//此函数用于输出导师所带的所有学生信息
function table_final_paper_echo($result, $link, $row_stu_control,$today)
{
    $height = mysqli_num_rows($result);
    for ($i = 0; $i < $height; $i++) { //根据该老师的课题数进行循环输出
        $row = mysqli_fetch_array($result, MYSQLI_BOTH); //依次查询每个课题的详细信息
        echo <<< Archemiya
        <tr>
        <td class="td-height"> <a href="./tutor.php?func=topic&id={$row['id']}" >{$row['name']}</a></td>
        
Archemiya;

        //查询当前课题学生最新提交的论文终稿信息
        $sql_id = "SELECT max(`record_id`) from `final_paper_record` 
        where `student_id` = '{$row['student_id']}' order by `record_id` desc";
        $result_id = mysqli_query($link, $sql_id);
        $row_id = mysqli_fetch_array($result_id);

        $sql_final_paper = "SELECT * FROM `final_paper_record` 
        WHERE `final_paper_record`.`topic_id` = '{$row['id']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
        $result_final_paper = mysqli_query($link, $sql_final_paper);
        $row_final_paper = mysqli_fetch_array($result_final_paper, MYSQLI_BOTH);
        $num_final_paper = mysqli_num_rows($result_final_paper);

        /*
        思路：
        1.首先判断是否超过截止时间
        2.未超过截止时间
            - 1 根据各个状态判断
        */

        //首先判断是否超过截止时间，若未超过：
        if ($today <= $row_stu_control['final_paper_deadline'] && $row_stu_control['final_paper_deadline'] != NULL) {

            //当前学生从未交过论文终稿
            if (!$num_final_paper) {
                echo <<< Archemiya
                <td class="td-height td-title-center alert alert-danger" role="alert">
                    {$row['student_id']}{$row['student_name']}
                </td>
                <td class="td-height td-title-center">     
                <button class='btn btn-danger' disabled >学生尚未提交</button>
                </td>
                <td class="td-height td-title-center">
                <button class='btn btn-danger' disabled >学生尚未提交</button>
                </td>
Archemiya;
            }
            //当前学生已修改论文摘要，但未提交附件
            elseif ($num_final_paper 
            && $row_final_paper['annex_flag'] == 0 
            && $row_final_paper['final_flag'] == 0) { 
                echo <<< Archemiya
                <td class="td-height td-title-center alert alert-warning" role="alert">
                    {$row['student_id']}{$row['student_name']}
                </td>
                <td class="td-height td-title-center">     
                <button class='btn btn-default' disabled >已提交摘要</button>
                </td>
                <td class="td-height td-title-center">
                <button class='btn btn-warning' disabled >附件尚未提交</button>
                </td>
Archemiya;
            }
            //当前学生已提交论文摘要，但尚未提交附件
            elseif ($num_final_paper 
            && $row_final_paper['annex_flag'] == 0 
            && $row_final_paper['final_flag'] == 0) { 
                echo <<< Archemiya
                <td class="td-height td-title-center alert alert-warning" role="alert">
                    {$row['student_id']}{$row['student_name']}
                </td>
                <td class="td-height td-title-center">     
                <button class='btn btn-default' disabled >已提交摘要</button>
                </td>
                <td class="td-height td-title-center">
                <button class='btn btn-warning' disabled >附件尚未提交</button>
                </td>
Archemiya;
            }
            //当前学生摘要与附件均已提交，老师应及时给出修改意见
            elseif ($num_final_paper 
            && $row_final_paper['annex_flag'] == 1 
            && $row_final_paper['final_flag'] == 0) { 
                echo <<< Archemiya
                <td class="td-height td-title-center alert alert-warning" role="alert">
                    {$row['student_id']}{$row['student_name']}
                </td>
                <td class="td-height td-title-center">     
                <a href='tutor.php?func=final_paper&id={$row['id']}'
                class='btn btn-primary' role='button'>查看终稿摘要</a>
                </td>
                <td class="td-height td-title-center">
                <a href='../uploaded_files/final_paper_files/{$row['student_id']}_{$row_id['max(`record_id`)']}/{$row_final_paper['final_paper_annex_name']}'
                class='btn btn-primary' role='button'>下载附件</a>
                </td>
Archemiya;
            }
            //已给出修改意见，等待当前学生重新上传
            elseif ($num_final_paper 
            && $row_final_paper['final_flag'] == 2) { 
                echo <<< Archemiya
                <td class="td-height td-title-center alert alert-warning" role="alert">
                    {$row['student_id']}{$row['student_name']}
                </td>
                <td class="td-height td-title-center">     
                <button class='btn btn-warning' disabled >等待学生修改</button>
                </td>
                <td class="td-height td-title-center">
                <button class='btn btn-warning' disabled >等待学生修改</button>
                </td>
Archemiya;
            }
            //论文终稿审核结束
            elseif ($num_final_paper 
            && $row_final_paper['final_flag'] == 1) { 
                echo <<< Archemiya
                <td class="td-height td-title-center alert alert-info" role="alert">
                    {$row['student_id']}{$row['student_name']}
                </td>
                <td class="td-height td-title-center">     
                <a href='tutor.php?func=final_paper&id={$row['id']}'
                class='btn btn-success' role='button'>查看终稿摘要</a>
                </td>
                <td class="td-height td-title-center">
                <a href='../uploaded_files/final_paper_files/{$row['student_id']}_{$row_id['max(`record_id`)']}/{$row_final_paper['final_paper_annex_name']}'
                class='btn btn-success' role='button'>下载附件</a>
                </td>
Archemiya;
            }
        }elseif ($today > $row_stu_control['final_paper_deadline'] && $row_stu_control['final_paper_deadline'] != NULL) { 
            if($row_final_paper['final_flag'] == 1){
                echo <<< archemiya
                <td class="td-height td-title-center alert alert-info" role="alert">
                    {$row['student_id']}{$row['student_name']}
                </td>
                <td class="td-height td-title-center">     
                <a href='tutor.php?func=final_paper&id={$row['id']}'
                class='btn btn-success' role='button'>查看终稿摘要</a>
                </td>
                <td class="td-height td-title-center">
                <a href='../uploaded_files/final_paper_files/{$row['student_id']}_{$row_id['max(`record_id`)']}/{$row_final_paper['final_paper_annex_name']}'
                class='btn btn-success' role='button'>下载附件</a>
                </td>
archemiya;
            }
            else{
                echo <<< archemiya
                <td class="td-height td-title-center alert alert-danger" role="alert">
                    {$row['student_id']}{$row['student_name']}
                </td>
                <td>
                <button class="btn btn-danger"  disabled>已逾期</button>
                </td>
                <td>
                <button class="btn btn-danger"  disabled>已逾期</button>
                </td>
archemiya;
            }
        }
    }
}

?>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <?php
    if($row_stu_control['final_paper']==0){
        echo "<br/>";
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
        echo "<strong>尚未开启论文终稿流程！</strong>";
        echo "</div>";
    }else {
        //判断是否已到提交截止时间
        if ($today > $row_stu_control['final_paper_deadline'] && $row_stu_control['final_paper_deadline'] != NULL) {
            echo <<< Archemiya
            <div class="alert alert-danger" role="alert">
            <strong>当前论文终稿提交系统已关闭，未按时完成终稿审核的学生将失去参加论文一辩资格</strong>
            </div>
Archemiya;
        } else {
            echo <<< Archemiya
            <div class="alert alert-danger" role="alert">
            论文终稿截止时间为
            <strong>{$row_stu_control['final_paper_deadline']}</strong>，
            请提醒学生及时提交论文终稿
            </div>
Archemiya;
        }
        echo <<< archemiya
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar" data-pagination="true" data-page-list="[10, 25, 50, 100, 200, All]" >
            <thead>
                <tr>
                    <th class="col-md-6 th-title-topic-chs">课题名称</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">指导学生</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作1</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作2</th>
                </tr>
            </thead>
            <tbody>
archemiya;
        table_final_paper_echo($result, $link, $row_stu_control,$today);
        echo <<< archemiya
            </tbody>
        </table>
    </div>
archemiya;
    }
    ?>

</body>

</html>