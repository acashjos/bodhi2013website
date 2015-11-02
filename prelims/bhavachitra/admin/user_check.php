<?php
include '../core/connect.php';
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
$us=$data['username'];
$p=$data['password'];
$con=$data['contact'];
$result = mysql_query("SELECT `id` FROM contestants WHERE 
            team_name='$us' ") or die (mysql_error()); 
$num = mysql_num_rows($result);
if ( $num > 0 ) { 
echo "
<script type=\"text/javascript\">
window.location=\"create_user.php?er=1\";
</script>
"; 
}
else if(!empty($data['mem1']) AND !empty($data['mem2']) AND !empty($data['username']) AND !empty($data['password']))
{
$m1=$data['mem1'];
$m2=$data['mem2'];
$sql_insert = "INSERT into `contestants`
  			(`member_1`,`member_2`,`team_name`,`password`,`contact`
			)
		    VALUES
		    ('$m1','$m2','$us','$p','$con'
			)
			";
			
mysql_query($sql_insert,$link) or die("Insertion Failed:" . mysql_error());
echo "
<script type=\"text/javascript\">
window.location=\"create_user.php?er=2\";
</script>
"; 
}
else
{
echo "
<script type=\"text/javascript\">
window.location=\"create_user.php?er=3\";
</script>
"; 
}
?>