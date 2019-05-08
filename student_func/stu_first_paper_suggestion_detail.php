<!-- 此文件为论文初稿导师修改意见明细文件 -->
<!-- 学生可以在导师给出修改意见使用此文件查看对应的修改意见，并重新上传开题报告摘要 -->
<!-- 传递的参数为 topic_id -->
<?php
include "../link.php";
if (isset($_GET["id"])) {
    $get = $_GET["id"];
}
//查询当前学生最新论文初稿
$sql_id = "SELECT max(`record_id`) from `first_paper_record` WHERE `first_paper_record`.`topic_id` = '{$get}' order by `record_id` desc";
$result_id = mysqli_query($link, $sql_id);
$row_id = mysqli_fetch_array($result_id,MYSQLI_BOTH);

$sql = "SELECT * FROM `first_paper_record`WHERE `topic_id` = '{$get}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
$result = mysqli_query($link, $sql);
?>

<body>
    <?php
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    echo "<br/>";
    echo "<div class=\"alert alert-info\" role=\"alert\">";
    echo "<strong>主要修改意见: <br/></strong>";
    echo $row['modify_suggestion'];
    echo " </div>";
    ?>

    <br /> 
    <?php
    if($row['final_flag']==2){
        echo "<button type=\"button\" class=\"btn btn-primary\" data-toggle=\"modal\" data-target=\"#chsugTable\">修改论文初稿</button>";
    }else{
        echo "";
    }
    ?>
    <button type="button" class="btn btn-primary" onclick="JavaScript:history.go(-1)">返回</button>
    <div class="modal fade " id="chsugTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="chose-student-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">修改论文初稿</h4>
                </div>
                <div class="modal-body">
                    <?php
                    echo <<< archemiya
                    <form action="stu_add_first_paper.php?id={$get}" method="POST" class="form-horizontal">
                        <div class="form-group">
                            <label for="inputTopicIntro" class="col-sm-3 control-label">论文初稿摘要</label>
                            <div class="col-sm-8">
                                <textarea name="paper_main" class="form-control" rows="3">
archemiya;
                        echo $row['paper_main'];
                        echo <<< archemiya
                                </textarea>
                            </div>
                        </div>
                        <input type="hidden" name="topic_id" value="{$row['topic_id']}">
                        <input type="hidden" name="topic_name" value="{$row['topic_name']}">
                        <input type="hidden" name="teacher_id" value="{$row['teacher_id']}">
                        <input type="hidden" name="teacher_name" value="{$row['teacher_name']}">
archemiya;
                    ?>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-10">
                                <button type="submit" class="btn btn-primary" onclick="JavaScript:return confirm('确定填写无误并重新上传开题报告么？');">重新上传</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>
