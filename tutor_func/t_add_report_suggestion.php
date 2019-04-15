<?php
include "../link.php";
if (isset($_GET["func"])) {
    $result = $_GET["func"];
    switch ($result) {
        case "first_report":
            $sql_id = "SELECT max(`record_id`) from `first_report_record` order by `record_id` desc";
            $result_id = mysqli_query($link, $sql_id);
            $row_id = mysqli_fetch_array($result_id);
            if (isset($_GET['id'])) {
                $sql_first_report_record = "UPDATE  `first_report_record` set `modify_suggestion`='{$_POST['report_suggestion']}' , `final_flag` = 2 WHERE `first_report_record`.`topic_id` = '{$_GET['id']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
                mysqli_query($link, $sql_first_report_record);
                mysqli_close($link);
                echo "<script>alert('上传意见成功！');history.go(-1)</script>";
            } else if(isset($_GET['cid'])){
                $sql_first_report_record = "UPDATE  `first_report_record` set `final_flag` = 3 WHERE `first_report_record`.`topic_id` = '{$_GET['cid']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
                mysqli_query($link, $sql_first_report_record);
                mysqli_close($link);
                echo "<script>alert('已同意此学生的开题报告！');history.go(-1)</script>";
                
            }
            break;
        case "midterm_report":
            if (isset($_GET['id'])) {
                $sql_report = "UPDATE  `midterm_report` set `instructions`='{$_POST['report_suggestion']}',`islook_flag` = 1 WHERE `midterm_report`.`topic_id` = '{$_GET['id']}' ";
                mysqli_query($link, $sql_report);
                mysqli_close($link);
                echo "<script>alert('上传意见成功！');history.go(-1)</script>";
            } else {
                echo "<script>alert('上传意见失败！');history.go(-1)</script>"; 
            }
            break;
    }
}
