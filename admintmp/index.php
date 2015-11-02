<?php
$username='badmin';
$pass='bodhi@vjcet';


session_start();

if($_GET['command']=='logout')
unset($_SESSION['emag']);
if($_SESSION['emag']=='admin0' || ($_POST['user']==$username && $_POST['pass']===$pass))
{

define('admin',true);
$_SESSION['emag']='admin0';}
else
{ 
echo "<b> This is a temporary admin area for quick edits on events and to keep a watch on registration patterns</b>";
if(!empty($_POST['user']))
echo "<h1>contact admin to obtain temporary login details</h1>";
$e=<<<w
<form method='post'>
<input placeholder='username' name='user'>
<input placeholder='password' name='pass' type='password'><button>Login</button>
</form>
w;
exit($e);
}
?>
<a href='./edit.php'>Edit events</a> | 
<a href='./stats.php'>View Stats</a>