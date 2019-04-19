<?php
include "../link.php";
include "../secretary_func/sec_query_stu_control.php";
//为了不和学生控制流程混淆，只能重写查询语句
$sql_t_control = "SELECT * FROM `t_func_control`";
$result_t_control = mysqli_query($link, $sql_t_control);
$row_t_control = mysqli_fetch_array($result_t_control, MYSQLI_BOTH);

//当前服务器时间
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');

//查询该学生最新提交的开题报告
$sql_id = "SELECT max(`record_id`) from `first_report_record` where `student_id` = '{$_SESSION['user_id']}' order by `record_id` desc ";
$result_id = mysqli_query($link, $sql_id);
$row_id = mysqli_fetch_array($result_id,MYSQLI_BOTH);
$sql_first_report_record = "SELECT * FROM `first_report_record` WHERE `student_id` = '{$_SESSION['user_id']}' AND `record_id` = '{$row_id['max(`record_id`)']}'";
$result_first_report_record = mysqli_query($link, $sql_first_report_record);
$row_first_report_record = mysqli_fetch_array($result_first_report_record, MYSQLI_BOTH);
$num_first_report_record = mysqli_num_rows($result_first_report_record);

//查询该学生是否确认任务书
$sql_task_book = "SELECT * FROM `task_book` WHERE `student_id` = '{$_SESSION['user_id']}' ";
$result_task_book = mysqli_query($link, $sql_task_book);
$row_task_book = mysqli_fetch_array($result_task_book, MYSQLI_BOTH);
$num_task_book = mysqli_num_rows($result_task_book);

//查询该学生最终报告提交状态
$sql_final_first_report = "SELECT * FROM `first_report_record` WHERE `student_id` = '{$_SESSION['user_id']}' AND `final_flag` =4 ";
$result_final_first_report = mysqli_query($link, $sql_final_first_report);
$num_final_first_report = mysqli_num_rows($result_final_first_report);


//查询该学生的最终选题
$sql_topic = "SELECT * FROM `chose_topic_record` WHERE `student_id` = '{$_SESSION['user_id']}' AND `final_flag` =1 ";
$result_topic = mysqli_query($link, $sql_topic);
$num_topic = mysqli_num_rows($result_topic);

//当服务器时间超过截止时，加载该页面自动将老师流程控制页面中的开题流程开启，即禁止所有学生上传开题报告
if ($today > $row_t_control['first_report_deadline'] && $row_t_control['first_report_deadline'] != NULL) {
  $sql_close = "UPDATE `t_func_control` set `first_report` = 1";
  mysqli_query($link, $sql_close);
}

