<?php
include "../link.php";
include "../secretary_func/sec_query_t_control.php";
$sql_stu_control = "SELECT * FROM `stu_func_control`" ;
$result_stu_control = mysqli_query($link,$sql_stu_control);
$row_stu_control = mysqli_fetch_array($result_stu_control,MYSQLI_BOTH);

//查询此教师所属答辩组
$sql_group = "SELECT * from `reply_schedule` where `id` = '{$_SESSION['user_id']}'";
$result_group = mysqli_query($link, $sql_group);
$row_group = mysqli_fetch_array($result_group, MYSQLI_BOTH);

//一辩
function echo_fisrt_reply_schedule_table($row_group, $link)
{
    $group_id = $row_group['group_id'];

    //查询所有一辩学生
    $sql_student_num = "SELECT * FROM `reply_schedule` 
    WHERE `group_id` = '{$group_id}' AND `permission` = 'student' AND `reply_delay` = 0 AND `first_paper_flag` = 1";
    $result_student_num = mysqli_query($link, $sql_student_num);
    $num_student = mysqli_num_rows($result_student_num);
    echo <<< archemiya
    <div class=" alert alert-warning" role='alert'>
    一辩评分
    </div>
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#{$group_id}">
            <thead>
                <tr>
                    <th class="col-md-12 th-title-center" colspan="4">学生名单</th>
                </tr>
                <tr>
                    <th class="col-md-6 th-title-center">学生选题</th>
                    <th class="col-md-2 th-title-center">学生姓名</th>
                    <th class="col-md-2 th-title-center">操作1</th>
                    <th class="col-md-2 th-title-center">操作2</th>
                </tr>

            </thead>

            <tbody>
                <div id="{$group_id}">
                    <button type="button" class="btn btn-default active" > 
archemiya;
    echo "所属小组为：第 " . $group_id . " 小组";
    echo <<< archemiya
                </button>
                </div>
archemiya;
    for ($i = 0; $i < $num_student; $i++) {
        $row_student = mysqli_fetch_array($result_student_num, MYSQLI_BOTH);
        echo "<tr>";

        $sql_topic = "SELECT * FROM `topic`WHERE `student_id` = '{$row_student['id']}' ";
        $result_topic = mysqli_query($link, $sql_topic);
        $row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);

        //根据学生id查询学生的答辩记录情况
        $sql_record = "SELECT * FROM `reply_record` WHERE `student_id` = '{$row_student['id']}' ";
        $result_record = mysqli_query($link, $sql_record);
        $row_record = mysqli_fetch_array($result_record, MYSQLI_BOTH);

        //根据学生id查询学生成绩情况(此处查询的为学生成绩记录表)
        $sql_grade = "SELECT * FROM `student_reply_grade_record` 
        WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `student_id` = '{$row_student['id']}'";
        $result_grade = mysqli_query($link, $sql_grade);
        $row_grade = mysqli_fetch_array($result_grade, MYSQLI_BOTH);

        //根据学生id查询学生最终成绩情况(此处查询的为学生成绩表)
        $sql_fgrade = "SELECT * FROM `student_grade` 
        WHERE `student_id` = '{$row_student['id']}'";
        $result_fgrade = mysqli_query($link, $sql_fgrade);
        $row_fgrade = mysqli_fetch_array($result_fgrade, MYSQLI_BOTH);

        echo "<td class=\"td-height th-title-center\">";
        echo "<a href='tutor.php?func=reply_grade&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
        echo "</td>";
        echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
        echo   $row_student['id'] . $row_student['name'];
        echo "</td>";

        if (!isset($row_grade['reply_grade'])) {
            if (isset($row_record['reply_record_annex_name'])) {
                echo "<td>";
                echo "<a class='btn btn-primary' role='button'
            data-toggle=\"modal\" data-target=\"#first_{$row_student['id']}\">
            一辩评分
            </button>";
                echo "</td>";
                echo "<td>";
                echo "<a href='../uploaded_files/reply_record_files/{$row_student['id']}/{$row_record['reply_record_annex_name']}' 
            class='btn btn-primary' role='button'>
            下载附件
            </button>";
                echo "</td>";
            } else {
                echo "<td>";
                echo "<a class='btn btn-primary' role='button' disabled>
            一辩评分
            </button>";
                echo "</td>";
                echo "<td>";
                echo "<a class='btn btn-primary' role='button' disabled>
            尚无答辩记录附件
            </button>";
                echo "</td>";
            }
        } elseif (($row_fgrade['reply_grade']) != 0) {
            echo "<td class='th-title-center alert alert-info' role='alert'>";
            echo "最终成绩：";
            echo $row_fgrade['reply_grade'];
            echo "</td>";
            echo "<td>";
            echo "";
            echo "</td>";
        } else {
            echo "<td class='th-title-center alert alert-info' role='alert'>";
            echo "您的评分：";
            echo $row_grade['reply_grade'];
            echo "</td>";
            echo "<td>";
            echo "";
            echo "</td>";
        }

        echo "</tr>";
    }
    echo <<< archemiya
            </tbody>
        </table>

        <br/>

    </div>
