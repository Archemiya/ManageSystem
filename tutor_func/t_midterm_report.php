<?php
/*
思路：（和学生中期报告相似）
1.首先判断开启条件：
    - 只有一个条件，即开题报告结束，此处可对 `student_grade`即学生成绩表中的 `first_grade` 字段进行查询，得出 **num_rows** ，然后与`user`中的 **num_rows** 对比。
2.开启之后，显示名下所有学生的课题信息，根据学生是否提交中期报告显示能否查看中期报告并在中期报告详细页面进行指导意见填写和确认。
*/
include "../link.php";

//检查成绩表中得到开题分数的同学人数    
$sql_first_report_grade = "SELECT * from `student_grade` where `first_report_grade` != 0";
$result_first_report_grade = mysqli_query($link, $sql_first_report_grade);
$num_first_report_grade = mysqli_num_rows($result_first_report_grade);

//判断当前老师的课题数
$sql = "SELECT * FROM `topic` WHERE `topic`.`teacher_id` = '{$_SESSION['user_id']}'";
$result = mysqli_query($link, $sql);

//查询当前全员学生人数
$sql_student = "SELECT * from `user` where `permission` = 'student' ";
$result_student = mysqli_query($link, $sql_student);
$num_student = mysqli_num_rows($result_student);

//此函数用于输出导师所带的所有学生信息
function table_midterm_report_echo($result, $link)
{
    $height = mysqli_num_rows($result);
    for ($i = 0; $i < $height; $i++) { //根据该老师的课题数进行循环输出
        $row = mysqli_fetch_array($result, MYSQLI_BOTH); //依次查询每个课题的详细信息
        echo <<< Archemiya
        <tr>
        <td class="td-height"> <a href="./tutor.php?func=topic&id={$row['id']}" >{$row['name']}</a></td>
        
Archemiya;
        //查询当前课题的学生信息
        $sql_chose_final_flag = "SELECT * FROM `chose_topic_record` 
        WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `topic_id` = '{$row['id']}' AND `final_flag` = 1";
        $result_chose_final_flag = mysqli_query($link, $sql_chose_final_flag);
        $row_chose_final_flag = mysqli_fetch_array($result_chose_final_flag, MYSQLI_BOTH);

        //查询当前课题学生提交的中期报告信息
        $sql_midterm_report = "SELECT * FROM `midterm_report` 
        WHERE `midterm_report`.`topic_id` = '{$row['id']}' ";
        $result_midterm_report = mysqli_query($link, $sql_midterm_report);
        $row_midterm_report = mysqli_fetch_array($result_midterm_report, MYSQLI_BOTH);
        $num_midterm_report = mysqli_num_rows($result_midterm_report);

        if (!$num_midterm_report && $row_midterm_report['annex_flag'] == 0) {
            echo <<< Archemiya
        <td class="td-height td-title-center alert alert-danger" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <button class='btn btn-danger' disabled >学生未提交</button>
        </td>
        <td class="td-height td-title-center">
        <button class='btn btn-danger' disabled >学生未提交</button>
        </td>
Archemiya;
        } elseif ($num_midterm_report && $row_midterm_report['annex_flag'] == 0) {
            echo <<< Archemiya
        <td class="td-height td-title-center alert alert-danger" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <button class='btn btn-primary' disabled >已提交摘要</button>
        </td>
        <td class="td-height td-title-center">
        <button class='btn btn-danger' disabled >学生未提交</button>
        </td>
Archemiya;
        } elseif ($num_midterm_report && $row_midterm_report['islook_flag'] == 0 && $row_midterm_report['annex_flag'] == 1) {
            echo <<< Archemiya
        <td class="td-height td-title-center alert alert-warning" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <a href="tutor.php?func=midterm_report&id={$row['id']}" class='btn btn-primary' role='button'>查看中期报告</a>
        </td>
        <td class="td-height td-title-center">
        <a href='../uploaded_files/midterm_report_files/{$row_midterm_report['midterm_report_annex_name']}' class='btn btn-primary' role='button'>下载附件</a>
        </td>
Archemiya;
        } else {
            echo <<< Archemiya
        <td class="td-height td-title-center alert alert-info" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <a href="tutor.php?func=midterm_report&id={$row['id']}" class='btn btn-success' role='button'>查看中期报告</a>
        </td>
        <td class="td-height td-title-center">
        <a href='../uploaded_files/midterm_report_files/{$row_midterm_report['midterm_report_annex_name']}' class='btn btn-success' role='button'>下载附件</a>   
        </td>
Archemiya;
        }
        echo "</tr>";
    }
}
?>

<body>
    <?php
    if ($num_first_report_grade != $num_student) {
        echo <<< archemiya
                <br/>
                <div class="alert alert-danger" role='alert'>
                    当前开题答辩评分尚未结束，不可提交中期报告，请耐心等待评分结束！
                </div>
archemiya;
    } else {
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
        table_midterm_report_echo($result, $link);
        echo <<< archemiya
            </tbody>
        </table>
    </div>
archemiya;
    }
    ?>


</body>