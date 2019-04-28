<?php
include "../link.php";
include "../secretary_func/sec_query_stu_control.php";

/*查询此学生是否具有申请延期答辩资格:
    1.无需完成论文初稿！
    2.需在截止时间之前申请
申请状态码 即表`reply_schedule`中的reply_delay字段
    0 表示未申请
    1 表示申请成功
    -1 表示申请失败
    2 表示申请等待状态
注意此处只可进行一次延期答辩申请，即状态码为2之后不可再次操作
*/
//查询当前服务器时间
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');

//查询当前学生延期答辩申请状态
$sql_apply = "SELECT * from `reply_schedule` where `id` = '{$_SESSION['user_id']}' ";
$result_apply = mysqli_query($link, $sql_apply);
$row_apply = mysqli_fetch_array($result_apply, MYSQLI_BOTH);
$num_apply = mysqli_num_rows($result_apply);
?>

<body>

    <?php
    //当前服务器时间未超过截止时间
    if ($today <= $row_control['delay_reply_deadline'] && $row_control['delay_reply_deadline'] != NULL) {
        if ($row_apply['delay_reply'] == 0) {
            echo <<< archemiya
        <br/>
        <div class='alert alert-info' role='alert'>
            延期答辩申请截止时间为{$row_control['delay_reply_deadline']}，如需申请请在截止时间申请。
            <br/>
            申请流程：
            <span>
            <a href='' class='alert-info'>
            <strong>下载延期申请书</strong>
            </a>
            <span>
            并按要求填写，点击申请延期答辩按钮，填写申请理由并上传填写好的申请书，等待教务处审核。
        </div>
        <button class='btn btn-primary' data-toggle="modal" data-target="#delayTable">申请延期答辩</button>
archemiya;
        }
    }
    //当前服务器时间已超过截止时间
    elseif ($today > $row_control['delay_reply_deadline'] && $row_control['delay_reply_deadline'] != NULL) {
        echo <<< archemiya
        <br/>
        <div class='alert alert-danger' role='alert'>
            当前时间已超过申请截止时间，延期答辩申请功能已关闭
        </div>
archemiya;
    }
    //当前未设置截止时间
    elseif ($row_control['delay_reply_deadline'] == NULL) {
        echo <<< archemiya
        <br/>
        <div class='alert alert-danger' role='alert'>
            延期答辩申请功能尚未开放！
        </div>
archemiya;
    } elseif ($num_delay_1) {
        echo <<< archemiya
        <br/>
        <div class='alert alert-danger' role='alert'>
            您已申请延期答辩，请等待重新分组
        </div>
archemiya;
    }
    ?>
    <div class="modal fade " id="delayTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">申请延期答辩</h4>
                </div>
                <div class="modal-body">
                <?php
                    echo "<form action=\"../file-upload.php?func=delay_reply&id={$_SESSION['user_id']}\" method=\"POST\" class=\"form-horizontal\">";
                       
                        $sql = "SELECT * from `topic` where `student_id` = '{$_SESSION['user_id']}'";
                        $result = mysqli_query($link, $sql);
                        $row = mysqli_fetch_array($result, MYSQLI_BOTH);
                        ?>
                        <input type="hidden" name="topic_id" value="<?php $row['id'] ?>">
                        <input type="hidden" name="student_id" value="<?php $row['student_id'] ?>">
                        <input type="hidden" name="student_name" value="<?php $row['student_name'] ?>">

                        <div class="form-group">
                            <label for="inputTopicName" class="col-sm-2 control-label">申请理由说明</label>
                            <div class="col-sm-8">
                                <textarea name="delay_description" class="form-control" rows="5" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputDelayReport" class="col-sm-2 control-label">上传申请书</label>
                            <div class="col-sm-8">
                                <input name="file" type="file" class="input-file" required>
                                <p class="help-block">上传文件格式仅限doc/docx/pdf，文件大小限制为10MB</p>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" onclick="javascript:return confirm('确认无误并提交么？提交后将无法修改！')">提交</button>
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