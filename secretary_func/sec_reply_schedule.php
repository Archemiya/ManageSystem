<html>

<head>
    <script type="text/javascript">
        function loadXMLDoc(str) {
            var xmlhttp;
            var number = str;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("div_1st").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "sec_test.php", true);
            xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xmlhttp.send("num=" + number);
        }
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

    <div class="modal fade" id="table" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="">新增答辩小组</h4>
                </div>
                <form>
                    <div class="modal-body">
                        <div class="bootstrap-table">
                            <div class="fixed-table-toolbar">
                                <div class="bars">
                                    <div id="toolbar">

                                        <table>
                                            <tbody>
                                                <tr>
                                                    <td width="110px" style="float: left;margin: 10px">
                                                        <input id="number1" class="form-control" autocomplete="off" placeholder="老师增加人数" onkeypress="if(event.keyCode==13){loadXMLDoc(this.value)}">

                                                    </td>
                                                    <td width="110px">
                                                        <input id="number2" class="form-control" autocomplete="off" placeholder="学生增加人数" onkeypress="if(event.keyCode==13){loadXMLDoc(this.value)}">
                                                    </td>
                                                    <td></td>
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

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="td-title-center">答辩组长</td>
                                                            <td>
                                                                <input class="form-control">
                                                            </td>
                                                        </tr>
                                                        <div id="div_1st">
                                                        </div>
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
                                                            <th>

                                                            </th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>

                                                        <td class="td-title-center">
                                                            No.1
                                                        </td>
                                                        <td>
                                                            <input class="form-control">
                                                        </td>
                                                        <div id="div_2nd"></div>

                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>



                                </div>

                            </div>

                        </div>
                    </div>
                    <!-- <button type="submit" class="btn btn-primary" style="float: left;margin: 10px">确认</button> -->
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                </div>
            </div>
        </div>
    </div>


</body>

</html>



<body>



</body>

</html>


<div class="modal fade" id="table" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="">第一小组</h4>
            </div>
            <div class="modal-body">
                <div class="bootstrap-table">
                    <div class="fixed-table-toolbar">
                        <div class="bars">
                            <div id="toolbar">

                            </div>
                        </div>
                    </div>
                    <div class="fixed-table-container">
                        <table id="" class="table">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="th-inner">答辩组导师成员</div>
                                    </th>
                                    <th>

                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <td>答辩组长</td>
                                <td>
                                    <input class="form-control">
                                </td>

                            </tbody>
                        </table>
                        <br />
                        <table id="" class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>
                                        <div class="th-inner">答辩组学生成员</div>
                                    </th>
                                    <th>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td>
                                    <input class="form-control">
                                </td>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary">确认</button>
            </div>
        </div>
    </div>
</div>