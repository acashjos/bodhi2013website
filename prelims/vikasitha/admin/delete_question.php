<?php
include '../core/connect.php';
$q=$_GET['q'];
mysql_query("delete from questions where id='$q'") or die (mysql_error()); 
mysql_query("delete from options where question_id='$q'") or die (mysql_error()); 
mysql_query("delete from answers where question_id='$q'") or die (mysql_error()); 
?>