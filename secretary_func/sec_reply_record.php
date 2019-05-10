<?php
//此页面为答辩秘书汇总所有学生的答辩记录，整理并上传的功能展示页面
include "../link.php";
include "sec_query_stu_control.php";

function table_echo($link, $row_control)
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
        >
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
        echo "<a href='secretary.php?func=reply_record&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
        echo "</td>";
        echo "<td class=\"td-height th-title-center \" >";
        echo   $row_topic['teacher_id'] . $row_topic['teacher_name'];
        echo "</td>";

        /*
        应根据所处的答辩阶段来进行答辩状态显示 
        此处应显示出学生的三种状态，即一辩，二辩与延期毕业状态
            应注意的几个地方：
                1 论文初稿与延期申请状态是第一次判断一辩与二辩状态的节点
                2 一辩结束之后应该再次判断是否存在二辩的同学
                3 延期毕业状态同样也存在着两次判定，第一次是在论文初稿和延期申请结束时，第二次是在二辩结束之后
        */
        //使用second_reply来表示状态，0表示一辩 1表示二辩 -1表示延期毕业
        //先判断当前所处阶段

        //处于一辩阶段
        if ($row_control['first_reply'] && !$row_control['second_reply']) {
            //判断当前学生是否为当前阶段一辩学生
            if ($row_student['first_paper_flag'] == 1 && $row_student['reply_delay'] == 0) {
                echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
                echo   $row_student['id'] . $row_student['name'];
                echo "</td>";

                echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
                echo "参与一辩";
                echo "</td>";
                if (!isset($row_record['reply_record_annex_name'])) {
                    echo "<td>";
                    echo "<button class='btn btn-primary' 
                    data-toggle=\"modal\" data-target=\"#{$row_student['id']}\">
                    上传答辩记录
                    </button>";
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo "<button class='btn btn-success' disabled>
                    已上传答辩记录
                    </button>";
                    echo "</td>";
                }
            }
            //判断当前学生是否为当前阶段二辩学生
            elseif (($row_student['first_paper_flag'] == 1 && $row_student['reply_delay'] == 1)
                || ($row_student['first_paper_flag'] == 0 && $row_student['reply_delay'] == 1)
            ) {
                $sql_second_reply_1 = "UPDATE `reply_schedule` set `second_reply` = 1
                WHERE `id` = '{$row_student['id']}' ";
                mysqli_query($link, $sql_second_reply_1);
                echo "<td class=\"td-height th-title-center alert alert-warning\" role='alert' >";
                echo   $row_student['id'] . $row_student['name'];
                echo "</td>";

                echo "<td class=\"td-height th-title-center alert alert-warning\" role='alert' >";
                echo "参与二辩";
                echo "</td>";

                echo "<td>";
                echo "<button class='btn btn-warning' disabled>
                    不可上传
                    </button>";
                echo "</td>";
            } elseif (($row_student['first_paper_flag'] == 0 && $row_student['reply_delay'] == 0)
                || ($row_student['first_paper_flag'] == 0 && $row_student['reply_delay'] == -1)
            ) {
                $sql_gg = "UPDATE `reply_schedule` set `second_reply` = -1
                WHERE `id` = '{$row_student['id']}' ";
                mysqli_query($link, $sql_gg);
                echo "<td class=\"td-height th-title-center alert alert-danger\" role='alert' >";
                echo   $row_student['id'] . $row_student['name'];
                echo "</td>";

                echo "<td class=\"td-height th-title-center alert alert-danger\" role='alert' >";
                echo "延迟毕业";
                echo "</td>";

                echo "<td>";
                echo "<button class='btn btn-danger' disabled>
                不可上传
                </button>";
                echo "</td>";
            }
        }
        //处于二辩阶段
        elseif ($row_control['second_reply']) {
            //判断当前学生是否为当前阶段一辩学生
            if ($row_student['second_reply'] == 0) {
                echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
                echo   $row_student['id'] . $row_student['name'];
                echo "</td>";

                echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
                echo "参与一辩";
                echo "</td>";
                if (!isset($row_record['reply_record_annex_name'])) {
                    echo "<td>";
                    echo "<button class='btn btn-primary' 
                    data-toggle=\"modal\" data-target=\"#{$row_student['id']}\">
                    上传答辩记录
                    </button>";
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo "<button class='btn btn-success' disabled>
                    已上传答辩记录
                    </button>";
                    echo "</td>";
                }
            }
            //判断当前学生是否为当前阶段二辩学生
            elseif ($row_student['second_reply'] == 1) {
                $sql_second_reply_1 = "UPDATE `reply_schedule` set `second_reply` = 1
                WHERE `id` = '{$row_student['id']}' ";
                mysqli_query($link, $sql_second_reply_1);
                echo "<td class=\"td-height th-title-center alert alert-warning\" role='alert' >";
                echo   $row_student['id'] . $row_student['name'];
                echo "</td>";

                echo "<td class=\"td-height th-title-center alert alert-warning\" role='alert' >";
                echo "参与二辩";
                echo "</td>";

                if (!isset($row_record['reply_record_annex_name'])) {
                    echo "<td>";
                    echo "<button class='btn btn-warning' 
                    data-toggle=\"modal\" data-target=\"#second{$row_student['id']}\">
                    上传答辩记录
                    </button>";
                    echo "</td>";
                } else {
                    echo "<td>";
                    echo "<button class='btn btn-success' disabled>
                    已上传答辩记录
                    </button>";
                    echo "</td>";
                }
            } elseif (($row_student['first_paper_flag'] == 0 && $row_student['reply_delay'] == 0)
                || ($row_student['first_paper_flag'] == 0 && $row_student['reply_delay'] == -1)
            ) {
                $sql_gg = "UPDATE `reply_schedule` set `second_reply` = -1
                WHERE `id` = '{$row_student['id']}' ";
                mysqli_query($link, $sql_gg);
                echo "<td class=\"td-height th-title-center alert alert-danger\" role='alert' >";
                echo   $row_student['id'] . $row_student['name'];
                echo "</td>";

                echo "<td class=\"td-height th-title-center alert alert-danger\" role='alert' >";
                echo "延迟毕业";
                echo "</td>";

                echo "<td>";
                echo "<button class='btn btn-danger' disabled>
                不可上传
                </button>";
                echo "</td>";
            }
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
    if (!$row_control['first_reply']) {
        echo <<< archemiya
        <div class="alert alert-danger" role="alert">
        当前一次答辩流程尚未开启！
        </div>
archemiya;
    } elseif ($row_control['first_reply'] && !$row_control['second_reply']) {
        echo <<< archemiya
        <div class="alert alert-info" role="alert">
        当前为一次答辩阶段，只可上传一辩学生答辩记录
        </div>
archemiya;
        table_echo($link, $row_control);
    } elseif ($row_control['second_reply']) {
        echo <<< archemiya
        <div class="alert alert-info" role="alert">
        当前为二次答辩阶段，可上传二辩学生答辩记录
        </div>
archemiya;
        table_echo($link, $row_control);
    }

    //一辩 查询所有答辩学生及其答辩状态（此处用于输出多个modalTable）
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

    //二辩 查询所有答辩学生及其答辩状态（此处用于输出多个modalTable）
    $sql_second_student = "SELECT * FROM `second_reply_schedule` WHERE `permission` = 'student' ";
    $result_second_student = mysqli_query($link, $sql_second_student);
    $num_second_student = mysqli_num_rows($result_second_student);

    for ($i = 0; $i < $num_second_student; $i++) {
        $row_second_student = mysqli_fetch_array($result_second_student, MYSQLI_BOTH);

        //根据学生id查询学生的课题详情
        $sql_topic_2 = "SELECT * FROM `topic`WHERE `student_id` = '{$row_second_student['id']}' ";
        $result_topic_2 = mysqli_query($link, $sql_topic_2);
        $row_topic_2 = mysqli_fetch_array($result_topic_2, MYSQLI_BOTH);

        echo <<< archemiya
        <div class="modal fade " id="second{$row_second_student['id']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">上传附件</h4>
                </div>
                <div class="modal-body">
                    <form action="../file-upload.php?func=second_reply_record" method="POST" class="form-horizontal" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">上传答辩记录附件</label>
                            <div class="col-sm-8">
                                <input name="file" type="file" class="input-file" />
                                <p class="help-block">上传文件格式仅限doc/docx/pdf，文件大小限制为10MB</p>
                            </div>
                        </div>
                <input type="hidden" name="student_id" value="{$row_second_student['id']}">
                <input type="hidden" name="student_name" value="{$row_second_student['name']}">
                <input type="hidden" name="topic_id" value="{$row_topic_2['id']}">
                <input type="hidden" name="topic_name" value="{$row_topic_2['name']}">
                <input type="hidden" name="teacher_id" value="{$row_topic_2['teacher_id']}">
                <input type="hidden" name="teacher_name" value="{$row_topic_2['teacher_name']}">
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