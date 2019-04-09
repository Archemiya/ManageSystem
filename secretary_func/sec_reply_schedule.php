<?php


?>

<html>

<body>
    <br />
    <div class="alert alert-danger" role="alert">
        <strong>本页面为答辩组分配页面，请谨慎操作</strong>
    </div>
    <button class="btn btn-primary" data-toggle="modal" data-target="#table">分配答辩组</button>
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
    </div>
</body>

</html>