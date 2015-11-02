<?php
session_start();
if(isset($_SESSION['id']) AND isset($_SESSION['member_1']) AND isset($_SESSION['member_2']))
{
echo "
<script type=\"text/javascript\">
window.location=\"rules.php\";
</script>
";
}
include 'core/connect.php';
if (isset($_GET['er']))
{
$eris=$_GET['er'];
}
else
{
$eris='';
}
?>
<html>
<head>
<title>Bodhi 2k13</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<script type="text/javascript" src="stuff/jquery.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $(document).bind("contextmenu",function(e){
        //return false;
    });
});
</script>
</head>
<body>
<div style="text-align:center;margin: auto;width: 206px;height:15px;margin-top:10px;">
<img src="stuff/index.png" style="height: 185px;"/>
</div>
<div id="content" class="container_shadow" style="min-height:280px;">
<h1 >Welcome to Prelims : <span style="color:green;"><?php echo file_get_contents("core/event.txt");?></span></h1>

<table style="font-family:Lucida Grande, Verdana, Sans-serif;font-size:13px;" >
<tbody>
<tr>
<td style="color: #333333;">
<p style="margin-top: 25px;"><strong>Login</strong></p>
<form method="post" action="verify.php">
<input type="text" id="username" name="username" value="" style="width: 250px;" placeholder="username"/>
<br /><br />
<input type="password" id="password" name="password" value="" style="width: 250px;" placeholder="password"/>
<br /><br />
<input type="submit" value="login" name="submit" class="g-button" id="submit"/>
</form>
</td>
<br />
<td style="min-height: 200px;color: #333333;position:absolute;width: 57%;margin-left: 2%;border-left: 1px solid silver;padding-left:15px;">
<?php echo nl2br(file_get_contents("welcome.txt"));?>
</td>
</tr>
</tbody>
</table>

<br />
<p style="display:none;color: white;border:3px solid #D19298;text-align:center;background:#D73645;padding-top:15px;padding-bottom:15px;" id="error2">
Enter a username/password ! Try again after filling those fields properly .
</p>


<script type="text/javascript">
$(document).ready(function() {
$("#submit").click(function() {
var username = $("#username").val();
var password = $("#password").val();
if(username.length<3 || password.length<3 )
{
$('#error2').fadeIn("slow");
$('#error2').delay(4200).fadeOut("slow");
return false;
}
});
});
</script>
<?php
if($eris==1)
{
?>
<br />
<p style="color: white;border:3px solid #D19298;text-align:center;background:#D73645;padding-top:15px;padding-bottom:15px;" id="error">
The username/password you have entered is incorrect ! 
</p>
<script type="text/javascript">
$(document).ready(function() {
$('#error').delay(4200).fadeOut("slow");
});
</script>
<?php
}
?>
</div>
<span style="text-align:right;color: black;font-size: 13px;margin: 15px auto 15px;margin-left:66%;">
&copy; 2013 <b>Bodhi2k13</b> | <a href="http://www.bodhiofficial.in" target="_blank" title="click to the view official bodhi 2013 website" alt="bodhi-site">www.bodhiofficial.in</a>
</span>
</body>
</html>