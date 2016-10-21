<?php	if(!empty($success)){?>
    <div class="w3-container w3-blue">
        <?php echo $success;?>
    </div>
    <?php }?>
    <?php if(validation_errors()!=false){?>
    <div class="w3-container w3-red">
        <ul><?php	echo validation_errors('<li>', '</li>'); ?> </ul>
    </div>
    <?php }?>

<table cellpadding="6" cellspacing="0" width="100%">
<form name="frm1" method="post" action="<?php echo base_url('member/add');?>">
<tr> <td width="36%">Name: </td>
<td width="64%"><input type="text"  name="mname" id="mname" required  value="<?php echo set_value("mname");?>"/></td>
</tr>
<tr> <td>Email: </td>
<td>  <input type="email" name="memail" id="memail" required value="<?php echo set_value("memail");?>"></td>
</tr>
<tr> <td>Select One or more School: </td>
<td><select multiple="multiple" name="mschool[]" required>
<?php
 if(count($schools)>0)
	foreach($schools as $row)
	{?>
    <option value="<?php echo $row->school_id;?>" <?php echo set_select('school_id', $row->school_id);?>><?php echo $row->school_name;?></option>
	<?php }
?>
</select><br />
<span class="w3-small">Press Ctrl key to select multiple school</span>
</td></tr>
<tr>
<td align="center" colspan="2">
<input type="submit" class="w3-btn w3-teal" value="Add member">
</td></tr>
</form>
</table>
