<html>
	<head>
		<?php include 'header.php'; ?>

	    <link href="<?php echo base_url(); ?>assets/css/login_and_signup.css" rel="stylesheet" media="screen">
	    <link href="<?php echo base_url(); ?>assets/css/form.css" rel="stylesheet" media="screen">
	</head>


	<body>
		<?php include 'navbar_not_logged_in.php'; ?>

		<form class="reset-password-form" method="post" action="reset_password">
			<h2 class="form-heading">Reset Your Password</h2>	
			<p class="text-info">Type your email address in the text box below. A new password will be sent to your email address.</p>
			<input name="email" type="text" class="input-block-level" placeholder="Email address" 
        	       value="<?php echo $this->session->userdata('email'); ?>" />

        	<?php if (isset($resetError)): ?>
        		<p class="text-error"><?php echo $resetError; ?></p>
        	<?php endif; ?>
    		<button class="btn btn-large btn-primary" type="submit">Email New Password</button>
		</form>

	</body>

</html>