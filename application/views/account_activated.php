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
		<h2>Account has been activated</h2>
		<p class="text-info">Thank you for confirming your registration for <?php echo $this->session->userdata('email'); ?></p>
		<p class="text-info">You may now <?php echo anchor('login', 'log in'); ?>.</p>
	</div>

  </body>

</html>