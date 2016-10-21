   <?php if(validation_errors()!=false){?>
    <div class="w3-container w3-red">
        <ul><?php	echo validation_errors('<li>', '</li>'); ?> </ul>
    </div>
    <?php }?>
<table width="100%" cellpadding="6" cellspacing="0">
<form name="frm_memlist" method="post" action="<?php echo base_url('member/display');?>">
<tr><td><select class="w3-select w3-border" name="school_id" required>
  <option value="" disabled selected>Choose your school</option>
  <?php
  // get school list from database
  	if(count($schools)>0)
	foreach($schools as $row)
	{?>
  	 <option value="<?php echo $row->school_id;?>" <?php echo  set_select('school_id', $row->school_id); ?>><?php echo $row->school_name;?></option>
	<?php }?>
    </select></td>
    <td><input type="submit" class="w3-btn w3-teal" value="Show members" />
    </td>
    </tr></form></table>
    <br>
<?php
if(!empty($school_id))
{
	$total_member=0;
	if(!empty($school_members))
		$total_member=count($school_members);
	if($total_member>0)
	{	
		echo $total_member .' Members found';
	?>
    
	<table class="w3-table w3-striped w3-border" width="100%">
	<thead>
	<tr class="w3-blue">
	  <th>Member Name</th>
	  <th>Member Email</th>
	  <th>Selected School</th>
	</tr>
	</thead>
	<?php 
	// display result records
	foreach($school_members as $row)
		{?>
	<tr>
	  <td><?php echo $row->name;?></td>
	  <td><?php echo $row->email;?></td>
	  <td><?php echo $row->school_name;?></td>
	</tr>
	<?php }?>
	</table>
	<br>
	<?php }
	else{?>
	<p class="w3-container w3-red">No members data found</p>	
	<?php }
}
else
{	
?><p class="w3-container w3-blue">Please select school to view members.</p>	
<?php } ?>