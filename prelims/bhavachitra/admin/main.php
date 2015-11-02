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
<h1 >Admin : <span style="color:green;"><?php echo file_get_contents("../core/event.txt");?></span></h1>

<p style="margin-top: 25px;text-align: right;background:#F3F5F8;padding: 10px;"><a href="result.php">View results</a>&nbsp;|&nbsp;<a href="create_user.php">Create new user/team</a>&nbsp;|&nbsp;<a href="setting.php">Settings</a></p>

<p style="margin-top: 25px;"><strong>Create new question :</strong></p>
<p style="color: #333333;">
<form action="" id="databaser" onsubmit="return false;">

<textarea id="question" name="question" cols="82" rows="8" placeholder="Enter the Question here" tabindex="4" style="resize: vertical;height:auto;"></textarea> 
<br /><br />
<textarea id="options" name="options" cols="82" rows="6" placeholder="Enter the Options here . Each individual option sholud be entered in a new line ." tabindex="4" style="resize: vertical;height:auto;"></textarea> 

<br /><br />

<input type="text" style="width: 100%;" placeholder="enter the correct answer of question here ." name="answer" id="answer"/>

<br /><br />
Enter mark of this question : <input type="text" name="mark" style="width: 30px;" id="mark" value="1"/>
&nbsp;&nbsp;&nbsp;Enter negative mark of this question : <input type="text" name="nmark" style="width: 30px;" id="nmark" value="0"/>
<p style="text-align:center;">
<input type="submit" value="submit" name="submit" id="submit_button" class="g-button" />
</p></form>
</p>

<p style="display:none;color: black;text-align:center;padding-top:15px;padding-bottom:15px;" id="submitting">
<img src="../stuff/spinner.gif" width="16" height="16" />&nbsp;Adding Question ....
</p>

<p style="display:none;color: white;border:3px solid #D2E8CD;text-align:center;background:green;padding-top:15px;padding-bottom:15px;" id="question-added">
Question added succesfully !
</p>

<p style="display:none;color: white;border:3px solid #D19298;text-align:center;background:#D73645;padding-top:15px;padding-bottom:15px;" id="question-notadded">
Error adding Question ?
</p>

<p style="display:none;color: white;border:3px solid #D19298;text-align:center;background:#D73645;padding-top:15px;padding-bottom:15px;" id="fillup">
You need to enter a Question , atleast 2 options and a correct answer ! 
</p>

<p style="display:none;color: white;border:3px solid #D19298;text-align:center;background:#D73645;padding-top:15px;padding-bottom:15px;" id="fillup2">
It appears that the <i>correct answer</i> you have entered is not present in any of the options .
</p>

<br />
<p style="color: #333333;border-top:1px solid #DEE0E4;">
<br />
<strong>Questions in database :</strong>
</p>

<p style="color: #333333;text-align:center;" id="question-list">
</p>

</div>

<script type="text/javascript">
$(document).ready(function() {
$('#question-list').html('<p  id="is-load" style="text-align:center;padding-top: 15px;padding-bottom: 15px;"><img src="../stuff/indicator.gif" width="16" height="16" /></p>');
$('#question-list').load("question_loader.php");
});
$(document).ready(function() {
$("#submit_button").click(function() {

$('#fillup').css("display","none");
$('#fillup2').css("display","none");
$('#question-added').css("display","none");
$('#question-list').css("display","none");
$('#submitting').css("display","none");
$('#question-list').css("display","block");

var errors=0;

		
var question = $("#question").val();
var options = $("#options").val();
var answer = $("#answer").val();
var mark=$("#mark").val();
var nmark=$("#nmark").val();

if(question.length<6 || options.length<1 || answer.length<1 )
{
$('#fillup').fadeIn("slow");
errors++;
$('#fillup').delay(5200).fadeOut("slow");
}

if(!(options.indexOf(answer) >=0) && errors==0 )
{
$('#fillup').css("display","none");
$('#fillup2').fadeIn("slow");
errors++;
$('#fillup2').delay(5200).fadeOut("slow");
}


if(errors==0)
{
$('#fillup2').css("display","none");
$('#fillup').css("display","none");
$('#question-added').fadeOut("slow");
$('#submitting').fadeIn("slow");
var dataString = 'question='+ encodeURIComponent(question) + '&options=' + encodeURIComponent(options) +'&answer='+ encodeURIComponent(answer) +'&mark='+ mark +'&nmark=' + nmark;
$.ajax({
    type: "POST",
    url: "create_check.php",
    data: dataString,
    success: function() {
$('#submitting').css("display","none");
  $('#question-added').fadeIn("slow");
$('#question-list').html('<p  id="is-load" style="text-align:center;padding-top: 15px;padding-bottom: 15px;"><img src="../stuff/indicator.gif" width="16" height="16" /></p>');
$('#question-list').load("question_loader.php");
 $('#question-added').delay(3200).fadeOut("slow");
}
  });
}
});
});
</script>

</body>
</html>