//此函数将“确认任务书”之后的情况全部涵盖，具体请看每个状态码的注释
function report_echo($link, $row_task_book, $num_task_book, $row_first_report_record, $num_first_report_record, $row_control, $row_t_control, $num_final_first_report)
{
  // 此处使用task_book表中查询所得的各个信息较为方便，故使用了$row_task_book.
  echo <<< archemiya
<div class="table-responsive">
    <table data-toggle="table" data-toolbar="#toolbar">
      <thead>
        <tr>
          <th class="col-md-4 th-title-topic-chs" >课题名称</th>
          <th class="col-md-1 th-title-center th-title-topic-stu" >指导教师</th>
          <th class="col-md-3 th-title-center th-title-topic-stu" >状态</th>
          <th class="col-md-2 th-title-center th-title-topic-stu" >操作1</th>
          <th class="col-md-2 th-title-center th-title-topic-stu" >操作2</th>
        </tr>
        
      </thead>
      <tbody>
        <tr>
          <td class="td-height"><a href="./student.php?func=topic&id={$row_task_book['topic_id']}" >{$row_task_book['topic_name']}</a> </td>
          <td class="td-height td-title-center"> {$row_task_book['teacher_name']}</td>
archemiya;
  /*
重要说明：对于开题报告分为三个阶段：
1.没有上传限制。此阶段由导师和学生双方根据是否完成选题，是否下达任务书，是否确认任务书等步骤判断是否可以上传报告。**该阶段无任何限制，师生双方可以多次交流开题报告，由学生上传开题报告，导师给予修改意见。**

2.上传终稿阶段。**表示学生可以向答辩导师组递交开题报告最终稿**
  全体开启条件(前提条件)：全员学生完成选题且答辩小组分配完毕。**由答辩秘书开启此阶段（即学生控制面板中的开题流程）**
  个体开启条件(直接条件)：对于每个学生由导师开启，开启条件为导师确认最终稿。
  
  进入该阶段之后：
    - 如果该学生已完成导师审核（即最终稿的确认），学生可以进行最终稿的上传，此次上传将直接上传至答辩评阅组。
    - 如未完成导师审核，应加紧时间完成最终稿的审核。

3.最终审核阶段。**表示导师可以对开题报告进行评分**
开启条件：（**1）由答辩秘书进行操作 2）由答辩秘书进行操作或自行刷新页面**）
  - 1）全员学生按时上传终稿完成。
  - 2）超过提交截止时间。
此阶段下，学生无法做出任何操作，如未上传最终报告成绩将记为0分。

***重要提示***
设计时存在一个误区需要避免，即只有第三阶段的开启会限制报告的提交，第二阶段并不会限制！第二阶段并不会限制！第二阶段并不会限制！！！重要的事说三遍。
第二阶段开启标志：$row_control['first_report'] == 1
第三阶段开启标志：$row_t_control['first_report'] == 1

关于表`first_report_record`中`final_flag`的状态码说明：
  - 0 表示已上传报告但导师未审核状态
  - 2 表示已上传报告且导师已审核状态
  - 3 表示已上传且导师已确认的最终报告，但未上传至答辩评阅组，此状态码在整个记录表中只出现一次
  - 4 表示已上传至答辩评阅组的最终稿，此状态码在整个记录表中同样只出现一次
  - 1 表示开题报告流程顺利完成
*/
  /*
稍后补上伪代码
*/
  $second = $row_control['first_report'];
  $third = $row_t_control['first_report'];
  if (!$third) {
    if (!$second) { //第一阶段，此时需要判断选题以及任务书的确认情况
      if ($num_task_book == 0) { //状态1
        echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
        echo "导师还未下达任务书！不可填写开题报告";
      } elseif ($row_task_book['islook_flag'] == 0) { //状态2
        echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
        echo "您还未确认任务书！不可填写开题报告";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && (!$num_first_report_record && ($row_first_report_record['annex_flag'] == 0))
      ) { //状态3 未上传报告及附件状态
        echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
        echo "您还未上传开题报告及附件，请及时上传";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && ($num_first_report_record && ($row_first_report_record['annex_flag'] == 0))
      ) { //状态4 未上传附件
        echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
        echo "您还未上传附件，请及时上传";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && $num_first_report_record && ($row_first_report_record['final_flag'] == 0)
        && ($row_first_report_record['annex_flag'] == 1)
      ) { //状态5
        //表示处于导师审核阶段
        echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
        echo "您已上传开题报告，请等待指导老师审核";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && $num_first_report_record && ($row_first_report_record['final_flag'] == 2)
      ) { //状态6
        //表示导师已提交意见，可查看意见并重新上传，此阶段会循环数次
        echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
        echo "导师已审核，请查看修改建议";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && $num_first_report_record && ($row_first_report_record['final_flag'] == 3)
      ) { //状态7
        //表示导师已确认最终稿，但此时不可上传最终稿
        echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
        echo "导师已确定最终稿，当前还未分配答辩组，不可提交最终稿";
      }
    } elseif ($second) { //第二阶段不限制第一阶段的进行，此时不需要判断选题以及任务书的确认情况，因此第二阶段应包含第一阶段的师生交互过程
      if (
        $num_first_report_record
        && (($row_first_report_record['final_flag'] == 3) || ($row_first_report_record['final_flag'] == 4))
      ) { //状态1
        //表示导师已确认最终版，系统将自动上传至答辩组，如果存在final_flag为3的记录将自动升级成为4
        $sql_update = "UPDATE `first_report_record` set `final_flag` = 4 
        where `first_report_record`.`final_flag` = 3 ";
        mysqli_query($link, $sql_update);
        echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
        echo "已上传至答辩组，请等待答辩组审核";
      } elseif (
        !$num_first_report_record && ($row_first_report_record['annex_flag'] == 0)
      ) { //状态2
        //表示尚未完成最终稿 （报告与附件都从未上交），应在截止日期之前完成
        echo "<td class=\"td-height td-title-center alert alert-danger\" role='alert'>";
        echo "尚未完成最终稿，请在";
        echo $row_t_control['first_report_deadline'];
        echo "前完成";
      } elseif (
        $num_first_report_record && ($row_first_report_record['annex_flag'] == 0)
      ) { //状态3
        //上交报告未上交附件
        echo "<td class=\"td-height td-title-center alert alert-danger\" role='alert'>";
        echo "您还未上传附件，请及时上传";
        echo "（截止时间";
        echo $row_t_control['first_report_deadline'];
        echo "）";
      } elseif (
        $num_first_report_record && ($row_first_report_record['final_flag'] == 0)
        && ($row_first_report_record['annex_flag'] == 1)
      ) { //状态4
        //导师审核
        echo "<td class=\"td-height td-title-center alert alert-danger\" role='alert'>";
        echo "您已上传开题报告，请等待指导老师审核";
        echo "（截止时间";
        echo $row_t_control['first_report_deadline'];
        echo "）";
      } elseif (
        $num_first_report_record && ($row_first_report_record['final_flag'] == 2)
      ) { //状态5
        //表示导师已提交意见，可查看意见并重新上传，此阶段会循环数次
        echo "<td class=\"td-height td-title-center alert alert-danger\" role='alert'>";
        echo "导师已审核，请查看修改建议";
        echo "（截止时间";
        echo $row_t_control['first_report_deadline'];
        echo "）";
      }
    }
  } elseif ($third) {
    if (
      $num_task_book && $row_task_book['islook_flag']
      && $num_first_report_record && ($row_first_report_record['final_flag'] == 4)
      && ($row_first_report_record['annex_flag'] == 1)
    ) { //状态1
      echo "<td class=\"td-height td-title-center alert alert-warning\" role='alert'>";
      echo "已上传至答辩组，请等待答辩组审核";
    } elseif (
      $num_task_book && $row_task_book['islook_flag']
      && $num_first_report_record
      && ($row_first_report_record['final_flag'] == 1)
    ) { //状态2
      echo "<td class=\"td-height td-title-center alert alert-info\" role='alert'>";
      echo "开题报告审核已结束";
    } else {
      echo "<td class=\"td-height td-title-center alert alert-danger\" role='alert'>";
      echo "已超过提交截止时间，该项成绩将被扣分";
    }
  }

  echo "</td>";
  echo "<td>";

  if (!$third) {
    if (!$second) {
      if ($num_task_book == 0) { //状态1
        echo "<button class=\"btn btn-primary\" disabled >不可操作</button>";
      } elseif ($row_task_book['islook_flag'] == 0) { //状态2
        echo "<button class=\"btn btn-primary\" disabled >不可操作</button>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && (!$num_first_report_record && ($row_first_report_record['annex_flag'] == 0))
      ) { //状态3
        echo "<button class=\"btn btn-default\" data-toggle=\"modal\" 
            data-target=\"#firstReportTable\" >上传开题报告</button>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && ($num_first_report_record && ($row_first_report_record['annex_flag'] == 0))
      ) { //状态4
        echo "<button class=\"btn btn-warning\" disabled>不可操作</button>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && $num_first_report_record && ($row_first_report_record['final_flag'] == 0)
        && ($row_first_report_record['annex_flag'] == 1)
      ) { //状态5
        //表示处于导师审核阶段
        echo "<button class=\"btn btn-warning\" disabled>不可操作</button>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && $num_first_report_record && ($row_first_report_record['final_flag'] == 2)
      ) { //状态6
        //表示导师已提交意见，可查看意见并重新上传，此阶段会循环数次
        echo "<a href='student.php?func=first_report&id={$row_first_report_record['topic_id']}' 
    class=\"btn btn-primary\" role='button' >查看修改意见</a>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && $num_first_report_record && ($row_first_report_record['final_flag'] == 3)
      ) { //状态7
        //表示导师已确认最终稿，但此时不可上传最终稿
        echo "<button class=\"btn btn-warning\" disabled>不可操作</button>";
      }
    } elseif ($second) {
      if (
        $num_first_report_record
        && (($row_first_report_record['final_flag'] == 3) || ($row_first_report_record['final_flag'] == 4))
      ) { //状态1
        //表示导师已确认最终版，系统将自动上传至答辩组，如果存在final_flag为3的记录将自动升级成为4
        echo "<button class=\"btn btn-warning\"  disabled>不可操作</button>";
      } elseif (
        !$num_first_report_record && ($row_first_report_record['annex_flag'] == 0)
      ) { //状态2
        //表示尚未完成最终稿 （报告与附件都从未上交），应在截止日期之前完成
        echo "<button class=\"btn btn-default\" data-toggle=\"modal\" 
              data-target=\"#firstReportTable\" >上传开题报告</button>";
      } elseif (
        $num_first_report_record && ($row_first_report_record['annex_flag'] == 0)
      ) { //状态3
        //上交报告未上交附件
        echo "<button class=\"btn btn-warning\" disabled>不可操作</button>";
      } elseif (
        $num_first_report_record && ($row_first_report_record['final_flag'] == 0)
        && ($row_first_report_record['annex_flag'] == 1)
      ) { //状态4
        //导师审核
        echo "<button class=\"btn btn-warning\" disabled>不可操作</button>";
      } elseif (
        $num_first_report_record && ($row_first_report_record['final_flag'] == 2)
      ) { //状态5
        //表示导师已提交意见，可查看意见并重新上传，此阶段会循环数次
        echo "<a href='student.php?func=first_report&id={$row_first_report_record['topic_id']}' 
        class=\"btn btn-primary\" role='button' >查看修改意见</a>";
      }
    }
  } elseif ($third) {
    if (
       $num_first_report_record && ($row_first_report_record['final_flag'] == 4)
      && ($row_first_report_record['annex_flag'] == 1)
    ) { //状态1 
      echo "<button class=\"btn btn-warning\" disabled >不可操作</button>";
    } elseif (
       $num_first_report_record
      && ($row_first_report_record['final_flag'] == 1)
    ) { //状态2
      echo "<button class=\"btn btn-success\" disabled >审核结束</button>";
    } else {
      echo "<button class=\"btn btn-danger\" disabled >审核结束</button>";
    }
  }


  echo <<< archemiya
          </td>
          <td>
archemiya;

  if (!$third) {
    if (!$second) { //第一阶段，此时需要判断选题以及任务书的确认情况
      if ($num_task_book == 0) { //状态1
        echo "<button class=\"btn btn-primary\" disabled >不可操作</button>";
      } elseif ($row_task_book['islook_flag'] == 0) { //状态2
        echo "<button class=\"btn btn-primary\" disabled >不可操作</button>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && (!$num_first_report_record && ($row_first_report_record['annex_flag'] == 0))
      ) { //状态3
        echo "<button class=\"btn btn-default\" disabled>上传附件</button>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && ($num_first_report_record && ($row_first_report_record['annex_flag'] == 0))
      ) { //状态4
        echo "<button class=\"btn btn-default\" data-toggle=\"modal\" 
            data-target=\"#firstReportAnnexTable\" >上传附件</button>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && $num_first_report_record && ($row_first_report_record['final_flag'] == 0)
        && ($row_first_report_record['annex_flag'] == 1)
      ) { //状态5
        //表示处于导师审核阶段
        echo "<button class=\"btn btn-warning\" disabled>不可操作</button>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && $num_first_report_record && ($row_first_report_record['final_flag'] == 2)
      ) { //状态6
        //表示导师已提交意见，可查看意见并重新上传，此阶段会循环数次
        echo "<button class=\"btn btn-primary\" data-toggle=\"modal\" 
            data-target=\"#firstReportAnnexTable\" >重新上传附件</button>";
      } elseif (
        $num_task_book && $row_task_book['islook_flag']
        && $num_first_report_record && ($row_first_report_record['final_flag'] == 3)
      ) { //状态7
        //表示导师已确认最终稿，但此时不可上传最终稿
        echo "<button class=\"btn btn-warning\" disabled>不可操作</button>";
      }
    } elseif ($second) { //第二阶段，此时不需要判断选题以及任务书的确认情况
      if (
        $num_first_report_record
        && (($row_first_report_record['final_flag'] == 3) || ($row_first_report_record['final_flag'] == 4))
      ) { //状态1
        //表示导师已确认最终版，系统将自动上传至答辩组，如果存在final_flag为3的记录将自动升级成为4
        echo "<button class=\"btn btn-warning\" disabled>不可操作</button>";
      } elseif (
        !$num_first_report_record && ($row_first_report_record['annex_flag'] == 0)
      ) { //状态2
        //表示尚未完成最终稿 （报告与附件都从未上交），应在截止日期之前完成
        echo "<button class=\"btn btn-default\" disabled>上传附件</button>";
      } elseif (
        $num_first_report_record && ($row_first_report_record['annex_flag'] == 0)
      ) { //状态3
        //上交报告未上交附件
        echo "<button class=\"btn btn-default\" data-toggle=\"modal\" 
            data-target=\"#firstReportAnnexTable\" >上传附件</button>";
      } elseif (
        $num_first_report_record && ($row_first_report_record['final_flag'] == 0)
        && ($row_first_report_record['annex_flag'] == 1)
      ) { //状态4
        //导师审核
        echo "<button class=\"btn btn-warning\" disabled>不可操作</button>";
      } elseif (
        $num_first_report_record && ($row_first_report_record['final_flag'] == 2)
      ) { //状态5
        //表示导师已提交意见，可查看意见并重新上传，此阶段会循环数次
        echo "<button class=\"btn btn-primary\" data-toggle=\"modal\" 
        data-target=\"#firstReportAnnexTable\" >重新上传附件</button>";
      }
    }
  } elseif ($third) {
    if (
      $num_task_book && $row_task_book['islook_flag']
      && $num_first_report_record && ($row_first_report_record['final_flag'] == 4)
      && ($row_first_report_record['annex_flag'] == 1)
    ) { //状态1
      echo "<button class=\"btn btn-warning\" disabled >不可操作</button>";
    } elseif (
      $num_task_book && $row_task_book['islook_flag']
      && $num_first_report_record
      && ($row_first_report_record['final_flag'] == 1)
    ) { //状态2
      echo "<button class=\"btn btn-success\" disabled >审核结束</button>";
    } else {
      echo "<button class=\"btn btn-danger\" disabled >审核结束</button>";
    }
  }
  echo <<< archemiya
          </td>
        </tr>
      </tbody>
    </table>
  </div>
archemiya;
}
?>

