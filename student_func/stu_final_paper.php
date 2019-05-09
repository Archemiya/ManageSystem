<!-- 此php为学生论文终稿展示文件 -->
<?php
/*
思路:
和论文终稿完全相同，此处同样采用记录表的形式，故使用 0 1 2 三种状态码：
 - 0 导师未审核状态 
 - 2 导师已审核，学生未修改状态
 - 1 最终审核完成状态

 两个重要条件：
 1 中期报告是否完成审核
 2 服务器时间是否超过截止时间
*/

include "../link.php";
include "../secretary_func/sec_query_stu_control.php";

//当前服务器时间
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');

//查询此学生的课题信息
$sql_topic = "SELECT * from `topic` 
where `student_id` =  '{$_SESSION['user_id']}'";
$result_topic = mysqli_query($link, $sql_topic);
$row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);

//查询论文终稿开启条件，即此学生是否完成中期报告
$sql_midterm_ispassed = "SELECT * from `midterm_report` 
where `student_id` = '{$_SESSION['user_id']}' and `final_flag` = 1";
$result_midterm_ispassed = mysqli_query($link, $sql_midterm_ispassed);
$num_midterm_ispassed = mysqli_fetch_array($result_midterm_ispassed);

//查询此学生提交的最新的论文终稿
$sql_id = "SELECT max(`record_id`) from `final_paper_record` 
where `student_id` = '{$_SESSION['user_id']}' order by `record_id` desc ";
$result_id = mysqli_query($link, $sql_id);
$row_id = mysqli_fetch_array($result_id, MYSQLI_BOTH);

$sql_final_paper = "SELECT * FROM `final_paper_record` WHERE `student_id` = '{$_SESSION['user_id']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
$result_final_paper = mysqli_query($link, $sql_final_paper);
$row_final_paper = mysqli_fetch_array($result_final_paper, MYSQLI_BOTH);
$num_final_paper = mysqli_num_rows($result_final_paper);

//查询此学生提交的论文终稿次数
$sql_num = "SELECT * FROM `final_paper_record` WHERE `final_paper_record`.`student_id` = '{$_SESSION['user_id']}' ";
$result_num = mysqli_query($link, $sql_num);
$num = mysqli_num_rows($result_num);


