<br />
<div class="alert alert-danger" role="alert"><strong>本页面为学生流程控制页面，请谨慎操作</strong></div>
<?php
include "../link.php";
include "sec_query_stu_control.php";
$sql_t_control = "SELECT * from `t_func_control` where `id` = 1";
$result_t_control = mysqli_query($link, $sql_t_control);
$row_t_control = mysqli_fetch_array($result_t_control);

date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');
?>

<body>
    <div class="alert alert-info" role="alert">
        <strong>提示：</strong>
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
                        ) {
                            echo "<a href='sec_chang_stu_control_value.php?func=first_report' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启选题</a>";
                        } else if (($num_stu_chosed == $num_topic)
                            && ($row_control['first_report'] == 1)
                            && ($num_user == $num_reply)
                            && ($num_user == $num_task_book)
                        ) {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        } else {
                            echo "<button class='btn btn-warning' disabled>不可操作</button>";
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
    <script type="text/javascript" src="../js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            //language:  'fr',
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