<?php
include "../link.php";
function echo_the_student_grade_table($link)
{
    //查询所有学生
    $sql_the_student_num = "SELECT * FROM `user` 
    WHERE `permission` = 'student' ";
    $result_the_student_num = mysqli_query($link, $sql_the_student_num);
    $num_the_student = mysqli_num_rows($result_the_student_num);

    echo <<< archemiya
    <div class="table-responsive">
        <table data-toggle="table" >
            <thead>
                <tr>
                    <th class="col-md-12 th-title-center" colspan="6">学生名单</th>
                </tr>
                <tr>
                    <th class="col-md-4 th-title-center">学生选题</th>
                    <th class="col-md-2 th-title-center">学生姓名</th>
                    <th class="col-md-1 th-title-center">开题报告成绩</th>
                    <th class="col-md-1 th-title-center">答辩成绩</th>
                    <th class="col-md-1 th-title-center">终稿评阅成绩</th>
                    <th class="col-md-1 th-title-center">加权成绩</th>
                </tr>

            </thead>

            <tbody>
archemiya;
    for ($i = 0; $i < $num_the_student; $i++) {
        $row_the_student = mysqli_fetch_array($result_the_student_num, MYSQLI_BOTH);
        echo "<tr>";
        //查询此学生的课题详情
        $sql_the_topic = "SELECT * FROM `topic` WHERE `student_id` = '{$row_the_student['id']}' ";
        $result_the_topic = mysqli_query($link, $sql_the_topic);
        $row_the_topic = mysqli_fetch_array($result_the_topic, MYSQLI_BOTH);
        //$num_the_topic = mysqli_num_rows($result_the_topic);
        //根据学生id查询学生此项成绩得分情况
        $sql_the_grade = "SELECT * FROM `student_grade` WHERE `student_id` = '{$row_the_student['id']}' ";
        $result_the_grade = mysqli_query($link, $sql_the_grade);
        $row_the_grade = mysqli_fetch_array($result_the_grade, MYSQLI_BOTH);

        echo "<td class=\"td-height th-title-center\">";
        echo "<a href='tutor.php?func=reply_grade&id={$row_the_topic['id']} '>" . $row_the_topic['name'] . "</a>"; //此处显示课题名称
        echo "</td>";
        echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
        echo   $row_the_student['id'] . $row_the_student['name'];
        echo "</td>";

        echo "<td class='th-title-center alert alert-info' role='alert'>";
        echo "最终得分：";
        echo $row_the_grade['first_report_grade'];
        echo "</td>";
        echo "<td class='th-title-center alert alert-info' role='alert'>";
        echo "最终得分：";
        if ($row_the_grade['reply_grade'] < 60) {
            echo $row_the_grade['second_grade'];
        } else {
            echo $row_the_grade['reply_grade'];
        }
        echo "</td>";
        echo "<td class='th-title-center alert alert-info' role='alert'>";
        echo "最终得分：";
        echo $row_the_grade['teacher_grade'];
        echo "</td>";

        echo "<td class='th-title-center alert alert-success' role='alert'>";
        echo "最终得分：";
        echo $row_the_grade['student_grade'];
        echo "</td>";
        echo "</tr>";
    }
    
    echo <<< archemiya
            </tbody>
        </table>

        <br/>

    </div>
archemiya;
}

?>

<body>
    <div class="alert alert-info" role="alert">
        此页面为导师成绩查询页面，可以查看任一学生的各项成绩
    </div>
    <?php
    echo_the_student_grade_table($link);
    ?>
</body>