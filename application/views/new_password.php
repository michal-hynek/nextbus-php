<html>
	<head>
		<?php include 'header.php'; ?>

	    <link href="<?php echo base_url(); ?>assets/css/login_and_signup.css" rel="stylesheet" media="screen">
	    <link href="<?php echo base_url(); ?>assets/css/reset_password.css" rel="stylesheet" media="screen">
	    <link href="<?php echo base_url(); ?>assets/css/form.css" rel="stylesheet" media="screen">
	</head>

	<body>
		<?php include 'navbar_not_logged_in.php'; ?>
		
		<form class="login-form" method="post" action="new_password">
        	<h2 class="form-heading">Set new password</h2>

        	<input name="password" type="password" class="input-block-level" placeholder="New Password">
        	<?php echo form_error('password'); ?>
        	<input name="confirm_password" type="password" class="input-block-level" placeholder="Confirm New Password">

        	<button class="btn btn-large btn-primary" type="submit">Reset Password</button>
      </form>
	</body>

</html>