<?php


?>

<html>

<head>
    <script type="text/javascript">
        function upLoadNum(str) {
            var xmlhttp;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "sec_test.php", true);
            xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            xmlhttp.send("num=str");
        }
        function loadXMLDoc(str) {
            var xmlhttp;
            if (window.XMLHttpRequest) { // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            } else { // code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function() {
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                    document.getElementById("myDiv").innerHTML = xmlhttp.responseText;
                }
            }
            xmlhttp.open("POST", "sec_test.php", true);
            // xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            // xmlhttp.send("num=str");
        }
    </script>
</head>
var  v1=document.getElenmentById("text1").value;
<body>

    <h2>AJAX</h2>
    <input id="number" onblur="upLoadNum(this.value)">
    <button type="submit" onclick="loadXMLDoc()">请求数据</button>
    <div id="myDiv"></div>

</body>

</html>



<!-- <html>

<body>
    <br />
    <div class="alert alert-danger" role="alert">
        <strong>本页面为答辩组分配页面，请谨慎操作</strong>
    </div>
    

</body>

</html> -->


<!-- <div class="modal fade" id="table" tabindex="-1" role="dialog" aria-hidden="true">
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
                                    <th class="col-sm-1">
                                        <div class="th-inner">答辩组导师成员</div>
                                    </th>
                                    <th class="col-sm-1">

                                    </th>
                                    <th class="col-sm-1">
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
                                    <th class="col-sm-1"></th>
                                    <th class="col-sm-1">
                                        <div class="th-inner">答辩组学生成员</div>
                                    </th>
                                    <th class="col-sm-1">
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
</div> -->