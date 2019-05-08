<?php
//此页面为答辩秘书汇总所有学生的答辩记录，整理并上传的功能展示页面
include "../link.php";

function table_echo($link)
{
    //查询所有答辩学生及其答辩状态
    $sql_student = "SELECT * FROM `reply_schedule` WHERE `permission` = 'student' ";
    $result_student = mysqli_query($link, $sql_student);
    $num_student = mysqli_num_rows($result_student);

    echo <<< archemiya
    <div class="table-responsive">
    <table data-toggle="table" data-toolbar="#toolbar" data-pagination="true"
        data-page-list="[10, 25, 50, 100, 200, All]" 
        data-sort-name="name" data-sort-order="asc"
        data-show-refresh="true">
        <thead>
            <tr>
                <th class="col-md-4 th-title-center th-title-topic-stu">课题名称</th>
                <th class="col-md-2 th-title-center th-title-topic-stu">教师名称</th>
                <th class="col-md-2 th-title-center th-title-topic-stu">学生名称</th>
                <th class="col-md-2 th-title-center th-title-topic-stu" 
                data-field="name" data-sortable="true">状态</th>
                <th class="col-md-2 th-title-center th-title-topic-stu">操作</th>
            </tr>
        </thead>
        <tbody>
archemiya;
    for ($i = 0; $i < $num_student; $i++) {
        $row_student = mysqli_fetch_array($result_student, MYSQLI_BOTH);

        //根据学生id查询学生的课题详情
        $sql_topic = "SELECT * FROM `topic`WHERE `student_id` = '{$row_student['id']}' ";
        $result_topic = mysqli_query($link, $sql_topic);
        $row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);

        //根据学生id查询学生的答辩记录情况
        $sql_record = "SELECT * FROM `reply_record` WHERE `student_id` = '{$row_student['id']}' ";
        $result_record = mysqli_query($link, $sql_record);
        $row_record = mysqli_fetch_array($result_record, MYSQLI_BOTH);

        echo "<td class=\"td-height th-title-center\">";
        echo "<a href='tutor.php?func=reply_grade&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
        echo "</td>";
        echo "<td class=\"td-height th-title-center \" >";
        echo   $row_topic['teacher_id'] . $row_topic['teacher_name'];
        echo "</td>";

        //根据学生处于一辩、延期答辩或是二辩来显示状态
        //一辩显示蓝色，延期显示黄色，二辩显示红色
        //此处延期与二辩通过second_reply来区别，状态码为1时表示延期，状态码为2时表示二辩
        if ($row_student['first_paper_flag']==1 && $row_student['reply_delay']==0) {
            echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
            echo   $row_student['id'] . $row_student['name'];
            echo "</td>";

            echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
            echo "参与一辩";
            echo "</td>";
            if(!isset($row_record['reply_record_annex_name'])){
                echo "<td>";
                echo "<button class='btn btn-primary' 
                data-toggle=\"modal\" data-target=\"#{$row_student['id']}\">
                上传答辩记录
                </button>";
                echo "</td>";
            }else{
                echo "<td>";
                echo "<button class='btn btn-primary' disabled>
                上传答辩记录
                </button>";
                echo "</td>";
            }
        }
        elseif($row_student['reply_delay']==1){
            echo "<td class=\"td-height th-title-center alert alert-warning\" role='alert' >";
            echo   $row_student['id'] . $row_student['name'];
            echo "</td>";

            echo "<td class=\"td-height th-title-center alert alert-warning\" role='alert' >";
            echo "延期答辩";
            echo "</td>";

            echo "<td>";
            echo "<button class='btn btn-primary' 
            data-toggle=\"modal\" data-target=\"#{$row_student['id']}\">
            上传答辩记录
            </button>";
            echo "</td>";
        }
        else{
            echo "<td class=\"td-height th-title-center alert alert-danger\" role='alert' >";
            echo   $row_student['id'] . $row_student['name'];
            echo "</td>";

            echo "<td class=\"td-height th-title-center alert alert-danger\" role='alert' >";
            echo "参与二辩";
            echo "</td>";

            echo "<td>";
            echo "<button class='btn btn-primary' 
            data-toggle=\"modal\" data-target=\"#{$row_student['id']}\">
            上传答辩记录
            </button>";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo <<< archemiya
        </tbody>



    </table>
    </div>
archemiya;
}
?>

<body>
    <?php
    table_echo($link);

    //查询所有答辩学生及其答辩状态（此处用于输出多个modalTable）
    $sql_student = "SELECT * FROM `reply_schedule` WHERE `permission` = 'student' ";
    $result_student = mysqli_query($link, $sql_student);
    $num_student = mysqli_num_rows($result_student);

    for ($i = 0; $i < $num_student; $i++) {
        $row_student = mysqli_fetch_array($result_student, MYSQLI_BOTH);

        //根据学生id查询学生的课题详情
        $sql_topic = "SELECT * FROM `topic`WHERE `student_id` = '{$row_student['id']}' ";
        $result_topic = mysqli_query($link, $sql_topic);
        $row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);

        echo <<< archemiya
        <div class="modal fade " id="{$row_student['id']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">上传附件</h4>
                </div>
                <div class="modal-body">
                    <form action="../file-upload.php?func=reply_record" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">上传答辩记录附件</label>
                            <div class="col-sm-8">
                                <input name="file" type="file" class="input-file" />
                                <p class="help-block">上传文件格式仅限doc/docx/pdf，文件大小限制为10MB</p>
                            </div>
                        </div>
                <input type="hidden" name="student_id" value="{$row_student['id']}">
                <input type="hidden" name="student_name" value="{$row_student['name']}">
                <input type="hidden" name="topic_id" value="{$row_topic['id']}">
                <input type="hidden" name="topic_name" value="{$row_topic['name']}">
                <input type="hidden" name="teacher_id" value="{$row_topic['teacher_id']}">
                <input type="hidden" name="teacher_name" value="{$row_topic['teacher_name']}">
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
archemiya;
    }
    ?>
    
</body>