<?php
/*
思路：
不同于开题报告，中期报告只是一个检查报告，不需要答辩，因此只需要一次提交，导师确认即可，因此可参照任务书的形式来写
1.首先判断开启条件：
 - 只有一个条件，即开题报告结束，此处可对 `student_grade`即学生成绩表中的 `first_grade` 字段进行查询，得出 **num_rows** ，然后与`user`中的 **num_rows** 对比。
2.开启之后，学生提交中期报告，各自导师对学生的中期报告进行检查，并写下指导意见。
3.学生查看指导意见之后，对报告进行修改，并重新上传
4.重复上述过程直到老师同意为止

其中处于何种状态通过 `final_flag` 的值来确定
 - 0 学生已提交新的中期报告
 - 2 导师已提交新的指导建议
 - 1 导师已确定新的中期报告
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
$num_midterm = mysqli_num_rows($result_midterm);

//查询所有学生相关信息
$sql_topic = "SELECT * from `topic` where `student_id` = '{$_SESSION['user_id']}' ";
$result_topic = mysqli_query($link, $sql_topic);
$row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);


?>

<body>
<br/>
    <div class="alert alert-info" role="alert">
    <strong>提示：</strong>请先上传中期报告摘要，再上传附件
    </div>
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar">
            <thead>
                <tr>
                    <th class="col-md-4 th-title-topic-chs">课题名称</th>
                    <th class="col-md-1 th-title-center th-title-topic-stu">指导教师</th>
                    <th class="col-md-3 th-title-center th-title-topic-stu">状态</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作1</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作2</th>
                </tr>

            </thead>
            <tbody>
                <tr>
                    <td class="td-height">
                        <?php
                        echo <<< archemiya
                        <a href="./student.php?func=topic&id={$row_topic['id']}">
                        {$row_topic['name']}
archemiya;
                        ?>
                        </a>
                    </td>
                    <td class="td-height td-title-center">
                        <?php
                        echo $row_topic['teacher_name'];
                        ?>
                    </td>

                    <?php
                    if ($num_first_report_grade != $num_student) {
                        echo <<< archemiya
                <td class="td-title-center alert alert-danger" role='alert'>
                    当前开题答辩评分尚未结束，不可提交中期报告，请耐心等待评分结束！
                </td>
                <td>
                <td>
                </td>
                </td>
archemiya;
                    } else {
                        if (!isset($row_midterm['student_id'])) {
                            echo <<< archemiya
                            <td class="td-title-center alert alert-warning" role='alert'>
                            您尚未提交中期报告及附件，请及时提交！（请先上传摘要再上传附件）
                            </td>
                            <td>
                            <button class='btn btn-primary' data-toggle="modal" 
                            data-target="#midtermReportTable">提交中期报告</button>
                            </td>
                            <td>
                            <button class="btn btn-primary" disabled >上传附件</button>
                            </td>
archemiya;
                        } elseif (isset($row_midterm['student_id']) && $row_midterm['annex_flag'] == 0 && $row_midterm['final_flag'] == 0) {
                            echo <<< archemiya
                            <td class="td-title-center alert alert-warning" role='alert'>
                            您尚未提交附件，请及时提交！
                            </td>
                            <td>
                            <button class='btn btn-warning' disabled>已提交摘要部分</button>
                            </td>
                            <td>
                            <button class="btn btn-primary" data-toggle="modal" 
                data-target="#midtermReportAnnexTable" >上传附件</button>
                            </td>
archemiya;
                        } elseif (($row_midterm['student_id']) && $row_midterm['final_flag'] == 0) {
                            echo <<< archemiya
                            <td class="td-title-center alert alert-warning" role='alert'>
                            您已提交中期报告，请耐心等待导师确认！
                            </td>
                            <td>
                            <button class="btn btn-warning" disabled>不可操作</button>
                            </td>
                            <td>
                            <button class="btn btn-warning" disabled>不可操作</button>
                            </td>
archemiya;
                        } elseif (($row_midterm['student_id']) && $row_midterm['final_flag'] == 2) {
                            echo <<< archemiya
                            <td class="td-title-center alert alert-warning" role='alert'>
                            导师已批示，请及时查看
                            </td>
                            <td>
                            <a href='student.php?func=midterm_report&id={$row_midterm['topic_id']}' 
                            class="btn btn-primary" role='button' >查看修改意见</a>
                            </td>
                            <td>
                            <button class="btn btn-primary" data-toggle="modal" 
                data-target="#midtermReportAnnexTable" >重新上传附件</button>
                            </td>
archemiya;
                        } elseif(($row_midterm['student_id']) && $row_midterm['final_flag'] == 1) {
                            echo <<< archemiya
                            <td class="td-title-center alert alert-info" role='alert'>
                            已通过导师审核
                            </td>
                            <td>
                            <a href="student.php?func=midterm_report&fid={$row_midterm['topic_id']}"
                            class="btn btn-success" role='button' >查看中期报告</a>
                            </td>
                            <td>
                            <a href='../uploaded_files/midterm_report_files/{$row_midterm['midterm_report_annex_name']}' 
                            class='btn btn-success' role='button'>下载附件</a>
                            </td>
archemiya;
                        }
                    }
                    ?>

                </tr>
            </tbody>
        </table>
        <!-- 此处的两个modeltable功能为填写中期报告及中期报告附件 -->
        <div class="modal fade " id="midtermReportTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="chose-student-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title login-title">上传中期报告</h4>
                    </div>
                    <div class="modal-body">
                        <form action="stu_add_update_midterm_report.php" method="POST" class="form-horizontal">
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
                        <input type="hidden" name="student_id" value="{$_SESSION['user_id']}">
                        <input type="hidden" name="student_name" value="{$_SESSION['user_name']}">
                        <input type="hidden" name="topic_id" value="{$row_topic['id']}">
                        <input type="hidden" name="topic_name" value="{$row_topic['name']}">
                        <input type="hidden" name="teacher_id" value="{$row_topic['teacher_id']}">
                        <input type="hidden" name="teacher_name" value="{$row_topic['teacher_name']}">
archemiya;
                            ?>
                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-10">
                                    <button type="submit" class="btn btn-primary" >上传</button>
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

        <div class="modal fade " id="midtermReportAnnexTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="chose-student-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title login-title">上传附件（请先上传摘要再上传附件）</h4>
                    </div>
                    <div class="modal-body">
                        <form action="../file-upload.php?func=midterm_report" method="POST" class="form-horizontal" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="inputTopicRef" class="col-sm-3 control-label">上传中期报告附件</label>
                                <div class="col-sm-8">
                                    <input name="file" type="file" class="input-file" />
                                    <p class="help-block">上传文件格式仅限doc/docx/pdf，文件大小限制为10MB</p>
                                </div>
                            </div>
                            <?php
                            echo <<< archemiya
                        <input type="hidden" name="num" value="{$num_midterm}">
                        <input type="hidden" name="student_id" value="{$_SESSION['user_id']}">
                        <input type="hidden" name="student_name" value="{$_SESSION['user_name']}">
                        <input type="hidden" name="topic_id" value="{$row_topic['id']}">
                        <input type="hidden" name="topic_name" value="{$row_topic['name']}">
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