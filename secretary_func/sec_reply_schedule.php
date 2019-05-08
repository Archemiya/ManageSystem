<!-- 此文件为答辩小组显示 + 分组文件 -->
<?php
include "../link.php";
include "sec_query_stu_control.php";

//当前服务器时间
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');

//查看当前完成选题的学生数量
$sql_stu_chosed = "SELECT * FROM `chose_topic_record` WHERE `final_flag` = 1";
$result_stu_chosed = mysqli_query($link, $sql_stu_chosed);
$num_stu_chosed = mysqli_num_rows($result_stu_chosed);

//查看当前课题数量
$sql_topic = "SELECT * FROM `topic`";
$result_topic = mysqli_query($link, $sql_topic);
$num_topic = mysqli_num_rows($result_topic);

//查看当前已过审课题数量
$sql_topic_ispass = "SELECT * FROM `topic` where `topic_ispass` = 1";
$result_topic_ispass = mysqli_query($link, $sql_topic_ispass);
$num_topic_ispass = mysqli_num_rows($result_topic_ispass);

//查看当前所有人数以及已分配答辩组的人数以及完善答辩详情的人数
$sql_total = "SELECT * FROM `user` where `permission` = 'tutor' or `permission` = 'student' ";
$result_total = mysqli_query($link, $sql_total);
$num_total = mysqli_num_rows($result_total);

$sql_schedule = "SELECT * FROM `reply_schedule` where 1";
$result_schedule = mysqli_query($link, $sql_schedule);
$num_schedule = mysqli_num_rows($result_schedule);

$sql_detail = "SELECT * FROM `reply_schedule` where `reply_schedule`.`place` is not NULL";
$result_detail = mysqli_query($link, $sql_detail);
$num_detail = mysqli_num_rows($result_detail);

//查看当前所有申请状态 = 2的学生 （通过查询所有状态为2的学生来判断是否有学生未完成申请审核）
$sql_delay = "SELECT * FROM `reply_schedule` where `reply_delay` =2";
$result_delay = mysqli_query($link, $sql_delay);
$num_delay = mysqli_num_rows($result_delay);

