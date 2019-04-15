<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['user_permission'] != 'tutor')) {
    // 不存在session用户id，退出
    echo "<script>alert('请先登录'); window.location.href=\"../login.html\";</script>";
    exit;
}
include '../header.php';
?>

<!--主体-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-sidebar-left  sidebar">
            <ul class="nav nav-sidebar">
                <li><a href="./tutor.php?func=topic" method="GET" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "topic") {
                                                                        echo "class=active";
                                                                    } ?>><i class="glyphicon glyphicon-list-alt">
                            论文选题</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=chose_student" method="GET" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "chose_student") {
                                                                                echo "class=active";
                                                                            } ?>><i class="glyphicon glyphicon-user">
                            指导学生</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=task_book" method="GET" <?php if ((isset($_GET["func"]) && ($_GET["func"]) == "task_book") || (isset($_GET["func"]) && ($_GET["func"]) == "write_task_book")) {
                                                                            echo "class=active";
                                                                        } ?>><i class="glyphicon glyphicon-file">
                            任务书</i><span class="sr-only">(current)</span></a></li>

                <br />
                <li><a href="./tutor.php?func=first_report" <?php if ((isset($_GET["func"]) && ($_GET["func"]) == "first_report") || (isset($_GET["func"]) && ($_GET["func"]) == "a")) {
                                                                echo "class=active";
                                                            } ?>><i class="glyphicon glyphicon-file"> 开题报告</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=midterm_report" <?php if ((isset($_GET["func"]) && ($_GET["func"]) == "midterm_report") || (isset($_GET["func"]) && ($_GET["func"]) == "a")) {
                                                                echo "class=active";
                                                            } ?>><i class="glyphicon glyphicon-file"> 中期报告</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=guidance_record"><i class="glyphicon glyphicon-pencil"> 指导记录</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=first_draft"><i class="glyphicon glyphicon-file"> 论文初稿</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=paper_review"><i class="glyphicon glyphicon-search"> 论文查重 </i><span class="sr-only">(current)</span></a></li>

                <br />
                <li><a href="./tutor.php?func=answer_information"><i class="glyphicon glyphicon-list-alt"> 答辩信息
                        </i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=deferred_reply"><i class="glyphicon glyphicon-warning-sign"> 延期答辩
                        </i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=second_reply"><i class="glyphicon glyphicon-warning-sign"> 二次答辩</i> <span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=reply_record"><i class="glyphicon glyphicon-pencil"> 答辩记录</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=final_draft"><i class="glyphicon glyphicon-file"> 论文终稿</i> <span class="sr-only">(current)</span></a></li>

                <br />
                <li><a href="./tutor.php?func=inquiry_result"><i class="glyphicon glyphicon-search"> 成绩查询 </i><span class="sr-only">(current)</span></a></li>


                <li><a href="./tutor.php?func=excellent_paper"><i class="glyphicon glyphicon-thumbs-up"> 优秀论文 </i><span class="sr-only">(current)</span></a></li>


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
                                include "t_topic_detail.php";
                            } elseif (isset($_GET['cid'])) {
                                include "../secretary_func/sec_suggestion_detail.php";
                            } else {
                                include "t_topic.php";
                            }
                            break;
                        case "chose_student":
                            include "t_chose_student.php";
                            break;
                        case "task_book":
                            if (isset($_GET["id"])) {
                                include "../student_func/stu_task_book_detail.php";
                            } else {
                                include "t_task_book.php";
                            }
                            break;
                        case "first_report":
                            if (isset($_GET["id"])) {
                                include "../student_func/stu_first_report_detail.php";
                            } elseif (isset($_GET["fid"])) {
                                include "t_give_first_report_grade.php";
                            } else {
                                include "t_first_report.php";
                            }
                            break;
                        case "midterm_report":
                            if (isset($_GET["id"])) {
                                include "../student_func/stu_midterm_report_detail.php";
                            } elseif (isset($_GET["fid"])) {
                                include "t_give_first_report_grade.php";
                            } else {
                                include "t_midterm_report.php";
                            }
                            break;
                        case "paper_review":
                        case "answer_information":
                        case "deferred_reply":
                        case "second_reply":
                        case "reply_record":
                        case "final_draft":
                        case "inquiry_result":
                        case "excellent_paper":
                    }
                } else {
                    echo "欢迎";
                }
                ?>
            </div>
        </div>

    </div>
</div>