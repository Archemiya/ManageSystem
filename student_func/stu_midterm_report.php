<?php
/*
思路：
不同于开题报告，中期报告只是一个检查报告，不需要答辩，因此只需要一次提交，导师确认即可，因此可参照任务书的形式来写
1.首先判断开启条件：
 - 只有一个条件，即开题报告结束，此处可对 `student_grade`即学生成绩表中的 `first_grade` 字段进行查询，得出 **num_rows** ，然后与`user`中的 **num_rows** 对比。
2.开启之后，学生提交中期报告，各自导师对学生的中期报告进行检查，并写下指导意见。（暂时想不到其他的）
*/
include "../link.php";

//检查成绩表中得到开题分数的同学人数
$sql_first_report_grade = "SELECT * from `student_grade` where `first_report_grade` != 0";
$result_first_report_grade = mysqli_query($link, $sql_first_report_grade);
$num_first_report_grade = mysqli_num_rows($result_first_report_grade);

//查询当前全员学生人数
$sql_student = "SELECT * from `user` where `permission` = 'student' ";
$result_student = mysqli_query($link, $sql_student);
$num_student = mysqli_num_rows($result_student);

//查询当前中期报告状态
$sql_midterm = "SELECT * from `midterm_report` where `student_id` = '{$_SESSION['user_id']}' ";
$result_midterm = mysqli_query($link, $sql_midterm);
$row_midterm = mysqli_fetch_array($result_midterm, MYSQLI_BOTH);

?>


<body>
    <?php
    if ($num_first_report_grade != $num_student) {
        echo <<< archemiya
            <br/>
            <div class="alert alert-danger" role='alert'>
                当前开题答辩评分尚未结束，不可提交中期报告，请耐心等待评分结束！
            </div>
archemiya;
    } else {
        if (!isset($row_midterm['student_id'])) {
            echo <<< archemiya
                <br/>
                <div class="alert alert-warning" role='alert'>
                您尚未提交中期报告，请及时提交！
                </div>
                <button class='btn btn-primary' data-toggle=\"modal\" 
                data-target=\"#midtermReportTable\">提交中期报告</button>
archemiya;
        } elseif (($row_midterm['student_id']) && $row_midterm['islook_flag'] == 0) {
            echo <<< archemiya
                <br/>
                <div class="alert alert-warning" role='alert'>
                您已提交中期报告，请耐心等待导师确认！
                </div>
archemiya;
        }
    }
    ?>

    <!-- 此处的两个modeltable功能为填写中期报告及中期报告附件 -->
    <div class="modal fade " id="midtermReportTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">上传开题报告</h4>
                </div>
                <div class="modal-body">
                    <form action="stu_add_first_report.php" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">课题来源</label>
                            <div class="col-sm-8">
                                <textarea name="topic_source" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">课题研究的目的、意义</label>
                            <div class="col-sm-8">
                                <textarea name="topic_purpose" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">课题的国内外研究现状和发展动态</label>
                            <div class="col-sm-8">
                                <textarea name="topic_research_status" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">课题的研究内容、拟采取的技术方案或研究方法</label>
                            <div class="col-sm-8">
                                <textarea name="topic_main" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicReq" class="col-sm-3 control-label">课题研究的重点、难点及创新点</label>
                            <div class="col-sm-8">
                                <textarea name="topic_difficulty" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">课题研究的进度安排</label>
                            <div class="col-sm-8">
                                <textarea name="topic_schedule" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">主要参考文献</label>
                            <div class="col-sm-8">
                                <textarea name="topic_ref" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <?php
                        echo <<< archemiya
          <input type="hidden" name="student_id" value="{$_SESSION['user_id']}">
          <input type="hidden" name="student_name" value="{$_SESSION['user_name']}">
          <input type="hidden" name="topic_id" value="{$row_task_book['topic_id']}">
          <input type="hidden" name="topic_name" value="{$row_task_book['topic_name']}">
          <input type="hidden" name="teacher_id" value="{$row_task_book['teacher_id']}">
          <input type="hidden" name="teacher_name" value="{$row_task_book['teacher_name']}">
archemiya;
                        ?>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary" onclick="JavaScript:return confirm('确定填写无误并上传开题报告么？');">上传</button>
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

    <div class="modal fade " id="firstReportAnnexTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">上传附件（请先上传摘要再上传附件）</h4>
                </div>
                <div class="modal-body">
                    <form action="../file-upload.php?func=first_report" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">上传开题报告附件</label>
                            <div class="col-sm-8">
                                <input name="file" type="file" class="input-file" />
                                <p class="help-block">上传文件格式仅限doc/docx/pdf，文件大小限制为10MB</p>
                            </div>
                        </div>
                        <?php
                        echo <<< archemiya
          <input type="hidden" name="num" value="{$num_first_report_record}">
          <input type="hidden" name="student_id" value="{$_SESSION['user_id']}">
          <input type="hidden" name="student_name" value="{$_SESSION['user_name']}">
          <input type="hidden" name="topic_id" value="{$row_task_book['topic_id']}">
          <input type="hidden" name="topic_name" value="{$row_task_book['topic_name']}">
archemiya;
                        ?>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">确定上传</button>
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

