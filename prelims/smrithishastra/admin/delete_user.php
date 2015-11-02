<?php
include '../core/connect.php';
$q=$_GET['i'];
mysql_query("delete from contestants where id='$q'") or die (mysql_error()); 
mysql_query("delete from answers where contestant_id='$q'") or die (mysql_error()); 
?>