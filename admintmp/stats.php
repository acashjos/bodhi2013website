<?php


//include_once('./index.php');
$host = 'localhost';
$user = 'bodhi_user2k13';
$pw = 'HIcM{7X6n^7S';
$db = 'bodhi_AAA2k13';
  $link = mysql_connect( $host  , $user, $pw ) ;
         if (!$link)
                 {     
                   die('<br/><br/>Could not connect to the database.');
                   exit;        
                 }
         mysql_select_db( $db , $link ) ;
		 //select events.event_name as event,count(`event_regs`.reg_id) as num from `event_regs`,`events` ,`online_regs`  where `event_regs`.event=events.event_id  and `event_regs`.reg_id=`online_regs`.user_id and `online_regs`.confirm=1 group by `event_regs`.event order by num desc
       $q="select events.event_name as event,count(`event_regs`.reg_id) as num from `event_regs`,`events`,`online_regs`  where `event_regs`.user_id=`online_regs`.user_id and `online_regs`.confirm=1 and `event_regs`.event=events.event_id group by `event_regs`.event order by num desc";

 $query = "(select 0,count(user_id) as num from `online_regs` where confirm=1) 
 union ($q limit 0,5 ) 
 union (SELECT name as event,college as num FROM `online_regs` where confirm=1 order by user_id desc limit 0,5)
 union (select college as event , count(*) as num from `online_regs` where LOWER(college) not like '%viswajyothi%' and confirm=1 group by college order by num desc limit 0,5)
 union (select event_name as event , stopped as num from `events` where stopped=1 )";
     
	 $result2 = mysql_query($query);   
$e=array();
while($a= mysql_fetch_row($result2))
{$e[]=$a;}
//var_dump($e);
				$x=6;$y=1;$z=11; ?>

<style type='text/css'>
#allevent td {
    width: 50%;
    background: rgb(90, 138, 240) !important;
}
#allevent {
    margin-top: 10px;
    width: 100%;
    border-radius: 30px 0 0 0;
    overflow: hidden;
}
#all> div {font-size:15em;}
#all {
    background: #09f;
    color: white;
    border-radius: 0 0 20px 20px;
    border: none;
}
#all {}
.titlebar td {
    font-family: verdana,sans-serif;
    text-align: center;
    border: none;
    background: rgb(0, 145, 197);
    color: wheat;
}
table {
    border-collapse: collapse;
    background: rgb(89, 110, 138);
    border-radius: 0 0 0 20px;
}
td {
text-align: center;
height: 50px;
width: 25%;
border-bottom: dashed rgb(128, 128, 128) 1px;
    font-style: italic;
    background: rgb(89, 110, 138);
    font-family: sans-serif;
    color: rgb(255, 255, 255);
}
ul {
    list-style: none;
    font-family: arial,sans-serif;
    color: rgb(97, 97, 18);
}
</style>


<table>
<tr class='titlebar'><td id='all' rowspan='6'><h1>Total confirmed Registrations</h1><div><?php echo $e[0][1];?></div></td>
<td><h3>Recently added<h3></td><td><h3>Trending Events</h3></td><td><h3>Top External </h3></td></tr>
<tr><td><?php echo $e[$x][0].'<br><sub>'.$e[$x++][1].'</sub>';?></td><td><?php echo $e[$y][0].'<br><sub>'.$e[$y++][1].'</sub>';?></td><td><?php echo $e[$z][0].'<br><sub>'.$e[$z++][1].'</sub>';?></td></tr>
<tr><td><?php echo $e[$x][0].'<br><sub>'.$e[$x++][1].'</sub>';?></td><td><?php echo $e[$y][0].'<br><sub>'.$e[$y++][1].'</sub>';?></td><td><?php echo $e[$z][0].'<br><sub>'.$e[$z++][1].'</sub>';?></td></tr>
<tr><td><?php echo $e[$x][0].'<br><sub>'.$e[$x++][1].'</sub>';?></td><td><?php echo $e[$y][0].'<br><sub>'.$e[$y++][1].'</sub>';?></td><td><?php echo $e[$z][0].'<br><sub>'.$e[$z++][1].'</sub>';?></td></tr>
<tr><td><?php echo $e[$x][0].'<br><sub>'.$e[$x++][1].'</sub>';?></td><td><?php echo $e[$y][0].'<br><sub>'.$e[$y++][1].'</sub>';?></td><td><?php echo $e[$z][0].'<br><sub>'.$e[$z++][1].'</sub>';?></td></tr>
<tr><td><?php echo $e[$x][0].'<br><sub>'.$e[$x++][1].'</sub>';?></td><td><?php echo $e[$y][0].'<br><sub>'.$e[$y++][1].'</sub>';?></td><td><?php echo $e[$z][0].'<br><sub>'.$e[$z++][1].'</sub>';?></td></tr>
<!--2nd row -->
</table><?php
if($e[$z]){?>
<ul><li><h3>Registration stopped for:</h3></li>
<?

while($e[$z])
{echo "<li> {$e[$z++][0]}</li>";}
echo '</ul>'; }
$result2 = mysql_query($q);   
$e=array();
echo "<table id='allevent'>";
while($a= mysql_fetch_row($result2))
{echo "<tr><td>{$a[0]}</td><td>$a[1]</td></tr>";}
?>
</table>