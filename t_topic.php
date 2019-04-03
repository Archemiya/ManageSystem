<?php
$link = mysqli_connect("localhost", "root", "123456", "manasystem");
$sql = "SELECT * FROM `topic`";
$result = mysqli_query($link, $sql);
?>
<?php
function table_echo($result, $link)
{
    $length = mysqli_num_rows($result);
    $i = 0;
    while ($i < $length) {
        $row = mysqli_fetch_array($result);
        $sql_chose_recode_topic = "SELECT * FROM `chose_topic_record` WHERE `chose_topic_record`.`topic_id` = '{$row['id']}'";
        $result_chose_record_topic = mysqli_query($link, $sql_chose_recode_topic);
        $row_chose_record_topic = mysqli_fetch_array($result_chose_record_topic, MYSQLI_BOTH);
        $num_chose_record_topic = mysqli_num_rows($result_chose_record_topic);
        echo <<< archemiya
    <tr>
    <td> {$row['id']} </td>
    <td> {$row['name']} </td>
archemiya;
        if ($row['teacher_name'] == $_SESSION['user_name']) {
            echo "<td > {$row['teacher_name']} </td>";
        } else {
            echo "<td > &nbsp;{$row['teacher_name']} </td>";
        }
    
        echo <<< archemiya
    <td> {$num_chose_record_topic} / 5</td>
    <td >
    <a href="./tutor.php?func=topic&id={$row['id']}" class="btn btn-primary" role="button">查看课题详情</a>
    </td> 
    </td>
    </tr>
archemiya;
        $i++;
    }
}
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <div class="table-responsive">

        <table data-toggle="table" data-toolbar="#toolbar" data-pagination="true" data-search="true"
            data-page-list="[10, 25, 50, 100, 200, All]" data-sort-name="name" data-sort-order="desc"
            data-show-refresh="true">
            <thead>
                <tr>
                    <th class="th-title-small th-title-center" data-sortable="true">课题号</th>
                    <th class="th-title-large"> 选题名称</th>
                    <th class="th-title-normalfix th-title-center" data-field="name" data-sortable="true">教师名称</th>
                    <th class="th-title-normalfix th-title-center" data-sortable="true">选课人数</th>
                    <th class=" th-title-normal th-title-center">选项</th>
                </tr>
            </thead>
            <tbody>
                <div id="toolbar">
                    <button type="button" class="btn btn-primary" data-toggle="modal"
                        data-target="#topicTable">创建课题</button>
                </div>
                <?php
                table_echo($result, $link);
                ?>
            </tbody>

        </table>
    </div>
    <div class="modal fade " id="topicTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">创建课题</h4>
                </div>
                <div class="modal-body">

                    <form action="add_topic.php" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputTopicName" class="col-sm-3 control-label">课题名称</label>
                            <div class="col-sm-8">
                                <input type="topicName" name="topic_name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="inputTopicType" class="col-sm-3 control-label">课题类型</label>
                            <div class="col-sm-3">
                                <select type="topicType" name="topic_type" class="form-control">
                                    <option></option>
                                    <option>毕业设计</option>
                                    <option>毕业论文</option>
                                </select>
                            </div>
                            <label for="inputTopicNature" class="col-sm-2 control-label">题目性质</label>
                            <div class="col-sm-3">
                                <select type="topicNature" name="topic_nature" class="form-control">
                                    <option></option>
                                    <option>工程实践</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicSource" class="col-sm-3 control-label">题目来源</label>
                            <div class="col-sm-3">
                                <select type="topicSource" name="topic_source" class="form-control">
                                    <option></option>
                                    <option>自拟</option>
                                    <option>校外立项科研</option>
                                    <option>与外单位合作工程科研</option>
                                </select>
                            </div>
                            <label for="inputTopicEase" class="col-sm-2 control-label">题目预计难易程度</label>
                            <div class="col-sm-3">
                                <select type="topicEase" name="topic_ease" class="form-control">
                                    <option></option>
                                    <option>易</option>
                                    <option>一般</option>
                                    <option>难</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">题目简介</label>
                            <div class="col-sm-8">
                            <textarea type="topicIntro" name="topic_intro" class="form-control" rows="3"></textarea>
                                <!-- <input type="topicIntro" class="form-control"> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicReq" class="col-sm-3 control-label">毕业设计(论文)要求</label>
                            <div class="col-sm-8">
                            <textarea type="topicReq"  name="topic_request" class="form-control" rows="3"></textarea>
                                <!-- <input type="topicReq" class="form-control"> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">主要参考资料</label>
                            <div class="col-sm-8">
                            <textarea type="topicRef" name="topic_ref" class="form-control" rows="3"></textarea>
                                <!-- <input type="topicRef" class="form-control"> -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicOth" class="col-sm-3 control-label">其他指导老师【可选】</label>
                            <div class="col-sm-3">
                                <input type="topicOth" name="topic_other" class="form-control">
                            </div>
                            <label for="inputTopicChoseMode" class="col-sm-2 control-label">课题选择模式</label>
                            <div class="col-sm-3">
                                <select type="topicChoseMode" name="topic_chosemode" class="form-control">
                                    <option></option>
                                    <option>自由选择</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicApp" class="col-sm-3 control-label">课题适用专业</label>
                            <div class="col-sm-3">
                            <select type="topicApp" name="topic_app" class="form-control">
                                    <option></option>
                                    <option>保密管理</option>
                                </select>
                            </div>
                            <label for="inputTopicWorkLoad" class="col-sm-2 control-label">工作量大小</label>
                            <div class="col-sm-3">
                                <select type="topicWorkLoad" name="topic_workload" class="form-control">
                                    <option></option>
                                    <option>小</option>
                                    <option>适中</option>
                                    <option>大</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">上传课题</button>
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

    <script>
    var $table = $('#table')

    $(function() {
        $('#topicTable').on('shown.bs.modal', function() {
            $table.bootstrapTable('resetView')
        })
    })
    </script>
</body>

</html>