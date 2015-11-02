<?php
include '../core/connect.php';
$r = mysql_query("SELECT * FROM contestants") or die (mysql_error()); 
$n = mysql_num_rows($r);
if($n==0)
{
echo "There are no users/teams in database !";
}
else
{
$number=0;
while ($arr = mysql_fetch_array($r))
{ 
$number++;
echo "
<p style=\"display:none;color: black;text-align:center;padding-top:15px;padding-bottom:15px;\" id=\"delete-".$arr['id']."\">
<img src=\"../stuff/spinner.gif\" width=\"16\" height=\"16\" />&nbsp;deleting user/team ....
</p>
<span id=\"user-".$arr['id']."\">
<br /><p style=\"border-top: 2px solid #DEE0E4;\"></p>
<span id=\"deletebutton-".$arr['id']."\" class=\"close\" title=\"click to delete this user/team\">X</span>
";
echo "<b>Team/User : ".$number."</b>&nbsp;";
echo "<ul style=\"list-style-type: none;text-align: left;margin-left:30%;\">";
echo '<li>Username/Team name :'.$arr['team_name'].'</li>';
echo '<li>password :'.$arr['password'].'</li>';
echo '<li>Team member 1 :'.$arr['member_1'].'</li>';
echo '<li>Team member 2 :'.$arr['member_2'].'</li>
<li>Contact number :'.$arr['contact'].'</li>
</ul>
<p style="border-top: 2px solid #DEE0E4;"></p>
</span>
';
?>
<script type="text/javascript">
$("#deletebutton-<?php echo $arr['id'];?>").click(function() {
$('#user-<?php echo $arr['id'];?>').slideUp("slow");
$('#delete-<?php echo $arr['id'];?>').slideDown("slow");
var dataString = 'id=';
$.ajax({
    type: "POST",
    url: "delete_user.php?i=<?php echo $arr['id'];?>",
    data: dataString,
    success: function() {
$('#delete-<?php echo $arr['id'];?>').fadeOut("slow");
}
  });
});
</script>
<?php
}
}
?>