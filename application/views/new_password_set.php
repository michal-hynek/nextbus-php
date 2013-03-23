<html>
	<head>
		<?php include 'header.php'; ?>

	    <link href="<?php echo base_url(); ?>assets/css/login_and_signup.css" rel="stylesheet" media="screen">
	    <link href="<?php echo base_url(); ?>assets/css/reset_password.css" rel="stylesheet" media="screen">
	</head>

	<body>
		<?php include 'navbar_not_logged_in.php'; ?>
		
		<div class="info">
			<h2>Your password has been set</h2>
			<p class="text-info">Please use your new password from now on.</p>
			<p class="text-info">You can now <?php echo anchor('login', 'log in'); ?> using the new password.</p>
		</div>
	</body>

</html>