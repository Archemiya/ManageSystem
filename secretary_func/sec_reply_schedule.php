<html>

<head>
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
                            var $li3 = "<td> <input id='hezi" + t_idtemp + "' name='t_" + t_idtemp + "_name' class='form-control'  active> </td>"
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
                            var $li3 = "<td> <input <input id='hezi_stu" + stu_idtemp + "' name='stu_" + stu_idtemp + "_name' class='form-control' active> </td>"
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
    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#table">
        添加答辩小组
    </button>

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
                                                                <input id="hezi1" name="t_tleader_name" class="form-control" autocomplete="off" active>
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
                                                            <input id="hezi_stu1" name="stu_1_name" class="form-control" autocomplete="off" active>
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