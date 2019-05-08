<?php
include "../link.php";
$sql = "UPDATE `topic` SET `topic_ispass` = 1 WHERE `id` = '{$_GET['id']}' ";
mysqli_query($link,$sql);
echo "<script>alert('课题审核完成！');history.go(-1)</script>";
?>