					 <style>
					 table, .con {
    border-collapse: collapse;
    border: dashed rgb(128, 128, 128) 1px;
    padding: 10px;
}
th {
    border: solid #ccc 1px;
    border-bottom: solid gray 2px;
    padding: 5px;
}
td {
    text-align: center;
    border: dashed gray 1px;
    border-style: solid;
    padding: 5px;
}
h1{
color: #327994;
background: #dfecf2;
border: 1px solid #d2e8ec;
}
th{
background:#cecfcf;
bordeR:1px solid #99a2a3;
}
ul {
    list-style: none;
    font-family: arial,sans-serif;
    color: rgb(97, 97, 18);
}
#allevent td {
    width: 50%;
    background: rgb(90, 138, 240) !important;
}
#allevent {
    margin-top: 0px;
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
	border: none;
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
</style>
<div id="page">
<h1 class="heading">Overview</h1>
<table>
<tr class='titlebar'><td id='all' rowspan='6'><h1>Total confirmed Registrations</h1><div><?php echo $total[0]["num"];?></div></td>
<td><h3>Recently added<h3></td><td><h3>Trending Events</h3></td><td><h3>Top External </h3></td></tr>
<?php 
$trend = array(); foreach($recently as $k => $v) { $trend[] = "<td>".$v["event"]."<br><sub>".$v["num"]."</sub></td>"; } 

$trend_eve = array();
foreach($top_eve as $k => $v) { $trend_eve[] = "<td>".$v["event"]."<br><sub>".$v["num"]."</sub></td>"; } 

$top_ext = array();
foreach($top_external as $k => $v) { $top_ext[] = "<td>".$v["event"]."<br><sub>".$v["num"]."</sub></td>"; } 

for($i=0;$i<5;$i++) { 
?>
<tr><?php if(isset($trend[$i])) { echo $trend[$i]; } else { echo '<td></td>';}?> <?php if(isset($trend_eve[$i])) { echo $trend_eve[$i]; } else { echo '<td></td>';}?> <?php  if(isset($top_ext[$i])) {  echo $top_ext[$i]; } else { echo '<td></td>';}?></tr>
<?php } ?>
</table>

<?php if(count($stopped) > 0) { ?>
<ul><li><h3>Registration stopped</h3></li>
<?php for($i=0;$i<count($stopped); $i++) { 
echo "<li> {$stopped[$i]["event"]}</li>";}

}
?>
<table id='allevent'> 
<h3 class="con">Confirmed registrations for all events</h3>
<?php
foreach($whole as $k => $v) 
{ echo "<tr><td>{$v["event"]}</td><td>{$v["num"]}</td></tr>";}
?>
</table>
<!--
<iframe src="http://www.bodhiofficial.in/admintmp/stats.php" style="width:100%; border:0;min-height: 2270px;"></iframe> -->
</div>