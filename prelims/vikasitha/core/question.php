<?php
session_start();
include 'connect.php';
$r = mysql_query("SELECT * FROM questions ORDER BY RAND()") or die (mysql_error()); 
$n = mysql_num_rows($r);
if($n==0)
{
echo "<p style=\"margin-top:30px;\">There are no questions in database !</p>";
}
else
{
?>
<p style="color:#133E6F;">
<?php echo nl2br(file_get_contents("../q_page.txt")); ?>
</p>
<?php
$number=0;
while($k = mysql_fetch_array($r))
{ 

$number++;
echo "
<p style=\"border-top: 1px solid #DEE0E4;\"></p>
<span id=\"question-".$k['id']."\">";
echo "<b style=\"font-size: 17px;\">".$number." .</b><br /><br />";
echo "<span  style=\"font-weight:normal;line-height:19px;min-height:0px;padding-top:3px;padding-bottom:3px;\">".nl2br($k['text'])."</span>";
echo "&nbsp;&nbsp;&nbsp;&nbsp;<span style=\"font-style: italic;\"> (<span style=\"color:#060;\">Mark :".$k['mark']."</span> , <span style=\"color:#C00;\">Negative Mark :".$k['n_mark']."</span>)</span>&nbsp;&nbsp;&nbsp;&nbsp;";
$is1=$k['id'];
$is2=$_SESSION['id'];
$r56 = mysql_query("SELECT option_id from answers where question_id='$is1' AND contestant_id='$is2'") or die (mysql_error()); 
$n56 = mysql_num_rows($r56);
list($a56)=mysql_fetch_row($r56);
if($n56==0)
{
echo "&nbsp;&nbsp;<span title=\"click to view/hide options\" style=\"padding-bottom: 2px;font-size: 17px;font-weight:bold;line-height:16px;min-height:0px;min-width:0px;\" id=\"toggle-".$k['id']."\" class=\"g-button\">+</span> 
";
?>
<p style="display:none;color: black;text-align:center;padding-top:15px;padding-bottom:15px;" id="submitting-<?php echo $k['id'];?>">
<img src="stuff/spinner.gif" width="16" height="16" />&nbsp;submitting your answer ....
</p>
<?php
echo "<br /><form action=\"\" id=\"submitter-".$k['id']."\" onsubmit=\"return false;\"><ul id=\"options-".$k['id']."\" class=\"stylish\" style=\"margin-right: 5%;margin-left: 40px;list-style-type: none;text-align: left;display:none;\">";
$rt=$k['id'];
$r2 = mysql_query("SELECT * FROM options where question_id='$rt' order by option_id asc ") or die (mysql_error()); 
$coun=1;
$t3=$k['answer'];
$r3 = mysql_query("SELECT option_text FROM options WHERE option_id='$t3' AND question_id='$rt'") or die (mysql_error()); 
list($max2)=mysql_fetch_row($r3);
while ($arr2 = mysql_fetch_array($r2))
{ 
echo "<li>&nbsp;<input type=\"radio\" name=\"radio-".$k['id']."\" value=\"".$arr2['option_id']."\" />&nbsp;".$arr2['option_text']."</li>";
$coun++;
}
echo "
<li style=\"margin: 15px;\">
<input type=\"submit\" value=\"submit\" name=\"submit\" id=\"submit_button-".$k['id']."\" class=\"g-button\" />
</li>
<li>
<p style=\"display:none;color: white;border:3px solid #D19298;text-align:center;background:#D73645;padding-top:15px;padding-bottom:15px;\" id=\"fillup-".$k['id']."\">
You need to select an option before submitting !
</p>
</li>
</ul>
</form>

<p id=\"result-".$k['id']."\" style=\"display:none;\">
</p>
<p style=\"border-top: 1px solid #DEE0E4;\"></p>";
?>
<script type="text/javascript">
$("#toggle-<?php echo $k['id'];?>").click(function() {
if($('#options-<?php echo $k['id'];?>').is(":hidden"))
{
$("#toggle-<?php echo $k['id'];?>").html("-");
$('#options-<?php echo $k['id'];?>').slideDown("slow");
}
else
{
$("#toggle-<?php echo $k['id'];?>").html("+");
$('#options-<?php echo $k['id'];?>').slideUp("slow");
}
return;
});
$(document).ready(function() {
$("#submit_button-<?php echo $k['id'];?>").click(function() {

var question = <?php echo $k['id'];?>;
var options = $("input[name='radio-<?php echo $k['id'];?>']:checked").val();
var user=<?php echo $_SESSION['id'];?>;
if(options!=undefined)
{
$('#fillup-<?php echo $k['id'];?>').css("display","none");
$('#submitter-<?php echo $k['id'];?>').css("display","none");
$('#submitting-<?php echo $k['id'];?>').css("display","block");
$("#toggle-<?php echo $k['id'];?>").css("display","none");
var dataString = 'question='+ question + '&option=' + options+'&user='+user;
$.ajax({
    type: "POST",
    url: "core/answer_store.php",
    data: dataString,
    success: function() {
$('#result-<?php echo $k['id'];?>').load("core/result_loader.php?q=<?php echo $k['id'];?>&u=<?php echo $_SESSION['id'];?>",function(){
$('#submitting-<?php echo $k['id'];?>').css("display","none");
$('#result-<?php echo $k['id'];?>').fadeIn("slow",function(){var t1=readCookie("answered");
t1++;
createCookie("answered",t1, ctime);
$("#done").html(readCookie("answered"));
});});
}
});

}
else
{
$('#fillup-<?php echo $k['id'];?>').fadeIn("slow");
$('#fillup-<?php echo $k['id'];?>').delay(5200).fadeOut("slow");
}
});});
</script>
<?php
}
if($n56!=0)
{
$rgh = mysql_query("SELECT answer from questions where id='$is1'") or die (mysql_error()); 
list($agh)=mysql_fetch_row($rgh);

/*
$rgh = mysql_query("SELECT option_id from answers where question_id='$is1' AND contestant_id='$is2' AND option_id='$agh'") or die (mysql_error()); 
$ngh = mysql_num_rows($rgh);

if($ngh==0)
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
You have answered this question !
</p>
<?php
//}
}
echo "</span>";
}
}
if($n!=0)
{
?>
<br />
<p style="margin-left:43%;">
<span class="g-button" id="getout">finish</span>
</p>
<script type="text/javascript">
$(document).ready(function() {
$("#getout").click(function() {
$(".container_shadow").slideUp("slow");
$("#top-img").css("display","block");
$("#analytics").html('<p  id="is-load" style="text-align:center;padding-top: 15px;padding-bottom: 15px;"><img src="stuff/indicator.gif" width="16" height="16" /></p>');
$("#analytics").load("core/finish.php");
eraseCookie("answered");
eraseCookie("min");
eraseCookie("sec");
$("#analytics").slideDown("slow");
});
});
</script>
<?php
}
?>
<script type="text/javascript">
 function createCookie(name, value, days) {
        var expires;
        if (days) {
            var date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            expires = "; expires=" + date.toGMTString();
        }
        else expires = "";
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function readCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') c = c.substring(1, c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
        }
        return null;
    }

    function eraseCookie(name) {
        createCookie(name, "", -1);
    }
var ctime=4;

</script>