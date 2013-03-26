
              <h3><?php echo $stop_names[$stopCode]; ?> </h3>
                <div>
                  <strong>Eastbound</strong><br/>
                  <strong>Stop #<?php echo $stopCode; ?></strong>
                   <a href="#deleteConfirmationPopup" name="delete<?php echo $stopCode ?>" 
                      role="button" class="btn btn-primary btn-danger btn-small delete" data-toggle="modal">Delete</a><br/>
                </div>
                <br/>
                <table class="table busstop-table">
                  <th>Bus #</th>
                  <th>Destination</th>
                  <th class="rightCell">Arrives in</th>

                  <?php for ( $i = 0; $i < MAXIMUM_ROWS_TO_DISPLAY; $i++ ): ?>    

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

                <div class="pagination pagination-mini pull-right">
                  <ul>

                    <li><a href="#">&laquo;</a></li>
                   
                    <?php 
                      $numberOfPages = floor($stop_data[$stopCode]['number_of_buses'] / 5);
                      $pageNumber = 1;
                      while ($pageNumber <= $numberOfPages): ?>
                       
                        <li><a href="#"><?php echo $pageNumber; ?></a></li>
                    
                    <?php 
                      $pageNumber++;
                      endwhile ?>
                    
                    <li><a href="#">&raquo;</a></li>

                 </ul>
                </div>

                <!-- Delete Confirmation Popup -->
                <div id="deleteConfirmationPopup" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Delete Confirmation</h3>
                  </div>
                  <div class="modal-body">
                    <p>Are you sure you want to delete the bus stop.</p>
                  </div>
                  <div class="modal-footer">
                    <a name="delete<?php echo $stopCode ?>" href="<?php echo base_url(); ?>index.php/userstops/delete_stop/<?php echo $stopCode; ?>" class="btn btn-primary btn-danger">Yes</a>
                    <button class="btn btn-primary" data-dismiss="modal" aria-hidden="true">No</button>
                  </div>
                </div>
