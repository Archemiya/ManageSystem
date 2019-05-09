<!-- 此文件为答辩小组显示 + 分组文件 -->
<?php
include "../link.php";
include "sec_query_stu_control.php";

//当前服务器时间
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');

//查看当前所有人数以及已分配答辩组的人数以及完善答辩详情的人数
$sql_total = "SELECT * FROM `user` where `permission` = 'tutor' or `permission` = 'student' ";
$result_total = mysqli_query($link, $sql_total);
$num_total = mysqli_num_rows($result_total);

$sql_schedule = "SELECT * FROM `second_reply_schedule` where 1";
$result_schedule = mysqli_query($link, $sql_schedule);
$num_schedule = mysqli_num_rows($result_schedule);

$sql_detail = "SELECT * FROM `second_reply_schedule` where `second_reply_schedule`.`place` is not NULL";
$result_detail = mysqli_query($link, $sql_detail);
$num_detail = mysqli_num_rows($result_detail);

//此函数用于输出最终确定的二辩学生名单
function echo_second_reply_schedule_table($link)
{

    $sql_teacher_num = "SELECT * FROM `second_reply_schedule` WHERE  `permission` = 'tutor' ";
    $result_teacher_num = mysqli_query($link, $sql_teacher_num);
    $num_teacher = mysqli_num_rows($result_teacher_num);

    //随意查询一个学生可得答辩时间与地点
    $sql_time = "SELECT * FROM `second_reply_schedule` WHERE `permission` = 'student' ";
    $result_time = mysqli_query($link, $sql_time);
    $row_time = mysqli_fetch_array($result_time, MYSQLI_BOTH);

    //查看当前所有二辩学生 
    $sql_second = "SELECT * FROM `second_reply_schedule` where  `permission` = 'student'";
    $result_second = mysqli_query($link, $sql_second);
    $num_second = mysqli_num_rows($result_second);

    if (isset($row_time['time'])) {
        echo " <div class='alert alert-info' role='alert'>";
        echo "答辩时间为：";
        echo $row_time['time'];
        echo " 答辩地点为：";
        echo $row_time['place'];
        echo "</div>";
    } else {
        echo "";
    }
    echo <<< archemiya
    
    <div class="table-responsive">
        <table data-toggle="table" >
            <thead>
                <tr>
                    <th class="col-md-6 th-title-center" colspan="2">导师名单</th>
                    <th class="col-md-6 th-title-center" colspan="2">学生名单</th>
                </tr>
                <tr>
                    <th class="col-md-3 th-title-center">导师姓名</th>
                    <th class="col-md-3 th-title-center">导师简介</th>
                    <th class="col-md-3 th-title-center">学生姓名</th>
                    <th class="col-md-3 th-title-center">学生选题</th>
                </tr>

            </thead>

            <tbody>
archemiya;

    if ($num_second < $num_teacher) {
        $num_second = $num_teacher;
    }
    for ($i = 0; $i < $num_second; $i++) {
        $row_teacher = mysqli_fetch_array($result_teacher_num, MYSQLI_BOTH);
        $row_student = mysqli_fetch_array($result_second, MYSQLI_BOTH);
        echo "<tr>";

        echo "<td class=\"td-height th-title-center\">";
        echo $row_teacher['id'] . $row_teacher['name'];
        echo "</td>";

        echo "<td class=\"td-height th-title-center\">";
        if ($i < $num_teacher) {
            echo "答辩老师";
        } else {
            echo "";
        }
        echo "</td>";
        echo "<td class=\"td-height th-title-center\">";
        echo   $row_student['id'] . $row_student['name'];
        echo "</td>";
        $sql_topic = "SELECT * FROM `topic`WHERE `student_id` = '{$row_student['id']}' ";
        $result_topic = mysqli_query($link, $sql_topic);
        $row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);
        echo "<td class=\"td-height th-title-center\">";
        echo "<a href='secretary.php?func=second_reply_schedule&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
        echo "</td>";
        echo "</tr>";
    }
    echo <<< archemiya
            </tbody>
        </table>



    </div>
archemiya;
}

?>
<html>

