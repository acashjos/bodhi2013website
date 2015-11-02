<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<style>

#page{
background: #d55269;
border: 4px solid #C46978;
border-radius: 5px;
box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
width: 700px;
}

#page, #page-header{
margin: auto;
padding: 15px;
}
#page{
margin-left: 13%;
}

body{
background-color: #C73F57;
}


.button {
	-moz-box-shadow:inset 0px 1px 0px 0px #f5978e;
	-webkit-box-shadow:inset 0px 1px 0px 0px #f5978e;
	box-shadow:inset 0px 1px 0px 0px #f5978e;
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #D7584E), color-stop(1, #BD4338) );
	background:-moz-linear-gradient( center top, #D7584E 5%, #BD4338 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#D7584E', endColorstr='#BD4338');
	background-color:#D7584E;
	-webkit-border-top-left-radius:6px;
	-moz-border-radius-topleft:6px;
	border-top-left-radius:6px;
	-webkit-border-top-right-radius:6px;
	-moz-border-radius-topright:6px;
	border-top-right-radius:6px;
	-webkit-border-bottom-right-radius:6px;
	-moz-border-radius-bottomright:6px;
	border-bottom-right-radius:6px;
	-webkit-border-bottom-left-radius:6px;
	-moz-border-radius-bottomleft:6px;
	border-bottom-left-radius:6px;
	text-indent:0;
	border:1px solid #d02718;
	display:inline-block;
	color: #F2E4E3;
	font-family:Arial;
	font-size:15px;
	font-weight:bold;
	font-style:normal;
	padding: 10px;
	text-decoration:none;
	text-align:center;
	text-shadow:1px 1px 0px #810e05;
	width:50%;
}
.button:hover, .button-active{
	background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #D7584E), color-stop(1, #d2554a) );
	background:-moz-linear-gradient( center top, #D7584E 5%, #d2554a 100% );
	filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#D7584E', endColorstr='#d2554a');
	background-color:#D7584E;
}.button:active {
	position:relative;
	top:1px;
}
label{
width:20%;
display: inline-block;
font-weight: bold;
font-size: 14px;
color: rgba(248, 248, 248, 0.78);
text-shadow: 0px 1px 1px #854550;
}

h1 {
    font-family: verdana,sans-serif;
    font-weight: normal;
    color: rgb(255, 187, 187);
}
.panel-container span {
    display: block;
    height: 30px;
}
.tab.active a {
    color: white;
    font-weight: bold;
}
input[type="checkbox"] {
    zoom: 2;
}
label {}
.panel-container label {
    position: relative;
    top: 9px;
}
.etabs {
margin: 0;
padding: 0;
display: inline-block;
width: 300px;
}
.tab.active {
padding-top: 6px;
position: relative;
top: 1px;
border-color: rgb(102, 102, 102);
font-weight: bold;
}
.tab {
display: inline-block;
zoom: 1;
border: none;
width: 100%;
}
.tab a.active {
font-weight: bold;
}

.tab a:hover{
cursor:pointer;
}
.tab a {
font-size: 1.1em;
color: rgb(255, 187, 187);
line-height: 2em;
font-family: tahoma,verdana,sans-serif;
display: block;
font-weight: normal;
padding: 0 10px;
outline: none;
text-decoration: none;
}

.tab a:hover {
text-decoration:underline;
}

.tab-container .panel-container {
vertical-align: top;
display: inline-block;
min-height: 100px;
padding: 10px;
}
.hide{
display:none;
}

#error-box li{
font-style:italic;
}

.error-head{
color:#640505;
font-size: 17px;
padding: 5px;
text-align: center;
font-family: Georgia, serif;
font-weight: bold;
}

.arrow_box {
	position: absolute;
	background: #d5a0a9;
	border: 4px solid #E65757;
	min-height: 100px;
	width: 280px;
	top: 35%;
	left: 78%;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
-moz-box-shadow: 0 1px 3px rgba(0,0,0,0.5);
-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, 0.5);
border-radius: 5px;
}
.arrow_box:after, .arrow_box:before {
	right: 100%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

.arrow_box:after {
	border-color:rgba(245, 191, 191, 0);
	border-right-color: #d5a0a9;
	border-width: 30px;
	top: 50%;
	margin-top: -30px;
}
.arrow_box:before {
	border-color: rgba(245, 191, 191, 0);
	border-right-color: #BD7373;
	border-width: 36px;
	top: 50%;
	margin-top: -36px;
}

input[type="text"]:focus{
background:#e7c0bc;
outline:none;
}
#side-info{
background: #d5a0a9;
width: 380px;
padding:10px;
border: 5px solid #BD7373;
font-family: sans-serif;
font-size:15px;
color: #4C4D46;
position:absolute;
top:3%;
left:69%;
}