function paper_table_echo($link, $today, $num_final_paper, $row_topic, $row_control, $row_final_paper, $row_id, $num)
{

    echo <<< archemiya
<div class="table-responsive">
    <table data-toggle="table" data-toolbar="#toolbar">
        <thead>
            <tr>
            <th class="col-md-4 th-title-topic-chs" >课题名称</th>
            <th class="col-md-1 th-title-center th-title-topic-stu" >指导教师</th>
            <th class="col-md-3 th-title-center th-title-topic-stu" >状态</th>
            <th class="col-md-2 th-title-center th-title-topic-stu" >操作1</th>
            <th class="col-md-2 th-title-center th-title-topic-stu" >操作2</th>
            </tr>
            
        </thead>
        <tbody>
            <tr>
            <td class="td-height"><a href="./student.php?func=topic&id={$row_topic['id']}" >{$row_topic['name']}</a> </td>
            <td class="td-height td-title-center"> {$row_topic['teacher_name']}</td>
archemiya;

    //当前是否超过截止时间
    if (($today <= $row_control['final_paper_deadline'] && $row_control['final_paper_deadline'] != NULL)
        || $row_control['final_paper_deadline'] == NULL
    ) {
        //状态1 未提交状态，判断条件：查询最新报告未发现查询结果
        if (!$num_final_paper) {
            echo <<< archemiya
            <td class='td-title-center alert alert-danger' role='alert'>
            当前尚未提交论文终稿，请在
            <strong>{$row_control['final_paper_deadline']}</strong>
            前完成
            </td>
            <td>
            <button class="btn btn-default" data-toggle="modal" 
            data-target="#firstPaperTable" >上传论文终稿</button>
            </td>
            <td>
            <button class="btn btn-default" disabled >上传附件</button>
            </td>
archemiya;
        }
        //状态2 上交摘要 但尚未上交附件
        elseif (
            $num_final_paper
            && $row_final_paper['annex_flag'] == 0
            && $row_final_paper['final_flag'] == 0
        ) {
            //第一次提交时显示
            if ($num == 1) {
                echo <<< archemiya
            <td class='td-title-center alert alert-danger' role='alert'>
            当前尚未上传附件，请尽快上传
            （截止时间：
            <strong>{$row_control['final_paper_deadline']}</strong>）
            </td>
            <td>
            <button class="btn btn-default" disabled>已上传终稿摘要</button>
            </td>
            <td>
            <button class="btn btn-default" data-toggle="modal" 
            data-target="#firstPaperAnnexTable" >上传附件</button>
            </td>
archemiya;
                //第二次提交时显示
            } else {
                echo <<< archemiya
            <td class='td-title-center alert alert-warning' role='alert'>
            当前尚未上传附件，请尽快上传
            （截止时间：
            <strong>{$row_control['final_paper_deadline']}</strong>）
            </td>
            <td>
            <button class="btn btn-primary" disabled>已上传终稿摘要</button>
            </td>
            <td>
            <button class="btn btn-primary" data-toggle="modal" 
            data-target="#firstPaperAnnexTable" >重新上传附件</button>
            </td>
archemiya;
            }
        }
        //状态3 全部上传等待老师提出修改意见
        elseif (
            $num_final_paper
            && $row_final_paper['annex_flag'] == 1
            && $row_final_paper['final_flag'] == 0
        ) {
            echo <<< archemiya
        <td class='td-title-center alert alert-warning' role='alert'>
        已上传论文终稿，等待导师审核
        </td>
        <td>
        <button class="btn btn-warning" disabled>不可操作</button>
        </td>
        <td>
        <button class="btn btn-warning" disabled>不可操作</button>
        </td>
archemiya;
        }
        //状态4 导师给出修改意见，可重新修改后上传
        elseif (
            $num_final_paper
            && $row_final_paper['annex_flag'] == 1
            && $row_final_paper['final_flag'] == 2
        ) {
            echo <<< archemiya
        <td class='td-title-center alert alert-warning' role='alert'>
        导师已上传修改意见，请及时查看
        </td>
        <td>
        <a href='student.php?func=final_paper&id={$row_topic['id']}'
        class="btn btn-primary" role='button'>查看修改意见</a>
        </td>
        <td>
        <button class="btn btn-primary" disabled>重新上传附件</button>
        </td>
archemiya;
        }
        //状态5 论文终稿审核完成
        elseif (
            $num_final_paper
            && $row_final_paper['annex_flag'] == 1
            && $row_final_paper['final_flag'] == 1
        ) {
            echo <<< archemiya
        <td class='td-title-center alert alert-info' role='alert'>
        导师审核已完成
        </td>
        <td>
        <a href='student.php?func=final_paper&fid={$row_topic['id']}'
        class="btn btn-success" role='button'>查看论文终稿</a>
        </td>
        <td>
        <a href='../uploaded_files/final_paper_files/{$row_topic['student_id']}_{$row_id['max(`record_id`)']}/{$row_final_paper['final_paper_annex_name']}'
                class='btn btn-success' role='button'>下载附件</a>
        </td>
archemiya;
        }
    }
    //如果超过截止时间  
    elseif ($today > $row_control['final_paper_deadline'] && $row_control['final_paper_deadline'] != NULL) {
        if ($row_final_paper['final_flag'] == 1) {
            echo <<< archemiya
            <td class='td-title-center alert alert-info' role='alert'>
            导师审核已完成
            </td>
            <td>
            <a href='student.php?func=final_paper&fid={$row_topic['id']}'
            class="btn btn-success" role='button'>查看论文终稿</a>
            </td>
            <td>
            <a href='../uploaded_files/final_paper_files/{$row_topic['student_id']}_{$row_id['max(`record_id`)']}/{$row_final_paper['final_paper_annex_name']}'
                    class='btn btn-success' role='button'>下载附件</a>
            </td>
archemiya;
        } else {
            echo <<< archemiya
            <td class='td-title-center alert alert-danger' role='alert'>
            已超过截止时间，未完成论文终稿的审核
            </td>
            <td>
            <button class="btn btn-danger"  disabled>不可操作</button>
            </td>
            <td>
            <button class="btn btn-danger"  disabled>不可操作</button>
            </td>
archemiya;
        }
    }

    echo <<< archemiya
            </tr>
        </tbody>
    </table>
</div>

archemiya;
}
?>

