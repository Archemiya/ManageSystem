<br />
<div class="alert alert-danger" role="alert"><strong>本页面为学生流程控制页面，请谨慎操作</strong></div>
<?php
include "../link.php";
include "sec_query_stu_control.php";
?>

<body>

    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar">
            <thead>
                <tr>
                    <th class="col-xs-5 th-title-center">学生流程名称</th>
                    <th class="col-xs-5 th-title-center">状态说明</th>
                    <th class="col-xs-2 th-title-center"> 操作</th>

                </tr>
            </thead>
            <tbody>
                <div id="toolbar">
                </div>
                <tr>
                    <td class="col-xs-5 th-title-center">论文选题</td>
                    <?php
                    $sql_topic = "SELECT * FROM `topic`";
                    $sql_passed_topic = "SELECT * FROM `topic` WHERE `topic_ispass` = 1";
                    $result_topic = mysqli_query($link, $sql_topic);
                    $result_passed_topic = mysqli_query($link, $sql_passed_topic);
                    $num_topic = mysqli_num_rows($result_topic);
                    $num_passed_topic = mysqli_num_rows($result_passed_topic);
                    if (($num_passed_topic == $num_topic) && ($row_control['topic'] == 0) && ($num_topic != 0)) {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "当前课题审核已全部完成，可以开启学生选题流程";
                    } else if(($num_passed_topic == $num_topic) && ($row_control['topic'] == 1)){
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\" >";
                        echo "已开启学生选题流程";
                    } else {
                        echo "<td class=\"col-xs-5 th-title-center alert alert-danger\">";
                        echo "当前课题审核尚未全部完成，不可开启学生选题流程";
                    }
                    ?>
                    </td>

                    <td class="col-xs-2 th-title-center">
                        <?php
                        if (($num_passed_topic == $num_topic) && ($row_control['topic'] == 0) && ($num_topic != 0)) {
                            echo "<a href='sec_chang_stu_control_value.php?func=topic' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启选题</a>";
                        } else if (($num_passed_topic == $num_topic) && ($row_control['topic'] == 1)) {
                            echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                        } else {
                            echo "<button class='btn btn-danger' disabled>不可操作</button>";
                        }
                        ?>
                    </td>


                </tr>

            </tbody>
        </table>



    </div>
</body>