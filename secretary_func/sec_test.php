<?php
date_default_timezone_set('Asia/Shanghai');
$today = date('Y-m-d');
header('Content-type:text/json');     
for($i=0;$i<$_POST['num'];$i++){
    echo <<< archemiya
    <td></td>
    <td>
        <input class="form-control">
    </td>
archemiya;
}
?>