<!DOCTYPE html>
<html>
  <head>
    <?php include 'header.php' ?>

    <link href="<?php echo base_url(); ?>assets/css/login_and_signup.css" rel="stylesheet" media="screen">
    <link href="<?php echo base_url(); ?>assets/css/form.css" rel="stylesheet" media="screen">
  </head>

  <body>
    <?php include 'navbar_not_logged_in.php' ?>

    <div class="container">

      <form class="login-form" method="post" action="login">
        <h2 class="form-heading">Log in</h2>
        <input name="email" type="text" class="input-block-level" placeholder="Email address" 
               value="<?php echo $this->session->userdata('email'); ?>" />
        <input name="password" type="password" class="input-block-level" placeholder="Password">

        <div id="forgot-password">
          <?php echo anchor('password/forgot_password', 'Forgot Password?'); ?><br/>
        </div>

        <?php if (isset($loginError)): ?>
          <p class="text-error"><?php echo $loginError; ?></p>
        <?php endif; ?>

        <button class="btn btn-large btn-primary" type="submit">Log in</button>
        <?php echo anchor('signup', 'Sign up', 'id="signup"'); ?><br/>
      </form>


    </div>

  </body>

</html>