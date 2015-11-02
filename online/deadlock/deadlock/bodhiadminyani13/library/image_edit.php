<?php

function image_edit()
		{
			
            if(isset($_GET['sq']))
                {
                    if ( $_GET['sq'] == 'edited')
                        {

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

                			      $result = mysql_query('update deadlock_levels set question=\''.$_POST['title'].'\',
                                answer=\''.$user_ans.'\',page_source_clues=\''.$_POST['clues'].'\' where id=\''.$_GET['id'].'\'');
                            check($result) ;

                            $body = '<!-- Message OK -->
                                        <div class="msg msg-ok">
                                        <p><strong>Specified image was succesfully edited.</strong></p>
                                       </div>
                                     <!-- End Message OK --> ';
                        }
                    else
                        {
                            $body = image_edit_form();
                        }   
                }
            else
                {
                    $body = '<!-- Message Error -->
                              <div class="msg msg-error">
                                <p><strong>Sorry this dosen\'t seems to be a valid request.</strong></p>
                                 </div>
                              <!-- End Message Error -->';
                }                             
            return $body;         
		}


function image_edit_form()
        {

            $result = mysql_query('select id,question,pic_name,answer,page_source_clues from deadlock_levels where id=\''.$_GET['id'].'\'');
            check($result) ;

            $row = mysql_fetch_row($result);

            $body = '<!-- Box -->
                            <div class="box">
                              <!-- Box Head -->
                              <div class="box-head">
                                <h2>Edit Picture</h2>
                              </div>
                              <!-- End Box Head -->
                              <form action="./?q=pics&sq=edited&id='.$row[0].'" method="post">
                                <!-- Form -->
                                <div class="form">
                                  <p><label>Title <span>(Required Field)</span></label>
                                    <input type="text" name="title" class="field size1" value="'.$row[1].'"/>
                                  </p>
                                  <p><label>Answers <span>(Required Field)</span></label>
                                    <input type="text" name="answers" class="field size1" value="'.$row[3].'"/>
                                  </p>
                                  <p><label>Clues </label>
                                    <textarea name="clues" class="field size1"> '.$row[4].'</textarea>
                                  </p>

                                  <p>
                                    <label>Image</label>
                                    <img src="../xyqimageszmn/'.$row[2].'" width="410px" height="280px" />
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

?>