<body>
  <?php
  if (!$num_topic) {
    echo <<< archemiya
    <br/>
    <div class='alert alert-danger' role='alert'>
    <strong>您尚未选题，请先选题！</strong>
    </div>
archemiya;
  } elseif (!$num_task_book) {
    echo <<< archemiya
    <br/>
    <div class='alert alert-danger' role='alert'>
    <strong>您尚未确认任务书，请先确认！</strong>
    </div>
archemiya;
  } else {
    echo <<< archemiya
    <br/>
    <div class='alert alert-info' role='alert'>
    <strong>提示：</strong>
    请上传开题报告摘要，再上传附件！
    </div>
archemiya;
    report_echo($link, $row_task_book, $num_task_book, $row_first_report_record, $num_first_report_record, $row_control, $row_t_control, $num_final_first_report);
  }
  ?>

  <!-- 此处的两个modeltable为该学生上传开题报告和附件所用 -->
  <div class="modal fade " id="firstReportTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="chose-student-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title login-title">上传开题报告</h4>
        </div>
        <div class="modal-body">
          <form action="stu_add_first_report.php" method="POST" class="form-horizontal">
            <div class="form-group">
              <label for="inputTopicIntro" class="col-sm-3 control-label">课题来源</label>
              <div class="col-sm-8">
                <textarea name="topic_source" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicIntro" class="col-sm-3 control-label">课题研究的目的、意义</label>
              <div class="col-sm-8">
                <textarea name="topic_purpose" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicIntro" class="col-sm-3 control-label">课题的国内外研究现状和发展动态</label>
              <div class="col-sm-8">
                <textarea name="topic_research_status" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicIntro" class="col-sm-3 control-label">课题的研究内容、拟采取的技术方案或研究方法</label>
              <div class="col-sm-8">
                <textarea name="topic_main" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicReq" class="col-sm-3 control-label">课题研究的重点、难点及创新点</label>
              <div class="col-sm-8">
                <textarea name="topic_difficulty" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicRef" class="col-sm-3 control-label">课题研究的进度安排</label>
              <div class="col-sm-8">
                <textarea name="topic_schedule" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <div class="form-group">
              <label for="inputTopicRef" class="col-sm-3 control-label">主要参考文献</label>
              <div class="col-sm-8">
                <textarea name="topic_ref" class="form-control" rows="3" required></textarea>
              </div>
            </div>
            <?php
            echo <<< archemiya
          <input type="hidden" name="student_id" value="{$_SESSION['user_id']}">
          <input type="hidden" name="student_name" value="{$_SESSION['user_name']}">
          <input type="hidden" name="topic_id" value="{$row_task_book['topic_id']}">
          <input type="hidden" name="topic_name" value="{$row_task_book['topic_name']}">
          <input type="hidden" name="teacher_id" value="{$row_task_book['teacher_id']}">
          <input type="hidden" name="teacher_name" value="{$row_task_book['teacher_name']}">
archemiya;
            ?>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" class="btn btn-primary">上传</button>
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

  <div class="modal fade " id="firstReportAnnexTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="chose-student-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title login-title">上传附件（请先上传摘要再上传附件）</h4>
        </div>
        <div class="modal-body">
          <form action="../file-upload.php?func=first_report" method="POST" class="form-horizontal" enctype="multipart/form-data">
            <div class="form-group">
              <label for="inputTopicRef" class="col-sm-3 control-label">上传开题报告附件</label>
              <div class="col-sm-8">
                <input name="file" type="file" class="input-file" />
                <p class="help-block">上传文件格式仅限doc/docx/pdf，文件大小限制为10MB</p>
              </div>
            </div>
            <?php
            echo <<< archemiya
          <input type="hidden" name="num" value="{$num_first_report_record}">
          <input type="hidden" name="student_id" value="{$_SESSION['user_id']}">
          <input type="hidden" name="student_name" value="{$_SESSION['user_name']}">
          <input type="hidden" name="topic_id" value="{$row_task_book['topic_id']}">
          <input type="hidden" name="topic_name" value="{$row_task_book['topic_name']}">
archemiya;
            ?>
            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-10">
                <button type="submit" class="btn btn-primary">确定上传</button>
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






  <body>