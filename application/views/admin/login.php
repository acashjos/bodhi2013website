<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<title>Bodhi2k13 Online Registration Admin | Login</title>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<style>
#login-form{
margin:auto;
width: 300px;
border:12px solid #93d0d7;
border-bottom:6px solid #4eadb8;
border-left:6px solid #74c1ca;
border-right:6px solid #30afbe;
background: #F4FBFC;
margin-top:-50px;
background:#fcfdfd;
-webkit-box-shadow: 1px 1px 27px rgba(133, 133, 133, 0.9);
-moz-box-shadow: 1px 1px 27px rgba(133, 133, 133, 0.9);
-o-box-shadow: 1px 1px 27px rgba(133, 133, 133, 0.9);
box-shadow: 1px 1px 27px rgba(133, 133, 133, 0.9);
}
label{
width:25%;
display:inline-block;
font-family:"Palatino Linotype", "Book Antiqua", Palatino, serif;
margin-right: 15px;
color:#44494a;
}
.row{
padding:15px;
}
#login-form h2{
margin-top:40px;
margin-left:15px;
font-family: Impact, Charcoal, sans-serif;
font-weight: normal;
color:#6c7475;
text-align:center;
letter-spacing:3px
}
body{
background-color: #F0F0F0;
	background-image: url(<?php echo base_url(); ?>pics/hoffman.png);
	background-repeat:repeat;
}
#logo-pos{
margin:auto;
width: 206px;
}
input{
padding: 5px;
outline:none;
}
input[type="text"], input[type="password"]{
border: 1px solid #abdacf;
background:#fafcfc;
}

input[type="text"]:focus, input[type="password"]:focus{
border: 1px solid #82c1b2;
background:#edf9f6;
}
.last{
background: #E8EEEB;
border-top: 1px solid #D6E3DD;
}
.sbut{
padding: 6px;
width: 120px;
background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #d6edd5), color-stop(1, #b6d0b5) );
background: -moz-linear-gradient( center top, #d6edd5 5%, #b6d0b5 100% );
background: -o-linear-gradient( center top, #d6edd5 5%, #b6d0b5 100% );
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#d6edd5', endColorstr='#b6d0b5');
background: -ms-linear-gradient(top, #d6edd5 0%,#b6d0b5 100%); 
background: linear-gradient(to bottom, #d6edd5 0%,#b6d0b5 100%); 
background-color: #d6edd5;
border:1px solid #9bb99a;
font-weight:bold;
color:#465545;
}
.hovered, .sbut:hover{
background: -webkit-gradient( linear, left top, left bottom, color-stop(0.05, #e4f9e4), color-stop(1, #cae0c9) );
background: -moz-linear-gradient( center top, #e4f9e4 5%, #cae0c9 100% );
background: -o-linear-gradient( center top, #e4f9e4 5%, #cae0c9 100% );
filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e4f9e4', endColorstr='#cae0c9');
background: -ms-linear-gradient(top, #e4f9e4 0%,#cae0c9 100%); 
background: linear-gradient(to bottom, #e4f9e4 0%,#cae0c9 100%);
background-color: #e4f9e4;
border:1px solid #9bb99a;
}
.error{
text-align:center;
background:#f7e4c9;
font-weight:bold;
color:#7c1a0d;
}
</style>
</head>
<body>
<div id="logo-pos">
<img src="<?php echo base_url(); ?>pics/logo-admin.png" alt="bodhi2k13" width="206" height="238">
</div>
<div id="login-form">
<h2>Admin Login</h2>
<?php if($_POST) { echo '<p class="error">Trespassing is striclty prohibited <img src="http://icons.iconarchive.com/icons/deleket/scrap/256/Smiley-Angry-icon.png" alt="angry" style="width: 40px;vertical-align: middle;height:40px;"></p>';} ?> 
<?php echo form_open(base_url().uri_string(),array('id'=>'admin-login','name'=>'admin-login')); ?>
<div class="row"> 
<label for="username">Username</label><input type="text" name="username">
</div>

<div class="row"> 
<label for="password">Password</label><input type="text" name="password">
</div>

<div class="row last"> 
<label for="submit"></label><input type="submit" name="submit" value="Login" class="sbut">
</div>
</form>
</div>
<script>
$(document).ready(function(){
$("#admin-login").submit(function(){
$("input[type='submit']").attr("disabled",'disabled');
$("input[type='submit']").addClass("hovered");
$("input[type='submit']").attr("value",'Logging In..');
});
});
</script>
</body>
</html>