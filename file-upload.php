<?php

$uploaddir = './uploaded_file/';
$uploadfile = $uploaddir . basename($_FILES['userfile']['name']);


if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "<script>alert('文件上传成功！');history.go(-1)</script>";
} else {
    echo "<script>alert('文件上传失败！请重新上传')</script>";
}

?>