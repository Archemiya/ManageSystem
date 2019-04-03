<?php
$link = mysqli_connect("localhost", "root", "123456", "manasystem");
$sql = "SELECT * FROM `topic` WHERE `topic`.`teacher_id` = '{$_SESSION['user_id']}'";

$result = mysqli_query($link, $sql);

?>
<?php
function chose_topic_table_echo($result, $link)
{
    $height = mysqli_num_rows($result);
    for ($i=0; $i<$height; $i++) {
        $row = mysqli_fetch_array($result, MYSQLI_BOTH);
        echo <<< Archemiya
        <tr>
        <td class="td-height"> {$row['name']}</td>
Archemiya;

        $sql_chose_record = "SELECT * FROM `chose_topic_record` WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `topic_id` = '{$row['id']}' ";
        $sql_chose_final_flag = "SELECT * FROM `chose_topic_record` 
        WHERE `teacher_id` = '{$_SESSION['user_id']}' AND `topic_id` = '{$row['id']}' AND `final_flag` = 1";
        $result_chose_record = mysqli_query($link, $sql_chose_record);
        $result_chose_final_flag = mysqli_query($link, $sql_chose_final_flag);
        $num_chose_final_flag = mysqli_num_rows($result_chose_final_flag);
        for ($j = 0; $j < 5; $j++) {
            if (!$num_chose_final_flag) {
                $row_chose_record = mysqli_fetch_array($result_chose_record, MYSQLI_BOTH);
                echo "<td>";
                if (isset($row_chose_record['student_id'])) {
                    echo "<a href=\"./determine_student.php?topic={$row_chose_record['topic_id']}&id={$row_chose_record['student_id']}\" 
                onclick=\"JavaScript:return confirm('确定选择此学生么？');\" 
                class=\"btn btn-primary\"
                role=\"button\"> 
                {$row_chose_record['student_id']}{$row_chose_record['student_name']}</a>";
                } else {
                    echo '';
                }
                echo "</td>";
            } else {
                $row_chose_record = mysqli_fetch_array($result_chose_record, MYSQLI_BOTH);
                echo "<td>";
                if($row_chose_record['final_flag']==1){
                    
                    echo "<button class=\"btn btn-success\" disabled>
                    {$row_chose_record['student_id']}{$row_chose_record['student_name']}
                    </button>";
                    
                }else if(!isset($row_chose_record['student_id'])){
                    echo '';
                }else{
                    echo "<button class=\"btn btn-danger\" disabled>
                    {$row_chose_record['student_id']}{$row_chose_record['student_name']}
                    </button>";
                }
                echo "</td>";
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
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar" data-pagination="true" data-page-list="[10, 25, 50, 100, 200, All]" data-show-refresh="true">
            <thead>
                <tr>
                    <th class="th-title-topic-chs">课题名称</th>
                    <th class="th-title-center th-title-topic-stu">No.1</th>

                    <th class="th-title-center th-title-topic-stu">No.2</th>

                    <th class="th-title-center th-title-topic-stu">No.3</th>

                    <th class="th-title-center th-title-topic-stu">No.4</th>

                    <th class="th-title-center th-title-topic-stu">No.5</th>

                </tr>
            </thead>
            <tbody>
                <?php
                chose_topic_table_echo($result, $link);
                ?>
            </tbody>



        </table>
    </div>

</body>

</html> 