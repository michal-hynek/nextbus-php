
              <h3>W BROADWAY @ BURRARD ST</h3>
                <div>
                  <strong>Eastbound</strong><br/>
                  <strong>Stop #<?php echo $stopId; ?></strong>
                </div>
                <br/>
                <table class="table busstop-table">
                  <th>Bus #</th>
                  <th>Destination</th>
                  <th class="rightCell">Arrives in</th>

                  <?php for ( $i = 0; $i < MAXIMUM_ROWS_TO_DISPLAY; $i++ ): ?>    

                  <tr>
                    <?php if(!empty($stop_data[$stopId][$i])): ?>
                      <td><?php echo $stop_data[$stopId][$i]['bus_number']; ?></td>
                      <td><?php echo $stop_data[$stopId][$i]['destination']; ?></td>
                      <td class="rightCell"><?php echo $stop_data[$stopId][$i]['time']; ?> min</td>
                    <?php endif ?>
                  </tr> 

                  <?php endfor ?>

                </table>

                <small>* indicates scheduled departure time</small>

                <div class="pagination pagination-mini pull-right">
                  <ul>

                    <li><a href="#">&laquo;</a></li>
                   
                    <?php 
                      $numberOfPages = floor($stop_data[$stopId]['number_of_buses'] / 5);
                      $pageNumber = 1;
                      while ($pageNumber <= $numberOfPages): ?>
                       
                        <li><a href="#"><?php echo $pageNumber; ?></a></li>
                    
                    <?php 
                      $pageNumber++;
                      endwhile ?>
                    
                    <li><a href="#">&raquo;</a></li>

                 </ul>
                </div>