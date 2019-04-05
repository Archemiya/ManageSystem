<?php
include "../link.php";
include "../secretary_func/sec_query_stu_control.php";
$sql = "SELECT * FROM `topic`"; //查询全部课题
$sql_chose_record_stu = "SELECT * FROM `chose_topic_record` WHERE `chose_topic_record`.`student_id` = '{$_SESSION['user_id']}'"; //查询当前学生的选课记录
$sql_chose_record_stu_final = "SELECT * FROM `chose_topic_record` WHERE `chose_topic_record`.`student_id` = '{$_SESSION['user_id']}' AND `final_flag` = 1"; //查询当前学生是否存在确定课题
$result = mysqli_query($link, $sql);
$result_chose_record_stu = mysqli_query($link, $sql_chose_record_stu);
$result_chose_record_stu_final = mysqli_query($link, $sql_chose_record_stu_final);
$num_chose_record_stu = mysqli_num_rows($result_chose_record_stu); //当前学生选课记录的条数x
$row_chose_record_stu_final = mysqli_fetch_array($result_chose_record_stu_final, MYSQLI_BOTH);
$num_chose_record_stu_final = mysqli_num_rows($result_chose_record_stu_final);
$length = mysqli_num_rows($result);
/*查询学生所有选择课题被确定状态下，所属学生不为该学生的数量*/
$final_not_this_stu = 0;
for ($i = 0; $i < $num_chose_record_stu; $i++) {
    $row_chose_record_stu = mysqli_fetch_array($result_chose_record_stu, MYSQLI_BOTH); //当前所有选课记录的详情
    $current_topic_id = $row_chose_record_stu['topic_id'];
    $sql_search = "SELECT * FROM `chose_topic_record` WHERE `topic_id` = $current_topic_id AND `final_flag` =1 ";
    $result_search = mysqli_query($link, $sql_search);
    $row_search = mysqli_fetch_array($result_search, MYSQLI_BOTH);
    $num_search = mysqli_num_rows($result_search);
    if ($num_search == 1) {
        if ($row_search['student_id'] != $_SESSION['user_id']) {
            $final_not_this_stu++;
        }
    }
}
?>
<?php
function table_echo($length, $result, $link, $num_chose_record_stu_final, $row_chose_record_stu_final, $num_chose_record_stu, $result_chose_record_stu, $final_not_this_stu)
{
    for ($i = 0; $i < $length; $i++) {
        $row = mysqli_fetch_array($result, MYSQLI_BOTH);
        $sql_chose_recode_topic = "SELECT * FROM `chose_topic_record` WHERE `topic_id` = '{$row['id']}'"; //当前课题被选记录
        $sql_chose_recode_topic_final = "SELECT * FROM `chose_topic_record` WHERE `topic_id` = '{$row['id']}' AND `final_flag` = 1"; //当前课题被确定记录
        $sql_chose_record_stu_topic = "SELECT * FROM `chose_topic_record` WHERE `topic_id` = '{$row['id']}' AND `student_id` = '{$_SESSION['user_id']}'"; //当前课题被该学生选择记录
        $result_chose_record_topic = mysqli_query($link, $sql_chose_recode_topic);
        $result_chose_record_topic_final = mysqli_query($link, $sql_chose_recode_topic_final);
        $result_chose_record_stu_topic = mysqli_query($link, $sql_chose_record_stu_topic);
        $row_chose_record_stu2 = mysqli_fetch_array($result_chose_record_stu, MYSQLI_BOTH);
        $row_chose_record_topic_final = mysqli_fetch_array($result_chose_record_topic_final, MYSQLI_BOTH);
        $num_chose_record_topic = mysqli_num_rows($result_chose_record_topic);
        $num_chose_record_topic_final = mysqli_num_rows($result_chose_record_topic_final);
        $num_chose_record_stu_topic = mysqli_num_rows($result_chose_record_stu_topic);
        echo "<tr>";
        echo "<td> {$row['id']} </td>";
        echo "<td> {$row['name']} </td>";
        echo "<td> {$row['teacher_name']} </td>";
        echo "<td> {$num_chose_record_topic} / 5</td>";
        echo "<td >";
        echo "<a href=\"./student.php?func=topic&id={$row['id']}\" class=\"btn btn-primary\" role=\"button\">查看课题详情</a>";

        echo "</td> ";
        echo "<td >";
        if ($num_chose_record_stu_final == 1) { //该学生被老师选中
            if ($row_chose_record_stu_final['topic_id'] == $row['id']) {
                echo "<button type=\"button\" class=\"btn btn-success disabled \">";
                echo "已选课题";
            } else {
                echo "";
            }
        } else if ($num_chose_record_stu == 0) { //该学生未进行选题
            if ($num_chose_record_topic == 5) { //当前课题已被选满
                echo "<button type=\"button\" class=\"btn btn-danger\" disabled>";
                echo "课题已满";
            } else if ($num_chose_record_topic_final && ($row_chose_record_topic_final['student_id'] != $_SESSION['user_id'])) { //当前课题已被其他学生确定
                echo "<button type=\"button\" class=\"btn btn-danger\" disabled>";
                echo "课题已锁";
            } else {
                echo "<a href=\"./stu_chose_topic.php?func={$row['id']}\" 
                onclick=\"JavaScript:return confirm('确定选择此课题么？');\"
                class=\"btn btn-primary\" role=\"button\"
                > 确认选题</a>";
            }
        } else if ($num_chose_record_stu >= 1 && $num_chose_record_stu_final == 0) { //该学生进行过选题操作但未被选上（包括 被拒绝但还未重新选题 和 选题但老师还未被确定学生 两种状态）
            /*此处需先进行学生是否处于被拒状态的判断：
            1. 当学生处于被拒状态时，判断条件为，学生所选课题数 = 学生所有选择课题被确定状态下，所属学生不为该学生的数量。
            2. 当学生处于未被选上状态，判断条件为，存在一个未被确认的课题，即final全部为0的课题
            综上，配合上述求得的$final_not_this_stu数目，我们选择从第一种情况入手。
            */
            if ($num_chose_record_stu == $final_not_this_stu) { //该学生处于被拒绝状态
                if (($num_chose_record_stu_topic == 1) && ($num_chose_record_topic_final == 1)) { //该学生选择了当前课题，当前课题已被确认（由于前面已经判断过学生被选中的情况，所以这里是未被选中的情况）即当前课题被拒绝
                    echo "<button type=\"button\" class=\"btn btn-danger\" disabled>";
                    echo "课题被拒";
                } else if (($num_chose_record_stu_topic == 0) && ($num_chose_record_topic_final == 1)) { //该学生未选择当前课题，当前课题已被确认
                    echo "<button type=\"button\" class=\"btn btn-danger\" disabled>";
                    echo "课题已锁";
                } else if (($row_chose_record_stu2['topic_id'] != $row['id']) && ($num_chose_record_topic == 5)) { //该学生未选择当前课题，但当前课题已达最大选题人数
                    echo "<button type=\"button\" class=\"btn btn-danger\" disabled>";
                    echo "课题已满";
                } else {
                    echo "<a href=\"./stu_chose_topic.php?func={$row['id']}\" 
                onclick=\"JavaScript:return confirm('确定选择此课题么？');\"
                class=\"btn btn-primary\" role=\"button\"
                > 确认选题</a>";
                }
            } else {
                if (($num_chose_record_stu_topic == 1) && ($num_chose_record_topic_final == 1)) { //该学生选择了当前课题，当前课题已被确认（由于前面已经判断过学生被选中的情况，所以这里是未被选中的情况）即当前课题被拒绝
                    echo "<button type=\"button\" class=\"btn btn-danger\" disabled>";
                    echo "课题被拒";
                } else if (($num_chose_record_stu_topic == 1) && ($num_chose_record_topic_final == 0)) { //该学生选择了当前课题，当前课题未被确认
                    echo "<button type=\"button\" class=\"btn btn-warning\" disabled>";
                    echo "已选课题";
                } else if (($row_chose_record_stu2['topic_id'] != $row['id']) && ($num_chose_record_topic == 5)) { //该学生未选择当前课题，但当前课题已达最大选题人数
                    echo "<button type=\"button\" class=\"btn btn-danger\" disabled>";
                    echo "课题已满";
                } else {
                    echo '';
                }
            }
        }

        echo "</td> ";
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
    <div class="table-responsive">
        <?php
        if($row_control['topic']==0){
            echo "<br/>";
            echo "<div class='alert alert-danger'>";
            echo "<strong>当前选题功能未开放！</strong>";
            echo "</div>";
        }else{
            echo <<< archemiya
            <table data-toggle="table" 
            data-toolbar="#toolbar" 
            data-pagination="true" 
            data-search="true" 
            data-page-list="[10, 25, 50, 100, 200, All]" 
            data-show-refresh="true"
archemiya;
            if (!$num_chose_record_stu || $num_chose_record_stu == $final_not_this_stu) {                        
            } else {
            echo "data-sort-name=\"option\" ";
            echo "data-sort-order=\"desc\" ";
            }
            echo ">";
            echo <<< archemiya
            <thead>
                <tr>
                    <th class="col-xs-1 th-title-center" data-sortable="true">课题号</th>
                    <th class="col-xs-5">选题名称</th>
                    <th class="col-xs-1 th-title-center">教师名称</th>
                    <th class="col-xs-2 th-title-center" data-sortable="true">选课人数</th>
                    <th class="col-xs-2 th-title-center">选项</th>
                    <th class="col-xs-1 th-title-center" data-field="option" 
archemiya;
                    if (!$num_chose_record_stu || $num_chose_record_stu == $final_not_this_stu) {                        
                    } else {
                    echo "data-sortable=\"true\"";
                    }
                    echo <<< archemiya
                    >
                    操作/状态</th>
                </tr>
            </thead>
            <tbody>
archemiya;
                echo "<div id=\"toolbar\">";
                if (!$num_chose_record_stu) {
                    echo "<button id=\"未选题\" class=\"btn btn-danger\" disabled>";
                    echo "<i class=\"glyphicon glyphicon-warning-sign\"></i>";
                    echo " 未选题";
                } else if ($num_chose_record_stu_final) {
                    echo "<button id=\"已确认\" class=\"btn btn-success\" disabled>";
                    echo "<i class=\"glyphicon glyphicon-ok\"></i>";
                    echo " 已选题";
                } elseif ($num_chose_record_stu == $final_not_this_stu) {
                    echo "<button id=\"等待中\" class=\"btn btn-danger\" disabled>";
                    echo "<i class=\"glyphicon glyphicon-warning-sign\"></i>";
                    echo " 请重新选题";
                } else {
                    echo "<button id=\"等待中\" class=\"btn btn-warning\" disabled>";
                    echo "<i class=\"glyphicon glyphicon-refresh\"></i>";
                    echo " 导师确认中";
                }
                echo "</button>";
                echo "</div>";
                table_echo($length, $result, $link, $num_chose_record_stu_final, $row_chose_record_stu_final, $num_chose_record_stu, $result_chose_record_stu, $final_not_this_stu);
            
            echo "</tbody>";

        echo "</table>";
        }
        ?>
    </div>
</body>

</html> 