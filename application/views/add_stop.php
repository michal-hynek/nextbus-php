
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'header.php' ?>
    <link href="<?php echo base_url(); ?>assets/css/add_busstop.css" rel="stylesheet">
  </head>

  <body>

    <?php include 'navbar_logged_in.php' ?>

    <div class="container-fluid">
      <div class="row">
        <h1 class="title">Add Bus Stop</h1>
      </div>

      <form class="search-form" action="<?php echo base_url(); ?>index.php/stops/find" method="post">
      <div class="row">
        <div class="span7 offset4"> 
          <input name="search_input" type="text" class="input-block-level" 
                 placeholder="Type in bus stop # or location" value="<?php echo set_value('search_input'); ?>">
        </div>

        <div class="span1">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </div><!--/row-->
      </form>

      <div class="row">

        <?php if(isset($errorMessage)): ?>
        <div class="span8 offset4 alert alert-error" />
          <?php echo $errorMessage; ?>
          <a href="#" class="close" data-dismiss="alert">&times;</a>
        </div>
        <?php endif; ?>

        <div class="span8 offset4 search-result">

          <?php if (isset($searchResult) && sizeof($searchResult) > 0): ?>
          <table class="table search-result-table">
            <th>Stop #</th>
            <th>Name</th>
            <th></th>

            <?php foreach ($searchResult as $stop): ?>
              <tr>
                <td><?php echo $stop->code; ?></td>
                <td><?php echo $stop->name; ?></td>
                <td class="rightCell"><a class="btn btn-primary">Add</a></td>
              </tr>
            <?php endforeach; ?>
          </table>
          <?php endif; ?>

        </div>
      </div>

      <hr>

      <footer>
        <p><center>&copy; Michal Hynek and Colin Buckton 2013<center></p>
      </footer>

    </div><!--/.fluid-container-->


    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-alert.js"></script>
  </body>
</html>