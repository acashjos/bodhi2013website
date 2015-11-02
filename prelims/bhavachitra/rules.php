<?php
session_start();
if(!isset($_SESSION['id']) OR !isset($_SESSION['member_1']) OR !isset($_SESSION['member_2']))
{
echo "
<script type=\"text/javascript\">
window.location=\"index.php\";
</script>
";
}
else
{
include 'core/connect.php';
setcookie('answered','0',time()+60*60*60,'/');
?>
<html>
<head>
<title>Bodhi 2k13</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>
<body>
<div style="text-align:center;margin: auto;width: 206px;height:15px;margin-top:10px;">
<img src="stuff/index.png" style="height: 185px;"/>
</div>
<div id="content" class="container_shadow">
<h1></h1><br />
<h1 >RULES & INSTRUCTIONS : <span style="color:green;"><?php echo file_get_contents("core/event.txt");?></span></h1>

<p style="margin-top: 25px;font-size: 18px;"><b>Hi <?php echo $_SESSION['member_1'];?> , <?php echo $_SESSION['member_2'];?> please be patient to read following carefully .</b></p>


<p style="margin-top: 25px;font-size:18px;"><strong>Rules</strong></p>
		
<p style="color: #333333;">
<?php echo nl2br(file_get_contents("rules.txt"));?>
</p>


<p style="margin-top: 25px;font-size:18px;"><strong>Instructions</strong></p>
		
<p style="color: #333333;">
<?php echo nl2br(file_get_contents("instructions.txt"));?>
</p>
<p style="text-align:center;margin-top:55px;">
<a href="questions.php" class="g-button">Start</a>
</p>

</div>
<span style="text-align:right;color: black;font-size: 13px;margin: 15px auto 85px;margin-left:66%;">
&copy; 2013 <b>Bodhi2k13</b> | <a href="http://www.bodhiofficial.in" target="_blank" title="click to the view official bodhi 2013 website" alt="bodhi-site">www.bodhiofficial.in</a>
</span>
<br /><br /><br /><br /><br /><br />
</body>
</html>
<?php
}
?>