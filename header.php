<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>毕业设计教学管理系统</title>
    <link rel="stylesheet" href="../css/bootstrap-datetimepicker.css" media="screen">
    <link rel="stylesheet" type="text/css" href="../css/ManaSys.css">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap3.3.7.css">
    <!-- <link rel="stylesheet" href="../css/bootstrap4.3.1.css" > -->
    <link rel="stylesheet" type="text/css" href="../css/dashboard.css">
    <link rel="stylesheet" type="text/css" href="../css/form_login.css">
    <link rel="stylesheet" href="../css/bootstrap-table.css">
    <script type="text/javascript" src="../js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="../js/popper.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap3.3.7.min.js"></script>
    <script type="text/javascript" src="../js/bootstrap-table.js"></script>
    <script type="text/javascript" src="../js/bootstrap-table-zh-CN.min.js"></script>
    <script type="text/javascript" src="../js/dashboard4.3.1.js"></script>
    <link rel="icon" href="../images/besti.ico">
    
</head>

<body>
    <!--顶端标题-->
    <div class="content fixed-top">
        <div class="homehead">
            <div class="centered">
                <div class="piclf">
                    <div class="logo"></div>
                    <div class="spacingline"></div>
                    <p class="systemname">毕业设计教学管理系统</p>
                </div>
                <nav class="navbar-inverse">
                    <div id="navbar" class="navbar-collapse collapse topbar">
                        <ul class="nav navbar-nav navbar-right">
                            <?php
                            echo "<li><a >";
                            echo "<i class=\"glyphicon glyphicon-user\">";
                            echo $_SESSION['user_name'], $_SESSION['user_id'];
                            echo "</i></a></li>";
                            ?>
                            <li><a href="" data-toggle="modal" data-target="#modalTable"><i class="glyphicon glyphicon-cog">修改密码</i></a></li>
                            <li><a href="../logout.php"><i class="glyphicon glyphicon-log-out">登出</i></a></li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <div class="shadow"></div>
    </div>
    <div class="modal fade " id="modalTable" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title login-title">密码修改</h4>
                </div>
                <div class="modal-body ">
                    <form action="../chpasswd.php" method="POST" class="form-signin row">
                        <label for="inputAccountnumber" class="sr-only">账号</label>
                        <input type="account" name="account" id="inputAccountnumber" class="form-control" placeholder="账号" autocomplete="off" required="">
                        <br />
                        <label for="inputPassword" class="sr-only">原密码</label>
                        <input type="password" name="oldpasswd" id="inputOldPassword" class="form-control" placeholder="原密码" autocomplete="off" required="">
                        <br />
                        <label for="inputPassword" class="sr-only">新密码</label>
                        <input type="password" name="newpasswd" id="inputNewPassword" class="form-control" placeholder="新密码" autocomplete="off" required="">
                        <br />
                        <label for="inputPassword" class="sr-only">确认新密码</label>
                        <input type="password" name="newpasswd2" id="inputNewPassword2" class="form-control" placeholder="确认新密码" autocomplete="off" required="">
                        <br />
                        <button class="btn btn-lg btn-primary btn-block" type="submit">确认修改</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- <script type="text/javascript" src="../js/jquery-1.8.3.min.js" charset="UTF-8"></script> -->
    <!-- <script type="text/javascript" src="../js/bootstrap.min.js"></script> -->
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
    <script type="text/javascript" src="../js/bootstrap-datetimepicker.zh-CN.js" charset="UTF-8"></script>
    <script type="text/javascript">
        $('.form_datetime').datetimepicker({
            //language:  'fr',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            forceParse: 0,
            showMeridian: 1
        });
        $('.form_date').datetimepicker({
            //language: 'fr',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 2,
            minView: 2,
            forceParse: 0
        });
        $('.form_time').datetimepicker({
            //language: 'fr',
            weekStart: 1,
            todayBtn: 1,
            autoclose: 1,
            todayHighlight: 1,
            startView: 1,
            minView: 0,
            maxView: 1,
            forceParse: 0
        });
    </script>
</body>