<?php
include "../link.php";
$sql = "SELECT * FROM `first_report` WHERE `student_id` = '{$_SESSION['user_id']}'"; //查询该学生开题报告
$sql_task_book = "SELECT * FROM `task_book` WHERE `student_id` = '{$_SESSION['user_id']}' ";
$result_task_book = mysqli_query($link, $sql_task_book);
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
$num = mysqli_num_rows($result);
$row_task_book = mysqli_fetch_array($result_task_book, MYSQLI_BOTH);
$num_task_book = mysqli_num_rows($result_task_book);

?>

<body>
  <div class="table-responsive">
    <table data-toggle="table" data-toolbar="#toolbar">
      <thead>
        <tr>
          <th class="col-md-5 th-title-topic-chs">课题名称</th>
          <th class="col-md-1 th-title-center th-title-topic-stu">指导教师</th>
          <th class="col-md-3 th-title-center th-title-topic-stu">状态</th>
          <th class="col-md-3 th-title-center th-title-topic-stu">操作</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="td-height"><?php echo $row_task_book['topic_name']; ?></td>
          <td class="td-height td-title-center"><?php echo $row_task_book['teacher_name']; ?></td>

          <?php
          if ($num_task_book == 0) {
            echo "<td class=\"td-height td-title-center alert alert-danger\" role='alert'>";
            echo "导师还未下达任务书！不可填写开题报告";
          } elseif ($row_task_book['islook_flag'] == 0) {
            echo "<td class=\"td-height td-title-center alert alert-danger\" role='alert'>";
            echo "您还未确认任务书！不可填写开题报告";
          } elseif ($num_task_book && $row_task_book['islook_flag'] && !$num) {
            echo "<td class=\"td-height td-title-center alert alert-danger\" role='alert'>";
            echo "您还未上传开题报告，请及时上传";
          } elseif ($num_task_book && $row_task_book['islook_flag'] && $num && ($row['final_flag'] == 0)) {
            echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
            echo "您已上传开题报告，请等待指导老师审核";
          } elseif ($num_task_book && $row_task_book['islook_flag'] && $num && ($row['final_flag'] == 2)) {
            echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
            echo "指导老师已提交至评阅组，请等待评阅组审核";
          } elseif ($num_task_book && $row_task_book['islook_flag'] && $num && ($row['final_flag'] == 1)) {
            echo "<td class=\"td-height td-title-center alert alert-info\" role='alert'>";
            echo "开题报告审核已结束";
          }
          ?>
          </td>
          <td>
            <?php
            if ($num_task_book == 0) {
              echo "<button class=\"btn btn-primary\" disabled >不可操作</button>";
            } elseif ($row_task_book['islook_flag'] == 0) {
              echo "<button class=\"btn btn-primary\" disabled >不可操作</button>";
            } elseif ($num_task_book && $row_task_book['islook_flag'] && !$num) {
              echo "<button class=\"btn btn-primary\" data-toggle=\"modal\" 
            data-target=\"#firstReportTable\" >上传开题报告</button>";
            } elseif ($num_task_book && $row_task_book['islook_flag'] && $num && ($row['final_flag'] == 0)) {

            } elseif ($num_task_book && $row_task_book['islook_flag'] && $num && ($row['final_flag'] == 2)) { 

            } elseif ($num_task_book && $row_task_book['islook_flag'] && $num && ($row['final_flag'] == 1)) { 
              
            }
            ?>

          </td>
        </tr>
      </tbody>
    </table>
  </div>

  <div class="modal fade " id="firstReportTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
          <input type="hidden" name="num" value="{$num}">
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

  <body>