<body>

    <?php
    //先判断是否超过截止时间
    if (($today <= $row_control['final_paper_deadline'] && $row_control['final_paper_deadline'] != NULL)
        || $row_control['final_paper_deadline'] == NULL
    ) {
        if (!$row_control['final_paper']) {
            echo <<< archemiya
        <br/>
        <div class="alert alert-danger" role="alert">
        <strong>当前论文终稿流程尚未开启，请等待教务处开启！</strong>
        </div>
archemiya;
        } else {
            //判断此学生当前的答辩状态
            //依旧为一辩状态则可以提交
            $sql_student = "SELECT * FROM `reply_schedule` WHERE `id` = '{$_SESSION['user_id']}' ";
            $result_student = mysqli_query($link, $sql_student);
            $row_student = mysqli_fetch_array($result_student, MYSQLI_BOTH);
            $num_student = mysqli_num_rows($result_student);
            if ($row_student['second_reply'] == 0) {
                echo <<< archemiya
    <br/>
    <div class="alert alert-danger" role="alert">
    论文终稿截止时间为<strong>{$row_control['final_paper_deadline']}</strong>，
    请及时完成论文终稿审核</div>
    <div class="alert alert-info" role="alert">
    <strong>提示：</strong>请先上传终稿内容摘要，再上传附件
    </div>
archemiya;
                paper_table_echo($link, $today, $num_final_paper, $row_topic, $row_control, $row_final_paper, $row_id, $num);
            } elseif ($row_student['second_reply'] == 1) {
                if ($row_control['second_reply']) {
                    echo <<< archemiya
    <br/>
    <div class="alert alert-danger" role="alert">
    论文终稿截止时间为<strong>{$row_control['final_paper_deadline']}</strong>，
    请及时完成论文终稿审核</div>
    <div class="alert alert-info" role="alert">
    <strong>提示：</strong>请先上传终稿内容摘要，再上传附件
    </div>
archemiya;
                }
            }
        }
    } else {
        if (
            !$num_final_paper
            || $row_final_paper['annex_flag'] != 1
            || $row_final_paper['final_flag'] != 1
        ) {
            echo <<< archemiya
    <br/>
    <div class="alert alert-danger" role="alert">
    <strong>当前已超过截止时间，您未完成论文终稿的线上审核，失去参加论文一辩资格</strong>
    </div>
archemiya;
        }
        paper_table_echo($link, $today, $num_final_paper, $row_topic, $row_control, $row_final_paper, $row_id, $num);
    }
    ?>
    <!-- 此处的两个modeltable为该学生上传开题报告和附件所用 -->
    <div class="modal fade " id="firstPaperTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">上传论文终稿</h4>
                </div>
                <div class="modal-body">
                    <form action="stu_add_final_paper.php" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">论文内容摘要</label>
                            <div class="col-sm-8">
                                <textarea name="paper_main" class="form-control" rows="20" required></textarea>
                            </div>
                        </div>
                        <?php
                        echo <<< archemiya
                        <input type="hidden" name="topic_id" value="{$row_topic['id']}">
                        <input type="hidden" name="topic_name" value="{$row_topic['name']}">
                        <input type="hidden" name="teacher_id" value="{$row_topic['teacher_id']}">
                        <input type="hidden" name="teacher_name" value="{$row_topic['teacher_name']}">
archemiya;
                        ?>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary">上传</button>
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

    <div class="modal fade " id="firstPaperAnnexTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">上传附件（请先上传摘要再上传附件）</h4>
                </div>
                <div class="modal-body">
                    <form action="../file-upload.php?func=final_paper" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">上传论文终稿附件</label>
                            <div class="col-sm-8">
                                <input name="file" type="file" class="input-file" />
                                <p class="help-block">上传文件格式仅限doc/docx/pdf，文件大小限制为10MB</p>
                            </div>
                        </div>
                        <?php
                        echo <<< archemiya
          <input type="hidden" name="num" value="{$num_final_paper}">
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