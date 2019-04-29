<?php
include "../link.php";

//查询此教师所属答辩组
$sql_group = "SELECT * from `reply_schedule` where `id` = '{$_SESSION['user_id']}'";
$result_group = mysqli_query($link, $sql_group);
$row_group = mysqli_fetch_array($result_group, MYSQLI_BOTH);

function echo_fisrt_reply_schedule_table($row_group, $link)
{
    $group_id = $row_group['group_id'];

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
        echo "<td class=\"td-height th-title-center\">";
        echo "<a href='tutor.php?func=reply_grade&id={$row_topic['id']} '>" . $row_topic['name'] . "</a>";
        echo "</td>";
        echo "<td class=\"td-height th-title-center alert alert-info\" role='alert' >";
        echo   $row_student['id'] . $row_student['name'];
        echo "</td>";
        echo "<td>";
        echo "<a class='btn btn-primary' role='button'
        data-toggle=\"modal\" data-target=\"#firstGradeTable\">
        一辩评分
        </button>";
        echo "</td>";
        echo "<td>";
        echo "<a href='' class='btn btn-primary' role='button'>
        下载附件
        </button>";
        echo "</td>";
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
    <div class="alert alert-info" role="alert">
        此页面为答辩小组评分页面，共分为三部分：<br/>
        1.请答辩组各导师成员结合学生线下答辩情况、线上论文提交情况等综合因素打分<br/>
        2.请各位导师为自己的指导学生打分<br/>
        3.请各组答辩组长为二次答辩同学打分<br/>
    </div>
    <?php
    echo_fisrt_reply_schedule_table($row_group, $link);
    ?>
    <div class="modal fade " id="firstGradeTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">一辩成绩</h4>
                </div>
                <div class="modal-body">
                    <?php
                    $sql = "SELECT * from `topic` where `id` = '{$get}'";
                    $result = mysqli_query($link, $sql);
                    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
                    echo "<form action=\"../score.php?func=first_report&id={$row['student_id']}\" method=\"POST\" class=\"form-horizontal\">";
                    echo "<input type=\"hidden\" name=\"topic_id\" value=\"{$get}\">";
                    echo "<input type=\"hidden\" name=\"student_id\" value=\"{$row['student_id']}\">";
                    echo "<input type=\"hidden\" name=\"student_name\" value=\"{$row['student_name']}\">";
                    ?>
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">分数（百分制）</label>
                        <div class="col-sm-3">
                            <input name="first_report_grade" class="form-control" rows="20"></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputTopicName" class="col-sm-2 control-label">说明（点评）</label>
                        <div class="col-sm-8">                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    
                            <textarea name="grade_description" class="form-control" rows="20"></textarea>
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
</body>