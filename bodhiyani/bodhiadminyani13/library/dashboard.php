<?php

function dashboard()
          {
                        

              $result_log = mysql_query('select * from deadlock_counter');
              check($result_log) ;
              $row = mysql_fetch_row($result_log);
              $replace_log = '<tr>
                                    <td>'.$row[1].'</td>
                                    <td><h3><a href="#">'.$row[2].'</a></h3></td>
                                    <td>'.$row[3].'</td>
                                    <td>'.$row[4].'</td>
                              </tr>';	  

              $body = str_replace('{stats_table}', $replace_log,dashboard_html() ) ; 
              return $body;
          }

function dashboard_html()
        {
            return '<div class="cl">&nbsp;</div>
                        <!-- Content -->
                        <div id="content">


                          <!-- Box -->
                          <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                              <h2 class="left">Statistics</h2>
                            </div>
                            <!-- End Box Head -->
                            <!-- Table -->
                            <div class="table">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <th>Users</th>
                                  <th>Levels</th>
                                  <th>Attempts</th>
                                  <th>Total Hits</th>
                                </tr>
                                 {stats_table} 
                              </table>
                              
                            </div>
                            <!-- Table -->
                          </div>

                        </div>
                        <!-- End Content -->
                        <div class="cl">&nbsp;</div>
                      </div>';
        }

?>