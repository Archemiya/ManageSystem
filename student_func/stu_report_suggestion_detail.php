<!-- 此文件为导师修改意见明细文件 -->
<!-- 学生可以在导师给出修改意见使用此文件查看对应的修改意见，并重新上传开题报告摘要 -->
<!-- 传递的参数为 topic_id -->
<?php
include "../link.php";
if (isset($_GET["id"])) {
    $get = $_GET["id"];
}
$sql = "SELECT * FROM `first_report_record`WHERE `topic_id` = '{$get}' ORDER BY `record_id` DESC";
$result = mysqli_query($link, $sql);
?>

<body>
    <?php
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    echo "<br/>";
    echo "<div class=\"alert alert-info\" role=\"alert\">";
    echo "<strong>主要修改意见: <br/></strong>";
    echo $row['modify_suggestion'];
    echo " </div>";
    ?>

    <br /> 
    <?php
    if($row['final_flag']==2){
        echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#chsugTable\">修改开题报告</button>";
    }else{
        echo "";
    }
    ?>
    <button type="button" class="btn btn-primary" onclick="JavaScript:history.go(-1)">返回</button>
    <div class="modal fade " id="chsugTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">修改开题报告</h4>
                </div>
                <div class="modal-body">
                    <?php
                    echo <<< archemiya
                    <form action="stu_add_first_report.php?id={$get}" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">课题来源</label>
                            <div class="col-sm-8">
                                <textarea name="topic_source" class="form-control" rows="3">
archemiya;
                        echo $row['topic_source'];
                        echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">课题研究的目的、意义</label>
                            <div class="col-sm-8">
                                <textarea name="topic_purpose" class="form-control" rows="3">
archemiya;
                        echo $row['topic_purpose'];

                        echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">课题的国内外研究现状和发展动态</label>
                            <div class="col-sm-8">
                                <textarea name="topic_research_status" class="form-control" rows="3">
archemiya;
                        echo $row['topic_research_status'];

                        echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">课题的研究内容、拟采取的技术方案或研究方法</label>
                            <div class="col-sm-8">
                                <textarea name="topic_main" class="form-control" rows="3">
archemiya;
                        echo $row['topic_main'];

                        echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicReq" class="col-sm-3 control-label">课题研究的重点、难点及创新点</label>
                            <div class="col-sm-8">
                                <textarea name="topic_difficulty" class="form-control" rows="3">
archemiya;
                        echo $row['topic_difficulty'];

                        echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">课题研究的进度安排</label>
                            <div class="col-sm-8">
                                <textarea name="topic_schedule" class="form-control" rows="3">
archemiya;
                        echo $row['topic_schedule'];

                        echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">主要参考文献</label>
                            <div class="col-sm-8">
                                <textarea name="topic_ref" class="form-control" rows="3">
archemiya;
                        echo $row['topic_ref'];

                        echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <input type="hidden" name="student_id" value="{$_SESSION['user_id']}">
                        <input type="hidden" name="student_name" value="{$_SESSION['user_name']}">
                        <input type="hidden" name="topic_id" value="{$row['topic_id']}">
                        <input type="hidden" name="topic_name" value="{$row['topic_name']}">
                        <input type="hidden" name="teacher_id" value="{$row['teacher_id']}">
                        <input type="hidden" name="teacher_name" value="{$row['teacher_name']}">
archemiya;
                    ?>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary" onclick="JavaScript:return confirm('确定填写无误并重新上传开题报告么？');">重新上传</button>
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
