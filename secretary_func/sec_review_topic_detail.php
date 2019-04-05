<?php
include "../link.php";
if (isset($_GET["id"])) {
    $get = $_GET["id"];
}
$sql = "SELECT * FROM `topic`WHERE `id` = {$get} ORDER BY `id`  ASC";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar">
            <tbody>
                <?php
                $row = mysqli_fetch_array($result, MYSQLI_BOTH);
                echo "<br/>";
                echo "<tr>";
                echo "<td class='col-xs-2'>课题名称</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['name']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>课题类型</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['topic_type']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>题目性质</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['topic_nature']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>题目来源</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['topic_source']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>题目预计难易程度</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['topic_difficulty']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>题目简介</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['introduction']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>毕业设计(论文)要求</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['topic_request']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>主要参考资料</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['topic_reference']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>其他指导老师【可选】</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['topic_otherteacher']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>课题选择模式</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['topic_chosemode']);
                echo " </td>";
                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>课题适用专业</td>";
                echo "<td class='col-xs-10'>";
                echo nl2br($row['topic_application']);
                echo " </td>";
                echo "</tr>";

                ?>
            </tbody>
        </table>
        <br />
        <?php
        if ($row['topic_ispass'] == 1) {
            echo "";
        } else {
            echo "<a href=\"sec_complete_review.php?id={$get}\" class=\"btn btn-primary\" role=\"button\" onclick=\"JavaScript:return from('确定同意该课题审核通过么？')\">同意通过</a>";
            echo " ";
            echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#suggestionTable\">撰写修改意见</button>";
        }
        ?>

        <button type="button" class="btn btn-primary" onclick="JavaScript:history.go(-1)">返回</button>
    </div>
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
                    echo "<form action=\"sec_add_suggestion.php?id={$_GET['id']}\" method=\"POST\" class=\"form-horizontal\">";
                    ?>
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">主要修改意见</label>
                        <div class="col-sm-8">
                            <textarea name="topic_suggestion" class="form-control" rows="20"><?php echo $row['topic_suggestion']; ?></textarea>
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
</body>

</html>