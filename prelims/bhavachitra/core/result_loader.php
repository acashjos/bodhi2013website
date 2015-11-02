<?php
include 'connect.php';

$q=$_GET['q'];
$u=$_GET['u'];
/*
$r = mysql_query("SELECT answer from questions where id='$q'") or die (mysql_error()); 
list($a)=mysql_fetch_row($r);

$r = mysql_query("SELECT option_id from answers where question_id='$q' AND contestant_id='$u' AND option_id='$a'") or die (mysql_error()); 
$n = mysql_num_rows($r);

if($n==0)
{
?>
<p style="color: white;border:3px solid #D19298;text-align:center;background:#D73645;padding-top:15px;padding-bottom:15px;" id="question-notadded">
Your answer is wrong !
</p>
<?php
}
else
{
*/
?>
<p style="color: white;border:3px solid #729BCE;text-align:center;background:#4372AC;padding-top:15px;padding-bottom:15px;" id="question-added">
Your answer has been submitted !
</p>
<?php
//}
?>