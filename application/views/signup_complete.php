<!DOCTYPE html>
<html>
  <head>
    <?php include 'header.php'; ?>

    <link href="<?php echo base_url(); ?>assets/css/login_and_signup.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/css/signup_complete.css" rel="stylesheet" media="screen">
  </head>

  <body>

    <?php include 'navbar_not_logged_in.php'; ?>

  	<div class="info">
		<h2>Thank you for registering</h2>
		<p class="text-info">An email has been sent to <?php echo $this->session->userdata('email'); ?></p>
		<p class="text-info">Please confirm your registration by clicking the link in your email. </p>
		<p class="text-info">Then you can <?php echo anchor('login', 'log in'); ?>. 
		   Alternatively, you can finish signing up <?php echo anchor($activationLink, 'now'); ?>.
		</p>
	</div>

  </body>

</html>