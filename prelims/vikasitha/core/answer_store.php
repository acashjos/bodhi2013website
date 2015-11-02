<?php
include 'connect.php';

foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
$m2=$data['question'];
$m1=$data['option'];
$us=$data['user'];

if(!empty($m1) AND !empty($m2) AND !empty($us))
{
$sql_insert = "INSERT into `answers`
  			(`option_id`,`question_id`,`contestant_id`
			)
		    VALUES
		    ('$m1','$m2','$us'
			)
			";
			
mysql_query($sql_insert,$link) or die("Insertion Failed:" . mysql_error());
}
?>

