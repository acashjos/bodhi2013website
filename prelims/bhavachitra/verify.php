<?php
session_start();
include 'core/connect.php';
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}
?>
<html>
<head>
<title>Verifying</title>
</head>
<body>
Verifying username , password | Please wait ..........  
</body>
</html>
<?php
$us=$data['username'];
$pas=$data['password'];

if($us==ADMIN_US AND $pas==ADMIN_PAS)
{
echo "
<script type=\"text/javascript\">
window.location=\"admin/main.php\";
</script>
";
$_SESSION['admin']=1;
}
else
{
$r = mysql_query("SELECT id,member_1,member_2,finish FROM contestants where team_name='$us' AND password='$pas' ") or die (mysql_error()); 
$n = mysql_num_rows($r);
if($n==0)
{
echo "
<script type=\"text/javascript\">
window.location=\"index.php?er=1\";
</script>
"; 
}
else
{
list($id,$m1,$m2,$fin)=mysql_fetch_row($r);
$_SESSION['id']=$id;
$_SESSION['member_1']=$m1;
$_SESSION['member_2']=$m2;
$_SESSION['finish']=$fin;
echo "
<script type=\"text/javascript\">
window.location=\"rules.php\";
</script>
"; 
}}
?>