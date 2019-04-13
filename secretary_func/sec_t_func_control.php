<br />
<div class="alert alert-danger" role="alert"><strong>本页面为老师流程控制页面，请谨慎操作</strong></div>
<?php
include "../link.php";
include "sec_query_t_control.php";
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');
?>

<body>
    <div class="alert alert-info" role="alert">
        <strong>提示：</strong>
        <span><strong>开题流程</strong></span>表示导师可以对开题报告进行评分（开启条件：所有学生全部上交开题报告最终稿或超过提交截止日期）
        <div>
        </div>
    </div>
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
                    <td class="col-xs-5 th-title-center">开题
                        <?php
                        if (!$row_control['first_report_deadline']) {
                            echo "<a data-toggle=\"modal\" data-target=\"#deadline_setting\">（点此添加提交截止日期）<a>";
                        } else {
                            echo "(截止时间为：";
                            echo $row_control['first_report_deadline'];
                            echo "）";
                        }

                        ?>
                    </td>
                    <?php
                    //查看当前提交最终报告学生的数量
                    $sql_final_first_report = "SELECT * from `first_report_record` where `final_flag` = 4";
                    $result_final_first_report = mysqli_query($link, $sql_final_first_report);
                    $num_final_first_report = mysqli_num_rows($result_final_first_report);

                    //查看当前学生人数
                    $sql_user = "SELECT * FROM `user` where `permission` = 'student' ";
                    $result_user = mysqli_query($link, $sql_user);
                    $num_user = mysqli_num_rows($result_user);

                    //当前时间
                    //$today & $row_control['first_report_deadline']

                    if (($num_final_first_report == $num_user) || ($today > $row_control['first_report_deadline']) && ($row_control['first_report'] == 0)) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "当前学生已全部全部上交开题报告最终稿或超过提交截止日期，可以开启学生开题流程";
                    } else if (($row_control['first_report'] == 1)) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "已开启学生开题流程";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-warning\">";
                        echo "当前时间未超过截止日期且学生尚未全部上交开题报告最终稿，不可开启学生开题流程";
                        echo "<a data-toggle=\"modal\" data-target=\"#unupload_list\">(查看未提交名单)</a>";
                    }
                    ?>
                    </td>

                    <td class="col-xs-2 th-title-center">
                        <?php
                        if (($num_final_first_report == $num_user) || ($today > $row_control['first_report_deadline']) && ($row_control['first_report'] == 0)) {
                            echo "<a href='sec_chang_t_control_value.php?func=first_report' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启选题</a>";
                        } else if (($row_control['first_report'] == 1)) {
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

    <div class="modal fade" id="unupload_list" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">人员名单</h4>
                </div>
                <div class="modal-body">
                    <?php
                    //已提交人员名单
                    $sql_do = "SELECT * FROM `first_report_record` WHERE `final_flag` = 4";
                    $result_do = mysqli_query($link, $sql_do);
                    $num_do = mysqli_num_rows($result_do);

                    //全员名单
                    $sql_user = "SELECT * FROM `user` WHERE `permission` = 'student'";
                    $result_user = mysqli_query($link, $sql_user);
                    $num_user = mysqli_num_rows($result_user);
                    echo <<< archemiya
                <div class="fixed-table-container">
            <table width="100%">
                <tr>
                    <td width="50%" style="float: left;margin: 0px;padding: 0px;">
                        <table id="table1" class="table col-md-6" data-toggle="table">
                            <thead>
                                <tr>
                                    <th >
                                        <div class="th-inner th-title-center" >已提交学生名单</div>
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody >
archemiya;
                    for ($i = 0; $i < $num_do; $i++) {
                        $row_do = mysqli_fetch_array($result_do, MYSQLI_BOTH);
                        echo "<tr>";

                        echo "<td class='alert alert-info td-title-center td-height' role='alert'>";
                        echo $row_do['student_id'] . $row_do['student_name'];
                        echo "</td>";
                        echo "</tr>";
                    }
                    echo <<< archemiya
                                
                            </tbody>
                        </table>

                    </td>
                    <td width="50%" style="float: right;margin: 0px;padding: 0px;">
                        <table id="table2" class="table col-md-6" data-toggle="table">
                            <thead>
                                <tr>
                                    <th >
                                        <div class="th-inner th-title-center" >未完成选题学生名单</div>
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody >
archemiya;
                    for ($i = 0; $i < ($num_user - $num_do); $i++) {
                        $row_user = mysqli_fetch_array($result_user, MYSQLI_BOTH);
                        for ($j = 0; $j < $num_do; $j++) {
                            $row_do_check = mysqli_fetch_array($result_do, MYSQLI_BOTH);
                            if ($row_user['id'] == $row_do_check['student_id']) { 
                                $i++;
                                break;
                            }else{
                                echo "<tr>";

                                echo "<td class='alert alert-danger td-title-center td-height' role='alert'>";
                                echo $row_user['id'] . $row_user['name'];
                                echo "</td>";
                                echo "</tr>";
                            }
                        }
                    }


                    echo <<< archemiya
                                
                            </tbody>
                        </table>

                    </td>

                </tr>
            </table>
        </div>

archemiya;
                    ?>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
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