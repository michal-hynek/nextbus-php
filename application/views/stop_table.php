
              <h3><?php echo $stop_names[$stopCode]; ?> </h3>
                <div>
                  <strong>Eastbound</strong><br/>
                    <a name="delete<?php echo $stopCode ?>" href="<?php echo base_url(); ?>index.php/userstops/delete_stop/<?php echo $stopCode; ?>" class="btn btn-primary btn-danger btn-small delete">Delete</a><br/>
                  <strong>Stop #<?php echo $stopCode; ?></strong>
                </div>
                <br/>
                <table class="table busstop-table">
                  <th>Bus #</th>
                  <th>Destination</th>
                  <th class="rightCell">Arrives in</th>

                  <?php if($show_all == FALSE) {
                    $rowsToDisplay = MAXIMUM_ROWS_TO_DISPLAY;
                  } else {
                    $rowsToDisplay = sizeof($stop_data[$stopCode]);
                  } ?>

                    <?php for ( $i = 0; $i < $rowsToDisplay; $i++ ): ?>
                      <tr>
                        <?php if(!empty($stop_data[$stopCode][$i])): ?>
                          <td><?php echo $stop_data[$stopCode][$i]['bus_number']; ?></td>
                          <td><?php echo $stop_data[$stopCode][$i]['destination']; ?></td>
                          <td class="rightCell"><?php echo $stop_data[$stopCode][$i]['time']; ?> min</td>
                        <?php endif ?>
                      </tr>
                    <?php endfor ?>

                </table>

                <small>* indicates scheduled departure time</small>