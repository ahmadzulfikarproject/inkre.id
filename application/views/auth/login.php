<div class="container">
  <div class="d-flex align-items-start h-100">
    <div class="card">
      <div class="card-header">
        <a class="logo" href="<?php echo base_url(); ?>"><img class="sr-header" width='100%' src='<?php echo home_url() . 'asset/settings/' . setting('site_logo'); ?>'></a>
        <h3><?php echo lang('login_heading'); ?></h3>
        <p><?php echo lang('login_subheading'); ?></p>
        <div id="infoMessage"><?php echo $message; ?></div>
        <div class="d-flex justify-content-end social_icon hidden">
          <span><i class="fab fa-facebook-square"></i></span>
          <span><i class="fab fa-google-plus-square"></i></span>
          <span><i class="fab fa-twitter-square"></i></span>
        </div>
      </div>
      <div class="card-body">
        <?php //echo form_open("auth/login");
        ?>
        <?php echo form_open_multipart('auth/login'); ?>
        <div class="input-group form-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-user"></i></span>
          </div>
          <?php echo form_input($identity); ?>
        </div>
        <div class="input-group form-group">
          <div class="input-group-prepend">
            <span class="input-group-text"><i class="fas fa-key"></i></span>
          </div>
          <?php echo form_input($password); ?>
        </div>
        <div class="row align-items-center remember">
          <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"'); ?><?php echo lang('login_remember_label', 'remember'); ?>
        </div>
        <div class="form-group">
          <?php echo form_submit($submit, lang('login_submit_btn')); ?>
        </div>
        <?php echo form_close(); ?>

      </div>
      <div class="card-footer">
        <div class="d-flex justify-content-center links hidden">
          Don't have an account?<a href="create_user">Sign Up</a>
        </div>
        <div class="d-flex justify-content-center">
          <a href="forgot_password"><?php echo lang('login_forgot_password'); ?></a>
        </div>
      </div>
    </div>
  </div>
</div>