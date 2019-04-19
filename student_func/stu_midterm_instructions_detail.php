<!-- 此文件为中期检查导师修改意见明细文件 -->
<!-- 学生可以在导师给出修改意见使用此文件查看对应的修改意见，并重新上传开题报告摘要 -->
<!-- 传递的参数为 topic_id -->
<?php
include "../link.php";
if (isset($_GET["id"])) {
    $get = $_GET["id"];
}
$sql = "SELECT * FROM `midterm_report`WHERE `topic_id` = '{$get}' ";
$result = mysqli_query($link, $sql);
?>

<body>
    <?php
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    echo "<br/>";
    echo "<div class=\"alert alert-info\" role=\"alert\">";
    echo "<strong>主要指导意见: <br/></strong>";
    echo $row['instructions'];
    echo " </div>";
    if ($row['final_flag'] == 2) {
        echo "<button class='btn btn-primary' data-toggle='modal' data-target='#midtermReportTable'>更新中期报告</button>";
    } else { 
        echo "";
    }
    ?>

    <div class="modal fade " id="midtermReportTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">上传中期报告</h4>
                </div>
                <div class="modal-body">
                    <form action="stu_add_update_midterm_report.php?func=update" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">当前完成情况</label>
                            <div class="col-sm-8">
                                <textarea name="current_status" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">尚需完成任务</label>
                            <div class="col-sm-8">
                                <textarea name="need_to_complete" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">目前存在的问题及拟解决办法</label>
                            <div class="col-sm-8">
                                <textarea name="current_problems_and_solutions" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">后期工作进度安排</label>
                            <div class="col-sm-8">
                                <textarea name="postwork_schedule" class="form-control" rows="3" required></textarea>
                            </div>
                        </div>
                        <?php
                        echo <<< archemiya
                        
archemiya;
                        ?>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">确认上传</button>
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
<!-- // <input type="hidden" name="student_id" value="{$_SESSION['user_id']}">
// <input type="hidden" name="student_name" value="{$_SESSION['user_name']}">
// <input type="hidden" name="topic_id" value="{$row_topic['id']}">
// <input type="hidden" name="topic_name" value="{$row_topic['name']}">
// <input type="hidden" name="teacher_id" value="{$row_topic['teacher_id']}">
// <input type="hidden" name="teacher_name" value="{$row_topic['teacher_name']}"> -->