archemiya;
}

//二辩
function echo_second_reply_schedule_table($row_group, $link)
{
    $group_id = $row_group['group_id'];

    //查询所有二辩学生
    $sql_student_num = "SELECT * FROM `reply_schedule`
    AND `permission` = 'student' 
    AND `second_reply` = 1";
    $result_student_num = mysqli_query($link, $sql_student_num);
    $num_student = mysqli_num_rows($result_student_num);
    echo <<< archemiya
    <div class=" alert alert-warning" role='alert'>
    二辩评分
    </div>
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#{$group_id}">
            <thead>
                <tr>
                    <th class="col-md-12 th-title-center" colspan="4">学生名单</th>
                </tr>
                <tr>
                    <th class="col-md-6 th-title-center">学生选题</th>
                    <th class="col-md-2 th-title-center">学生姓名</th>
                    <th class="col-md-2 th-title-center">操作1</th>
                    <th class="col-md-2 th-title-center">操作2</th>
                </tr>

            </thead>

            <tbody>
                <div id="{$group_id}">
                    <button type="button" class="btn btn-default active" > 
archemiya;
    echo "所属小组为：第 " . $group_id . " 小组";
    echo <<< archemiya
                </button>
                </div>
archemiya;
    for ($i = 0; $i < $num_student; $i++) {
        $row_student = mysqli_fetch_array($result_student_num, MYSQLI_BOTH);
        echo "<tr>";

        $sql_topic = "SELECT * FROM `topic`WHERE `student_id` = '{$row_student['id']}' ";
        $result_topic = mysqli_query($link, $sql_topic);
        $row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);

        //根据学生id查询学生的答辩记录情况
        $sql_record = "SELECT * FROM `reply_record` WHERE `student_id` = '{$row_student['id']}' ";
        $result_record = mysqli_query($link, $sql_record);
        $row_record = mysqli_fetch_array($result_record, MYSQLI_BOTH);

        //根据学生id查询学生成绩情况(此处查询的为学生成绩记录表)
        $sql_grade = "SELECT * FROM `student_reply_grade_record` 
        WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `student_id` = '{$row_student['id']}'";
        $result_grade = mysqli_query($link, $sql_grade);
        $row_grade = mysqli_fetch_array($result_grade, MYSQLI_BOTH);

        //根据学生id查询学生最终成绩情况(此处查询的为学生成绩表)
        $sql_fgrade = "SELECT * FROM `student_grade` 
        WHERE `student_id` = '{$row_student['id']}'";
        $result_fgrade = mysqli_query($link, $sql_fgrade);
        $row_fgrade = mysqli_fetch_array($result_fgrade, MYSQLI_BOTH);

        echo "<td class=\"td-height th-title-center\">";
        echo "<a href='tutor.php?func=reply_grade&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
        echo "</td>";
        echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
        echo   $row_student['id'] . $row_student['name'];
        echo "</td>";

        if (!isset($row_grade['reply_grade'])) {
            if (isset($row_record['reply_record_annex_name'])) {
                echo "<td>";
                echo "<a class='btn btn-primary' role='button'
            data-toggle=\"modal\" data-target=\"#first_{$row_student['id']}\">
            一辩评分
            </button>";
                echo "</td>";
                echo "<td>";
                echo "<a href='../uploaded_files/reply_record_files/{$row_student['id']}/{$row_record['reply_record_annex_name']}' 
            class='btn btn-primary' role='button'>
            下载附件
            </button>";
                echo "</td>";
            } else {
                echo "<td>";
                echo "<a class='btn btn-primary' role='button' disabled>
            一辩评分
            </button>";
                echo "</td>";
                echo "<td>";
                echo "<a class='btn btn-primary' role='button' disabled>
            尚无答辩记录附件
            </button>";
                echo "</td>";
            }
        } elseif (($row_fgrade['reply_grade']) != 0) {
            echo "<td class='th-title-center alert alert-info' role='alert'>";
            echo "最终成绩：";
            echo $row_fgrade['reply_grade'];
            echo "</td>";
            echo "<td>";
            echo "";
            echo "</td>";
        } else {
            echo "<td class='th-title-center alert alert-info' role='alert'>";
            echo "您的评分：";
            echo $row_grade['reply_grade'];
            echo "</td>";
            echo "<td>";
            echo "";
            echo "</td>";
        }

        echo "</tr>";
    }
    echo <<< archemiya
            </tbody>
        </table>

        <br/>

    </div>