//此函数输出所有已分配好的答辩小组名单
function echo_first_schedule_table($i, $link)
{
    $group_id = $i + 1;
    $sql_teacher_num = "SELECT * FROM `reply_schedule` WHERE `group_id` = '{$group_id}' AND `permission` = 'tutor' ";
    $result_teacher_num = mysqli_query($link, $sql_teacher_num);
    $num_teacher = mysqli_num_rows($result_teacher_num);

    $sql_student_num = "SELECT * FROM `reply_schedule` WHERE `group_id` = '{$group_id}' AND `permission` = 'student' ";
    $result_student_num = mysqli_query($link, $sql_student_num);
    $num_student = mysqli_num_rows($result_student_num);

    echo <<< archemiya
    
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#{$group_id}">
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
                <div id="{$group_id}">
                    <button type="button" class="btn btn-default active" > 
archemiya;
    echo "第 " . $group_id . " 小组";
    echo <<< archemiya
                </button>
                </div>
archemiya;
    for ($i = 0; $i < $num_student; $i++) {
        $row_teacher = mysqli_fetch_array($result_teacher_num, MYSQLI_BOTH);
        $row_student = mysqli_fetch_array($result_student_num, MYSQLI_BOTH);
        echo "<tr>";

        echo "<td class=\"td-height th-title-center\">";
        echo $row_teacher['id'] . $row_teacher['name'];
        echo "</td>";

        echo "<td class=\"td-height th-title-center\">";
        if (!$i) {
            echo "答辩组长";
        } else if ($i < $num_teacher) {
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
        echo "<a href='secretary.php?func=reply_schedule&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
        echo "</td>";

        echo "</tr>";
    }
    echo <<< archemiya
            </tbody>
        </table>



    </div>
archemiya;
}

//此函数用于输出最终确定的一辩学生名单
function echo_reply_schedule_table($i, $link)
{
    $group_id = $i + 1;

    $sql_teacher_num = "SELECT * FROM `reply_schedule` WHERE `group_id` = '{$group_id}' AND `permission` = 'tutor' ";
    $result_teacher_num = mysqli_query($link, $sql_teacher_num);
    $num_teacher = mysqli_num_rows($result_teacher_num);

    //随意查询一个学生可得答辩时间与地点
    $sql_time = "SELECT * FROM `reply_schedule` WHERE `group_id` = '{$group_id}' AND `permission` = 'student' ";
    $result_time = mysqli_query($link, $sql_time);
    $row_time = mysqli_fetch_array($result_time, MYSQLI_BOTH);

    /* 对于答辩组的学生说明：
        可以参加一辩的条件：
            1 论文初稿审核完成
            2 未申请延期答辩                     
    */

    $sql_student_num = "SELECT * FROM `reply_schedule`
    WHERE `group_id` = '{$group_id}' AND `permission` = 'student' AND `reply_delay` = 0 AND `first_paper_flag` = 1";
    $result_student_num = mysqli_query($link, $sql_student_num);
    $result_student = mysqli_query($link, $sql_student_num);
    $num_student = mysqli_num_rows($result_student_num);

    if (isset($row_time['time'])) {
        echo " <div class='alert alert-info' role='alert'>";
        echo "第 " . $group_id . " 小组";
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
        <table data-toggle="table" data-toolbar="#{$group_id}">
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
                <div id="{$group_id}">
                    <button type="button" class="btn btn-default active" > 
archemiya;
    echo "第 " . $group_id . " 小组";
    echo <<< archemiya
                </button>
                </div>
archemiya;
    if ($num_student >= $num_teacher) {
        $num_student = $num_student;
    } else {
        $num_student = $num_teacher;
    }
    for ($i = 0; $i < $num_student; $i++) {
        $row_teacher = mysqli_fetch_array($result_teacher_num, MYSQLI_BOTH);
        $row_student = mysqli_fetch_array($result_student, MYSQLI_BOTH);
        echo "<tr>";

        echo "<td class=\"td-height th-title-center\">";
        echo $row_teacher['id'] . $row_teacher['name'];
        echo "</td>";

        echo "<td class=\"td-height th-title-center\">";
        if (!$i) {
            echo "答辩组长";
        } else if ($i < $num_teacher) {
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
        echo "<a href='secretary.php?func=reply_schedule&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
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

<head>
    <!-- js脚本实现答辩小组分配按钮的全部功能 -->
    <script language="javascript" type="text/javascript">
        var t_idtemp = 1;
        var stu_idtemp = 1;

        function showName(temp, id) {
            var xmlhttp;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $('#hezi' + temp).val(xmlhttp.responseText)
                }
            }
            xmlhttp.open("POST", "sec_display_name.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id=" + id);
        }

        function showName2(temp, id) {
            var xmlhttp;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    $('#hezi_stu' + temp).val(xmlhttp.responseText)
                }
            }
            xmlhttp.open("POST", "sec_display_name.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("id=" + id);
        }
        $(document).ready(function() {
            $("#number1").keypress(
                function() {
                    if (event.keyCode == "13") {
                        //创建一个节点
                        //创建tr
                        $height = $("#number1").val();
                        for ($i = 0; $i < $height; $i++) {
                            t_idtemp += 1;
                            var $tr = $("<tr></tr>");
                            var $li1 = "<td class='td-title-center'>答辩老师</td>";
                            var $li2 = "<td> <input id='id_t_" + t_idtemp + "' name='t_" + t_idtemp + "_id' class='form-control' onkeyup='showName(" + t_idtemp + ",this.value)' autocomplete='off'> </td>"
                            var $li3 = "<td> <input id='hezi" + t_idtemp + "' name='t_" + t_idtemp + "_name' class='form-control'  readonly> </td>"
                            var $li4 = "<td> <butto type='button' id='del_t_" + t_idtemp + "' class='btn btn-default' autocomplete='off' onclick=''>删除 </button></td>"
                            //将获取的 name Email phone 的值追加到tr中
                            $tr.append($li1, $li2, $li3, $li4);
                            //将获取的tr 追加到 table中
                            $('#table_1_tbody').append($tr);
                            $("#del_t_" + t_idtemp).click(function() {
                                var p1 = this.parentNode;
                                var p2 = p1.parentNode;
                                t_idtemp -= 1;
                                $(p2).remove();
                            });
                        }
                    }
                }
            );
            $("#number2").keypress(
                function() {
                    if (event.keyCode == "13") {
                        //创建一个节点
                        //创建tr
                        $height = $("#number2").val();
                        for ($i = 0; $i < $height; $i++) {
                            stu_idtemp += 1;
                            var $tr = $("<tr></tr>");
                            var $li1 = "<td class='td-title-center'> No." + stu_idtemp + "</td>";
                            var $li2 = "<td> <input id='id_stu_" + stu_idtemp + "' name='stu_" + stu_idtemp + "_id' class='form-control' onkeyup='showName2(" + stu_idtemp + ",this.value)'  autocomplete='off'> </td>"
                            var $li3 = "<td> <input <input id='hezi_stu" + stu_idtemp + "' name='stu_" + stu_idtemp + "_name' class='form-control' readonly> </td>"
                            var $li4 = "<td> <button type='button' id='del_stu_" + stu_idtemp + "' class='btn btn-default' autocomplete='off' >删除 </td>"
                            //将获取的 name Email phone 的值追加到tr中
                            $tr.append($li1, $li2, $li3, $li4);
                            //将获取的tr 追加到 table中
                            $('#table_2_tbody').append($tr);
                            $("#del_stu_" + stu_idtemp).click(function() {
                                var p1 = this.parentNode;
                                var p2 = p1.parentNode;
                                stu_idtemp -= 1;
                                $(p2).remove();
                            });
                        }
                    }
                }
            );
        });
    </script>
</head>

<body>
    <br />
    <div class="alert alert-danger" role="alert">
        <strong>本页面为答辩组分配页面，请谨慎操作</strong>
        <br />
        答辩秘书应在<strong>开题阶段分配好所有的开题答辩小组</strong>，
        分配好答辩小组后可在<strong>后期添加答辩安排详情</strong>,
        最后系统会根据学生的<strong>论文初稿审核情况和延期答辩申请情况</strong>确定一辩的最终人员名单
    </div>
    <?php

    $group_num = 0;

    //以下代码用于输出已完成选题的学生和未完成选题的学生
    for ($i = 1;; $i++) { //使用循环判断已有答辩组数量
        $sql_group_num = "SELECT * FROM `reply_schedule` WHERE `group_id` = '{$i}'";
        $result_group_num = mysqli_query($link, $sql_group_num);
        $num_group_num = mysqli_num_rows($result_group_num);
        if (!$num_group_num) {
            break;
        } else {
            $group_num += 1;
        }
    }
    if ($num_stu_chosed != $num_topic && $num_topic == $num_topic_ispass) {
        //比较 选题学生数 和 全部课题数 来得出当前学生是否全部完成选题
        $sql_chose = "SELECT * FROM `user` WHERE `topic_ischose` = 1 AND `permission`='student'";
        $result_chose = mysqli_query($link, $sql_chose);
        $num_chose = mysqli_num_rows($result_chose);

        $sql_unchose = "SELECT * FROM `user` WHERE `topic_ischose` = 0 AND `permission`='student'";
        $result_unchose = mysqli_query($link, $sql_unchose);
        $num_unchose = mysqli_num_rows($result_unchose);

        echo <<< archemiya
        <div class="alert alert-danger" role="alert">
            <strong>尚有学生未完成选题，不可进行答辩小组分配</strong>
        </div>
        <div class="fixed-table-container">
            <table width="100%">
                <tr>
                    <td width="50%" style="float: left;margin: 0px;padding: 0px;">
                        <table id="table1" class="table col-md-6" data-toggle="table">
                            <thead>
                                <tr>
                                    <th >
                                        <div class="th-inner th-title-center" >已完成选题学生名单</div>
                                    </th>
                                    
                                </tr>
                            </thead>
                            <tbody >
archemiya;
        for ($i = 0; $i < $num_chose; $i++) {
            $row_chose = mysqli_fetch_array($result_chose, MYSQLI_BOTH);
            echo "<tr>";

            echo "<td class='alert alert-info td-title-center td-height' role='alert'>";
            echo $row_chose['id'] . $row_chose['name'];
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
        for ($i = 0; $i < $num_unchose; $i++) {
            $row_unchose = mysqli_fetch_array($result_unchose, MYSQLI_BOTH);
            echo "<tr>";

            echo "<td class='alert alert-danger td-title-center td-height' role='alert'>";
            echo $row_unchose['id'] . $row_unchose['name'];
            echo "</td>";
            echo "</tr>";
        }
        echo <<< archemiya
                            </tbody>
                        </table>
                    </td>
                </tr>               
            </table>
        </div>        
archemiya;
        //以上为输出已完成选题学生和未完成选题学生名单

    } elseif (!$num_topic) {
        echo <<< archemiya
        <div class="alert alert-danger" role="alert">
            <strong>尚无导师提交课题</strong>
        </div>
archemiya;
    } elseif ($num_topic != $num_topic_ispass) {
        echo <<< archemiya
        <div class="alert alert-danger" role="alert">
            <strong>当前导师课题尚未全部过审</strong>
        </div>
archemiya;
    }
    //判断是否所有学生已经完成选题
    elseif (
        $num_topic == $num_topic_ispass
        && $today <= $row_control['delay_reply_deadline']
        && $row_control['delay_reply_deadline'] != NULL
    ) {
        if ($num_total != $num_schedule) {
            echo <<< archemiya
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#table">
            添加答辩小组
            </button>
archemiya;
        }
        for ($i = 0; $i < $group_num; $i++) {
            echo_first_schedule_table($i, $link);
            echo "<br/>";
        }
    }
    /* 
    答辩安排详情应在最终参加一辩的学生名单产生之后 即 所有延期答辩申请审核已结束 
    && 同时确保所有组还未完善信息，若全部完善，则同样应该关闭
    */ 
    elseif ($num_delay == 0
    && $num_detail < $num_total) {
        echo <<< archemiya
        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#detail">
        添加答辩安排详情
        </button>
        <p></p>
        <br/>
archemiya;
        for ($i = 0; $i < $group_num; $i++) {
            echo_reply_schedule_table($i, $link);
            echo "<br/>";
        }
    }
    elseif ($num_delay == 0
    && $num_detail == $num_total) {
        for ($i = 0; $i < $group_num; $i++) {
            echo_reply_schedule_table($i, $link);
            echo "<br/>";
        }
    }
    ?>
    <!-- 增加答辩小组modaltable -->
    <div class="modal fade" id="table" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-alter">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="">新增答辩小组</h4>
                </div>

                <div class="modal-body">
                    <form action="sec_update_reply_schedule.php?func=group" method="post" onkeypress="if(event.keyCode==13){return false;}">
                        <div class="bootstrap-table">
                            <div class="fixed-table-toolbar">
                                <div class="bars">
                                    <div id="toolbar">

                                        <table width="100%">
                                            <tbody>
                                                <tr>
                                                    <td width="110px" style="float: left;margin-right: 10px">
                                                        <input id="number1" class="form-control" autocomplete="off" placeholder="老师增加人数">

                                                    </td>
                                                    <td width="110px" style="float: left">
                                                        <input id="number2" class="form-control" autocomplete="off" placeholder="学生增加人数">
                                                    </td>
                                                    <td width="110px" style="float: right">
                                                        <input id="number3" name="group_id" style="float:right" class="form-control" autocomplete="off" placeholder="答辩组组号" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <p class="help-block">请在输入框中输入要增加老师或学生人数，按回车键生效</p>
                                    </div>
                                </div>
                                <div class="fixed-table-container">
                                    <table width="100%">
                                        <tr>
                                            <td width="50%" style="float: left;margin: 0px;padding: 0px;">
                                                <table id="" class="table col-md-6">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <div class="th-inner th-title-center">答辩组导师成员</div>
                                                            </th>
                                                            <th>

                                                            </th>
                                                            <th>

                                                            </th>
                                                            <th>

                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_1_tbody">
                                                        <tr>
                                                            <td class="td-title-center">答辩组长</td>
                                                            <td>
                                                                <input id="id_t_1" name="t_tleader_id" class="form-control " autocomplete="off" onkeyup="showName(1,this.value)">
                                                            </td>
                                                            <td>
                                                                <input id="hezi1" name="t_tleader_name" class="form-control" autocomplete="off" readonly>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>

                                            </td>
                                            <td width="50%" style="float: right;margin: 0px;padding: 0px;">
                                                <table id="" class="table col-md-6">
                                                    <thead>
                                                        <tr>
                                                            <th>
                                                                <div class="th-inner th-title-center">答辩组学生成员</div>
                                                            </th>
                                                            <th></th>
                                                            <th>

                                                            </th>
                                                            <th>

                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="table_2_tbody">
                                                        <td class="td-title-center">
                                                            No.1
                                                        </td>
                                                        <td>
                                                            <input id="id_stu_1" name="stu_1_id" class="form-control" autocomplete="off" onkeyup="showName2(1,this.value)">
                                                        </td>
                                                        <td>
                                                            <input id="hezi_stu1" name="stu_1_name" class="form-control" autocomplete="off" readonly>
                                                        </td>
                                                        <td>
                                                        </td>
                                                    </tbody>
                                                </table>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td>
                                                <button type="submit" class="btn btn-default" style="float: right;margin: 10px">确认分组</button>
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
    <!-- 增加答辩详情modaltable -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-alter">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="">添加答辩安排详情</h4>
                </div>
                <div class="modal-body">
                    <form action="sec_update_reply_schedule.php?func=detail" class="form-horizontal" method="post">
                        <div class="bootstrap-table">
                            <div class="fixed-table-toolbar">
                                <div class="bars">
                                    <div id="toolbar">
                                        <table width="100%">
                                            <tbody>
                                                <tr>
                                                    <td width="110px" style="float: left;margin-right: 10px">
                                                        <input id="number3" width="110px" name="group_id" class="form-control" autocomplete="off" placeholder="答辩组组号" required>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
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