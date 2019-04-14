<?php
include "../link.php";
include "../secretary_func/sec_query_t_control.php";
//判断当前老师的课题数
$sql = "SELECT * FROM `topic` WHERE `topic`.`teacher_id` = '{$_SESSION['user_id']}'";
$result = mysqli_query($link, $sql);

//用于判断当前是否有学生查看任务书
$sql_islook_task = "SELECT * FROM `task_book` WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `islook_flag` = 1";
$result_islook_task = mysqli_query($link, $sql_islook_task);
$num_islool_task = mysqli_num_rows($result_islook_task);

//此函数用于输出导师所带的所有学生信息
function table_first_report_echo($result, $link, $row_control)
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

        //查询当前课题学生最新提交的开题报告信息
        $sql_id = "SELECT max(`record_id`) from `first_report_record` where `student_id` = '{$row_chose_final_flag['student_id']}' order by `record_id` desc";
        $result_id = mysqli_query($link, $sql_id);
        $row_id = mysqli_fetch_array($result_id);
        $sql_first_report_record = "SELECT * FROM `first_report_record` 
        WHERE `first_report_record`.`topic_id` = '{$row['id']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
        $result_first_report_record = mysqli_query($link, $sql_first_report_record);
        $row_first_report_record = mysqli_fetch_array($result_first_report_record, MYSQLI_BOTH);
        $num_first_report_record = mysqli_num_rows($result_first_report_record);

        if (!$num_first_report_record && $row_first_report_record['annex_flag'] == 0) {
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
        } elseif ($num_first_report_record && $row_first_report_record['annex_flag'] == 0) {
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
        } elseif ($num_first_report_record && $row_first_report_record['final_flag'] == 0 && $row_first_report_record['annex_flag'] == 1) {
            echo <<< Archemiya
        <td class="td-height td-title-center alert alert-info" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <a href="tutor.php?func=first_report&id={$row['id']}" class='btn btn-primary' role='button'>查看开题报告</a>
        </td>
        <td class="td-height td-title-center">
        <a href='../uploaded_files/first_report_files/{$row_first_report_record['first_report_annex_name']}' class='btn btn-primary' role='button'>下载附件</a>
        </td>
Archemiya;
        } elseif ($num_first_report_record && $row_first_report_record['final_flag'] == 2 && $row_first_report_record['annex_flag'] == 1) {
            echo <<< Archemiya
        <td class="td-height td-title-center alert alert-warning" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <button class='btn btn-warning' disabled >等待学生修改</button>
        </td>
        <td class="td-height td-title-center">
        <button class='btn btn-warning' disabled >等待学生修改</button>        
        </td>
Archemiya;
        } elseif ($num_first_report_record && $row_first_report_record['final_flag'] == 3 && $row_first_report_record['annex_flag'] == 1) {
            if ($row_control['first_report']) {
                echo <<< Archemiya
        <td class="td-height td-title-center alert alert-danger" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <button class='btn btn-danger' disabled >未及时提交</button>
        </td>
        <td class="td-height td-title-center">
        <button class='btn btn-danger' disabled >未及时提交</button>        
        </td>
Archemiya;
            } else {
                echo <<< Archemiya
        <td class="td-height td-title-center alert alert-warning" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <button class='btn btn-warning' disabled >已确定最终稿</button>
        </td>
        <td class="td-height td-title-center">
        <button class='btn btn-warning' disabled >已确定最终稿</button>        
        </td>
Archemiya;
            }
        } elseif ($num_first_report_record && $row_first_report_record['final_flag'] == 4 && $row_first_report_record['annex_flag'] == 1) {
            echo <<< Archemiya
        <td class="td-height td-title-center alert alert-warning" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <button class='btn btn-warning' disabled >答辩组评分中</button>
        </td>
        <td class="td-height td-title-center">
        <button class='btn btn-warning' disabled >答辩组评分中</button>        
        </td>
Archemiya;
        } elseif ($num_first_report_record && $row_first_report_record['final_flag'] == 1 && $row_first_report_record['annex_flag'] == 1) {
            echo <<< Archemiya
        <td class="td-height td-title-center alert alert-info" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <button class='btn btn-success' disabled >开题结束</button>
        </td>
        <td class="td-height td-title-center">
        <button class='btn btn-success' disabled >开题结束</button>        
        </td>
Archemiya;
        }
    }
    echo "</tr>";
}

