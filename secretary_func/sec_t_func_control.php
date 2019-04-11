<br />
<div class="alert alert-danger" role="alert"><strong>本页面为老师流程控制页面，请谨慎操作</strong></div>
<?php
include "../link.php";
include "sec_query_t_control.php";
?>

<body>

    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar">
            <thead>
                <tr>
                    <th class="col-xs-5 th-title-center">老师流程名称</th>
                    <th class="col-xs-5 th-title-center">状态说明</th>
                    <th class="col-xs-2 th-title-center"> 操作</th>

                </tr>
            </thead>
            <tbody>
                <div id="toolbar">
                </div>
                <tr>
                    <td class="col-xs-5 th-title-center">论文选题</td>

                    <?php
                    if ($row_control['topic'] == 0) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-danger\"> 请根据学校安排准时开启老师论文选题流程！</td>";
                    } else if ($row_control['topic'] == 1) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\">已开启老师论文选题流程</td>";
                    }
                    ?>


                    <td class="col-xs-2 th-title-center">
                        <?php

                        if ($row_control['topic'] == 0) {
                            echo "<a href='sec_chang_t_control_value.php?func=topic' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启选题</a>";
                        } else if ($row_control['topic'] == 1) {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        }
                        ?>
                    </td>


                </tr>
                <tr>
                    <td class="col-xs-5 th-title-center">开题</td>
                    <?php
                    $sql_topic = "SELECT * FROM `topic`";
                    $sql_user = "SELECT * FROM `user` ";
                    $sql_reply_group = "SELECT * FROM `reply_schedule` ";
                    $sql_stu_chosed = "SELECT * FROM `chose_topic_record` WHERE `final_flag` = 1";
                    $result_topic = mysqli_query($link, $sql_topic);
                    $result_user = mysqli_query($link, $sql_user);
                    $result_reply_group = mysqli_query($link, $sql_reply_group);
                    $result_stu_chosed = mysqli_query($link, $sql_stu_chosed);
                    $num_topic = mysqli_num_rows($result_topic);
                    $num_user = mysqli_num_rows($result_user);
                    $num_reply_group = mysqli_num_rows($result_reply_group);
                    $num_stu_chosed = mysqli_num_rows($result_stu_chosed);
                    if (($num_stu_chosed == $num_topic) && ($row_control['first_report'] == 0) && ($num_user == $num_reply_group)) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "当前学生已全部完成选题且答辩小组分配完毕，可以开启老师开题流程";
                    } else if (($num_stu_chosed == $num_topic) && ($row_control['first_report'] == 1) && ($num_user == $num_reply_group)) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "已开启学生开题流程";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-danger\">";
                        echo "当前学生尚未全部完成选题或答辩小组未分配完毕，不可开启老师开题流程";
                    }
                    ?>
                    </td>

                    <td class="col-xs-2 th-title-center">
                        <?php
                        if (($num_stu_chosed == $num_topic) && ($row_control['first_report'] == 0) && ($num_user == $num_reply_group)) {
                            echo "<a href='sec_chang_stu_control_value.php?func=first_report' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启选题</a>";
                        } else if (($num_stu_chosed == $num_topic) && ($row_control['first_report'] == 1) && ($num_user == $num_reply_group)) {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        } else {
                            echo "<button class='btn btn-danger' disabled>不可操作</button>";
                        }
                        ?>
                    </td>


                </tr>
            </tbody>
        </table>



    </div>
</body>