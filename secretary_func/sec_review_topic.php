<?php
include "../link.php";
include "sec_query_t_control.php";
$sql = "SELECT * FROM `topic`";
$result = mysqli_query($link, $sql);
$num = mysqli_num_rows($result);

function topic_table_echo($result, $link)
{
    $length = mysqli_num_rows($result);
    $i = 0;
    while ($i < $length) {
        $row = mysqli_fetch_array($result);
        $sql_chose_recode_topic = "SELECT * FROM `chose_topic_record` WHERE `chose_topic_record`.`topic_id` = '{$row['id']}'";
        $result_chose_record_topic = mysqli_query($link, $sql_chose_recode_topic);
        $row_chose_record_topic = mysqli_fetch_array($result_chose_record_topic, MYSQLI_BOTH);
        $num_chose_record_topic = mysqli_num_rows($result_chose_record_topic);
        echo <<< archemiya
    <tr>
    <td> {$row['id']} </td>
    <td> {$row['name']} </td>
    <td> {$row['teacher_name']} </td>
    <td >
archemiya;
    echo "<a class=\"btn btn-primary\" role=\"button\" ";
    if($row['topic_ispass']==1){
        echo "disabled";
    }else{
        echo "href=\"./secretary.php?func=review_topic&id={$row['id']}\" ";
    }
    echo <<< archemiya
    >
    审核课题</a>
    </td> 
archemiya;
    if($row['topic_ispass']==1){
        echo "<td class=\" td-title-center alert alert-info\" >";
        echo "课题已审核";
    }else if($row['topic_ispass']==2){
        echo "<td class=\"td-title-center alert alert-warning\" >";
        echo "意见已发送";
    }else if($row['topic_ispass']==3){
        echo "<td class=\" td-title-center alert alert-warning\" >";
        echo "课题已修改";
    }else {
        echo "<td class=\"td-title-center alert alert-danger\" >";
        echo "课题未审核";
    }
    echo <<< archemiya
    </td>
    </tr>
archemiya;
        $i++;
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
    if($num==0){
        echo "<br/>";
        echo "<div class='alert alert-danger'>";
        echo "<strong>当前尚无老师提交课题！</strong>";
        echo "</div>";
    }else{
        echo <<< archemiya
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar" data-pagination="true"
            data-page-list="[10, 25, 50, 100, 200, All]" data-show-refresh="true">
            <thead>
                <tr>
                    <th class="col-md-2 th-title-center th-title-topic-chs">课题号</th>
                    <th class="col-md-4 th-title-topic-stu">课题名称</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">教师名称</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">状态</th>
                </tr>
            </thead>
            <tbody>
archemiya;
        topic_table_echo($result, $link);
        echo <<< archemiya
            </tbody>



        </table>
    </div>
archemiya;
    }
    ?>
</body>

</html>