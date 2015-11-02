<?php
header ('Content-type: text/html; charset=utf-8');
include_once('./index.php');
if($_POST['edit']=='true')
{
$x="##{$_POST['title']}\r\n\r\n#description\r\n{$_POST['desc']}\r\n{$_POST['body']}";
file_put_contents($_POST['event'].'.txt',$x);
}
$dir=scandir ('../events/');
$f=array();
foreach($dir as $i=>$val)
{if($val!='.' && is_dir('../events/'.$val))
{$files=scandir ('../events/'.$val);
foreach($files as $x)
{if(preg_match('/\.txt$/',$x))$f[]="$val/$x";}
}}
//var_dump($f);
?>
<style type='text/css'>
textarea {width:80%;height:50%;}
input[type="text"] {
width: 80%;
font-weight: bold;
padding: 10px;
font-size: 20px;
}
</style>
<form>
select event<select name='event'><?php
foreach($f as $x)
echo "<option >".str_replace('.txt','',$x)."</option>";
?></select>
<button >Edit</button>
</form>
<?php

$tm=$_GET['event'];
$_GET['event']='../events/'.$_GET['event'];
if(file_exists($_GET['event'].'.txt')){
include('../events/fetch.php'); 
$_GET['event']=$tm;
echo "
<form method='post'>
<input type='hidden' name='edit' value='true'>
<input type='hidden' name='event' value='{$_GET['event']}'>
<input type='text' name='title' placeholder='title' value='".str_replace('<br>',PHP_EOL,$fetch['title'])."'><br>
description:<br>
<textarea name='desc' placeholder='description' style='height:100px'>".str_replace('<br>',PHP_EOL,$fetch['desc'])."</textarea><br>Body:<br>
<textarea name='body' placeholder='body' >";
//var_dump($fetch['data'] );
foreach($fetch['data'] as $w=>$q)
{echo PHP_EOL.'#'.$w.PHP_EOL.str_replace('<br>',PHP_EOL,$q).PHP_EOL;}}
?></textarea><br><button>Save</button>