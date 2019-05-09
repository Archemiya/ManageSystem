<?php
//此页面为二次答辩安排页面
include "../link.php";
include "../secretary_func/sec_query_stu_control.php";

//输出二次答辩安排表
function echo_second_reply_schedule_table($link)
{

    $sql_teacher_num = "SELECT * FROM `second_reply_schedule` WHERE  `permission` = 'tutor' ";
    $result_teacher_num = mysqli_query($link, $sql_teacher_num);
    $num_teacher = mysqli_num_rows($result_teacher_num);

    //随意查询一个学生可得答辩时间与地点
    $sql_time = "SELECT * FROM `second_reply_schedule` WHERE `permission` = 'student' ";
    $result_time = mysqli_query($link, $sql_time);
    $row_time = mysqli_fetch_array($result_time, MYSQLI_BOTH);

    //查看当前所有二辩学生 
    $sql_second = "SELECT * FROM `second_reply_schedule` where  `permission` = 'student'";
    $result_second = mysqli_query($link, $sql_second);
    $num_second = mysqli_num_rows($result_second);

    if (isset($row_time['time'])) {
        echo " <div class='alert alert-info' role='alert'>";
        echo "答辩时间为：";
        echo $row_time['time'];
        echo " 答辩地点为：";
        echo $row_time['place'];
        echo "</div>";
    } else {
        echo "";
    }
    echo <<< archemiya
    
    <div class="table-responsive">
        <table data-toggle="table" >
            <thead>
                <tr>
                    <th class="col-md-6 th-title-center" colspan="2">导师名单</th>
                    <th class="col-md-6 th-title-center" colspan="2">学生名单</th>
                </tr>
                <tr>
                    <th class="col-md-3 th-title-center">导师姓名</th>
                    <th class="col-md-3 th-title-center">导师简介</th>
                    <th class="col-md-3 th-title-center">学生姓名</th>
                    <th class="col-md-3 th-title-center">学生选题</th>
                </tr>

            </thead>

            <tbody>
archemiya;

    if ($num_second < $num_teacher) {
        $num_second = $num_teacher;
    }
    for ($i = 0; $i < $num_second; $i++) {
        $row_teacher = mysqli_fetch_array($result_teacher_num, MYSQLI_BOTH);
        $row_student = mysqli_fetch_array($result_second, MYSQLI_BOTH);
        echo "<tr>";

        echo "<td class=\"td-height th-title-center\">";
        echo $row_teacher['id'] . $row_teacher['name'];
        echo "</td>";

        echo "<td class=\"td-height th-title-center\">";
        if ($i < $num_teacher) {
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
        echo "<a href='student.php?func=second_reply&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
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
    <br />
    <div class="alert alert-info" role="alert">
       本页面为二次答辩安排详情页面，请牢记自己的答辩时间与地点并按时参加答辩
    </div>
    <?php
    if(!$row_control['second_reply'])
    {
        echo <<< archemiya
        <div class="alert alert-danger" role='alert'>
    当前二次答辩流程尚未开启
        </div>
archemiya;
    }elseif($row_control['second_reply']){
        echo_second_rely_schedule_table($link);
    }
    ?>
</body>