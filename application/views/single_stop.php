
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'header.php'; ?>

    <link href="<?php echo base_url(); ?>assets/css/busstop.css" rel="stylesheet">
  </head>

  <body>

    <?php include 'navbar_logged_in.php'; ?>

    <div class="container-fluid">
      <a class="btn btn-primary pull-right refresh" href="<?php echo base_url(); ?>index.php/userstops/show_stop/<?php echo $single_stop; ?>">Update Now!</a>
      <p class="pull-right"><strong>Last update at <?php echo date("g:ia");?></strong></p>
      <div class="row-fluid">
        <div class="span12">
          <div class="row-fluid">            
              <div class="span8 offset2 nextbus-pod">
               
                <?php $stopCode = $single_stop; 
                      include 'stop_table.php';?>

              </div><!--/span-->
            </div><!--/row-->
          </div><!--/span-->
        </div><!--/row-->

      <hr>

      <footer>
        <p><center>&copy; Michal Hynek and Colin Buckton 2013<center></p>
      </footer>

    </div><!--/.fluid-container-->


    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
  </body>
</html>
