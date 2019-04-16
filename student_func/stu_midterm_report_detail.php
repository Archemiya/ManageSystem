<!-- 学生中期报告明细文件 -->
<!-- 导师调用该文件查看对应的学生中期报告摘要明细，并为其提供指导意见，并通过学生的中期报告 -->
<!-- 传递参数为 topic_id -->
<?php
include "../link.php";
if (isset($_GET["id"])) {
    $get = $_GET["id"];
} elseif(isset($_GET["fid"])){
    $get = $_GET["fid"];
}else {
    echo "<script>aler('请求失败！');history.go(-1)</script>";
}
//当前学生查询中期报告
$sql_midterm_report = "SELECT * FROM `midterm_report` WHERE `midterm_report`.`topic_id` = '{$get}'";
$result_midterm_report = mysqli_query($link, $sql_midterm_report);
$row_midterm_report = mysqli_fetch_array($result_midterm_report, MYSQLI_BOTH);

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <br />

    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar">
            <tbody>
                <tr>
                    <td class='col-xs-3'>当前完成情况</td>

                    <td class='col-xs-9'>
                        <?php echo $row_midterm_report['current_status']; ?>
                    </td>

                </tr>
                <tr>
                    <td class='col-xs-3'>尚需完成任务</td>

                    <td class='col-xs-9'>
                        <?php echo $row_midterm_report['need_to_complete']; ?>
                    </td>

                </tr>
                <tr>
                    <td class='col-xs-3'>目前存在的问题及拟解决办法</td>


                    <td class='col-xs-9'>
                        <?php echo $row_midterm_report['current_problems_and_solutions']; ?>
                    </td>

                </tr>
                <tr>
                    <td class='col-xs-3'>后期工作进度安排</td>


                    <td class='col-xs-9'>
                        <?php echo $row_midterm_report['postwork_schedule']; ?>
                    </td>

                </tr>
            </tbody>
        </table>

    </div>
    <?php
    if ($row_midterm_report['final_flag'] == 1 ) {
        echo "<br/>";
        echo "";
    } else {
        echo "<br/>";
        echo "<a href='../tutor_func/t_add_report_suggestion.php?func=midterm_report&cid={$get}' type=\"button\" class=\"btn btn-primary\" role='button'>同意通过</a>";
        echo " ";
        echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#suggestionTable\">撰写指导意见</button>";
    }
    ?>
    <button type="button" class="btn btn-primary" onclick="JavaScript:history.go(-1)">返回</button>
    <div class="modal fade " id="suggestionTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">撰写指导意见</h4>
                </div>
                <div class="modal-body">
                    <?php
                    echo "<form action=\"../tutor_func/t_add_report_suggestion.php?func=midterm_report&id={$get}\" method=\"POST\" class=\"form-horizontal\">";
                    ?>
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">主要指导意见</label>
                        <div class="col-sm-8">
                            <textarea name="report_suggestion" class="form-control" rows="20"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">上传指导意见</button>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <br />
</body>

</html>