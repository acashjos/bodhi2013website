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
$f = fopen('../core/time.txt','w');
fputs($f,$_POST['time']);
fclose($f);


if(!empty($_POST['welcome']))
{
$f = fopen('../welcome.txt','w');
fputs($f,$_POST['welcome']);
fclose($f);
}



if(!empty($_POST['qm']))
{
$f = fopen('../q_page.txt','w');
fputs($f,$_POST['qm']);
fclose($f);
}



if(!empty($_POST['rules']))
{
$f = fopen('../rules.txt','w');
fputs($f,$_POST['rules']);
fclose($f);
}

if(!empty($_POST['instructions']))
{
$f = fopen('../instructions.txt','w');
fputs($f,$_POST['instructions']);
fclose($f);
}

if(!empty($_POST['event']))
{
$f = fopen('../core/event.txt','w');
fputs($f,$_POST['event']);
fclose($f);
}



if(!empty($_POST['username']) AND !empty($_POST['password']))
{
$f = fopen('../core/admin_data.txt','w');
fputs($f,$_POST['username']."~".$_POST['password']);
fclose($f);
}


echo "
<script type=\"text/javascript\">
window.location=\"setting.php\";
</script>
";

}
?>