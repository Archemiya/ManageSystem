<!-- 此文件为导师修改意见明细文件 -->
<!-- 学生可以在导师给出修改意见使用此文件查看对应的修改意见，并重新上传开题报告摘要 -->
<!-- 传递的参数为 topic_id -->
<?php
include "../link.php";
if (isset($_GET["id"])) {
    $get = $_GET["id"];
}
$sql = "SELECT * FROM `midterm_report`WHERE `topic_id` = '{$get}' ";
$result = mysqli_query($link, $sql);
?>

<body>
    <?php
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    echo "<br/>";
    echo "<div class=\"alert alert-info\" role=\"alert\">";
    echo "<strong>主要指导意见: <br/></strong>";
    echo $row['instructions'];
    echo " </div>";
    ?>
</body>
