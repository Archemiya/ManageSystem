<!-- 学生开题报告明细文件 -->
<!-- 导师调用该文件查看对应的学生开题报告摘要明细，并为其上传修改意见，同时可以确定该学生的开题报告最终版 -->
<!-- 传递参数为 topic_id -->
<?php
include "../link.php";
if (isset($_GET["id"])) {
    $get = $_GET["id"];
} elseif (isset($_GET["fid"])) {
    $get = $_GET["fid"];
} else {
    echo "<script>aler('请求失败！');history.go(-1)</script>";
}
//当前学生查询最新开题报告
$sql_id = "SELECT max(`record_id`) from `first_report_record` WHERE `first_report_record`.`topic_id` = '{$get}' order by `record_id` desc";
$result_id = mysqli_query($link, $sql_id);
$row_id = mysqli_fetch_array($result_id, MYSQLI_BOTH);
$sql_first_report_record = "SELECT * FROM `first_report_record` WHERE `first_report_record`.`topic_id` = '{$get}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
$result_first_report_record = mysqli_query($link, $sql_first_report_record);
$row_first_report_record = mysqli_fetch_array($result_first_report_record, MYSQLI_BOTH);

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
                    <td class='col-xs-3'>课题来源</td>

                    <td class='col-xs-9'>
                        <?php echo $row_first_report_record['topic_source']; ?>
                    </td>

                </tr>
                <tr>
                    <td class='col-xs-3'>课题研究的目的、意义</td>

                    <td class='col-xs-9'>
                        <?php echo $row_first_report_record['topic_purpose']; ?>
                    </td>

                </tr>
                <tr>
                    <td class='col-xs-3'>课题的国内外研究现状和发展动态</td>


                    <td class='col-xs-9'>
                        <?php echo $row_first_report_record['topic_research_status']; ?>
                    </td>

                </tr>
                <tr>
                    <td class='col-xs-3'>课题的研究内容、拟采取的技术方案或研究方法</td>


                    <td class='col-xs-9'>
                        <?php echo $row_first_report_record['topic_main']; ?>
                    </td>

                </tr>
                <tr>
                    <td class='col-xs-3'>课题研究的重点、难点及创新点</td>


                    <td class='col-xs-9'>
                        <?php echo $row_first_report_record['topic_difficulty']; ?>
                    </td>

                </tr>
                <tr>
                    <td class='col-xs-3'>课题研究的进度安排</td>


                    <td class='col-xs-9'>
                        <?php echo $row_first_report_record['topic_schedule']; ?>
                    </td>

                </tr>
                <tr>
                    <td class='col-xs-3'>主要参考文献</td>


                    <td class='col-xs-9'>
                        <?php echo $row_first_report_record['topic_ref']; ?>
                    </td>

                </tr>
            </tbody>
        </table>

    </div>
    <?php
    if ($row_first_report_record['final_flag'] == 2 || $row_first_report_record['final_flag'] == 3 || $row_first_report_record['final_flag'] == 1) {
        echo "<br/>";
        echo "";
    } else {
        echo "<br/>";
        echo "<a href=\"../tutor_func/t_add_suggestion.php?func=first_report&cid={$get}\" class=\"btn btn-success\" role=\"button\" onclick=\"JavaScript:return confirm('确定同意该开题报告审核通过么？')\">同意通过</a>";
        echo " ";
        echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#suggestionTable\">撰写修改意见</button>";
    }
    ?>
    <button type="button" class="btn btn-primary" onclick="JavaScript:history.go(-1)">返回</button>
    <div class="modal fade " id="suggestionTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">撰写修改意见</h4>
                </div>
                <div class="modal-body">
                    <?php
                    echo "<form action=\"../tutor_func/t_add_suggestion.php?func=first_report&id={$get}\" method=\"POST\" class=\"form-horizontal\">";
                    ?>
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">主要修改意见</label>
                        <div class="col-sm-8">
                            <textarea name="report_suggestion" class="form-control" rows="20"><?php echo $row_first_report_record['modify_suggestion']; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary">上传修改意见</button>
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