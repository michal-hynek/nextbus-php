<!DOCTYPE html>
<html>
  <head>
    <?php include 'header.php' ?>

    <link href="<?php echo base_url(); ?>assets/css/form.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/css/login_and_signup.css" rel="stylesheet" media="screen">
  </head>

  <body>
    <?php include 'navbar_not_logged_in.php' ?>
    
  	<div class="container">

      <form class="form" method="post" action="signup">
        <h2 class="form-heading">Sign up</h2>

        <input name="email" type="text" class="input-block-level" placeholder="Email address" 
               value="<?php echo set_value('email'); ?>" />
        <?php echo form_error('email'); ?>

        <input name="password" type="password" class="input-block-level" placeholder="Password" />
        <?php echo form_error('password'); ?>
        <input name="confirm_password" type="password" class="input-block-level" placeholder="Confirm Password" />

        <input name="captcha_input" type="text" class="input-block-level" placeholder="Type the code on the picture" />
        <?php echo form_error('captcha_input'); ?>
        <div class="captcha">
          <?php echo $captcha; ?><br/>
          <?php echo anchor('signup/new_code', 'Generate New Code'); ?>
        </div>

        <input name="captcha_id" type="hidden" value="<?php echo $captcha_id; ?>" />

        <button class="btn btn-large btn-primary" type="submit">Create Account</button>
      </form>

    </div>

  </body>

</html>