<?php
//此php为系统所有上传文件脚本，使用get方式传参，对参数进行判断后选择上传各类别文件
$uploaddir = './uploaded_file/';
$uploadfilename = basename($_FILES['file']['name']);
$uploadfile = $uploaddir . $uploadfilename;
// echo $uploadfilename;
if ((($_FILES["file"]["type"] == "application/msword")
    || ($_FILES["file"]["type"] == "application/pdf")
    || ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"))
  && ($_FILES["file"]["size"] < 10000000)
) {
  if ($_FILES["file"]["error"] > 0) {
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
  } else {
    include "link.php";
    switch ($_GET['func']) { //根据参数func值进行判断
      case "first_report":
        $num = $_POST['num'];
        if (!$num) {
          echo "<script>alert('您还未上传开题报告！请先上传开题报告');history.go(-1)</script>";
        } else {
          move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile);
          $topic_id = $_POST['topic_id'];
          $sql = "UPDATE `first_report` SET `first_report_annex_name` = '$uploadfilename' 
            WHERE `topic_id` = '$topic_id'";
          mysqli_query($link, $sql);
          echo "<script>alert('上传附件成功！');history.go(-1)</script>";
        }
        mysqli_close($link);
        break;
    }
  }
} else if ($_FILES["file"]["size"] >= 10000000) {
  echo "<script>alert('文件过大超过10M！请重新上传');history.go(-1)</script>";
} else if (($_FILES["file"]["type"] != "application/msword")
  || ($_FILES["file"]["type"] != "application/pdf")
  || ($_FILES["file"]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
) {
  echo "<script>alert('只允许上传doc/docx/pdf格式文件！请重新上传');history.go(-1)</script>";
}