#page-header{
background: #e2aab4;
width: 600px;
border: 2px solid #db8291;
border-top: 1px solid #bd243f;
font-family: sans-serif;
font-size:15px;
color: #696263;
}
ol li, #page-header li, #side-info li{
font-style: italic;
font-weight:normal;
}
#page-header p{
font-weight: bold;
}

.bottom{
border-top: 1px solid #cd8ca6;
margin-left: -15px;
margin-right:-15px;
margin-bottom:-15px;
padding: 10px;
background:#C46978;
}
form{
margin:0;
}

.panel-container label {
width: auto;
}
</style>


<?php 
function check_registered($id, $user_regs)
{
foreach($user_regs as $k => $v)
{
if($v["event"] == $id)
{
return $v;
}
}
return false;
}
if($rows==0)
{
$this->input->set_cookie($this->config->item('cookie_prefix').$this->config->item('sess_cookie_name'),'',time()-12313);
?>
<p>We couldn't recognize you! Please make sure you have entered a valid URL.</p>
<?php } else { if($error) { ?>		
<link href="<?php echo base_url(); ?>css/form.css?v=1.1" rel="stylesheet">

<div id="side-info" class="arrow_box">
<p><?php if($param_key==''){echo 'Hi ';} else { echo 'Welcome back ';} echo '<i>'.$usd[0]["name"].'</i>';?>, here are the details you have registered with us :- </p>
<ul>
<li>Email : <?php echo $usd[0]["email"];?></li>
<li>College : <?php echo $usd[0]["college"];?></li>
<li>Department : <?php echo $usd[0]["dept"];?></li>
<li>Contact number : <?php echo $usd[0]["cno"];?></li>
</ul>
<p><b>Your bodhi id is :- <i><?php echo $usd[0]["username"];?></i></b></p>
<p>Now you may select the events to enroll for.</p>
</div>

<div id="page">

<h1>Events @ Bodhi2k13</h1>
<?php echo validation_errors();
echo form_open(base_url().uri_string(),array('id'=>'reg-form'));
$tab_heads = array();
$tab_bodies = array();
$i=0;
foreach($egroups as $k => $v)
{ if((int)$v["id"] != 10) { 
$tab_heads[] = $v["name"];
$tab_bodies[$i] = "";
foreach($v["events"] as $k1 => $v1)
{
$ch = false;
if(check_registered($v1->event_id, $user_regs))
{
$ch = true;
}
$data = array(
    'name'        => "events[]",
    'id'          => $v1->event_name,
    'value'       => $v1->event_id,
    'checked'     => $ch
    );
$tab_bodies[$i] .= '<span>'. form_checkbox($data).form_label($v1->event_name, $v1->event_name).'</span>';
} }
$i++;
}
?>

<div id="tab-container" class="tab-container">
  <ul class="etabs">
  <?php for($i=0; $i<count($tab_heads); $i++) { ?>
    <li class="tab <?php if($i==0) echo 'active';?>"><a targ="#tabc<?php echo $i; ?>" id="tab<?php echo $i; ?>"><?php echo $tab_heads[$i]; ?></a></li>
	<?php  } ?>
	<li class="tab"><a targ="#tabc71" id="tab71">Workshops</a></li>
  </ul>
  
  <div class="panel-container">
   <?php for($i=0; $i<count($tab_bodies); $i++) { ?>
  <div id="tabc<?php echo $i; ?>" class="<?php if($i!=0) echo 'hide';?>">
  <?php echo $tab_bodies[$i]; ?>
  </div>
  <?php } ?>
   <div id="tabc71" class="hide">
<span style="color: #430909;font-weight: bold;width: 320px;">Register for Windows 8 App development Workshop <a href="http://goo.gl/3pzDrW" target="_blank">here</a></span>
</div>
  </div>
</div>

<div class="bottom"> <label></label>
<input type="submit" name="submit" class="button" value="Thats all, Enroll Me" id="reg-event">
</div>
</form>
<script>
var th = $("#tab-container ul li");
var i=0;
th.each(function() {
$("#"+$(this).children().attr("id")).click(function(){
var cur = $(this);
if(!cur.parent().hasClass('active'))
{
$(".etabs li").removeClass("active");
cur.parent().addClass("active");
$(".panel-container div").hide();
$(cur.attr("targ")).show();
}

});
});

$('#reg-form').submit(function(){
$("#reg-event").attr("value","Enrolling..");
$("#reg-event").addClass("button-active");
$("#reg-event").attr("disabled","disabled");
});
</script>
</div>
<?php
}
else
{
?>
<style>
#page p{
font-size:18px;
font-weight:bold;
color:#42030e;
}
.ps{
color:#302527;
font-style:italic;
}
.fb{
padding: 0.3em 0.6em 0.375em;
border: 1px solid #999;
text-decoration:none;
border-color: #29447E #29447E #1A356E;
color: #FFF;
background-color: #5B74A8;
background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#637BAD), to(#5872A7));
background-image: -moz-linear-gradient(#637bad, #5872a7);
background-image: -o-linear-gradient(#637bad, #5872a7);
background-image: linear-gradient(#637BAD, #5872A7);
filter: progid:DXImageTransform.Microsoft.gradient(startColorStr='#637bad', EndColorStr='#5872a7');
-webkit-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #8A9CC2;
-moz-box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #8a9cc2;
box-shadow: 0 1px 0 rgba(0, 0, 0, 0.1), inset 0 1px 0 #8A9CC2;
}
</style>
<?php if ($param_key == '' || $this->session->userdata('user_id')) { ?>
<div id="page" style="margin: auto;margin-top:10%;">
<div style="text-align:center;">
<img src="http://3.bp.blogspot.com/-CaxXJKo21Kk/TcC0UR5fCHI/AAAAAAAAA_0/r99HL_fJXyM/s1600/ThumbsUp_clipart.png" alt="thumbs up" width="70" height="70">
</div>
<p>
Your registration has been completed successfully. Thanks for registering in events @ Bodhi2k13. Please check your mailbox for confirmation and account details. 
</p>
<div class="ps">PS : We try our best to make sure that emails sent by us reach your inbox. But, unfortunately due to false detections it may be marked as spam. So, please check your Spam/Junk folder too.</div>
<div style="text-align:center;margin-top:20px;font-weight:bold;">Like our <a href="https://www.facebook.com/bodhiofficial" target="_blank" class="fb">Facebook page</a> to get regular updates</div>
<?php } else { ?>
<div id="page" style="margin: auto;margin-top:10%;">
<div style="text-align:center;">
<img src="http://3.bp.blogspot.com/-CaxXJKo21Kk/TcC0UR5fCHI/AAAAAAAAA_0/r99HL_fJXyM/s1600/ThumbsUp_clipart.png" alt="thumbs up" width="70" height="70">
</div>
<p>
Your registration has been updated successfully. Thanks for registering in events @ Bodhi2k13. Please check your mailbox for confirmation and account details. In case of any bugs or help contact us at <a href="mailto:webmaster@bodhiofficial.in?subject=Help Online Registration">webmaster@bodhiofficial.in</a> 
</p>
<div class="ps">PS : We try our best to make sure that emails sent by us reach your inbox. But, unfortunately due to false detections it may be marked as spam. So, please check your Spam/Junk folder too.</div>
<div style="text-align:center;margin-top:20px;font-weight:bold;">Like our <a href="https://www.facebook.com/bodhiofficial" target="_blank" class="fb">Facebook page</a> to get regular updates</div>

<?php } ?>
<!-- <p style="font-family: verdana,sans-serif;
    color: white;
    line-height: 2em;
    font-size: 1.3em;
">Please check your mailbox for confirmation and account details. <br><sub><b>PS</b>. Remember to check your <b>Junk</b> folder as well </sub><br>
Like our<a href="https://www.facebook.com/bodhiofficial" target="_blank" style="
    text-decoration: none;
    color: rgb(76, 102, 164);
    text-shadow: 0 0 10px rgb(83, 30, 30);
"> facebook page </a>for getting regular updates
</p> -->
</div>
<?php
} }