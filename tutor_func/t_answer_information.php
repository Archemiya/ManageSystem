<?php
include "../link.php";
include "../secretary_func/sec_query_t_control.php";

//查询此教师所属答辩组
$sql_group = "SELECT * from `reply_schedule` where `id` = '{$_SESSION['user_id']}'";
$result_group = mysqli_query($link, $sql_group);
$row_group = mysqli_fetch_array($result_group, MYSQLI_BOTH);

function echo_reply_schedule_table($row_group, $link)
{
    $group_id = $row_group['group_id'];
    $sql_teacher_num = "SELECT * FROM `reply_schedule` WHERE `group_id` = '{$group_id}' AND `permission` = 'tutor' ";
    $result_teacher_num = mysqli_query($link, $sql_teacher_num);
    $num_teacher = mysqli_num_rows($result_teacher_num);

    $sql_student_num = "SELECT * FROM `reply_schedule` 
    WHERE `group_id` = '{$group_id}' AND `permission` = 'student' AND `reply_delay` = 0 AND `first_paper_flag` = 1";
    $result_student_num = mysqli_query($link, $sql_student_num);
    $num_student = mysqli_num_rows($result_student_num);
    echo <<< archemiya
    <div class="alert alert-info" role='alert'>
    此页面为答辩信息页面，请牢记自己的答辩时间与地点并按时参加答辩
    </div>
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#{$group_id}">
            <thead>
                <tr>
                    <th class="col-md-6 th-title-center" colspan="2">导师名单</th>
                    <th class="col-md-6 th-title-center" colspan="2">学生名单</th>
                </tr>
                <tr>
                    <th class="col-md-3 th-title-center">导师姓名</th>
                    <th class="col-md-3 th-title-center"> 导师简介</th>
                    <th class="col-md-3 th-title-center">学生姓名</th>
                    <th class="col-md-3 th-title-center">学生选题</th>
                </tr>

            </thead>

            <tbody>
                <div id="{$group_id}">
                    <button type="button" class="btn btn-default active" > 
archemiya;
    echo "所属小组为：第 " . $group_id . " 小组";
    echo <<< archemiya
                </button>
                </div>
archemiya;
    if (isset($row_group['time'])) {
        echo " <div class='alert alert-info' role='alert'>";
        echo "答辩时间为：";
        echo $row_group['time'];
        echo " 答辩地点为：";
        echo $row_group['place'];
        echo "</div>";
    } else {
        echo "";
    }
    if ($num_student >= $num_teacher) {
        $num_student = $num_student;
    } else {
        $num_student = $num_teacher;
    }
    for ($i = 0; $i < $num_student; $i++) {
        $row_teacher = mysqli_fetch_array($result_teacher_num, MYSQLI_BOTH);
        $row_student = mysqli_fetch_array($result_student_num, MYSQLI_BOTH);
        echo "<tr>";

        echo "<td class=\"td-height th-title-center\">";
        echo $row_teacher['id'] . $row_teacher['name'];
        echo "</td>";

        echo "<td class=\"td-height th-title-center\">";
        if (!$i) {
            echo "答辩组长";
        } else if ($i < $num_teacher) {
            echo "答辩老师";
        } else {
            echo "";
        }
        echo "</td>";
        echo "<td class=\"td-height th-title-center\">";
        echo   $row_student['id'] . $row_student['name'];
        echo "</td>";
        $sql_topic = "SELECT * FROM `topic`WHERE `student_id` = '{$row_student['id']}' ";
        $result_topic = mysqli_query($link, $sql_topic);
        $row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);
        echo "<td class=\"td-height th-title-center\">";
        echo "<a href='tutor.php?func=answer_information&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
        echo "</td>";

        echo "</tr>";
    }
    echo <<< archemiya
            </tbody>
        </table>



    </div>
archemiya;
}
?>

<body>

    <?php
    /* 对于答辩信息的显示应根据答辩秘书的流程控制来进行显示 */
    //当前一次答辩流程尚未开启
    if (!$row_control['first_reply']) {
        echo <<< archemiya
        <br/>
        <div class='alert alert-danger' role='alert'>
            <strong>当前答辩流程尚未开启，请等待教务处开启</strong>
        </div>
archemiya;
    }else{
        echo_reply_schedule_table($row_group, $link);
    }
    ?>
</body>