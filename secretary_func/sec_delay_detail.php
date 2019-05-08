<?php
//此文件用于显示学生的申请说明并对其进行审核
include '../link.php';

$sql = "SELECT * from `reply_schedule` where `id` = '{$_GET['judge']}'";
$result = mysqli_query($link, $sql);
$row = mysqli_fetch_array($result, MYSQLI_BOTH);
?>

<body>
    <div class='alert alert-info' role='alert'>
        <strong>申请说明：</strong>
        <br/>
        <?php 
        echo $row['delay_description'];
        ?>
    </div>
    <?php 
    if($row['reply_delay']==2){
        echo "<a href='sec_determine_delay.php?func=agree&id={$row['id']}' 
        class='btn btn-success' role='button'>同意申请</a>";
        echo " ";
        echo "<a href='sec_determine_delay.php?func=refuse&id={$row['id']}' 
        class='btn btn-danger' role='button'>驳回申请</a>";
    }
    ?>
    <button type="button" class="btn btn-primary" onclick="JavaScript:history.go(-1)">返回</button>
</body>