archemiya;
}

//指导学生 此处查询的为teacher_grade字段
function echo_student_reply_schedule_table($link)
{
    //查询所有指导学生学生
    $sql_student_num = "SELECT * FROM `topic` 
    WHERE `teacher_id` = '{$_SESSION['user_id']}' ";
    $result_student_num = mysqli_query($link, $sql_student_num);
    $num_student = mysqli_num_rows($result_student_num);

    echo <<< archemiya
    <div class=" alert alert-warning" role='alert'>
    指导学生评分
    </div>
    <div class="table-responsive">
        <table data-toggle="table" >
            <thead>
                <tr>
                    <th class="col-md-12 th-title-center" colspan="4">学生名单</th>
                </tr>
                <tr>
                    <th class="col-md-6 th-title-center">学生选题</th>
                    <th class="col-md-2 th-title-center">学生姓名</th>
                    <th class="col-md-2 th-title-center">操作1</th>
                    <th class="col-md-2 th-title-center">操作2</th>
                </tr>

            </thead>

            <tbody>
archemiya;
    for ($i = 0; $i < $num_student; $i++) {
        $row_student = mysqli_fetch_array($result_student_num, MYSQLI_BOTH);
        echo "<tr>";

        //根据学生id查询学生的答辩记录情况
        $sql_record = "SELECT * FROM `reply_record` WHERE `student_id` = '{$row_student['student_id']}' ";
        $result_record = mysqli_query($link, $sql_record);
        $row_record = mysqli_fetch_array($result_record, MYSQLI_BOTH);

        //根据学生id查询学生成绩情况
        $sql_grade = "SELECT * FROM `student_grade` WHERE `student_id` = '{$row_student['student_id']}' ";
        $result_grade = mysqli_query($link, $sql_grade);
        $row_grade = mysqli_fetch_array($result_grade, MYSQLI_BOTH);

        echo "<td class=\"td-height th-title-center\">";
        echo "<a href='tutor.php?func=reply_grade&id={$row_student['id']} '>" . $row_student['name'] . "</a>"; //此处显示课题名称
        echo "</td>";
        echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
        echo   $row_student['student_id'] . $row_student['student_name'];
        echo "</td>";

        if (!isset($row_grade['teacher_grade'])) {
            if (isset($row_record['reply_record_annex_name'])) {
                echo "<td>";
                echo "<a class='btn btn-primary' role='button'
            data-toggle=\"modal\" data-target=\"#student_{$row_student['student_id']}\">
            指导教师评分
            </button>";
                echo "</td>";
                echo "<td>";
                echo "<a href='../uploaded_files/reply_record_files/{$row_student['student_id']}/{$row_record['reply_record_annex_name']}' 
            class='btn btn-primary' role='button'>
            下载附件
            </button>";
                echo "</td>";
            } else {
                echo "<td>";
                echo "<a class='btn btn-primary' role='button' disabled>
            指导教师评分
            </button>";
                echo "</td>";
                echo "<td>";
                echo "<a class='btn btn-primary' role='button' disabled>
            尚无答辩记录附件
            </button>";
                echo "</td>";
            }
        } else {
            echo "<td class='th-title-center alert alert-info' role='alert'>";
            echo "您的评分：";
            echo $row_grade['teacher_grade'];
            echo "</td>";
            echo "<td>";
            echo "";
            echo "</td>";
        }

        echo "</tr>";
    }
    echo <<< archemiya
            </tbody>
        </table>

        <br/>

    </div>
archemiya;
}

?>

