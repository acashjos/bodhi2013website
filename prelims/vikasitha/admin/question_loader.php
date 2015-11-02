<?php
include '../core/connect.php';
$r = mysql_query("SELECT * FROM questions") or die (mysql_error()); 
$n = mysql_num_rows($r);
if($n==0)
{
echo "There are no questions in database !";
}
else
{
$number=0;
while ($arr = mysql_fetch_array($r))
{ 
$number++;
echo "
<p style=\"display:none;color: black;text-align:center;padding-top:15px;padding-bottom:15px;\" id=\"delete-".$arr['id']."\">
<img src=\"../stuff/spinner.gif\" width=\"16\" height=\"16\" />&nbsp;deleting Question ....
</p>
<span id=\"question-".$arr['id']."\">
<br /><p style=\"border-top: 2px solid #DEE0E4;\"></p>
<span id=\"deletebutton-".$arr['id']."\" class=\"close\" title=\"click to delete this question\">X</span>
";
echo "<b style=\"float: left;\">".$number." .</b>&nbsp;";
echo nl2br($arr['text']);
echo "<ul style=\"list-style-type: none;text-align: left;margin-left:30%;\">";
$rt=$arr['id'];
$r2 = mysql_query("SELECT * FROM options where question_id='$rt' order by option_id asc ") or die (mysql_error()); 
$coun=1;
$t3=$arr['answer'];
$r3 = mysql_query("SELECT option_text FROM options WHERE option_id='$t3' AND question_id='$rt'") or die (mysql_error()); 
list($max2)=mysql_fetch_row($r3);
while ($arr2 = mysql_fetch_array($r2))
{ 
echo "<li> <b>".$coun." .</b>&nbsp;".$arr2['option_text']."</li>";
$coun++;
}
echo "</ul>
Answer : ".$max2."<br /><br />
Mark : ".$arr['mark']."
&nbsp;|&nbsp;Negative Mark : ".$arr['n_mark']."
<p style=\"border-top: 2px solid #DEE0E4;\"></p>";
?>
<script type="text/javascript">
$("#deletebutton-<?php echo $arr['id'];?>").click(function() {
$('#question-<?php echo $arr['id'];?>').slideUp("slow");
$('#delete-<?php echo $arr['id'];?>').slideDown("slow");
var dataString = 'question=';
$.ajax({
    type: "POST",
    url: "delete_question.php?q=<?php echo $arr['id'];?>",
    data: dataString,
    success: function() {
$('#delete-<?php echo $arr['id'];?>').fadeOut("slow");
}
  });
});
</script>
<?php
echo "</span>";
}
}
?>