//此函数为答辩评阅导师所独有的输出函数，即 special 字段为 reviewer 的导师
function final_first_report_echo($link)
{
    //查询目前导师账号所在的答辩小组
    $sql_reply_group = "SELECT `group_id` from `reply_schedule` where `id` = '{$_SESSION['user_id']}' ";
    $result_reply_group = mysqli_query($link, $sql_reply_group);
    $row_reply_group = mysqli_fetch_array($result_reply_group, MYSQLI_BOTH);

    //查询该答辩小组所有学生
    $sql_reply_student = "SELECT * from `reply_schedule` where `group_id` = '{$row_reply_group['group_id']}' AND `permission` = 'student' ";
    $result_reply_student = mysqli_query($link, $sql_reply_student);
    $num_reply_student = mysqli_num_rows($result_reply_student);

    for ($i = 0; $i < $num_reply_student; $i++) {
        //提供当前循环中的学生id信息（注意此处只有id信息和name信息）
        $row_reply_student = mysqli_fetch_array($result_reply_student, MYSQLI_BOTH);

        //根据每个学生的id查询各自的选题id以及其他相关信息
        //1.查询当前课题学生所选课题信息（topic id&name）
        $sql_topic = "SELECT * from `topic` WHERE `student_id` = '{$row_reply_student['id']}' "; //此处选择从topic表查更快捷
        $result_topic = mysqli_query($link, $sql_topic);
        $row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);

        //2.查询当前课题学生最新提交至答辩评阅组的开题报告信息(此处可以直接判断final_flag=4的开题报告记录即可)
        $sql_final_first_report_record = "SELECT * FROM `first_report_record` 
        WHERE `first_report_record`.`topic_id` = '{$row_topic['id']}' AND `final_flag` = 4";
        $result_final_first_report_record = mysqli_query($link, $sql_final_first_report_record);
        $row_final_first_report_record = mysqli_fetch_array($result_final_first_report_record, MYSQLI_BOTH);
        $num_final_first_report_record = mysqli_num_rows($result_final_first_report_record);

        //3.查询是否已经给出最终成绩(以及是否是最终审核结束状态)
        $sql_final = "SELECT * FROM `first_report_record` 
            WHERE `first_report_record`.`topic_id` = '{$row_topic['id']}' AND `final_flag` = 1";
        $result_final = mysqli_query($link, $sql_final);
        $num_final = mysqli_num_rows($result_final);

        $sql_isscore = "SELECT * from `student_grade` where `student_id` = '{$row_reply_student['id']}'";
        $result_isscore = mysqli_query($link, $sql_isscore);
        $row_score = mysqli_fetch_array($result_isscore, MYSQLI_BOTH);
        $num_isscore = mysqli_num_rows($result_isscore);

        echo <<< archemiya

        <tr>
            <td class="td-height"> <a href="./tutor.php?func=topic&id={$row_topic['id']}" >{$row_topic['name']}</a></td>
            <td class="td-height td-title-center alert alert-info" role="alert">
                {$row_reply_student['id']}{$row_reply_student['name']}
            </td>
archemiya;

        if (!$num_final_first_report_record && !$num_final && !$num_isscore) {//在第三阶段开启后 未 提交最终报告摘要和附件

            echo <<< archemiya
            <td class="td-height td-title-center">     
            <a href="tutor.php?func=first_report&fid={$row_topic['id']}&index=delay" class='btn btn-danger' role='button'>尚未提交摘要</a>
            </td>
            <td class="td-height td-title-center">
            <button class='btn btn-danger' disabled>尚未提交附件</button>
            </td>
archemiya;
        } elseif ($num_final_first_report_record && $row_final_first_report_record['annex_flag'] == 0 && $row_final_first_report_record['final_flag'] != 1 && !$num_isscore) {//提交了摘要未提交附件
            echo <<< archemiya
            <td class="td-height td-title-center">     
            <a href="tutor.php?func=first_report&fid={$row_topic['id']}&index=delay" class='btn btn-warning' role='button'>尚未提交摘要</a>
            </td>
            <td class="td-height td-title-center">
            <button class='btn btn-danger' disabled>尚未提交附件</button>
            </td>
archemiya;
        } elseif ($num_isscore) {
            echo <<< archemiya
            <td class="td-height td-title-center alert alert-info" role="alert">     
                最终成绩：{$row_score['first_report_grade']}
            </td>
            <td class="td-height td-title-center">
            </td>
archemiya;
        } else {
            echo <<< archemiya
            <td class="td-height td-title-center">     
            <a href="tutor.php?func=first_report&fid={$row_topic['id']}" class='btn btn-primary' role='button'>查看开题报告</a>
            </td>
            <td class="td-height td-title-center">
            <a href='../uploaded_files/first_report_files/{$row_final_first_report_record['first_report_annex_name']}' class='btn btn-primary' role='button'>下载附件</a>
            </td>
archemiya;
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
                    <th class="col-md-2 th-title-center th-title-topic-stu">指导学生</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作1</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作2</th>
                </tr>
            </thead>
            <tbody>
archemiya;
        table_first_report_echo($result, $link, $row_control);
        echo <<< archemiya
            </tbody>
        </table>
    </div>
archemiya;
    }

    if ($row_control['first_report'] == 0) {
        echo "<br/>";
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
        echo "<strong>当前答辩小组开题报告评阅功能尚未开放</strong>";
        echo "</div>";
    } elseif($_SESSION['user_special']=='reviewer') {
        echo <<< archemiya
        <br/>
        <div class="alert alert-info" role="alert">
        <strong>您是答辩小组评阅组长，请对答辩小组学生成员进行打分</strong>
        </div>
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar" data-pagination="true" data-page-list="[10, 25, 50, 100, 200, All]" >
            <thead>
                <tr>
                    <th class="th-title-center" colspan="4">答辩小组课题信息</th>
                </tr>
                <tr>
                    <th class="col-md-6 th-title-topic-chs">课题名称</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">课题学生</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作1</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作2</th>
                </tr>
            </thead>
            <tbody>
archemiya;
        final_first_report_echo($link);
        echo <<< archemiya
            </tbody>
        </table>
    </div>
archemiya;
    }
    ?>

</body>

</html>