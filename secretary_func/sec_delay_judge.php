<?php
//此页面为答辩秘书进行延期答辩审核页面
include "../link.php";
function delay_echo($link)
{
    echo <<< archemiya
    <div class="table-responsive">
        <table data-toggle="table" data-toolbar="#toolbar" data-pagination="true" data-page-list="[10, 25, 50, 100, 200, All]" >
            <thead>
                <tr>
                    <th class="col-md-6 th-title-topic-chs">课题名称</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">学生姓名</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作1</th>
                    <th class="col-md-2 th-title-center th-title-topic-stu">操作2</th>
                </tr>
            </thead>
            <tbody>
archemiya;
    //查询所有申请延期答辩的学生
    $sql_student = "SELECT * from `reply_schedule` where `reply_delay` != 0";
    $result_student = mysqli_query($link, $sql_student);
    $num_student = mysqli_num_rows($result_student);

    for ($i = 0; $i < $num_student; $i++) {
        $row_student = mysqli_fetch_array($result_student, MYSQLI_BOTH);

        //根据学生id查询此学生的详细信息
        $sql_detail = "SELECT * from `topic` where `student_id` = '{$row_student['id']}'";
        $result_detail = mysqli_query($link, $sql_detail);
        $row_detail = mysqli_fetch_array($result_detail, MYSQLI_BOTH);
        echo <<< archemiya
        <tr>
            <td class="td-height"> 
            <a href="./secretary.php?func=delay_judge&id={$row_detail['id']}" >
            {$row_detail['name']}
            </a>
            </td>
            
archemiya;
        if ($row_student['reply_delay'] == 2) {
            echo <<< archemiya
            <td class="td-height td-title-center alert alert-warning" role="alert">
                    {$row_detail['student_id']}{$row_detail['student_name']}
            </td>
            <td class="td-height td-title-center">     
            <a href='./secretary.php?func=delay_judge&judge={$row_detail['student_id']}' 
            class='btn btn-primary' role='button'>查看申请</a>
            </td>
            <td class="td-height td-title-center">
            <a href='../uploaded_files/delay_report_files/{$row_detail['student_id']}/{$row_student['delay_annex_name']}''
            class='btn btn-primary' role='button'>下载附件</a>
            </td>
archemiya;
        } elseif ($row_student['reply_delay'] == 1) {
            echo <<< archemiya
            <td class="td-height td-title-center alert alert-success" role="alert">
                    {$row_detail['student_id']}{$row_detail['student_name']}
            </td>
            <td class="td-height td-title-center">     
            <button class='btn btn-success' disabled>审核结束</button>
            </td>
            <td class="td-height td-title-center">
            <button class='btn btn-success' disabled>审核结束</button>
            </td>
archemiya;
        } elseif ($row_student['reply_delay'] == -1) {
            echo <<< archemiya
            <td class="td-height td-title-center alert alert-danger" role="alert">
                    {$row_detail['student_id']}{$row_detail['student_name']}
            </td>
            <td class="td-height td-title-center">     
            <button class='btn btn-danger' disabled>审核结束</button>
            </td>
            <td class="td-height td-title-center">
            <button class='btn btn-danger' disabled>审核结束</button>
            </td>
        </tr>
archemiya;
        }
    }
    echo <<< archemiya
            </tbody>
        </table>
    </div>
archemiya;
}


?>

<body>
    <div class='alert alert-info' role='alert'>
        当前页面用于审核学生延期答辩申请，请谨慎操作
    </div>
    <?php
    delay_echo($link);
    ?>
</body>