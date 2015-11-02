<div id="page">
<style>
h3{
color: #21827c;
background: #e8f5f4;
border: 1px solid #d2ecec;
}
form label{
width: 15%;
}
</style>
<h3 class="heading">Search by Bodhi id</h3>
<?php echo form_open(base_url().uri_string(),array('id'=>'search','name'=>'search')); ?>
<div>
	<label for="username">Bodhi id</label><input type="text" name="username" value="bodhi">
	<input type="hidden" name="factor" value="username">
<input type="submit" name="submit" class="button" id="sub-but" value="Search">
</div>
</form>

<h3 class="heading" style="margin-top:30px;">Search by Email</h3>
<?php echo form_open(base_url().uri_string(),array('id'=>'search','name'=>'search')); ?>
<div>
	<label for="email">Email</label><input type="text" name="email" value="<?php echo $this->input->post('email'); ?>">
	<input type="hidden" name="factor" value="email">
	<input type="submit" name="submit" class="button" id="sub-but" value="Search">

</div>
</form>

<h3 class="heading" style="margin-top:40px;">Search by Phone number</h3>
<?php echo form_open(base_url().uri_string(),array('id'=>'search','name'=>'search')); ?>
<div>
	<label for="phone">Phone</label><input type="text" name="cno" value="<?php echo $this->input->post('cno'); ?>">
<input type="hidden" name="factor" value="cno">
<input type="submit" name="submit" class="button" id="sub-but" value="Search">

	</div>
</form>

</form>

</div>