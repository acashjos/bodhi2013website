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
<script type="text/javascript">
// interval to update cookie in sec
var c_up_delay = 6;
var up_timer =0;

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

if(!readCookie("min"))
{
createCookie("min",0, ctime);
}

if(!readCookie("sec"))
{
createCookie("sec",0, ctime);
}

var min=readCookie("min");
var sec=readCookie("sec");

function timed()
{
var t;
/* Buggy : stops timer
if(!readCookie("min"))
{
createCookie("min",0, ctime);
}
if(!readCookie("sec"))
{
createCookie("sec",0, ctime);
}
*/
if (sec>58)
{
min++;
sec=0;
}
if(sec<=58)
{
sec++;
}

if(sec>0 && up_timer>c_up_delay)
{
createCookie("sec",sec, ctime);
createCookie("min",min, ctime);
up_timer=0;
}
up_timer++;
$('#elapsed').html(min+" : "+sec);
var stupid1=setTimeout(timed,1050);
//return min+" : "+sec;
}
</script>
<style>
#content
{
margin: 85px auto 15px;
}
</style>
</head>
<body>
<div style="text-align:center;width: 206px;height:15px;position: absolute;
top: 0;
z-index: 1;
margin: auto;
margin-left: 43%;">
<img src="stuff/index.png" style="height: 185px;"/>
</div>
<div id="analytics" class="container_shadow uppapa" style="display:none;width:85%;text-align:center;">
</div>
<p id="content" class="container_shadow" style="margin-top: 0px;opacity:.9;-moz-border-radius:0px 0px 0px 0px;
border-radius:0px 0px 0px 0px;
-webkit-border-radius:0px;
width: 95%;position:fixed;top:0px;color: #333333;text-align:left;border-top:1px solid #DEE0E4;vertical-align:middle;padding-right:5%;padding-left:5%;" >
Answered : <b id="done"> </b> question<?php if($_COOKIE['answered']>1){echo "s";} ?> | Total : <b id="total"></b> questions
<span style="float:right;padding-right:5%;">Time elapsed : <b id="elapsed">loading....</b> | <?php echo TIME;?> </span>
</p>

<div id="content" class="container_shadow" style="margin-top:150px;">
<h1 >Questions</h1>




<p style="color: #333333;text-align:left;border-top:1px solid #DEE0E4;" id="questions">

</p>
<span style="display:none;" id="null"></span>
<script type="text/javascript">
var finish_ses=<?php echo $_SESSION['finish']; ?>;
$(document).ready(function() {
$('#questions').html('<p  id="is-load" style="text-align:center;padding-top: 15px;padding-bottom: 15px;"><img src="stuff/indicator.gif" width="16" height="16" /></p>');
$('#questions').load("core/question.php");

<?php
$r1 = mysql_query("SELECT id FROM questions") or die (mysql_error()); 
$n1 = mysql_num_rows($r1);

$r1 = mysql_query("SELECT option_id FROM answers where contestant_id='$_SESSION[id]' group by question_id") or die (mysql_error()); 
$n12 = mysql_num_rows($r1);

if($n12==$n1)
{
?>
createCookie("answered",<?php echo $n1;?>, ctime);
<?php
} 
else
{
?>
createCookie("answered",<?php echo $n12;?>, ctime);
<?php
}
echo 'var total='.$n1.';';
?>
$('#total').html(total);

var answered=readCookie("answered");
$('#done').html(answered);

var stupid1=setTimeout(timed,1050);
var fin=0;
if(fin==0)
{
var stupid2=setInterval(function(){
var ach=readCookie("answered"),minas=min;
if(ach==total || minas>=<?php echo MAX;?> || finish_ses==256)
{
$(".container_shadow").slideUp("slow");
clearInterval(stupid1);
clearInterval(stupid2);
fin++;
$("#top-img").css("display","block");
$("#analytics").html('<p  id="is-load" style="text-align:center;padding-top: 15px;padding-bottom: 15px;"><img src="stuff/indicator.gif" width="16" height="16" /></p>');
$("#analytics").load("core/finish.php");
eraseCookie("answered");
eraseCookie("min");
eraseCookie("sec");
$("#analytics").slideDown("slow");
}
},1050);
}
});
</script>


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