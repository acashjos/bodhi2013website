<?php

function defaultt( $page, $uzer)
          {
                        
              
              $result = mysql_query('select id,question,pic_name,page_source_clues from deadlock_levels where id = (select current_level from deadlock_profile where username=\''.$uzer.'\')');
              check($result) ;
              $row = mysql_fetch_row($result);
			     if( !$row[0]){ 
				 $query = 'select current_level from deadlock_profile where username = \''.$uzer.'\'';
                      check($result = mysql_query($query));
                      $kd1 = mysql_fetch_row($result);
					    $query = 'select total_levels from deadlock_counter';
                      check($result = mysql_query($query));
                      $kd2 = mysql_fetch_row($result);
					  if($kd1>$kd2)
                        {     
                          $page = str_replace('{image_replace}', '', $page);
                          $page = str_replace('{submit}', '', $page);
                          $page = str_replace('{question}', 'Thumbs Up. You cracked Bodhiyani .', $page);
                          $page = str_replace('{refresh_time}', '', $page); 
                        }  
              //setting unique url
			}
              if( $_GET['nowat']!='level'.$row[0])
                {header('Location: ?nowat=level'.$row[0]); }
				  $page = str_replace('{fbcomment}','<div class="fb-comments" data-href="http://'.$_SERVER["SERVER_NAME"].'/bodhiyani/?nowat=level'.$row[0].'" data-colorscheme="dark" data-width="550"></div>', $page);
                  
              $temp = random_str('captcha');
              $str = explode(',' , $temp);
              create_image($str[1]);
              $str2 = random_str(4);

              $page = str_replace('{image_replace}', image_v(), $page);
              $page = str_replace('{submit}' , submit_form(), $page);
              $page = str_replace('CurrentLevel', 'Level : '.$row[0], $page);
              $page = str_replace('{image-name}', $row[2], $page);
              $page = str_replace('{question}', $row[1], $page);
              
              $c = md5(base64_encode(trim($str[0]))) ;
              $cap = $c[0].$c[1].$c[2];

              $page = str_replace('csrsvalue', $str2, $page );

              $query = 'update deadlock_profile set csrs_key=\''.$str2.'\' ,image_captcha =\''.$cap.'\' where username=\''.$uzer.'\'';
              $result = mysql_query($query);
              check($result);

              return $page;
              
          }

function submit_form()
          {
            return '<form method="post" action="index.php?q=submit">
                        <input type="hidden" name="csrs" value="csrsvalue" />
                        <input type="text" name="ans" placeholder="Answer" />
                        &nbsp;
                        <img src="./image.png?v='.time().'" height="40px" width="100px" class="captcha" />
                        &nbsp;
                        <input type="text" name="captcha" placeholder="captcha" />
                        <input type="submit" value="Submit" style="cursor:pointer;font-family:verdanapadding:7px;font-weight:bold;" />
                    </form>';

          }
function image_v()
          {
            return '<div id="image">
                      <img src="./xyqimageszmn/{image-name}" width="921px" height="630" />
                    </div>';
          }

?>