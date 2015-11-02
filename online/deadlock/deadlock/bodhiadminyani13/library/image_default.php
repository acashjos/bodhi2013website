<?php

function image_default()
          {
                        
              $replace_recent = $replace_top = ' ';
              
              $result_recent = mysql_query('select id,question,pic_name from deadlock_levels order by id desc');
              check($result_recent) ;
              
              $i = 0;
              if(mysql_num_rows($result_recent) > 0 )
                {
                  while ( $row_recent = mysql_fetch_row($result_recent) )
                  	  {

                        $dt_recent = explode(' ', $row_recent[2] );
$_SESSION['admin']=true;
                        $replace_recent .= '<tr'. ( (++$i%2 == 0 )?'>':'class="odd">') .'
                                              <td>'.$i.'</td>
                                              <td><h3><a href="#">'.$row_recent[0].'</a></h3></td>
                                              <td>'.$row_recent[1].'</td>
                                              <td><a href="#">'.$row_recent[2].'</a></td>
                                              <td><a href="?q=clue&level='.$row_recent[0].'" >open clue.</a></td>
                                              <td><a href="./?q=pics&sq=edit&id='.$row_recent[0].'" class="ico edit">Edit</a></td>
                                            </tr>';
                  	  }
                }

              $body = str_replace('{recent_table}', $replace_recent, image_default_html());    
              return $body;
          }



function image_default_html()
        {
            return '<div class="cl">&nbsp;</div>
                        <!-- Content -->
                        <div id="content">
                          <!-- Box -->
                          <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                              <h2 class="left">Recently Uploaded</h2>
                            </div>
                            <!-- End Box Head -->
                            <!-- Table -->
                            <div class="table">
                              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <th>Sl. No.</th>
                                  <th>Level</th>
                                  <th>Question</th>
                                  <th>Image</th>
                                  <th>Clue</th>
                                  <th width="110" class="ac">Content Control</th>
                                </tr>
                                  {recent_table}
                              </table>
                              
                            </div>
                            <!-- Table -->
                          </div>
                        </div>
                        <!-- End Content -->
                        <!-- Sidebar -->
                        <div id="sidebar">
                          <!-- Box -->
                          <div class="box">
                            <!-- Box Head -->
                            <div class="box-head">
                              <h2>Management</h2>
                            </div>
                            <!-- End Box Head-->
                            <div class="box-content"> <a href="./?q=pics&sq=upload" class="add-button"><span>Add new Picture</span></a>
                              <div class="cl">&nbsp;</div>
                             
                              <!-- End Sort -->
                            </div>
                          </div>
                          <!-- End Box -->
                        </div>
                        <!-- End Sidebar -->
                        <div class="cl">&nbsp;</div>
                      </div>';
        }
?>