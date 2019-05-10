<?php
include "../link.php";
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['user_passwd']) || ($_SESSION['user_permission'] != 'student')) {
    // 不存在session用户id，退出
    echo "<script>alert('请先登录'); window.location.href=\"../login.html\";</script>";
    exit;
} else {
    $sql = "SELECT * FROM `user` WHERE `id` = \"{$_SESSION['user_id']}\" AND `password` = \"{$_SESSION['user_passwd']}\" ";
    $result = mysqli_query($link, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    if (!$row) {
        echo "<script>alert('请先登录'); window.location.href=\"../login.html\";</script>";
    }
}
include '../header.php';

//查询当前学生状态并设置其答辩状态
$sql_student = "SELECT * FROM `reply_schedule` WHERE `id` = '{$_SESSION['user_id']}' ";
$result_student = mysqli_query($link, $sql_student);
$row_student = mysqli_fetch_array($result_student, MYSQLI_BOTH);
?>

<!--主体-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-sidebar-left  sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="./student.php?func=topic" method="GET" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "topic") {
                                                                        echo "class=active";
                                                                    } ?>><i class="glyphicon glyphicon-list-alt"> 论文选题</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./student.php?func=task_book" method="GET" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "task_book") {
                                                                            echo "class=active";
                                                                        } ?>>
                        <i class="glyphicon glyphicon-file"> 任务书</i><span class="sr-only">(current)</span></a></li>
                <br />

                <li><a href="./student.php?func=first_report" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "first_report") {
                                                                    echo "class=active";
                                                                } ?>><i class="glyphicon glyphicon-file"> 开题报告</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./student.php?func=midterm_report" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "midterm_report") {
                                                                    echo "class=active";
                                                                } ?>><i class="glyphicon glyphicon-file"> 中期报告</i><span class="sr-only">(current)</span></a></li>

                <li><a href="./student.php?func=first_paper" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "first_paper") {
                                                                    echo "class=active";
                                                                } ?>><i class="glyphicon glyphicon-file"> 论文初稿</i><span class="sr-only">(current)</span></a></li>
                <br />

                <li><a href="./student.php?func=delay_reply" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "delay_reply") {
                                                                    echo "class=active";
                                                                } ?>><i class="glyphicon glyphicon-warning-sign"> 延期答辩
                        </i><span class="sr-only">(current)</span></a></li>

                <li><a href="./student.php?func=answer_information" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "answer_information") {
                                                                        echo "class=active";
                                                                    } ?>><i class="glyphicon glyphicon-list-alt"> 答辩信息
                        </i><span class="sr-only">(current)</span></a></li>

                <?php
                if ($row_student['second_reply'] == 0) {
                    ?>
                    <li><a href="./student.php?func=final_paper" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "final_paper") {
                                                                        echo "class=active";
                                                                    } ?>><i class="glyphicon glyphicon-file"> 论文终稿</i> <span class="sr-only">(current)</span></a></li>
                    <br />
                <?php
            } elseif ($row_student['second_reply'] == 1) {
                ?>
                    <li><a href="./student.php?func=second_reply" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "second_reply") {
                                                                        echo "class=active";
                                                                    } ?>><i class="glyphicon glyphicon-warning-sign"> 二次答辩</i> <span class="sr-only">(current)</span></a></li>
                    <li><a href="./student.php?func=final_paper" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "final_paper") {
                                                                        echo "class=active";
                                                                    } ?>><i class="glyphicon glyphicon-file"> 论文终稿</i> <span class="sr-only">(current)</span></a></li>
                    <br/>
                <?php
            } elseif ($row_student['second_reply'] == -1) {
                echo "<br>";
            }
            ?>

                <li><a href="./student.php?func=inquiry_result" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "inquiry_result") {
                                                                    echo "class=active";
                                                                } ?>><i class="glyphicon glyphicon-search"> 成绩查询 </i><span class="sr-only">(current)</span></a></li>

                <?php
                if (0) {
                    ?>
                    <li><a href="./student.php?func=excellent_paper" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "excellent_paper") {
                                                                            echo "class=active";
                                                                        } ?>><i class="glyphicon glyphicon-thumbs-up"> 优秀论文 </i><span class="sr-only">(current)</span></a></li>
                    <br />
                <?php
            }
            ?>

            </ul>
        </div>
        <div class="col-sm-sidebar-right col-sm-offset-right main">
            <div class="centeredalter">
                <?php
                if (isset($_GET["func"])) {
                    $result = $_GET["func"];
                    switch ($result) {
                        case "topic":
                            if (isset($_GET["id"])) {
                                include "../tutor_func/t_topic_detail.php";
                            } else {
                                include "stu_topic.php";
                            }
                            break;
                        case "task_book":
                            include "stu_task_book_detail.php";
                            break;
                        case "first_report":
                            if (isset($_GET["id"])) {
                                include "stu_report_suggestion_detail.php";
                            } elseif (isset($_GET["fid"])) {
                                include "stu_first_report_detail.php";
                            } else {
                                include "stu_first_report.php";
                            }
                            break;
                        case "midterm_report":
                            if (isset($_GET["id"])) {
                                include "stu_midterm_instructions_detail.php";
                            } elseif (isset($_GET["fid"])) {
                                include "stu_midterm_report_detail.php";
                            } else {
                                include "stu_midterm_report.php";
                            }
                            break;
                        case "first_paper":
                            if (isset($_GET["id"])) {
                                include "stu_first_paper_suggestion_detail.php";
                            } elseif (isset($_GET["fid"])) {
                                include "stu_first_paper_detail.php";
                            } else {
                                include "stu_first_paper.php";
                            }
                            break;
                        case "answer_information":
                            include "stu_answer_information.php";
                            break;
                        case "delay_reply":
                            include "stu_delay_reply.php";
                            break;
                        case "second_reply":
                        if (isset($_GET["id"])) {
                            include "../tutor_func/t_topic_detail.php";
                        } else {
                            include "stu_second_reply.php";
                        }
                            break;
                        case "final_paper":
                        if (isset($_GET["id"])) {
                            include "stu_final_paper_suggestion_detail.php";
                        } elseif (isset($_GET["fid"])) {
                            include "stu_final_paper_detail.php";
                        } else {
                            include "stu_final_paper.php";
                        }
                            break;
                        case "inquiry_result":
                        if (isset($_GET["id"])) {
                            include "../tutor_func/t_topic_detail.php";
                        } else {
                            include "stu_inquiry_result.php";
                        }
                        case "excellent_paper":
                    }
                } else {
                    echo "欢迎";

                    if ($row_student['first_paper_flag'] == 1 && $row_student['reply_delay'] == 0) {
                        echo "";
                    } elseif (($row_student['first_paper_flag'] == 1 && $row_student['reply_delay'] == 1)
                        || ($row_student['first_paper_flag'] == 0 && $row_student['reply_delay'] == 1)
                    ) {
                        $sql_second_reply_1 = "UPDATE `reply_schedule` 
                        SET `second_reply` = 1
                        WHERE `id` = '{$_SESSION['user_id']}'";
                        mysqli_query($link, $sql_second_reply_1);
                    } elseif (($row_student['first_paper_flag'] == 0 && $row_student['reply_delay'] == 0)
                        || ($row_student['first_paper_flag'] == 0 && $row_student['reply_delay'] == -1)
                    ) {
                        $sql_gg = "UPDATE `reply_schedule` set `second_reply` = -1
                    WHERE `id` = '{$_SESSION['user_id']}' ";
                        mysqli_query($link, $sql_gg);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>