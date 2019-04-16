<?php
/*
完成开题报告之后感觉写的实在太复杂了，这里没有使用记录表的形式，每个学生对应表中唯一的一个数据，这样能够较大程度的减少查库和代码的重复率。
系统写的比较乱，现在自己回顾起来已经有点吃力了，之后的每个重要功能应当将思路和每一个查库的意义进行注释。

思路：
1.首先判断开启条件：
    - 只有一个条件，即开题报告结束，此处可对 `student_grade`即学生成绩表中的 `first_grade` 字段进行查询，得出 **num_rows** ，然后与`user`中的 **num_rows** 对比。
2.开启之后，显示名下所有学生的课题信息，根据学生是否提交中期报告 显示能否查看中期报告并在中期报告详细页面进行指导意见填写和确认。
3.学生填写后再次查看，选择再次添加指导意见或同意通过，再次添加的过程可以重复直到同意通过为止。

其中处于何种状态通过 `final_flag` 的值来确定
 - 0 学生已提交新的中期报告
 - 2 导师已提交新的指导建议
 - 1 导师已确定新的中期报告
*/
include "../link.php";

//检查成绩表中得到开题分数的同学人数    
$sql_first_report_grade = "SELECT * from `student_grade` where `first_report_grade` != 0";
$result_first_report_grade = mysqli_query($link, $sql_first_report_grade);
$num_first_report_grade = mysqli_num_rows($result_first_report_grade);

//判断当前老师的课题数
$sql = "SELECT * FROM `topic` WHERE `topic`.`teacher_id` = '{$_SESSION['user_id']}'";
$result = mysqli_query($link, $sql);
$height = mysqli_num_rows($result);

//查询当前全员学生人数
$sql_student = "SELECT * from `user` where `permission` = 'student' ";
$result_student = mysqli_query($link, $sql_student);
$num_student = mysqli_num_rows($result_student);

//此函数用于输出导师名下的所有学生信息
function table_midterm_report_echo($result, $link, $height)
{
    for ($i = 0; $i < $height; $i++) { //根据该老师的课题数进行循环输出
        //依次查询每个课题的详细信息
        $row = mysqli_fetch_array($result, MYSQLI_BOTH); 
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

        //状态一：学生未提交报告及附件
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
        }
        //状态二：学生提交报告 未提交附件
        elseif ($num_midterm_report && $row_midterm_report['annex_flag'] == 0) {
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
        } 
        //状态三：学生提交完整报告，等待导师提交指导意见
        elseif ($num_midterm_report && $row_midterm_report['final_flag'] == 0 && $row_midterm_report['annex_flag'] == 1) {
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
        } 
        //状态四：导师提交指导意见，等待学生修改 (此处规定学生必须报告和附件均提交后导师才能进行查看)
        elseif($num_midterm_report && $row_midterm_report['final_flag'] == 2 ){
            echo <<< Archemiya
        <td class="td-height td-title-center alert alert-warning" role="alert">
            {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
        </td>
        <td class="td-height td-title-center">     
        <button class='btn btn-warning' disabled>等待学生修改</button>
        </td>
        <td class="td-height td-title-center">
        <button class='btn btn-warning' disabled>等待学生修改</button>
        </td>
Archemiya;
        }
        else {
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
        table_midterm_report_echo($result, $link, $height);
        echo <<< archemiya
            </tbody>
        </table>
    </div>
archemiya;
    }
    ?>


</body>