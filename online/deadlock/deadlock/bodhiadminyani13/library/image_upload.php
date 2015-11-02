<?php


function image_upload()

          {
               if ( isset($_POST['up']) )
                    {
                       if( $_POST['up'] == 1 )
                           {  $body = image_upload_get()  ; }
                       else
                           {  $body = image_upload_form() ; }  
                    }
               else 
                    { $body = image_upload_form() ; }     
            return $body ;          
          }


function image_upload_form()

          {
                $body = '<!-- Box -->
                            <div class="box">
                              <!-- Box Head -->
                              <div class="box-head">
                                <h2>Add New Picture</h2>
                              </div>
                              <!-- End Box Head -->
                              <form action="./?q=pics&sq=upload" method="post" enctype="multipart/form-data">
                                <!-- Form -->
                                <div class="form">
                                  <p><label>Title <span>(Required Field)</span></label>
                                    <input type="text" name="title" class="field size1" placeholder="One-line description or title"/>
                                  </p>
                                  <p><label>Answers <span>(Required Field)</span></label>
                                    <input type="text" name="answers" class="field size1" placeholder="(comma seperate in case of multiple answers)"/>
                                  </p>
                                  <p><label>Clues </label>
                                    <textarea name="clues" class="field size1"> </textarea>
                                  </p>

                                  <p class="inline-field">
                                    <label>Upload Pic</label>
                                     <input type="file" name="file" id="file" class="field"/> 
                                    <input type="hidden" name="up" value="1" />
                                  </p>
                                </div>
                                <!-- End Form -->
                                <!-- Form Buttons -->
                                <div class="buttons">
                                  <input type="submit" class="button" value="submit" />
                                </div>
                                <!-- End Form Buttons -->
                              </form>
                            </div>
                            <!-- End Box -->';

                return $body;                      
          }

function image_upload_get()

          {
            $error_flag = 0 ;
            $body = '';
            $allowedExts = array("jpg", "jpeg", "gif", "png");
            $temp_ext = explode(".", $_FILES["file"]["name"]);
            $extension = end( $temp_ext );

            if ((  ($_FILES["file"]["type"] == "image/gif")|| ($_FILES["file"]["type"] == "image/jpeg")|| ($_FILES["file"]["type"] == "image/png")|| ($_FILES["file"]["type"] == "image/pjpeg")) 
                  && ($_FILES["file"]["size"] < 1024*1024)  && in_array($extension, $allowedExts))
 
                {
                      if ($_FILES["file"]["error"] > 0)
                          {
                               $body = $body. "Return Code: " . $_FILES["file"]["error"] ;
                               $error_flag = 1 ;
                          }
                      else
                          {        
                              $body = $body."Upload: " . $_FILES["file"]["name"] . "<br /> Type: " . $_FILES["file"]["type"] . "<br /> 
                                              Size: " . (int)($_FILES["file"]["size"] / 1024) . " Kb<br/> Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
                              
                              //getting the extension of the image      
                              $extension = explode('/',$_FILES["file"]["type"]);
                              $new_name = random_str(7) . '.' . $extension[1] ;

                              $ans_temp = strtolower($_POST['answers']);
                              $valid = 'qwertyuiopasdfghjklzxcvbnm1234567890,';
                              $user_ans = '';
                              $i = 0 ;
                              while( $ans_temp[$i] )
                                {
                                  $flag = 0;
                                  for( $j = 0 ; isset($valid[$j]) ; ++$j )
                                    { 
                                        if($ans_temp[$i] == $valid[$j])
                                          {   $flag = 1; break ; }
                                    }
                                  $user_ans .= ( $flag ? $ans_temp[$i] : '' );   
                                  ++$i;
                                }

                              //entering details into mysql db
                              $result = mysql_query('insert into deadlock_levels(question,pic_name,answer,page_source_clues,people_count) 
                                                    values (\''.$_POST['title'].'\',\''.$new_name.'\',\''.$user_ans.'\',\''.$_POST['clues'].'\',0 )');
                              check($result) ;

                              $result = mysql_query('update deadlock_counter set total_levels = total_levels+1');
                              check($result) ;
                              
                              //moving the tempory uploaded file from temporary folder to images folder
                              move_uploaded_file($_FILES["file"]["tmp_name"], "../xyqimageszmn/" .$new_name);
                              $body = $body."Stored in: " . "./xyqimageszmn/" . $new_name .'</div>';
                          }
                }

            else
                {
                    $error_flag = 1 ;
                    $body = $body."Invalid file. Only images of type jpg,jpeg,png or gif with size less than 1Mb can be uploaded.";
                }

            if( $error_flag )
                  {
                      $body = '<!-- Message Error -->
                              <div class="msg msg-error">
                                <p><strong>'.$body.'</strong></p>
                              </div>
                              <!-- End Message Error -->';
                  } 
             else
                  {   $body = '<!-- Message OK -->
                                  <div class="msg msg-ok">
                                    <p><strong>Your file was uploaded successfully!'.PHP_EOL.$body.'</strong></p>
                                  </div>
                                  <!-- End Message OK --> '; 
                  }        
            return $body;
        }

?>