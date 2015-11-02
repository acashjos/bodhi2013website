<?php
include '../core/connect.php';
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}

$ques=$_POST['question'];
$ans=$_POST['answer'];

$str_from = array('<', '>','"',"'");
$str_to = array('&lt;', '&gt;','&quot;','&#39;');
$ques = str_replace($str_from, $str_to, $ques);


$str_from = array('<', '>','"',"'");
$str_to = array('&lt;', '&gt;','&quot;','&#39;');
$ans = str_replace($str_from, $str_to, $ans);


$mark=$_POST['mark'];
$nmark=$_POST['nmark'];

if(!is_numeric($mark) OR empty($mark) OR !isset($mark))
{
$mark=1;
}
if(!is_numeric($nmark) OR empty($nmark) OR !isset($nmark))
{
$nmark=0;
}

$anst=explode("\n",$_POST['options']);
$l=count($anst);


$sql_insert = "INSERT into `questions`
  			(`text`,`mark`,`n_mark`
			)
		    VALUES
		    ('$ques','$mark','$nmark'
			)
			";
		mysql_query($sql_insert,$link) or die("Insertion Failed:" . mysql_error());

$r = mysql_query("SELECT max(id) FROM questions") or die (mysql_error()); 
list($max)=mysql_fetch_row($r);
$y=1;

for($i=0;$i<$l;$i++)
{

$tr=$anst[$i];

$str_from = array('<', '>','"',"'");
$str_to = array('&lt;', '&gt;','&quot;','&#39;');
$tr = str_replace($str_from, $str_to, $tr);




if(!empty($tr))
{
$sql_insert = "INSERT into `options`
  			(`option_id`,`question_id`,`option_text`
			)
		    VALUES
		    ('$y','$max','$tr'
			)
			";
			
mysql_query($sql_insert,$link) or die("Insertion Failed:" . mysql_error());
$y++;
}
}

$rdf = mysql_query("SELECT option_id FROM options WHERE option_text='$ans' AND question_id='$max'") or die (mysql_error()); 
list($maxt)=mysql_fetch_row($rdf);
mysql_query("update questions set `answer`='$maxt' where id='$max'") or die (mysql_error()); 
?>