<?php
$link = mysqli_connect("localhost", "root", "123456", "manasystem");
if (isset($_GET["id"])) {
    $get = $_GET["id"];
}
$sql = "SELECT * FROM `task_book` WHERE `id` = {$get} ORDER BY `id`  ASC";
$result = mysqli_query($link, $sql);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
    <br />
    <div class="alert alert-info" role="alert">注：以下所列出的均是我认为有价值的内容，相应的评级也都是相对而言的，因此评级低不代表它不好，只是相对而言它不能够称得上完美。</div>
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar">
            <tbody>
                <?php
                $row = mysqli_fetch_array($result, MYSQLI_BOTH);
                echo "<tr>";
                echo "<td class='col-xs-2'>课题名称</td>";


                echo "<td class='col-xs-10'> {$row['topic_name']} </td>";

                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>主要内容</td>";


                echo "<td class='col-xs-10'> {$row['topic_main']} </td>";

                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>毕业设计（论文）进度安排</td>";


                echo "<td class='col-xs-10'> {$row['topic_schedule']} </td>";

                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>主要参考资料</td>";


                echo "<td class='col-xs-10'> {$row['topic_ref']} </td>";

                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>主要仪器设备及材料</td>";


                echo "<td class='col-xs-10'> {$row['topic_machine']} </td>";

                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>场地及要求</td>";


                echo "<td class='col-xs-10'> {$row['topic_space']} </td>";

                echo "</tr>";
                echo "<tr>";
                echo "<td class='col-xs-2'>指导答疑时间安排</td>";


                echo "<td class='col-xs-10'> {$row['topic_timetable']} </td>";

                echo "</tr>";

                ?>
            </tbody>
        </table>

    </div>
    <br />
    <button type="button" class="btn btn-primary" type="submit" onclick="JavaScript:history.go(-1)">返回</button>
</body>

</html> 