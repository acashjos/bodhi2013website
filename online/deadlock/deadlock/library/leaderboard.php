<?php

function leaderboard( $page )
          {
                $body = '<table>
                            <tr>
                                  <th>Position</th>
                                  <th>Username</th>
                                  <th>Current Level</th>
                                  <th>Attempts </th>
                            </tr>';
                $query = 'SELECT username,current_level,attempts from deadlock_profile order by current_level desc,last_level_clearence_time asc limit 0,250';
                $result = mysql_query($query);
                check($result);
                $i = 0;
                while( $row = mysql_fetch_row($result))
                    {
                       $body .= '<tr>
                                      <td>'.(++$i).'</td>
                                      <td>'.$row[0].'</td>
                                      <td>'.$row[1].'</td>
                                      <td>'.$row[2].'</td>
                                 </tr>';
                    }
                $body .='</table>';
                
                $page = str_replace('{question}', 'Leaderboard', $page);
                $page = str_replace('{image_replace}', '<div id="image">'.$body.'</div>', $page); 
                return $page;                
          }
?>