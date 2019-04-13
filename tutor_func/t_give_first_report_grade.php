<!-- 学生开题报告打分文件 -->
<!-- 答辩组导师调用该文件查看对应的学生开题报告摘要明细，并结合该学生线下开题汇报表现为学生打出开题报告项目的最终成绩 -->
<!-- 传递参数为 topic_id -->
<?php
include "../link.php";
if (isset($_GET["fid"])) {
    $get = $_GET["fid"];
} else {
    echo "<script>aler('请求失败！');history.go(-1)</script>";
}
//当前学生查询最新开题报告
$sql_id = "SELECT max(`record_id`) from `first_report_record` order by `record_id` desc";
$result_id = mysqli_query($link, $sql_id);
$row_id = mysqli_fetch_array($result_id);
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
    <div class="alert alert-danger" role="alert">
        <strong>提示：请仔细查看学生的开题报告，并结合学生线下开题答辩时的表现给出开题报告项目的最终成绩</strong>
    </div>
    <?php
    if ($_GET['index'] = "delay") {
        echo <<< archemiya
        <div class="alert alert-danger" role="alert">
        <strong>该学生未提交报告或附件，请酌情扣分</strong>
        </div>
archemiya;
    }
    ?>
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
    $sql_isscore = "SELECT * from `student_grade` where `topic_id` = '{$get}'";
    $result_isscore = mysqli_query($link, $sql_isscore);
    $num_isscore = mysqli_num_rows($result_isscore);

    if ($num_isscore) {
        echo "<br/>";
        echo "";
    } else {
        echo "<br/>";
        echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#suggestionTable\">最终成绩</button>";
    }
    ?>
    <button type="button" class="btn btn-primary" onclick="JavaScript:history.go(-1)">返回</button>
    <div class="modal fade " id="suggestionTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">开题报告最终成绩</h4>
                </div>
                <div class="modal-body">
                    <?php
                    $sql = "SELECT * from `topic` where `id` = '{$get}'";
                    $result = mysqli_query($link, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
                    echo "<form action=\"../score.php?func=first_report&id={$row['student_id']}\" method=\"POST\" class=\"form-horizontal\">";
                    echo "<input type=\"hidden\" name=\"topic_id\" value=\"{$get}\">";
                    echo "<input type=\"hidden\" name=\"student_id\" value=\"{$row['student_id']}\">";
                    echo "<input type=\"hidden\" name=\"student_name\" value=\"{$row['student_name']}\">";
                    ?>
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">分数（百分制）</label>
                        <div class="col-sm-3">
                            <input name="first_report_grade" class="form-control" rows="20"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">说明（点评）</label>
                        <div class="col-sm-8">
                            <textarea name="grade_description" class="form-control" rows="20"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" onclick="javascript:confirm('确认无误并提交么？提交成绩后将无法修改！')">提交</button>
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