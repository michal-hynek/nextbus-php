
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