
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

      <form id="search_form" class="search-form" action="<?php echo base_url(); ?>index.php/stops/find" method="post">
      <div class="row">
        <div class="span7 offset4"> 
          <input id="search_input" name="search_input" type="text" class="input-block-level" 
                 data-provide="typeahead"
                 autocomplete="off" placeholder="Type in bus stop # or location"
                 value="<?php echo set_value('search_input'); ?>">
        </div>

        <div class="span1">
          <button class="btn btn-primary" type="submit">Search</button>
        </div>
      </div><!--/row-->
      </form>

      <div id="message-row" class="row">
      </div>

      <div class="row">
        <div class="span12 offset2 search-result">

          <?php if (isset($searchResult) && sizeof($searchResult) > 0): ?>
          <table class="table search-result-table">
            <th>Stop #</th>
            <th>Name</th>
            <th>Description</th>
            <?php if(isset($searchResult[0]->distance)): ?>
            <th>Distance</th>
            <?php endif; ?>
            <th></th>

            <?php foreach ($searchResult as $stop): ?>
              <tr>
                <td><?php echo $stop->code; ?></td>
                <td><?php echo $stop->name; ?></td>
                <td><?php echo $stop->description; ?></td>
                <?php if(isset($stop->distance)): ?>
                <td><?php echo round($stop->distance, 2) . " km"; ?></td>
                <?php endif; ?>
                <td class="rightCell">
                  <a id="<?php echo $stop->code; ?>" class="btn btn-primary add_stop_button"
                    href="#">
                    Add
                  </a>
                </td>
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
    <script src="<?php echo base_url(); ?>assets/js/bootstrap-typeahead.js"></script>

    <script>
      $(function() {
        $('#search_input').typeahead({
          source: function (query, process) {
            $.ajax ({
              url:      '<?php echo base_url(); ?>index.php/stops/find_autocomplete',
              type:     'POST',
              data:     'search_input=' + query,
              dataType: 'JSON',
              async:    true,
              success: function(data) {
                process(data);
              }
            });
          }
        });

      // dispatch search when the user selects an item from autocomplete menu
      var onSelect = function(event) {
        $('#search_form').submit();
      }
      $('#search_input').on('change', onSelect);

      // add bus stop on 'add' button click
      var showErrorMessage = function(message) {
        $("#message-row").html(
          '<div class="span8 offset4 alert alert-error">' +
            '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
             message +
          '</div>');
      }

      var showInfoMessage = function(message) {
        $("#message-row").html(
          '<div class="span8 offset4 alert alert-info">' +
            '<a href="#" class="close" data-dismiss="alert">&times;</a>' +
             message +
          '</div>');
      }
      $('.add_stop_button').click(function() {
        $.ajax ({
            url:      '<?php echo base_url(); ?>index.php/userstops/add/<?php echo $this->session->userdata("user_id");?>/' + $(this).attr('id'),
            type:     'POST',
            dataType: 'json',
            cache:    false, 
            async:    false,
            success: function(response) {
              if (response.errorMessage != null) {
                showErrorMessage(response.errorMessage);
              }
              else if (response.infoMessage != null) {
                showInfoMessage(response.infoMessage);
              }
            }
        });
      });

      <?php if (isset($errorMessage)): ?>
      showErrorMessage("<?php echo $errorMessage; ?>");
      <?php endif; ?>
    });
    </script>
  </body>
</html>