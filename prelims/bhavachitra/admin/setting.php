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
$welcome=file_get_contents('../welcome.txt');
$rules=file_get_contents('../rules.txt');
$instructions=file_get_contents('../instructions.txt');
$eve=file_get_contents('../core/event.txt');
$qm=file_get_contents('../q_page.txt');

$atemp=file_get_contents('../core/admin_data.txt');
$atemp2=explode("~",$atemp);

$a_u=$atemp2[0];
$a_p=$atemp2[1];

?>
<html>
<title>Bodhi</title>
<head>
<link rel="stylesheet" type="text/css" href="../style.css" />
<script type="text/javascript" src="../stuff/jquery.js"></script>
</head>
<body>
<div style="text-align:center;margin: auto;width: 206px;height:15px;margin-top:10px;">
<img src="../stuff/index.png" style="height: 185px;"/>
</div>
<div id="content" class="container_shadow">
<h1 >Settings : <span style="color:green;"><?php echo file_get_contents("../core/event.txt");?></span></h1>
<p style="margin-top: 25px;text-align: right;background:#F3F5F8;padding: 10px;"><a href="main.php">Back to main page</a>&nbsp;|&nbsp;<a href="create_user.php">Create new user/team</a>&nbsp;|&nbsp;<a href="result.php">View results</a></p>
<br />
<form action="set_check.php" method="post">
Enter event time (in minutes) : <input type="text" name="time" style="width: 50px;" id="time" value="<?php echo MAX;?>"/>
<br /><br />
<u>welcome message :</u><br /><br />
<textarea id="welcome" name="welcome" cols="82" rows="8" placeholder="Enter the welcome message here " tabindex="4" style="resize: vertical;height:auto;"><?php if(!empty($welcome)) { echo $welcome;}  ?></textarea> 
<br /><br />
<u>rules :</u><br /><br />

<textarea id="rules" name="rules" cols="82" rows="8" placeholder="Enter the rules here " tabindex="4" style="resize: vertical;height:auto;"><?php if(!empty($rules)) { echo $rules;}  ?>
</textarea> 
<br /><br />

<u>instructions :</u><br /><br />
<textarea id="instructions" name="instructions" cols="82" rows="8" placeholder="Enter the instructions here " tabindex="4" style="resize: vertical;height:auto;"><?php if(!empty($instructions)) { echo $instructions;}  ?></textarea> 
<br /><br />



<u>Questions page message :</u><br /><br />
<textarea id="qm" name="qm" cols="82" rows="8" placeholder="Enter the message here " tabindex="4" style="resize: vertical;height:auto;"><?php if(!empty($qm)) { echo $qm;}  ?></textarea> 
<br /><br />



<u>event name :</u> &nbsp;&nbsp;&nbsp;<input type="text" value="<?php if(!empty($eve)) { echo $eve;}  ?>" name="event" />
<br /><br />

<u>admin username :</u> &nbsp;&nbsp;&nbsp;<input type="text" value="<?php if(!empty($a_u)) { echo $a_u;}  ?>" name="username" />
<br /><br />

<u>admin password :</u> &nbsp;&nbsp;&nbsp;<input type="text" value="<?php if(!empty($a_p)) { echo $a_p;}  ?>" name="password" />
<br /><br />

<input type="submit" value="submit" name="submit" id="submit_button" class="g-button" />

</form>
<form action="run_up.php" method="post">
<br /><br />
<span style="margin-left:45%;">
<?php
$f = fopen('../core/start.txt','r+');
while(!feof($f)) { 
$thedate= fgets($f);
}
fclose($f);
if($thedate!=256)
{
?>
<input type="submit" value="Start Event" name="submit" id="submit_button" class="g-button" />
<?php
}
else
{
?>
<input type="submit" value="Stop Event" name="submit" id="submit_button" class="g-button" />
<?php
}
?>
</span>
</form>
</div>

</body>
</html>