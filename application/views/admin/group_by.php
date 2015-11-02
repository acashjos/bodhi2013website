<div id="page">
<?php if($id==0) { ?>
<style>
#eventsc{
text-align:center;
margin-top:10%;
}
select{
padding:5px;
outline:none;
}
</style>
<div id="eventsc">
<p><i>You can view the registrations grouped by events here. Select an event from the dropdown below and you would automatically be redirected to a page containing table of registrations for that.</i></p>
<select name="events" id="events">
<option value="0">--- select event---</option>
<?php foreach($events as $k=>$v) {?>
<option value="<?php echo $k; ?>"><?php echo $v["event_name"]; ?>(<?php $t = (int)$v['group_id']; echo $groups[$t]; ?>)</option>
<?php } ?>
</select>
</div>
<div style="display:none;font-weight:bold;text-align:center;margin-top: 40px;" id="fetching">Fetching registrations for the event...</div>
<script>
$("#events").change(function(){
$("#fetching").show();
window.location='<?php echo base_url(); ?>admin/group-by/'+$(this).val();
});
</script>
<?php } else { ?>
<style>
table{
width:100%;
}
th, td{
padding: 5px;
background:white;
}
th {
background: grey;
color: #f5f0f0;
}
.id{
background:#FFD700;
color:black;
width: 60px;
}
h1{
color: #822175;
background: #f5e8f3;
border: 1px solid #ECD2E9;
}
h1{
color: #822175;
background: #f5e8f3;
border: 1px solid #ECD2E9;
}
</style>
<h1 class="heading">View Registrations for <?php echo $events[$id]["event_name"];?>(<?php echo $groups[$events[$id]["group_id"]];?>)</h1><br>
<?php echo $pages; if(count($regs) > 0){ ?>
<table border="1">
<tr>
<th>#</th> <th class="id">Bodhi id</th> <th>Name</th> <th>College</th> <th>Department</th> <th>Email</th> <th>Number</th> <th>Registered on</th> <th>Registered for Events</th>
<th>Confirmed Registration</th>
<th>Action</th>
</tr>

<?php $s = $current_page; foreach($regs as $k => $v) { ?>
<tr>
<td><?php echo $s; $s++; ?></td>
<td class="id"><?php echo $v["username"]; ?></td>
<td><?php echo $v["name"]; ?></td>
<td><?php echo $v["college"]; ?></td>
<td style="width:10px;"><?php echo $v["dept"]; ?></td>
<td><?php echo $v["email"]; ?></td>
<td><?php echo $v["cno"]; ?></td>
<td><?php 
//$v["user_regdate"] = local_to_gmt($v["user_regdate"]);
echo date('d-m-Y h:i A', $v["user_regdate"]); ?></td>
<td>
<?php if(count($v["reg_for_events"])==0) { ?>
<p>No event reg!</p>
<?php } foreach($v["reg_for_events"] as $k1 => $v1) { ?>
<span><?php echo $events[$v1["event"]]["event_name"]; ?>(<?php echo $groups[$events[$v1["event"]]["group_id"]]; ?>)</span>,
<?php } ?>
</td>
<td><?php if($v['confirm']==0) { echo '<span class="unc">Unconfirmed</span>'; } else { echo '<span class="con">Confirmed & payed registration fee</span>';} ?></td>
<td><a href="<?php echo base_url(); ?>admin/delete-reg/<?php echo $v["user_id"]; ?>">Delete</a> <br>
<a href="<?php echo base_url(); ?>admin/edit-reg/<?php echo $v["user_id"]; ?>">Edit</a> 
</td>
</tr>
<?php } ?>
</table>
<?php echo $pages; } else { ?>
<b style="display: block;text-align: center;">There are no confirmed registrations for this event as of now.</b>
<?php } } ?>
</div>