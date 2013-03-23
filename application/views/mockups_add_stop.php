
<!DOCTYPE html>
<html lang="en">
  <head>
    <?php include 'header.php' ?>
    <link href="<?php echo base_url(); ?>assets/css/add_busstop.css" rel="stylesheet">
  </head>

  <body>

    <?php include 'navbar_logged_in.php' ?>

    <div class="container-fluid">
      <form class="search-form" method="post">
      <div class="row-fluid">
        <h1 class="title">Add Bus Stop</h1>
        <div class="span3 offset3">
          <input name="search_input" type="text" class="input-block-level" placeholder="Search" />
        </div>
        <div class="span1">
          <select>
            <option value="stop_num">Bus Stop #</option>
            <option value="location">Location</option>
          </select>
        </div>
        <div id="search-button-div" class="span1 offset1">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </div><!--/row-->
      </form>

      <div class="row-fluid">
        <div class="span6 offset3 search-result">
          <table class="table search-result-table">
            <th>Stop #</th>
            <th>Name</th>
            <th></th>

            <tr>
              <td>50001</td>
              <td>DAVIE ST @ BIDWELL ST (Westbound)</td>
              <td class="rightCell"><a class="btn btn-primary">Add</a></td>
            </tr>

            <tr>
              <td>50002</td>
              <td>BEACH AVE @ BURNABY ST (Eastbound)</td>
              <td class="rightCell"><a class="btn btn-primary">Add</a></td>
            </tr>

            <tr>
              <td>50003</td>
              <td>BEACH AVE @ CARDERO ST (Eastbound)</td>
              <td class="rightCell"><a class="btn btn-primary">Add</a></td>
            </tr>

          </table>
        </div>
      </div>

      <hr>

      <footer>
        <p><center>&copy; Michal Hynek and Colin Buckton 2013<center></p>
      </footer>

    </div><!--/.fluid-container-->


    <script src="<?php echo base_url(); ?>assets/js/jquery.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-dropdown.js"></script>
  </body>
</html>