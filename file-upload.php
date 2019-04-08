<?php

if ((($_FILES["file"]["type"] == "application/msword")
|| ($_FILES["file"]["type"] == "application/pdf")
|| ($_FILES["file"]["type"] == "application/vnd.openxmlformats-officedocument.wordprocessingml.document"))
&& ($_FILES["file"]["size"] < 10000000))
  {
  if ($_FILES["file"]["error"] > 0)
    {
    echo "Error: " . $_FILES["file"]["error"] . "<br />";
    }
  else
    {
    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Stored in: " . $_FILES["file"]["tmp_name"];
    }
  }
else if($_FILES["file"]["size"] >= 10000000)
  {
  echo "<script>alert('文件过大超过10M！请重新上传');history.go(-1)</script>";
  }
else if(($_FILES["file"]["type"] != "application/msword")
||($_FILES["file"]["type"] != "application/pdf")
|| ($_FILES["file"]["type"] != "application/vnd.openxmlformats-officedocument.wordprocessingml.document")){
    echo "<script>alert('只允许上传doc/docx/pdf格式文件！请重新上传');history.go(-1)</script>";
}
