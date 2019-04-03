<?php
$link = mysqli_connect("localhost", "root", "123456", "manasystem");
if (isset($_GET["id"])) {
    $get = $_GET["id"];
}
if ($_SESSION['user_permission']=='tutor') {
    $sql = "SELECT * FROM `task_book` WHERE `topic_id` = {$get}";
    $result = mysqli_query($link, $sql);
} else {
    $sql = "SELECT * FROM `task_book` WHERE `student_id` = {$_SESSION['user_id']} ";
    $result = mysqli_query($link, $sql);
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <br />
    <?php
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    if ($_SESSION['user_permission']=='tutor') {
        if ($row['islook_flag']) {
            echo "<div class=\"alert alert-info\" role=\"alert\">
            任务书已于{$row['create_time_stamp']}下发至学生 <strong>{$row['student_id']}{$row['student_name']}</strong>，<strong>学生已确认</strong>
            </div>";
        } else {
            echo "<div class=\"alert alert-warning\" role=\"alert\">
            任务书已于{$row['create_time_stamp']}下发至学生 <strong>{$row['student_id']}{$row['student_name']}</strong>，<strong>学生未确认</strong>
            </div>";
        }
    } else {
        if ($row['islook_flag']) {
            echo "<div class=\"alert alert-info\" role=\"alert\">
            任务书已于{$row['create_time_stamp']}下发至 <strong>{$row['student_id']}{$row['student_name']}</strong>，<strong>当前已确认</strong>
            </div>";
        } else {
            echo "<div class=\"alert alert-danger\" role=\"alert\">
            任务书已于{$row['create_time_stamp']}下发至 <strong>{$row['student_id']}{$row['student_name']}</strong>，<strong>当前未确认，请尽快确认！</strong>
            </div>";
        }
    }
    echo <<< archemiya
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar">
            <tbody>
                <tr>
                <td class='col-xs-3'>课题名称</td>
archemiya;
                echo "<td class='col-xs-9'>";
                echo nl2br($row['topic_name']);
                echo  "</td>";
                echo <<< archemiya
                </tr>
                <tr>
                <td class='col-xs-3'>主要内容</td>
archemiya;
                echo "<td class='col-xs-9'>";
                echo nl2br($row['topic_main']);
                echo "</td>";
                echo <<< archemiya
                </tr>
                <tr>
                <td class='col-xs-3'>毕业设计（论文）进度安排</td>
                
archemiya;
                echo "<td class='col-xs-9'>";
                echo nl2br($row['topic_schedule']);
                echo  "</td>";
                echo <<< archemiya
                </tr>
                <tr>
                <td class='col-xs-3'>主要参考资料</td>
                
archemiya;
                echo "<td class='col-xs-9'>" ;
                echo nl2br($row['topic_ref']); 
                echo "</td>";
                echo <<< archemiya
                </tr>
                <tr>
                <td class='col-xs-3'>主要仪器设备及材料</td>
                
archemiya;
                echo "<td class='col-xs-9'>"; 
                echo nl2br($row['topic_machine']) ;
                echo "</td>";
                echo <<< archemiya
                </tr>
                <tr>
                <td class='col-xs-3'>场地及要求</td>
                
archemiya;
                echo "<td class='col-xs-9'>";
                echo  nl2br($row['topic_space']);
                echo " </td>";
                echo <<< archemiya
                </tr>
                <tr>
                <td class='col-xs-3'>指导答疑时间安排</td>
                
archemiya;
                echo "<td class='col-xs-9'> ";
                echo nl2br($row['topic_timetable']) ;
                echo "</td>";
                echo <<< archemiya
                </tr>
            </tbody>
        </table>

    </div>
    <br />
archemiya;
    if (!$row['islook_flag']) {
        echo "<a href='confirm_task_book.php' class=\"btn btn-primary\"  onclick=\"JavaScript:return confirm('是否确认该任务书？');history.go(-1)\" role = 'button'>确认任务书</a>";
    }
    ?>

</body>

</html> 