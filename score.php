<?php
include "link.php";
if (isset($_GET['func'])) {
    $get = $_GET['func'];
}
switch ($get) {
    case "first_report":
        $sql = "INSERT INTO `student_grade` 
    (`id`,`topic_id`, `student_id`, `student_name`, `first_report_grade`, `fp_grade_description`,`student_grade`) 
    VALUES (NULL,'{$_POST['topic_id']}' ,'{$_POST['student_id']}', '{$_POST['student_name']}', '{$_POST['first_report_grade']}', '{$_POST['grade_description']}' ,NULL)";
        $sql_final = "UPDATE `first_report_record` set `final_flag` = 1 where `student_id` = '{$_POST['student_id']}' and `final_flag` = 4";
        mysqli_query($link, $sql);
        mysqli_query($link, $sql_final);
        echo "<script>alert('评分成功！');history.go(-1)</script>";
        break;

    case "reply":
        $sql = "INSERT INTO `student_reply_grade_record` 
    (`record_id`, 
    `student_id`,
    `student_name`,
    `teacher_id`, 
    `teacher_name`,
    `topic_id`,
    `reply_grade`, 
    `reply_grade_description`) 
    VALUES 
    (NULL,
    '{$_POST['student_id']}', 
    '{$_POST['student_name']}', 
    '{$_POST['teacher_id']}', 
    '{$_POST['teacher_name']}', 
    '{$_POST['topic_id']}' ,
    '{$_POST['reply_grade']}', 
    '{$_POST['reply_grade_description']}'
    )";
        mysqli_query($link, $sql);

        //根据答辩组号查询当前答辩组导师数目
        $sql_search = "SELECT * FROM `reply_schedule` 
    WHERE `group_id` = '{$_POST['group_id']}' AND `permission` = 'tutor' ";
        $result_search = mysqli_query($link, $sql_search);
        $num_search = mysqli_num_rows($result_search);

        //根据当前学生id查询获得成绩数目
        $sql_search2 = "SELECT * FROM `student_reply_grade_record` WHERE `student_id` = '{$_POST['student_id']}' ";
        $result_search2 = mysqli_query($link, $sql_search2);
        $num_search2 = mysqli_num_rows($result_search2);

        if ($num_search == $num_search2) {
            $final_grade = 0;
            for ($i = 0; $i < $num_search; $i++) {
                $row_search2_grade = mysqli_fetch_array($result_search2, MYSQLI_BOTH);
                $final_grade += $row_search2_grade['reply_grade'];
            }
            $final_grade /= $num_search;
            //echo $final_grade;
            $sql_final = "UPDATE `student_grade` 
        SET `reply_grade` = '{$final_grade}',`reply_grade_final_flag` = 1
        where `student_id` = '{$_POST['student_id']}'";
            mysqli_query($link, $sql_final);
            if ($final_grade < 60) {
                $sql_change_to_second = "UPDATE `reply_schedule` 
        SET `second_reply` = 1
        where `id` = '{$_POST['student_id']}'";
                $sql_record = "UPDATE `reply_record` 
        SET `reply_record_annex_name` = NULL
                WHERE `student_id` = '{$_POST['student_id']}' ";
                mysqli_query($link, $sql_record);
                mysqli_query($link, $sql_change_to_second);
            }
        }
        echo "<script>alert('评分成功！');history.go(-1)</script>";
        break;
    case "second_reply":
        $sql = "INSERT INTO `student_second_reply_grade_record` 
    (`record_id`, 
    `student_id`,
    `student_name`,
    `teacher_id`, 
    `teacher_name`,
    `topic_id`,
    `reply_grade`, 
    `reply_grade_description`) 
    VALUES 
    (NULL,
    '{$_POST['student_id']}', 
    '{$_POST['student_name']}', 
    '{$_POST['teacher_id']}', 
    '{$_POST['teacher_name']}', 
    '{$_POST['topic_id']}' ,
    '{$_POST['reply_grade']}', 
    '{$_POST['reply_grade_description']}'
    )";
        mysqli_query($link, $sql);

        //查询当前二次答辩组导师数目
        $sql_search = "SELECT * FROM `second_reply_schedule` 
    WHERE `permission` = 'tutor' ";
        $result_search = mysqli_query($link, $sql_search);
        $num_search = mysqli_num_rows($result_search);

        //根据当前学生id查询获得成绩数目
        $sql_search2 = "SELECT * FROM `student_second_reply_grade_record` WHERE `student_id` = '{$_POST['student_id']}' ";
        $result_search2 = mysqli_query($link, $sql_search2);
        $num_search2 = mysqli_num_rows($result_search2);

        if ($num_search == $num_search2) {
            $final_grade = 0;
            for ($i = 0; $i < $num_search; $i++) {
                $row_search2_grade = mysqli_fetch_array($result_search2, MYSQLI_BOTH);
                $final_grade += $row_search2_grade['reply_grade'];
            }
            $final_grade /= $num_search;
            //echo $final_grade;
            $sql_final = "UPDATE `student_grade` 
        SET `second_grade` = '{$final_grade}',`second_grade_final_flag` = 1
        where `student_id` = '{$_POST['student_id']}'";
            mysqli_query($link, $sql_final);
        }
        echo "<script>alert('评分成功！');history.go(-1)</script>";
        break;

    case "teacher_grade":
        /* echo $_POST['teacher_grade'];
        echo $_POST['teacher_grade_description'];
        echo $_POST['student_id']; */
        $sql = "UPDATE `student_grade`
        set `teacher_grade` = '{$_POST['teacher_grade']}',
        `teacher_grade_description` = '{$_POST['teacher_grade_description']}'
        where `student_id` = '{$_POST['student_id']}' 
        ";
        mysqli_query($link, $sql);
        //完成此项成绩评阅之后即可上传最终成绩
        $sql_grade = "SELECT * from `student_grade` where `student_id` = '{$_POST['student_id']}' ";
        $result_grade = mysqli_query($link,$sql_grade);
        $row_grade = mysqli_fetch_array($result_grade,MYSQLI_BOTH);
        //在此完成成绩加权
        $first = 0.1 * $row_grade['first_report_grade'];
        if ($row_grade['reply_grade'] >= 60) {
            $second = 0.5 * $row_grade['reply_grade'];
        } else {
            $second = 0.5 * $row_grade['second_grade'];
        }
        $third = 0.4 * $row_grade['teacher_grade'];
        
        echo $final_grade = $first+$second+$third;
        $sql_final_grade = "UPDATE `student_grade` set `student_grade` = $final_grade 
        where `student_id` = '{$_POST['student_id']}'";
        mysqli_query($link, $sql_final_grade);

        echo "<script>alert('评分成功！');history.go(-1)</script>";
        break;
}
