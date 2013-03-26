<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container-fluid">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <div class="brand">Next Bus</div>
      <div class="nav-collapse collapse">
        <a class="btn pull-right logout" href="<?php echo base_url(); ?>index.php/application/logout">Logout</a>
        <p class="navbar-text pull-right">
          Logged in as <strong><?php echo $this->session->userdata('email'); ?></strong>
        </p>
        <ul class="nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">My Stops<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="<?php echo base_url(); ?>index.php/userstops">Show All Bus Stops</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/userstops">Update Bus Stops</a></li>
              <li><a href="<?php echo base_url(); ?>index.php/stops">Add Bus Stop</a></li>
              <li class="divider"></li>
              <li class="nav-header">Show Individual Bus Stops</li>
                 <?php if(!empty($stops)): ?>
                  <?php foreach($stops as $stop): ?>
                    <li><a href="<?php echo base_url(); ?>index.php/userstops/show_stop/<?php echo $stop; ?>"><?php echo $stop_names[$stop]; ?></a></li>
                  <?php endforeach ?>
                 <?php endif ?>
            </ul>
          </li>
        </ul>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>