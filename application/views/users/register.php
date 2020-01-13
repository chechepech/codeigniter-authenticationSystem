<div class="container">
  <?php echo validation_errors(); ?>
  <?php echo form_open('register/index', 'role="form" class="form-signin"'); ?>        
    <h2 class="form-signin-heading text-center"><?php echo $this->lang->line('register_page_title'); ?></h2>
  <div class="form-group">
    <input type="text" class="form-control" name="usr_fname" placeholder="<?php echo $this->lang->line('register_first_name'); ?>" autofocus required>
	</div>
  <div class="form-group">
    <input type="text" class="form-control" name="usr_lname" placeholder="<?php echo $this->lang->line('register_last_name'); ?>" required>
	</div>
  <div class="form-group">
    <input type="email" class="form-control" name="usr_email" placeholder="<?php echo $this->lang->line('register_email'); ?>" required>
	</div>
  <div class="form-group">
    <?php echo form_submit('submit', 'GO', 'class="btn btn-lg btn-default btn-block"'); ?>
  </div>
    <?php echo anchor('signin',$this->lang->line('top_nav_signin'),array('class' => 'text-center')); ?>
   <?php echo form_close(); ?>
</div>