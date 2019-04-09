<?php
session_start();
if (!isset($_SESSION['user_id']) || ($_SESSION['user_permission'] != 'secretary')) {
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
                <li><a href="./secretary.php?func=review_topic" method="GET" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "review_topic") {
                                                                                    echo "class=active";
                                                                                } ?>><i class="glyphicon glyphicon-list-alt">
                            课题审核</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./secretary.php?func=lesson_record" method="GET" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "lesson_record") {
                                                                                    echo "class=active";
                                                                                } ?>><i class="glyphicon glyphicon-pencil">
                            指导记录</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./secretary.php?func=reply_schedule" method="GET" <?php if (isset($_GET["func"]) && ($_GET["func"]) == "reply_schedule") {
                                                                                echo "class=active";
                                                                            } ?>><i class="glyphicon glyphicon-sort-by-alphabet">
                            答辩安排</i><span class="sr-only">(current)</span></a></li>

                <br />
                <li><a href="./secretary.php?func=stu_func_control" <?php if ((isset($_GET["func"]) && ($_GET["func"]) == "stu_func_control")) {
                                                                        echo "class=active";
                                                                    } ?>><i class="glyphicon glyphicon-sort"> 学生流程</i><span class="sr-only">(current)</span></a></li>


                <li><a href="./secretary.php?func=t_func_control" <?php if ((isset($_GET["func"]) && ($_GET["func"]) == "t_func_control")) {
                                                                        echo "class=active";
                                                                    } ?>><i class="glyphicon glyphicon-sort"> 导师流程</i><span class="sr-only">(current)</span></a></li>



            </ul>
        </div>
    </div>
    <div class="col-sm-sidebar-right col-sm-offset-right main">
        <div class="centeredalter">
            <?php
            if (isset($_GET["func"])) {
                $result = $_GET["func"];
                switch ($result) {
                    case "review_topic":
                        if (isset($_GET["id"])) {
                            include "sec_review_topic_detail.php";
                        } else {
                            include "sec_review_topic.php";
                        }
                        break;
                    case "lesson_record":
                        include "sec_test_2.php";
                        break;
                    case "reply_schedule":
                        include "sec_reply_schedule.php";
                        break;
                    case "stu_func_control":
                        include "sec_stu_func_control.php";
                        break;
                    case "t_func_control":
                        include "sec_t_func_control.php";
                        break;
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