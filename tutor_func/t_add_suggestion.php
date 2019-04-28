<?php
include "../link.php";
if (isset($_GET["func"])) {
    $result = $_GET["func"];
    switch ($result) {
        //开题报告
        case "first_report":
            if (isset($_GET['id'])) {
                //查询当前课题的最新开题报告
                $sql_id = "SELECT max(`record_id`) from `first_report_record` WHERE `first_report_record`.`topic_id` = '{$_GET['id']}' order by `record_id` desc";
                $result_id = mysqli_query($link, $sql_id);
                $row_id = mysqli_fetch_array($result_id, MYSQLI_BOTH);

                $sql_first_report_record = "UPDATE  `first_report_record` set `modify_suggestion`='{$_POST['report_suggestion']}' , `final_flag` = 2 
                WHERE `first_report_record`.`topic_id` = '{$_GET['id']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
                mysqli_query($link, $sql_first_report_record);
                mysqli_close($link);
                echo "<script>alert('上传意见成功！');history.go(-1)</script>";
            } else if (isset($_GET['cid'])) {
                //查询当前课题的最新开题报告
                $sql_id = "SELECT max(`record_id`) from `first_report_record` WHERE `first_report_record`.`topic_id` = '{$_GET['cid']}' order by `record_id` desc";
                $result_id = mysqli_query($link, $sql_id);
                $row_id = mysqli_fetch_array($result_id, MYSQLI_BOTH);

                $sql_first_report_record = "UPDATE  `first_report_record` set `final_flag` = 3 
                WHERE `first_report_record`.`topic_id` = '{$_GET['cid']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
                mysqli_query($link, $sql_first_report_record);
                mysqli_close($link);
                echo "<script>alert('已同意此学生的开题报告！');history.go(-1)</script>";
            }
            break;
        //中期报告
        case "midterm_report":
            if (isset($_GET['id'])) {
                //查询当前课题的最新论文初稿
                $sql_id = "SELECT max(`record_id`) from `midterm_report` 
                WHERE `midterm_report`.`topic_id` = '{$_GET['id']}' order by `record_id` desc";
                $result_id = mysqli_query($link, $sql_id);
                $row_id = mysqli_fetch_array($result_id, MYSQLI_BOTH);

                $sql_report = "UPDATE  `midterm_report` set `instructions`='{$_POST['report_suggestion']}',`final_flag` = 2 
                WHERE `midterm_report`.`topic_id` = '{$_GET['id']}' and `record_id` = '{$row_id['max(`record_id`)']}'";
                mysqli_query($link, $sql_report);
                mysqli_close($link);
                echo "<script>alert('上传意见成功！');history.go(-1)</script>";
            }
            if (isset($_GET['cid'])) {
                $sql_id = "SELECT max(`record_id`) from `midterm_report` 
                WHERE `midterm_report`.`topic_id` = '{$_GET['cid']}' order by `record_id` desc";
                $result_id = mysqli_query($link, $sql_id);
                $row_id = mysqli_fetch_array($result_id, MYSQLI_BOTH);

                $sql_report = "UPDATE  `midterm_report` set `final_flag` = 1 
                WHERE `midterm_report`.`topic_id` = '{$_GET['cid']}' and `record_id` = '{$row_id['max(`record_id`)']}'";
                mysqli_query($link, $sql_report);
                mysqli_close($link);
                echo "<script>alert('已同意此学生的中期报告！');history.go(-1)</script>";
            }
            break;
        //论文初稿
        case "first_paper":
            if (isset($_GET['id'])) {
                $sql_id = "SELECT max(`record_id`) from `first_paper_record` WHERE `first_paper_record`.`topic_id` = '{$_GET['id']}' order by `record_id` desc";
                $result_id = mysqli_query($link, $sql_id);
                $row_id = mysqli_fetch_array($result_id, MYSQLI_BOTH);

                $sql = "UPDATE  `first_paper_record` set `modify_suggestion`='{$_POST['paper_suggestion']}',`final_flag` = 2 
                WHERE `first_paper_record`.`topic_id` = '{$_GET['id']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";                
                mysqli_query($link, $sql);
                mysqli_close($link);
                echo "<script>alert('上传意见成功！');history.go(-1)</script>";
            }
            if (isset($_GET['cid'])) {
                //根据课题号查询学生信息
                $sql_s = "SELECT * from `topic` WHERE `topic`.`id` = '{$_GET['cid']}'";
                $result_s = mysqli_query($link, $sql_s);
                $row_s = mysqli_fetch_array($result_s, MYSQLI_BOTH);

                $sql_id = "SELECT max(`record_id`) from `first_paper_record` WHERE `first_paper_record`.`topic_id` = '{$_GET['cid']}' order by `record_id` desc";
                $result_id = mysqli_query($link, $sql_id);
                $row_id = mysqli_fetch_array($result_id, MYSQLI_BOTH);


                $sql = "UPDATE  `first_paper_record` set `final_flag` = 1 
                WHERE `first_paper_record`.`topic_id` = '{$_GET['cid']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
                $sql_2 = "UPDATE  `reply_schedule` set `first_paper_flag` = 1 
                WHERE `reply_schedule`.`id` = '{$row_s['student_id']}' ";
                mysqli_query($link, $sql);
                mysqli_query($link, $sql_2);
                mysqli_close($link);
                echo "<script>alert('已同意此学生的论文初稿！');history.go(-1)</script>";
            }
            break;
    }
}
