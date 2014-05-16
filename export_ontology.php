<?php

include_once ("./header.php");
include_once ("./onto_array.php");
include_once ("./appvars.php");
include_once ("./entity_helper.php");
include_once ("./db_helper.php");

set_time_limit(0);
echo $_POST['submit'];
if ($_POST['submit'] == '导出CSV文件') {
    include_once ( 'export_csv.php' );
}

if ($_POST['submit'] == '导出TTL文件') {
    include_once ( 'export_turtle.php' );
}

include_once ("./foot.php");
?>
