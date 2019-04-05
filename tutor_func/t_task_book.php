<?php
include "../link.php";
$sql = "SELECT * FROM `topic` WHERE `topic`.`teacher_id` = '{$_SESSION['user_id']}'";
$sql_chose_num = "SELECT * FROM `chose_topic_record` WHERE `chose_topic_record`.`teacher_id` = '{$_SESSION['user_id']}'";
$result = mysqli_query($link, $sql);
$result_chose_num = mysqli_query($link, $sql_chose_num);
$num_chose_num = mysqli_num_rows($result_chose_num);
?>
<?php
function task_book_table_echo($result, $link)
{
    $height = mysqli_num_rows($result);
    for ($i = 0; $i < $height; $i++) {
        $row = mysqli_fetch_array($result, MYSQLI_BOTH);
        echo <<< Archemiya
        <tr>
        <td class="td-height"> {$row['name']}</td>
        <td class="td-height td-title-center"> 
        <a href="./tutor.php?func=topic&id={$row['id']}" class="btn btn-primary" role="button">查看课题详情</a>
        </td>
Archemiya;
        $sql_chose_final_flag = "SELECT * FROM `chose_topic_record` 
        WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `topic_id` = '{$row['id']}' AND `final_flag` = 1";
        $result_chose_final_flag = mysqli_query($link, $sql_chose_final_flag);
        $num_chose_final_flag = mysqli_num_rows($result_chose_final_flag);

        if (!$num_chose_final_flag) {
            echo <<< Archemiya
            <td class="td-height">
            </td>
            <td class="td-height">
            </td>
Archemiya;
        } else {
            $row_chose_final_flag = mysqli_fetch_array($result_chose_final_flag, MYSQLI_BOTH);
            echo <<< Archemiya
            <td class="td-height td-title-center">
            <button class="btn btn-success" disabled>
                {$row_chose_final_flag['student_id']}{$row_chose_final_flag['student_name']}
            </button>
            </td>
            <td class="td-height td-title-center">          
Archemiya;
            $sql_task_book = "SELECT * FROM `task_book` WHERE `student_id` = '{$row_chose_final_flag['student_id']}' AND `topic_id` = '{$row['id']}'";
            $result_task_book = mysqli_query($link, $sql_task_book);
            $num_task_book = mysqli_num_rows($result_task_book);
            $row_task_book = mysqli_fetch_array($result_task_book, MYSQLI_BOTH);
            if ($num_task_book) {
                if ($row_task_book['islook_flag']) {
                    echo <<< Archemiya
                <a href="tutor.php?func=task_book&id={$row['id']} " class="btn btn-success " role= "button">
                查看任务书
                </a>
                </td>
Archemiya;
                } else {
                    echo <<< Archemiya
                <a href="tutor.php?func=task_book&id={$row['id']} " class="btn btn-warning " role= "button">
                查看任务书
                </a>
                </td>
Archemiya;
                }
            } else {
                echo <<< Archemiya
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#$i">
                下达任务书
                </button>
                </td>
Archemiya;
            }
        }
        echo "</tr>";
    }
}
        
?>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <?php
    if($num_chose_num==0){
        echo "<br/>";
        echo "<div class=\"alert alert-danger\" role=\"alert\">";
        echo "<strong>尚无学生选课！</strong>";
        echo "</div>";
    }else{
        echo <<< archemiya
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar" data-pagination="true" data-page-list="[10, 25, 50, 100, 200, All]" data-show-refresh="true">
            <thead>
                <tr>
                    <th class="col-md-6 th-title-topic-chs">课题名称</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">查看课题</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">指导学生</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作</th>
                </tr>
            </thead>
            <tbody>
archemiya;
        task_book_table_echo($result, $link);
        echo <<< archemiya
            </tbody>
        </table>
    </div>
archemiya;
    }
    ?>
    <?php
    $link = mysqli_connect("localhost", "root", "123456", "manasystem");
    $sql = "SELECT * FROM `topic` WHERE `topic`.`teacher_id` = '{$_SESSION['user_id']}'";

    $result = mysqli_query($link, $sql);
    $height = mysqli_num_rows($result);
    
    for ($i = 0; $i < $height; $i++) {
        $row = mysqli_fetch_array($result, MYSQLI_BOTH);
        $sql_chose_final_flag = "SELECT * FROM `chose_topic_record` 
        WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `topic_id` = '{$row['id']}' AND `final_flag` = 1";
        $result_chose_final_flag = mysqli_query($link, $sql_chose_final_flag);
        $num_chose_final_flag = mysqli_num_rows($result_chose_final_flag);
        if (!$num_chose_final_flag) {
        } else {
            $row_chose_final_flag = mysqli_fetch_array($result_chose_final_flag, MYSQLI_BOTH);
            echo <<< archemiya
            <div class="modal fade " id="$i" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="chose-student-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">下达任务书</h4>
                </div>
                <div class="modal-body">

                    <form action="t_update_task_book.php" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">主要内容和要求</label>
                            <div class="col-sm-8">
                                <textarea name="topic_main" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicReq" class="col-sm-3 control-label">毕业设计（论文）进度安排</label>
                            <div class="col-sm-8">
                                <textarea name="topic_schedule" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">主要参考资料</label>
                            <div class="col-sm-8">
                                <textarea name="topic_ref" class="form-control" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">主要仪器设备及材料</label>
                            <div class="col-sm-8">
                                <textarea name="topic_machine" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">场地及要求</label>
                            <div class="col-sm-8">
                                <textarea name="topic_space" class="form-control" rows="2"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputTopicRef" class="col-sm-3 control-label">指导答疑时间安排</label>
                            <div class="col-sm-8">
                                <textarea name="topic_timetable" class="form-control" rows="2"></textarea>
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
archemiya;
        }
    }

    ?>
</body>

</html> 