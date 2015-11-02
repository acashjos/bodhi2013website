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

if (isset($_GET['er']))
{
$er1=$_GET['er'];
}
else
{
$er1='';
}
?>
<html>
<head>
<title>Bodhi</title>
<link rel="stylesheet" type="text/css" href="../style.css" />
<script type="text/javascript" src="../stuff/jquery.js"></script>
</head>
<body>
<div style="text-align:center;margin: auto;width: 206px;height:15px;margin-top:10px;">
<img src="../stuff/index.png" style="height: 185px;"/>
</div>
<div id="content" class="container_shadow">
<h1 >Create new user/team : <span style="color:green;"><?php echo file_get_contents("../core/event.txt");?></span></h1>

<p style="margin-top: 25px;text-align: right;background:#F3F5F8;padding: 10px;"><a href="main.php">Back to main page</a>&nbsp;|&nbsp;<a href="result.php">View results</a>&nbsp;|&nbsp;<a href="setting.php">Settings</a></p>

<br />
<form action="user_check.php" id="databaser" method="post">

<p style="color: #333333;text-align:center;">

<input type="text" name="username" value="" style="width: 250px;" placeholder="username"/>
<br /><br />
<input type="password" name="password" value="" style="width: 250px;" placeholder="password"/>
<br /><br />

<input type="text" name="mem1" value="" style="width: 250px;" placeholder="member 1 name"/>
<br /><br />

<input type="text" name="mem2" value="" style="width: 250px;" placeholder="member 2 name"/>
<br /><br />

<input type="text" name="contact" value="" style="width: 250px;" placeholder="contact number"/>
<br /><br />


<input type="submit" value="Create" name="submit" id="submit_button" class="g-button" />
</form>
</p>
<?php
if($er1==2)
{
?>
<p style="color: white;border:3px solid #D2E8CD;text-align:center;background:green;padding-top:15px;padding-bottom:15px;" id="user-added">
User added succesfully !
</p>
<?php
}
if($er1==1)
{
?>
<p style="color: white;border:3px solid #D19298;text-align:center;background:#D73645;padding-top:15px;padding-bottom:15px;" id="user-notadded">
User with this username already exist ! Try another name 
</p>
<?php
}
?>


<?php
if($er1==3)
{
?>
<p style="color: white;border:3px solid #D19298;text-align:center;background:#D73645;padding-top:15px;padding-bottom:15px;" id="user-notadded2">
There was an error creating User ! Try again , Make sure that you have filled all the fields 
</p>
<?php
}
?>

<br />
<p style="color: #333333;border-top:1px solid #DEE0E4;">
<br />
<strong>Users/Teams in database :</strong>
</p>
<p style="color: #333333;text-align:center;" id="user-list">
</p>

<script type="text/javascript">
$(document).ready(function() {
$('#user-list').html('<p  id="is-load" style="text-align:center;padding-top: 15px;padding-bottom: 15px;"><img src="../stuff/indicator.gif" width="16" height="16" /></p>');
$('#user-list').load("user_loader.php");
});

<?php
if($er1==2)
{
?>
$('#user-added').delay(5200).fadeOut("slow");
<?php
}
?>


<?php
if($er1==1)
{
?>
$('#user-notadded').delay(5200).fadeOut("slow");
<?php
}
?>
<?php
if($er1==3)
{
?>
$('#user-notadded2').delay(5200).fadeOut("slow");
<?php
}
?>
</script>
</div>
</body>
</html>