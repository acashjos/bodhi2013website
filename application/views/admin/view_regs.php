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
</style>
<div id="page">
<h1 class="heading">View Registrations</h1>
<?php if(count($regs) == 0) { ?>
<p>I guess Bodhi2k13 sucks <img src="https://fbcdn-dragon-a.akamaihd.net/hphotos-ak-prn1/p50x50/851575_126362190881911_254357215_n.png" alt=":-P">, No one has registered yet!</p>
<?php } else { echo $pages; ?>
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
<td><?php if($v['confirm']==0) { echo '<span class="unc">Unconfirmed</span>'; } else { echo '<span class="con">Confirmed & paid registration fee</span>';} ?></td>
<td><a href="<?php echo base_url(); ?>admin/delete-reg/<?php echo $v["user_id"]; ?>">Delete</a> <br>
<a href="<?php echo base_url(); ?>admin/edit-reg/<?php echo $v["user_id"]; ?>">Edit</a> 
</td>
</tr>
<?php } ?>

</table>
<?php echo $pages; } ?>
</div>