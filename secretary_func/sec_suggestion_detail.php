<?php
include "../link.php";
if (isset($_GET["cid"])) {
    $get = $_GET["cid"];
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
    <?php
        $row = mysqli_fetch_array($result, MYSQLI_BOTH);
        echo "<br/>";
        echo "<div class=\"alert alert-info\" role=\"alert\">";
        echo "<strong>主要修改意见: <br/></strong>";
        echo nl2br($row['topic_suggestion']);
        echo " </div>";
    ?>

    <br />
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#chsugTable">修改课题</button>
    <button type="button" class="btn btn-primary" onclick="JavaScript:history.go(-1)">返回</button>
    <div class="modal fade " id="chsugTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">修改课题</h4>
                </div>
                <div class="modal-body">
                    <?php
                    echo <<< archemiya
                    <form action="../tutor_func/t_change_topic.php?id={$get}" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputTopicName" class="col-sm-3 control-label">课题名称</label>
                            <div class="col-sm-8">
                                <input type="topicName" name="topic_name" class="form-control" value="
archemiya;
                    echo $row['name'];
                    echo <<< archemiya
                                ">
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="inputTopicType" class="col-sm-3 control-label">课题类型</label>
                            <div class="col-sm-3">
                                <select type="topicType" name="topic_type" class="form-control">
                                    <option>
archemiya;
                    echo $row['topic_type'];
echo <<< archemiya
                                    </option>
                                    <option>毕业设计</option>
                                    <option>毕业论文</option>
                                </select>
                            </div>
                            <label for="inputTopicNature" class="col-sm-2 control-label">题目性质</label>
                            <div class="col-sm-3">
                                <select type="topicNature" name="topic_nature" class="form-control">
                                    <option>
archemiya;
                    echo $row['topic_nature'];
echo <<< archemiya
                                    </option>
                                    <option>工程实践</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicSource" class="col-sm-3 control-label">题目来源</label>
                            <div class="col-sm-3">
                                <select type="topicSource" name="topic_source" class="form-control">
                                    <option>
archemiya;
                    echo $row['topic_source'];
echo <<< archemiya
                                    </option>
                                    <option>自拟</option>
                                    <option>校外立项科研</option>
                                    <option>与外单位合作工程科研</option>
                                </select>
                            </div>
                            <label for="inputTopicEase" class="col-sm-2 control-label">题目预计难易程度</label>
                            <div class="col-sm-3">
                                <select type="topicEase" name="topic_ease" class="form-control">
                                    <option>
archemiya;
                    echo $row['topic_difficulty'];
echo <<< archemiya
                                    </option>
                                    <option>易</option>
                                    <option>一般</option>
                                    <option>难</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">题目简介</label>
                            <div class="col-sm-8">
                                <textarea type="topicIntro" name="topic_intro" class="form-control" rows="3">
archemiya;
                    echo $row['introduction'];
echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicReq" class="col-sm-3 control-label">毕业设计(论文)要求</label>
                            <div class="col-sm-8">
                                <textarea type="topicReq" name="topic_request" class="form-control" rows="3">
archemiya;
                    echo $row['topic_request'];
echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">主要参考资料</label>
                            <div class="col-sm-8">
                                <textarea type="topicRef" name="topic_ref" class="form-control" rows="3">
archemiya;
                    echo $row['topic_reference'];
echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicOth" class="col-sm-3 control-label">其他指导老师【可选】</label>
                            <div class="col-sm-3">
                                <input type="topicOth" name="topic_other" class="form-control" value="
archemiya;
                    echo $row['topic_otherteacher'];
echo <<< archemiya
                                ">
                            </div>
                            <label for="inputTopicChoseMode" class="col-sm-2 control-label">课题选择模式</label>
                            <div class="col-sm-3">
                                <select type="topicChoseMode" name="topic_chosemode" class="form-control">
                                    <option>
archemiya;
                    echo $row['topic_chosemode'];
echo <<< archemiya
                                    </option>
                                    <option>自由选择</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicApp" class="col-sm-3 control-label">课题适用专业</label>
                            <div class="col-sm-3">
                                <select type="topicApp" name="topic_app" class="form-control">
                                    <option>
archemiya;
                    echo $row['topic_application'];
echo <<< archemiya
                                    </option>
                                    <option>保密管理</option>
                                </select>
                            </div>
                            <label for="inputTopicWorkLoad" class="col-sm-2 control-label">工作量大小</label>
                            <div class="col-sm-3">
                                <select type="topicWorkLoad" name="topic_workload" class="form-control">
                                    <option>    
archemiya;
                    echo $row['topic_workload'];
                    echo <<< archemiya
                                    </option>
                                    <option>小</option>
                                    <option>适中</option>
                                    <option>大</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">确认修改课题</button>
                            </div>
                        </div>
                    </form>
archemiya;
                ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>