<body>
    <div class="alert alert-info" role="alert">
        此页面为答辩小组评分页面，共分为三部分：<br />
        1.请答辩组各导师成员结合学生线下答辩情况、线上论文提交情况等综合因素打分<br />
        2.请各位导师根据自己指导学生的论文终稿进行打分<br />
        3.请各组答辩组长为二次答辩同学打分（注：二次答辩组导师成员为各组评阅组组长）<br />
    </div>
    <?php
    //根据一辩评分流程控制来判断是否开启
    if ($row_control['first_reply_grade']) {
        echo_fisrt_reply_schedule_table($row_group, $link);
    }
    //根据指导学生完成的论文终稿给分
    if ($row_stu_control['final_paper']) {

        echo_student_reply_schedule_table($link);
    }
    //根据二辩评分流程控制来判断是否开启
    if ($row_control['second_reply_grade']) {
        //查询当前老师是否为评阅组长
        $sql_reviewer = "SELECT * from `user` 
        where `special` = 'reviewer'";
        $result_reviewer = mysqli_query($link,$sql_reviewer);
        $num_reviewer = mysqli_num_rows($result_reviewer);
        if($num_reviewer){
            echo_second_reply_schedule_table($row_group, $link);
        }
    }

    /*由于此页面没法通用一个modalTable，故此处使用for循环输出各个不同id的modalTable */
    //查询当前答辩组一辩学生
    $group_id = $row_group['group_id'];
    $sql_student_num = "SELECT * FROM `reply_schedule` 
    WHERE `group_id` = '{$group_id}' AND `permission` = 'student' AND `reply_delay` = 0 AND `first_paper_flag` = 1";
    $result_student_num = mysqli_query($link, $sql_student_num);
    $num_student = mysqli_num_rows($result_student_num);

    //根据学生id循环输出modalTable
    for ($i = 0; $i < $num_student; $i++) {
        $row_student = mysqli_fetch_array($result_student_num, MYSQLI_BOTH);

        //根据学生id查询学生的课题详情
        $sql_topic = "SELECT * FROM `topic`WHERE `student_id` = '{$row_student['id']}' ";
        $result_topic = mysqli_query($link, $sql_topic);
        $row_topic = mysqli_fetch_array($result_topic, MYSQLI_BOTH);
        echo <<< archemiya
    <div class="modal fade " id="first_{$row_student['id']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">一辩成绩</h4>
                </div>
                <div class="modal-body">
archemiya;
        echo "<form action=\"../score.php?func=reply&id={$row_topic['student_id']}\" method=\"POST\" class=\"form-horizontal\">";
        echo "<input type=\"hidden\" name=\"topic_id\" value=\"{$row_topic['id']}\">";
        echo "<input type=\"hidden\" name=\"student_id\" value=\"{$row_topic['student_id']}\">";
        echo "<input type=\"hidden\" name=\"student_name\" value=\"{$row_topic['student_name']}\">";
        echo "<input type=\"hidden\" name=\"teacher_id\" value=\"{$_SESSION['user_id']}\">";
        echo "<input type=\"hidden\" name=\"teacher_name\" value=\"{$_SESSION['user_name']}\">";
        echo "<input type=\"hidden\" name=\"group_id\" value=\"{$row_group['group_id']}\">";

        echo <<< archemiya
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">分数（百分制）</label>
                        <div class="col-sm-3">
                            <input name="reply_grade" class="form-control" rows="20"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">说明（点评）</label>
                        <div class="col-sm-8">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                            <textarea name="reply_grade_description" class="form-control" rows="20"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" onclick="javascript:return confirm('确认无误并提交么？提交成绩后将无法修改！')">提交</button>
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

    //查询所有指导学生学生
    $sql_student_num = "SELECT * FROM `topic` 
    WHERE `teacher_id` = '{$_SESSION['user_id']}' ";
    $result_student_num = mysqli_query($link, $sql_student_num);
    $num_student = mysqli_num_rows($result_student_num);

    for ($i = 0; $i < $num_student; $i++) {
        $row_student = mysqli_fetch_array($result_student_num, MYSQLI_BOTH);

        echo <<< archemiya
    <div class="modal fade " id="student_{$row_student['student_id']}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">一辩成绩</h4>
                </div>
                <div class="modal-body">
archemiya;
        echo "<form action=\"../score.php?func=teacher_grade&id={$row_student['student_id']}\" method=\"POST\" class=\"form-horizontal\">";
        echo "<input type=\"hidden\" name=\"topic_id\" value=\"{$row_student['id']}\">";
        echo "<input type=\"hidden\" name=\"student_id\" value=\"{$row_student['student_id']}\">";
        echo "<input type=\"hidden\" name=\"student_name\" value=\"{$row_student['student_name']}\">";

        echo <<< archemiya
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">分数（百分制）</label>
                        <div class="col-sm-3">
                            <input name="teacher_grade" class="form-control" rows="20"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">说明（点评）</label>
                        <div class="col-sm-8">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                            <textarea name="teacher_grade_description" class="form-control" rows="20"></textarea>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-primary" onclick="javascript:return confirm('确认无误并提交么？提交成绩后将无法修改！')">提交</button>
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