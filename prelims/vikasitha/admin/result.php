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
<h1 >Results : <span style="color:green;"><?php echo file_get_contents("../core/event.txt");?></span></h1>
<p style="margin-top: 25px;text-align: right;background:#F3F5F8;padding: 10px;"><a href="main.php">Back to main page</a>&nbsp;|&nbsp;<a href="create_user.php">Create new user/team</a>&nbsp;|&nbsp;<a href="setting.php">Settings</a></p>
<br />
<?php
$rm = mysql_query("SELECT * from contestants where finish='256' ORDER BY marks desc") or die (mysql_error()); 
$number=0;
$sn=mysql_num_rows($rm);
if($sn==0)
{
echo "<span style=\"text-align:center;margin-left: 40%;\">No results are available</span>";
}
if($sn!=0)
{
while($arr=mysql_fetch_array($rm))
{
$number++;
$correct=0;
$wrong=0;
$correct_t=0;
$wrong_t=0;
$r56 = mysql_query("SELECT * from answers where contestant_id='$arr[id]'") or die (mysql_error()); 
$num=mysql_num_rows($r56);
while($r=mysql_fetch_array($r56))
{
$i=$r['question_id'];
$e=$r['option_id'];
$rg = mysql_query("SELECT answer from questions where id='$i'") or die (mysql_error()); 
list($ans)=mysql_fetch_row($rg);
if($ans==$e)
{
$correct++;
}
else
{
$wrong++;
}

}
echo "<span id=\"result-".$arr['id']."\">
<p style=\"border-top: 2px solid #DEE0E4;\"></p>
<b style=\"font-size: 17px;\">".$number." .&nbsp;&nbsp;&nbsp;".$arr['team_name']."</b><br />
<span style=\"text-align:center;padding-left: 40%;\">
";
echo "answered : ".$num." Question";
if($num>1)
{
echo "s";
}
echo "<br />";
echo '<span style="color:#060;padding-left: 40%;">Answered correct : '.$correct.'</span><br />';
echo '<span style="color:#C00;padding-left: 40%;">Answered wrong : '.$wrong.'</span><br />';
echo '<span style="padding-left: 40%;">Score : '.$arr['marks'].'</span>';
echo "</span><p style=\"border-top: 2px solid #DEE0E4;\"></p></span><br />";
}}
?>
</div>
</body>
</html>