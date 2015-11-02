<style>
h1{
color: #9a9151;
background: #f2f0df;
border: 1px solid #e5e2cd;
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

.tab.active a{
color: #757E3B;
font-weight: bold;
}

.tab a:hover{
cursor:pointer;
}
.tab a {
font-size: 1.1em;
color: #716c6c;
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

.tab-container .panel-container div span{
display: inline-block;
width: 250px;
}
.tab-container .panel-container div span label{
width: auto;
}
.tab-container .panel-container {
vertical-align: top;
display: inline-block;
min-height: 100px;
padding: 0 10px;
}

.panel-container div{
width: 120%;
}

.hide{
display:none;
}
</style>
<div id="page">

<h1 class="heading">Stop registration for events</h1>
<?php echo form_open(base_url().uri_string(),array('id'=>'stop-event','name'=>'stop-event', 'class'=>'style-form')); ?>
<p><i>You can stop an event registration here. By doing so, the event would no longer be listed in the create registration and edit registration forms.</i></p>
<?php if($done) { ?>
<div class="done-msg">
Registration for selected events have been stopped.
</div>
<?php } ?>


<?php if($error !="") { ?>
<div class="error-msg">
<?php echo $error; ?>
</div>
<?php } ?>

<h3>Events @ Bodhi2k13</h3>
<?php  
$tab_heads = array();
$tab_bodies = array();
$i=0;
$peve = ($this->input->post('events')!== false) ?  $this->input->post('events') : array(); 
foreach($egroups as $k => $v)
{
$tab_heads[] = $v["name"];
$tab_bodies[$i] = "";
$closed_events[$i] = array();
foreach($v["events"] as $k => $v)
{
$ch = false;
if(($_POST && is_int(array_search((string)$v->event_id, $peve)) ) || ($v->stopped==1 && !$_POST))
{
$ch = true;
} 
$data = array(
    'name'        => "events[]",
    'id'          => $v->event_name,
    'value'       => $v->event_id,
    'checked'     => $ch
    );
$tab_bodies[$i] .= '<span>'. form_checkbox($data).form_label($v->event_name, $v->event_name).'</span>';
}
$i++;
}  ?>
<script>/*
$(document).ready(function(){
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
});*/
</script>


<div id="tab-container" class="tab-container">

  <div class="panel-container">
   <?php for($i=0; $i<count($tab_bodies); $i++) { ?>
  <div id="tabc<?php echo $i; ?>" class="<?php //if($i!=0) echo 'hide';?>">
  <h4><?php echo $tab_heads[$i]; ?></h4>
  <?php echo $tab_bodies[$i];?>
  </div>
  <?php } ?>
  
  </div>
</div>

<hr>


<div>
	<label for="pass">Master password</label><input type="password" name="pass">
</div>

<div class="last" style="margin-top: 0;"> 
<label></label><input type="submit" name="submit" class="button" id="sub-but" value="Stop">
</div>	


</form>
</div>