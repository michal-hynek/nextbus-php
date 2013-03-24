
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'header.php'; ?>

    <link href="<?php echo base_url(); ?>assets/css/busstop.css" rel="stylesheet">
  </head>

  <body>

    <?php include 'navbar_logged_in.php'; ?>

    <div class="container-fluid">
      <a class="btn btn-primary pull-left add-stop">Add Bus Stop</a>
      <a class="btn btn-primary pull-right refresh">Update Now!</a>
      <p class="pull-right"><strong>Last update at 8:17pm</strong></p>
      <div class="row-fluid">
        <div class="span12">
          <div class="row-fluid">
            <div class="span6 nextbus-pod">        

              <?php $stopId = $stops[0];
                    include 'stop_table.php';?>
              
              </div><!--/span-->
              
              <?php if(!empty($stops[1])): ?>  

                <div class="span6 nextbus-pod">
                  
              <?php $stopId = $stops[1];
                    include 'stop_table.php';?>

              </div><!--/span-->
            
            <?php endif ?>

          </div><!--/row-->
        </div><!--/span-->
      </div><!--/row-->

      <div class="row-fluid">
        <div class="span12">
          <div class="row-fluid">

            <?php if(!empty($stops[2])): ?>  

              <div class="span6 nextbus-pod">
                
            <?php $stopId = $stops[2];
                  include 'stop_table.php';?>

              </div><!--/span-->
          
            <?php endif ?>

            <?php if(!empty($stops[3])): ?>  

              <div class="span6 nextbus-pod">
            
            <?php $stopId = $stops[3];
                  include 'stop_table.php';?>

              </div><!--/span-->

            <?php endif ?>
          
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
