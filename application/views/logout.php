<html>
	<head>
		<?php include 'header.php'; ?>

	    <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet" media="screen">
	    <link href="<?php echo base_url(); ?>assets/css/login_and_signup.css" rel="stylesheet" media="screen">
	    <link href="<?php echo base_url(); ?>assets/css/logout.css" rel="stylesheet" media="screen">
	</head>

	<body>
		<?php include 'navbar_not_logged_in.php'; ?>

		<div class="info">
			<h2><?php echo $email; ?> is now logged out.</h2>
			<p class="text-info"><?php echo anchor("/login/index", "Log in"); ?> again.</p>
		</div>
	</body>

</html>

