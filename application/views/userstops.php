
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php 
      include 'header.php'; ?>

    <link href="<?php echo base_url(); ?>assets/css/busstop.css" rel="stylesheet">
    <style>
      .error {
        text-indent: 175px;
      }
    </style>

  </head>

  <body>

    <?php include 'navbar_logged_in.php'; ?>

    <div class="container-fluid">
      <a class="btn btn-primary pull-left add-stop" href="<?php echo base_url(); ?>index.php/stops">Add Bus Stop</a>
      <a class="btn btn-primary pull-right refresh" href="<?php echo base_url(); ?>index.php/userstops">Update Now!</a>
      <p class="pull-right"><strong>Last update at <?php date_default_timezone_set('America/Vancouver'); echo date("g:ia");?></strong></p>

      <?php if( !empty($stops) ): ?>
        <?php $newRow = TRUE; // tracks whether at start or end of div row.  TRUE == start
              $element = 0; // tracks which element of the $stops array we are at
              $lastElement = sizeof($stops) - 1; // the last element number
        foreach( $stops as $stop => $stopCode ): ?>

          <?php if( $newRow == TRUE ): ?>
            <div class="row-fluid">
              <div class="span12">
                <div class="row-fluid">
          <?php endif ?>     

            <div class="span6 nextbus-pod">        
              <?php include 'stop_table.php';?>
            </div><!--/span-->
       
          <?php if( $newRow == FALSE || $element == $lastElement): ?>
            </div><!--/row-->
              </div><!--/span-->
                </div><!--/row-->
          <?php endif ?>   

          <?php $newRow = !$newRow;
                $element++; ?>
        
        <?php endforeach ?>

      <?php else: 
          echo '<h3 class="text-center text-error strong error">' . $errorMessage . '</h3>';
            endif ?>

      <hr>

      <footer>
        <p><center>&copy; Michal Hynek and Colin Buckton 2013<center></p>
      </footer>

    </div><!--/.fluid-container-->

    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-modal.js"></script>
  </body>
</html>
