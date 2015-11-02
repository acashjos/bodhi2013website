<?php

function submit_level( $page, $user )
		{global $fbuser,$facebook;
			 $query = 'update deadlock_counter set total_attempts = total_attempts+1';
       check(mysql_query($query));

       $query = 'update deadlock_profile set attempts = attempts+1 where username=\''.$user.'\'';
       check(mysql_query($query));

       if(!($_POST['error']))
          {
              $query = 'select answer from deadlock_levels where id = (select current_level from deadlock_profile where username=\''.$user.'\')';
              $result = mysql_query($query);
              check($result);
              $row = mysql_fetch_row($result);
              $orig_ans = strtolower( $row[0] );

              #sterilising the input answer
              $ans_temp = strtolower($_POST['ans']);
              $valid = 'qwertyuiopasdfghjklzxcvbnm1234567890';
              $user_ans = '';
              $i = 0 ;
              while( isset($ans_temp[$i]) )
                {
                  $flag = 0;
                  for( $j = 0 ; $valid[$j] ; ++$j )
                    { 
                        if($ans_temp[$i] == $valid[$j])
                          {   $flag = 1; break ; }
                    }
                  $user_ans .= ( $flag ? $ans_temp[$i] : '' );  
                  ++$i; 
                }

              $flag = 0;  
              if(substr_count($orig_ans, ',') > 0 )
                  {   
                    $ans = explode(',', $orig_ans);
                    $i = 0 ;
                    while(isset($ans[$i]))
                      {
                        if($ans[$i] == $user_ans)
                          { $flag = 1 ; break ; }
                        ++$i;
                      }
                  }
              else
                  {
                     if( $orig_ans == $user_ans )
                        { $flag = 1 ;   }
                  }     


              if( $flag )
                  {
                      $query = 'select current_level from deadlock_profile where username = \''.$user.'\'';
                      check($result = mysql_query($query));
                      $kd1 = mysql_fetch_row($result);

                      $query = 'select total_levels from deadlock_counter';
                      check($result = mysql_query($query));
                      $kd2 = mysql_fetch_row($result);
                      
                      if( $kd1[0] != $kd2[0] )
                        {
						 try {$ret_obj = $facebook->api('/me/feed', 'POST',
array(
'link' => "http://www.bodhiofficial.in/bodhiyani/",
// current level is in variable $kd1[0]
'message' => " Guys, I just cracked level {$kd1[0]} on Bodhiyani 2k13  :P"
));
//exit();
               }
catch(FacebookApiException $e) {

      }   
                          $query = 'update deadlock_levels set people_count = people_count-1 where id = ( select current_level 
                            from deadlock_profile where username=\''.$user.'\')';
                          check(mysql_query($query));

                          $query = 'select last_level_clearence_time,attempts,each_level_attempts,each_level_completion_time 
                          from deadlock_profile where username=\''.$user.'\'';
                          check( $result = mysql_query($query));

                          $row = mysql_fetch_row($result);
                          $dt = date("Y-m-d h:i:s");

                          $query = 'update deadlock_profile set current_level=current_level+1,last_level_clearence_time=\''.$dt.'\', attempts = attempts+1, 
                          each_level_attempts = \''.$row[2].','.$row[1].'\', each_level_completion_time = \''.$row[3].','.$row[0].'\' where
                          username=\''.$user.'\'';
                          check( mysql_query($query));

                          $query = 'update deadlock_levels set people_count = people_count+1 where id = ( select current_level 
                            from deadlock_profile where username=\''.$user.'\')';
                          check(mysql_query($query));

                          return defaultt( $page, $user);
                        }
                        
                      else
                        {     
                          $page = str_replace('{image_replace}', '', $page);
                          $page = str_replace('{submit}', '', $page);
                          $page = str_replace('{question}', 'Thumbs Up. You cracked Bodhiyani .', $page);
                          $page = str_replace('{refresh_time}', '', $page); 
                        }    

                  }    
              else
                  {
                      $files = array('1.jpg','2.jpg','3.jpg','4.jpg','5.png','6.jpg','7.jpeg','8.jpeg','9.jpg','10.jpg','11.jpg','12.png','13.jpg','14.jpg','15.jpg','16.jpg','17.jpg','18.jpg');
                      $i = rand(1,18);
                      $image = './error/'.$files[$i];
                      $tt = str_replace('./xyqimageszmn/{image-name}', $image, image_v());
                      $page = str_replace('{image_replace}', $tt, $page);
                      $page = str_replace('{submit}', '', $page);
                      $page = str_replace('{question}', 'Nice try.Try harder.', $page);
                      $page = str_replace('{refresh_time}', '5;index.php', $page);                   
                  }    

          }
       else
          {
              $page = str_replace('{image_replace}', '', $page);
              $page = str_replace('{submit}', '', $page);
              $page = str_replace('{question}', 'Incorrect Captcha.', $page);
              $page = str_replace('{refresh_time}', '3;index.php', $page);   
          }   
       return $page;     
		}

?>