<body>
    <br />
    <div class="alert alert-danger" role="alert">
        <strong>本页面为二次答辩组分配页面，请谨慎操作</strong>
        <br />
        此页面将在<strong>一次答辩结束之后</strong>开放功能，
        二次答辩小组成员将自动由<strong>所有评阅组长</strong>以及
        <strong>参与二次答辩学生</strong>组成，<strong>不需要手动分配</strong>
    </div>
    <?php
    //首先判断是否已经开启二辩流程
    if (!$row_control['second_reply']) {
        echo <<< archemiya
        <div class="alert alert-danger" role="alert">
        当前二辩流程尚未开启，请及时根据教务处安排开启二辩流程
    </div>
archemiya;
    } elseif ($row_control['second_reply']) {
        //查询当前二辩答辩安排表以得知是否应该insert数据
        //（此处由于二辩人员安排可以一锤定音，所以只需要insert一次即可）
        $sql_second = "SELECT * FROM `second_reply_schedule` where 1";
        $result_second = mysqli_query($link, $sql_second);
        $num_second = mysqli_num_rows($result_second);
        //如果当前安排表为空则insert所有人员
        if ($num_second == 0) {
            //查询所有二辩学生
            $sql_second = "SELECT * FROM `reply_schedule` where `second_reply` = 1";
            $result_second = mysqli_query($link, $sql_second);
            $num_second = mysqli_num_rows($result_second);
            //查询所有评阅组长
            $sql_teacher = "SELECT * FROM `reply_schedule` WHERE  `special` = 'reviewer' ";
            $result_teacher = mysqli_query($link, $sql_teacher);
            $num_teacher = mysqli_num_rows($result_teacher);

            for ($i = 0; $i < $num_second; $i++) {
                $row_second = mysqli_fetch_array($result_second, MYSQLI_BOTH);
                $sql_insert = "INSERT INTO `second_reply_schedule`
                (`id`, `name`, `major`, `permission`)
                VALUES (
                '{$row_second['id']}',
                '{$row_second['name']}', 
                '{$row_second['major']}', 
                '{$row_second['permission']}'
                )";
                mysqli_query($link,$sql_insert);
            }
            for ($j = 0; $j < $num_teacher; $j++) {
                $row_teacher = mysqli_fetch_array($result_teacher, MYSQLI_BOTH);
                $sql_insert = "INSERT INTO `second_reply_schedule`
                (`id`, `name`, `major`, `permission`)
                VALUES (
                '{$row_teacher['id']}',
                '{$row_teacher['name']}', 
                '{$row_teacher['major']}', 
                '{$row_teacher['permission']}'
                )";
                mysqli_query($link,$sql_insert);
            }
        }
        //随意查询一个学生可得答辩时间与地点
        $sql_time = "SELECT * FROM `second_reply_schedule` WHERE `permission` = 'student' ";
        $result_time = mysqli_query($link, $sql_time);
        $row_time = mysqli_fetch_array($result_time, MYSQLI_BOTH);
        if (!$row_time['time']) {
            echo <<< archemiya
        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#detail">
        添加答辩安排详情
        </button>
        <p></p>
        <br/>
archemiya;

            echo_second_reply_schedule_table($link);
            echo "<br/>";
        } elseif ($row_time['time']) {
            echo_second_reply_schedule_table($link);
            echo "<br/>";
        }
    }
    ?>
    <!-- 增加答辩详情modaltable -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-alter">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="">添加二辩安排详情</h4>
                </div>
                <div class="modal-body">
                    <form action="sec_update_reply_schedule.php?func=second_detail" class="form-horizontal" method="post">
                        <div class="bootstrap-table">
                            <div class="fixed-table-toolbar">
                                <div class="fixed-table-container">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%" style="float: left;margin: 0px;padding: 0px;">
                                                <br />
                                                <div class="form-group">
                                                    <label for="dtp_input2" class="col-md-4 control-label">选择答辩时间</label>
                                                    <div class="input-group date form_datetime col-md-6" data-date="" data-date-format="yyyy-mm-dd hh:ii" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd hh:ii">
                                                        <?php
                                                        echo "<input name='time' class=\"form-control\" size=\"16\" type=\"text\" value=\"{$today}\" readonly>";
                                                        ?>
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
                                                        <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                                                    </div>
                                                    <input type="hidden" id="dtp_input1" value="" /><br />
                                                </div>

                                            </td>
                                            <td width="50%" style="float: right;margin: 0px;padding: 0px;">
                                                <br />
                                                <div class="form-group">
                                                    <label for="dtp_input2" class="col-md-4 control-label">填写答辩地点</label>
                                                    <div class="input-group col-md-6">

                                                        <input name='place' class="form-control" size="16" type="text">

                                                    </div>
                                                    <input type="hidden" id="dtp_input1" value="" /><br />
                                                </div>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" class="btn btn-default" style="float: right;margin: 10px">确认答辩安排详情</button>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>


                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
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

</html>