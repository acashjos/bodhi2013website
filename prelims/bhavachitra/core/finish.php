<?php
session_start();
include 'connect.php';
$correct=0;
$wrong=0;
$who=0;
$is2=$_SESSION['id'];
$r56 = mysql_query("SELECT * from answers where contestant_id='$is2'") or die (mysql_error()); 
$num=mysql_num_rows($r56);
while($r=mysql_fetch_array($r56))
{
$i=$r['question_id'];
$e=$r['option_id'];
$rg = mysql_query("SELECT answer,mark,n_mark from questions where id='$i'") or die (mysql_error()); 
list($ans,$mark,$nmark)=mysql_fetch_row($rg);
$who=$who+$mark;
if($ans==$e)
{
$correct=$correct+$mark;
}
else
{
$wrong=$wrong+$nmark;
}
}

$tot=$correct-$wrong;
if($tot<0)
{
$tot=0;
}
echo "You have answered : ".$num." Question";
if($num>1)
{
echo "s";
}
$run=256;
mysql_query("update contestants set marks='$tot',finish='$run' where id='$is2'") or die (mysql_error()); 

echo '<br />Your score is : '.$tot.' out of '.$who;
echo "<br /><br /><img src=\"stuff/smile.png\" title=\"thanks for participating & meanwhile enjoy BODHI 2k13\" alt=\"smile\" /><br /><br />Thanks for participating in <span style=\"color:green;font-weight: bold;\">".EVENT."</span> @ <b>BODHI 2k13</b>";

echo '<br /><br /><span style="float:right;">developed by <a target="_blank" href="http://www.fiverr.com/amalfra">Amal Francis</a> in association with <a href="http://www.bodhiofficial.in/#reach" target="_blank" title="Anto Dominic, Akash kurian Jose & Amal Francis">BodhiWebteam</a></span>';

unset($_SESSION['id']);
unset($_SESSION['member_1']);
unset($_SESSION['member_2']);
unset($_SESSION['finish']);
session_unset();
session_destroy(); 
?>