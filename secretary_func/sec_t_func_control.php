<br />
<div class="alert alert-danger" role="alert"><strong>本页面为老师流程控制页面，请谨慎操作</strong></div>
<?php
include "../link.php";
include "sec_query_t_control.php";
?>

<body>

    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar">
            <thead>
                <tr>
                    <th class="col-xs-5 th-title-center">老师流程名称</th>
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
                    if($row_control['topic']==0){
                        echo "<td class=\"col-xs-5 th-title-center alert alert-danger\"> 请根据学校安排准时开启老师论文选题流程！</td>";
                    }else if($row_control['topic']==1){
                        echo "<td class=\"col-xs-5 th-title-center alert alert-info\">已开启老师论文选题流程</td>";
                    }                         
                    ?>
                    

                    <td class="col-xs-2 th-title-center">
                        <?php
                            
                            if ($row_control['topic']==0) {
                                echo "<a href='sec_chang_t_control_value.php?func=topic' 
                                class='btn btn-primary' role='button'
                                onclick=\"Javascript:return confirm('确定开启么？此操作不可逆转')\">开启选题</a>";
                            } else if($row_control['topic']==1){
                                echo "<a class='btn btn-primary' role='button' disabled>已开启</a>";
                            } 
                        ?>
                    </td>


                </tr>
                
            </tbody>
        </table>



    </div>
</body>