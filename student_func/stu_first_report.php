<?php
include "../link.php";
?>

<body>
  <div>
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#topicTable">上传开题报告</button>
  </div>
  <div class="modal fade " id="topicTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="chose-student-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title login-title">开题报告</h4>
        </div>
        <div class="modal-body">

          <form action="stu_update_first_report.php" method="POST" class="form-horizontal">
          <div class="form-group">
              <label for="inputTopicIntro" class="col-sm-3 control-label">课题来源</label>
              <div class="col-sm-8">
                <textarea name="topic_main" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicIntro" class="col-sm-3 control-label">课题研究的目的、意义</label>
              <div class="col-sm-8">
                <textarea name="topic_main" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicIntro" class="col-sm-3 control-label">课题的国内外研究现状和发展动态</label>
              <div class="col-sm-8">
                <textarea name="topic_main" class="form-control" rows="3"></textarea>
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
                <textarea name="topic_schedule" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicRef" class="col-sm-3 control-label">课题研究的进度安排</label>
              <div class="col-sm-8">
                <textarea name="topic_ref" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicRef" class="col-sm-3 control-label">主要参考文献</label>
              <div class="col-sm-8">
                <textarea name="topic_machine" class="form-control" rows="3"></textarea>
              </div>
            </div>
            <input type="hidden" name="student_id" value="{$row_chose_final_flag['student_id']}">
            <input type="hidden" name="student_name" value="{$row_chose_final_flag['student_name']}">
            <input type="hidden" name="topic_id" value="{$row['id']}">
            <input type="hidden" name="topic_name" value="{$row['name']}">
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" class="btn btn-primary" onclick="JavaScript:return confirm('确定填写无误并下达任务书么？');">确定</button>
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



    <!-- <form class="form-horizontal" action="../file-upload.php" method="post" enctype="multipart/form-data">
  <input type="hidden" name="MAX_FILE_SIZE" value="30000" />
  <div class=" ">
    <label for="inputTopicIntro" class="col-sm-3 control-label">上传开题报告</label>
    <div class="col-sm-8">
    <input name="file" type="file" class="input-file"/><br />
    </div>
  </div>
  <input class="btn btn-primary" type="submit" value="确认上传" />
</form> -->