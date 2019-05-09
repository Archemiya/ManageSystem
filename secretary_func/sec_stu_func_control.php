<br />
<div class="alert alert-danger" role="alert"><strong>本页面为学生流程控制页面，请谨慎操作</strong></div>
<?php
include "../link.php";
include "sec_query_stu_control.php";

$sql_t_control = "SELECT * from `t_func_control` where `id` = 1";
$result_t_control = mysqli_query($link, $sql_t_control);
$row_t_control = mysqli_fetch_array($result_t_control, MYSQLI_BOTH);

date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');
?>

<body>
    <div class="alert alert-info" role="alert">
        <span><strong>开题流程</strong></span>表示学生可以向答辩导师组递交开题报告最终稿

    </div>
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar">
            <thead>
                <tr>
                    <th class="col-xs-5 th-title-center">学生流程名称</th>
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
                    //查看当前课题数量
                    $sql_topic = "SELECT * FROM `topic`";
                    $result_topic = mysqli_query($link, $sql_topic);
                    $num_topic = mysqli_num_rows($result_topic);

                    //查看当前过审课题数量
                    $sql_passed_topic = "SELECT * FROM `topic` WHERE `topic_ispass` = 1";
                    $result_passed_topic = mysqli_query($link, $sql_passed_topic);
                    $num_passed_topic = mysqli_num_rows($result_passed_topic);
                    if (($num_passed_topic == $num_topic) && ($row_control['topic'] == 0) && ($num_topic != 0)) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "当前课题审核已全部完成，可以开启学生选题流程";
                    } else if (($num_passed_topic == $num_topic) && ($row_control['topic'] == 1)) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "已开启学生选题流程";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "当前课题审核尚未全部完成，不可开启学生选题流程";
                    }
                    ?>
                    </td>

                    <td class="col-xs-2 th-title-center">
                        <?php
                        if (($num_passed_topic == $num_topic) && ($row_control['topic'] == 0) && ($num_topic != 0)) {
                            echo "<a href='sec_chang_stu_control_value.php?func=topic' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启选题</a>";
                        } else if (($num_passed_topic == $num_topic) && ($row_control['topic'] == 1)) {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        } else {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        }
                        ?>
                    </td>


                </tr>
                <tr>
                    <!-- 开题流程开启条件：
                        1.当前学生是否全部完成选题
                        2.当前学生是否全部确认任务书
                        3.当前学生是否全部分配至相对应的答辩组                
                    -->
                    <td class="col-xs-5 th-title-center">开题
                        <?php
                        if (!$row_t_control['first_report_deadline']) {
                            echo "<a data-toggle=\"modal\" data-target=\"#deadline_setting\">（点此添加提交截止日期）<a>";
                        } else {
                            echo "(截止时间为：";
                            echo $row_t_control['first_report_deadline'];
                            echo "）";
                        }
                        ?>
                    </td>
                    <?php
                    //查看当前学生人数
                    $sql_user = "SELECT * FROM `user` where `permission` = 'student' ";
                    $result_user = mysqli_query($link, $sql_user);
                    $num_user = mysqli_num_rows($result_user);

                    //分配至答辩小组的人数，即查看当前有多少人已分配至答辩小组
                    $sql_reply = "SELECT * FROM `reply_schedule` where `permission` = 'student' ";
                    $result_reply = mysqli_query($link, $sql_reply);
                    $num_reply = mysqli_num_rows($result_reply);

                    //查看当前完成选题的学生数量
                    $sql_stu_chosed = "SELECT * FROM `chose_topic_record` WHERE `final_flag` = 1";
                    $result_stu_chosed = mysqli_query($link, $sql_stu_chosed);
                    $num_stu_chosed = mysqli_num_rows($result_stu_chosed);

                    //查看当前确认任务书的学生数量
                    $sql_task_book = "SELECT * from `task_book` where `islook_flag` = 1";
                    $result_task_book = mysqli_query($link, $sql_task_book);
                    $num_task_book = mysqli_num_rows($result_task_book);

                    if (($num_stu_chosed == $num_topic)
                        && ($row_control['first_report'] == 0)
                        && ($num_user == $num_reply)
                        && ($num_user == $num_task_book)
                        && ($row_t_control['first_report_deadline'])
                    ) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "当前学生已全部完成选题，确认其任务书且答辩小组分配完毕，可以开启学生开题流程";
                    } else if (($num_stu_chosed == $num_topic)
                        && ($row_control['first_report'] == 1)
                        && ($num_user == $num_reply)
                        && ($num_user == $num_task_book)
                    ) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "已开启学生开题流程";
                    } elseif (($num_stu_chosed == $num_topic)
                        && ($row_control['first_report'] == 0)
                        && ($num_user == $num_reply)
                        && ($num_user == $num_task_book)
                        && (!$row_t_control['first_report_deadline'])
                    ) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\" >";
                        echo "请设置上交最终稿截止时间";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "当前学生尚未全部完成选题并确认其任务书或答辩小组未分配完毕，不可开启学生开题流程";
                    }
                    ?>
                    </td>

                    <td class="col-xs-2 th-title-center">
                        <?php
                        if (($num_stu_chosed == $num_topic)
                            && ($row_control['first_report'] == 0)
                            && ($num_user == $num_reply)
                            && ($num_user == $num_task_book)
                            && ($row_t_control['first_report_deadline'])
                        ) {
                            echo "<a href='sec_chang_stu_control_value.php?func=first_report' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启开题</a>";
                        } else if (($num_stu_chosed == $num_topic)
                            && ($row_control['first_report'] == 1)
                            && ($num_user == $num_reply)
                            && ($num_user == $num_task_book)
                        ) {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        } elseif (($num_stu_chosed == $num_topic)
                            && ($row_control['first_report'] == 0)
                            && ($num_user == $num_reply)
                            && ($num_user == $num_task_book)
                            && (!$row_t_control['first_report_deadline'])
                        ) {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        } else {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        }
                        ?>
                    </td>


                </tr>
                <tr>
                    <!-- 
                        中期报告开启条件：
                        此处中期报告流程控制不可控制学生与老师间的中期报告交互功能，只可起到规定截止时间的作用，即到达截止
                     -->
                    <td class="col-xs-5 th-title-center">中期报告
                        <?php
                        if (!$row_control['midterm_deadline']) {
                            echo "<a data-toggle=\"modal\" data-target=\"#midterm_deadline_setting\">（点此添加提交截止日期）<a>";
                        } else {
                            echo "(截止时间为：";
                            echo $row_control['midterm_deadline'];
                            echo "）";
                        }
                        ?>
                    </td>
                    <?php

                    if ((!$row_control['midterm_deadline']) && $row_control['midterm_deadline'] == NULL) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "请根据学校要求及时设置截止日期";
                    } elseif ((!$row_t_control['first_report'])) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "当前开题流程尚未完全开启";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\">";
                        echo "已开启学生中期流程";
                    }
                    ?>
                    </td>

                    <td class="col-xs-2 th-title-center">
                        <?php
                        if ((!$row_control['midterm_deadline']) && $row_control['midterm_deadline'] == NULL) {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        } elseif ((!$row_t_control['first_report'])) {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        } else {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        }

                        ?>
                    </td>


                </tr>
                <tr>
                    <!-- 
                        论文初稿开启条件：
                        无特殊开启条件，由答辩秘书自行控制
                     -->
                    <td class="col-xs-5 th-title-center">论文初稿
                        <?php
                        if (!$row_control['first_paper_deadline']) {
                            echo "<a data-toggle=\"modal\" data-target=\"#first_paper_deadline_setting\">（点此添加提交截止日期）<a>";
                        } else {
                            echo "(截止时间为：";
                            echo $row_control['first_paper_deadline'];
                            echo "）";
                        }
                        ?>
                    </td>
                    <?php

                    if ((!$row_control['first_paper']) && $row_control['first_paper_deadline'] == NULL) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "请根据学校要求及时设置截止日期并打开论文初稿提交流程";
                    } elseif ((!$row_control['first_paper'])) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "请根据学校要求及时打开论文初稿提交流程";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\">";
                        echo "已开启学生论文初稿流程";
                    }
                    ?>
                    </td>

                    <td class="col-xs-2 th-title-center">
                        <?php
                        if ((!$row_control['first_paper']) && $row_control['first_paper_deadline'] == NULL) {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        } elseif ((!$row_control['first_paper'])) {
                            echo "<a href='sec_chang_stu_control_value.php?func=first_paper' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启论文初稿</a>";
                        } else {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <!-- 
                        一次答辩开启条件：
                            必须等待所有延期答辩申请审核结束&所有的答辩安排详情添加完毕

                            ***注意此处是审核结束，不是到达截止时间，注意区别。
                            此处实现需要查询时候不存在申请状态码为2的学生，如果存在即表示有学生的申请未完成审核

                     -->
                    <td class="col-xs-5 th-title-center">一次答辩</td>
                    <?php
                    //查看当前所有申请状态 = 2的学生 （通过查询所有状态为2的学生来判断是否有学生未完成申请审核）
                    $sql_delay = "SELECT * FROM `reply_schedule` where `reply_delay` =2";
                    $result_delay = mysqli_query($link, $sql_delay);
                    $num_delay = mysqli_num_rows($result_delay);

                    //查看当前所有答辩安排详情
                    $sql_detail = "SELECT * FROM `reply_schedule` where `reply_schedule`.`place` is NULL";
                    $result_detail = mysqli_query($link, $sql_detail);
                    $num_detail = mysqli_num_rows($result_detail);

                    if ($num_delay != 0 && $row_control['reply_delay'] == 0) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\" >";
                        echo "当前延期答辩审核尚未全部完成，不可开启学生一次答辩流程";
                    } elseif ($num_delay == 0 && $row_control['first_reply'] == 0 && $num_detail) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\" >";
                        echo "当前答辩详情安排尚未全部完成，请及时完善答辩详情信息";
                    } else if ($num_delay == 0 && $row_control['first_reply'] == 0 && !$num_detail) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "当前可以开启学生一次答辩流程，请根据学校要求及时开启";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\">";
                        echo "当前学生一次答辩流程已开启";
                    }
                    ?>
                    </td>
                    <td class="col-xs-2 th-title-center">
                        <?php
                        if ($num_delay != 0 && $row_control['reply_delay'] == 0) {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        } elseif ($num_delay == 0 && $row_control['first_reply'] == 0 && $num_detail) {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        } else if ($num_delay == 0 && $row_control['first_reply'] == 0 && !$num_detail) {
                            echo "<a href='sec_chang_stu_control_value.php?func=first_reply' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启选题</a>";
                        } else {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        }
                        ?>
                    </td>


                </tr>
                <tr>
                    <!-- 
                        论文终稿开启条件：
                        一次答辩结束即可，之后需要答辩秘书自行判断
                        此处以一辩学生全部完成一辩评分为节点，全部评分完毕即表示一辩结束
                     -->
                    <td class="col-xs-5 th-title-center">论文终稿
                        <?php
                        if (!$row_control['final_paper_deadline']) {
                            echo "<a data-toggle=\"modal\" data-target=\"#final_paper_deadline_setting\">（点此添加提交截止日期）<a>";
                        } else {
                            echo "(截止时间为：";
                            echo $row_control['final_paper_deadline'];
                            echo "）";
                        }
                        ?>
                    </td>
                    <?php
                    //判断一辩是否结束
                    //判断已完成一辩评分的学生数量
                    $sql_final_grade_num = "SELECT * FROM `student_grade` 
                    where `reply_grade_final_flag` = 1 ";
                    $result_final_grade_num = mysqli_query($link, $sql_final_grade_num);
                    $num_final_grade_num = mysqli_num_rows($result_final_grade_num);

                    //查看当前所有一辩学生的数量
                    $sql_first = "SELECT * FROM `reply_schedule` where `permission` = 'student' 
                    AND `first_paper_flag` = 1 AND `reply_delay`=0 ";
                    $result_first = mysqli_query($link, $sql_first);
                    $num_first = mysqli_num_rows($result_first);

                    if ($num_first > $num_final_grade_num) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "当前一辩评分工作尚未完成，请等待导师评分完成";
                    } elseif ((!$row_control['final_paper'])
                        && $row_control['final_paper_deadline'] == NULL
                        && $num_first == $num_final_grade_num
                    ) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "请根据学校要求及时设置截止日期并打开论文终稿提交流程";
                    } elseif ((!$row_control['final_paper'])) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "请根据学校要求及时打开论文终稿提交流程";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\">";
                        echo "已开启学生论文终稿流程";
                    }
                    ?>
                    </td>

                    <td class="col-xs-2 th-title-center">
                        <?php
                        if ($num_first > $num_final_grade_num) {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        } elseif ((!$row_control['final_paper'])
                            && $row_control['final_paper_deadline'] == NULL
                            && $num_first == $num_final_grade_num
                        ) {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        } elseif ((!$row_control['final_paper'])) {
                            echo "<a href='sec_chang_stu_control_value.php?func=final_paper' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启论文终稿</a>";
                        } else {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        }

                        ?>
                    </td>
                </tr>
                <tr>
                    <!-- 
                        二次答辩开启条件：
                        所有导师对一辩学生完成评分之后才可开启二辩，即知晓所有一辩未及格学生
                     -->
                    <td class="col-xs-5 th-title-center">二次答辩
                    </td>
                    <?php
                    //判断已完成一辩评分的学生数量
                    $sql_final_grade_num = "SELECT * FROM `student_grade` 
                    where `reply_grade_final_flag` = 1 ";
                    $result_final_grade_num = mysqli_query($link, $sql_final_grade_num);
                    $num_final_grade_num = mysqli_num_rows($result_final_grade_num);

                    //查看当前所有一辩学生的数量
                    $sql_first = "SELECT * FROM `reply_schedule` where `permission` = 'student' 
                    AND `first_paper_flag` = 1 AND `reply_delay`=0 ";
                    $result_first = mysqli_query($link, $sql_first);
                    $num_first = mysqli_num_rows($result_first);

                    if ($num_first > $num_final_grade_num) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "当前一辩评分工作尚未完成，请等待导师评分完成";
                    } elseif ((!$row_control['second_reply'])
                        && $num_first == $num_final_grade_num
                    ) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "请根据学校要求及时打开二次答辩流程";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\">";
                        echo "已开启学生二次答辩流程";
                    }
                    ?>
                    </td>

                    <td class="col-xs-2 th-title-center">
                        <?php
                        if ($num_first > $num_final_grade_num) {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
                        } elseif ((!$row_control['second_reply'])
                            && $num_first == $num_final_grade_num
                        ) {
                            echo "<a href='sec_chang_stu_control_value.php?func=second_reply' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启二次答辩</a>";
                        } else {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        }

                        ?>
                    </td>
                </tr>
            </tbody>
        </table>



    </div>
    <div class="modal fade" id="deadline_setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加最终报告提交截止时间</h4>
                </div>
                <div class="modal-body">
                    <form action="../deadline-setting.php?func=first_report " method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="dtp_input2" class="col-md-4 control-label">选择日期</label>
                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <?php
                                echo "<input name='deadline' class=\"form-control\" size=\"16\" type=\"text\" value=\"{$today}\" readonly>";
                                ?>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input2" value="" /><br />
                            <button type="submit" class="col-sm-offset-4 btn btn-default" onclick="Javascript:return confirm('确定要上传么？此操作不可逆转');">确认截止时间</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="midterm_deadline_setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加中期报告提交截止时间</h4>
                </div>
                <div class="modal-body">
                    <form action="../deadline-setting.php?func=midterm " method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="dtp_input2" class="col-md-4 control-label">选择日期</label>
                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <?php
                                echo "<input name='deadline' class=\"form-control\" size=\"16\" type=\"text\" value=\"{$today}\" readonly>";
                                ?>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input2" value="" /><br />
                            <button type="submit" class="col-sm-offset-4 btn btn-default" onclick="Javascript:return confirm('确定要上传么？此操作不可逆转');">确认截止时间</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="first_paper_deadline_setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加论文初稿提交截止时间</h4>
                </div>
                <div class="modal-body">
                    <form action="../deadline-setting.php?func=first_paper " method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="dtp_input2" class="col-md-4 control-label">选择日期</label>
                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <?php
                                echo "<input name='deadline' class=\"form-control\" size=\"16\" type=\"text\" value=\"{$today}\" readonly>";
                                ?>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input2" value="" /><br />
                            <button type="submit" class="col-sm-offset-4 btn btn-default" onclick="Javascript:return confirm('确定要上传么？此操作不可逆转');">确认截止时间</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="final_paper_deadline_setting" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">添加论文终稿提交截止时间</h4>
                </div>
                <div class="modal-body">
                    <form action="../deadline-setting.php?func=final_paper " method="post" class="form-horizontal">
                        <div class="form-group">
                            <label for="dtp_input2" class="col-md-4 control-label">选择日期</label>
                            <div class="input-group date form_date col-md-5" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                                <?php
                                echo "<input name='deadline' class=\"form-control\" size=\"16\" type=\"text\" value=\"{$today}\" readonly>";
                                ?>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                            </div>
                            <input type="hidden" id="dtp_input2" value="" /><br />
                            <button type="submit" class="col-sm-offset-4 btn btn-default" onclick="Javascript:return confirm('确定要上传么？此操作不可逆转');">确认截止时间</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
        $('.form_date').datetimepicker({
            language: 'zh-CN',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
        $('.form_time').datetimepicker({
            //language: 'fr',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0
        });
    </script>
</body>