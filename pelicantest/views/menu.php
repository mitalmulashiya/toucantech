 <ul class="w3-navbar w3-black">
    <li><a  <?php if($title==$this->lang->line('add')){?>class="w3-light-grey"<?php } ?> href="<?php echo base_url('member/add/');?>">Add Member</a></li>
    <li><a <?php if($title==$this->lang->line('view')){?>class="w3-light-grey"<?php } ?> href="<?php echo base_url();?>">Members</a></li>
 </ul>
