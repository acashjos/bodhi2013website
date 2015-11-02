<?php
session_start();
include '../core/connect.php';
if($_SESSION['admin']!=1)
{
echo "
<script type=\"text/javascript\">
window.location=\"../index.php\";
</script>
";
}
else
{
$f = fopen('../core/start.txt','w');
if($_POST['submit']=="Start Event")
{
fputs($f,256);
}
if($_POST['submit']=="Stop Event")
{
fputs($f,0);
}
fclose($f);
echo "
<script type=\"text/javascript\">
window.location=\"setting.php\";
</script>
";
}
?>