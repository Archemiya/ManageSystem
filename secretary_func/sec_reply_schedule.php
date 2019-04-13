<!-- 此文件为答辩小组显示 + 分组文件 -->
<?php
include "../link.php";
$sql_stu_chosed = "SELECT * FROM `chose_topic_record` WHERE `final_flag` = 1"; //查看当前完成选题的学生数量
$result_stu_chosed = mysqli_query($link, $sql_stu_chosed);
$num_stu_chosed = mysqli_num_rows($result_stu_chosed);

$sql_topic = "SELECT * FROM `topic`";
$result_topic = mysqli_query($link, $sql_topic);
$num_topic = mysqli_num_rows($result_topic);

//此函数输出所有已分配好的答辩小组名单
function echo_reply_schedule_table($i, $link)
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
                    <th class="col-md-3 th-title-center"> 导师简介</th>
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
    </div>
    <?php

    $group_num = 0;

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
    if ($num_stu_chosed != $num_topic) {
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
    } else {
        echo <<< archemiya
        <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#table">
        添加答辩小组
        </button>
archemiya;
        for ($i = 0; $i < $group_num; $i++) {
            echo_reply_schedule_table($i, $link);
            echo "<br/>";
        }
    }
    ?>
    <div class="modal fade" id="table" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog-alter">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="">新增答辩小组</h4>
                </div>

                <div class="modal-body">
                    <form action="sec_update_reply_schedule.php" method="post" onkeypress="if(event.keyCode==13){return false;}">
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
                                                                <input id="id_t_1" name="t_tleader_id" class="form-control" autocomplete="off" onkeyup="showName(1,this.value)">
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


</body>

</html>