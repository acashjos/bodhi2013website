<?php


function random_str( $length = 5 )
        {
                $flag = 0;
                if($length == 'captcha')     
                    {   
                        $flag = 1;      
                        $length = 2 ;    
                    }
                $chars = "ABCDEFGHIJKLMNPQRSTUVWXYZ";  
                $size = strlen( $chars );
                $str = '';
                $str2 = '';

                for( $i = 0; $i < $length; $i++ ) 
                   {
                        $char = $chars[ rand( 0, $size - 1 ) ];
                        $str  .= $char;
                        $str2 .= ' '.$char;
                   }
                return ( $flag ? $str.','.$str2 : $str ) ;
        }

function login()
         {global $fbuser,$facebook;
             $conn = connect();
                                     #checking whether the user logins for the first time
                                     $query = 'select id from deadlock_profile where username=\''.$fbuser['username'].'\'';
                                     $result = mysql_query($query);
                                     check($result);

                                     if(mysql_num_rows($result) == 0 )
                                         {
                                            #inserting into deadlock profile
                                            $query = 'insert into deadlock_profile(username,current_level,cookie_key,attempts) values (\''.$fbuser['username'].'\'
                                                ,1,\''.$chumma.'\',0)';
                                            check(mysql_query($query));
 try {$ret_obj = $facebook->api('/me/feed', 'POST',
array(
'link' => "http://www.bodhiofficial.in/bodhiyani/",
'message' => " Hey, I started playing Bodhiyani'13. Its an online treasure hunt of Bodhi
2k13, National level Technical and Cultural Fest of VJCET. Prize worth
Rs.2000 at stake. Find the Bodhi In You. "
));
//exit();
               }
catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
       // $login_url = $facebook->getLoginUrl( array(
                //       'scope' => 'publish_stream'
                //       )); 
      //  echo 'Please <a href="' . $login_url . '">login.</a>';
       // echo ($e->getType());
       //echo ($e->getMessage());
		//exit();
      }   
	  
	  #updating number of deadlock users
                                            $query = 'update deadlock_counter set total_users = total_users +1';
                                            check(mysql_query($query));
                                            
                                            $query = 'update deadlock_levels set people_count = people_count+1 where id=1';
                                            check(mysql_query($query));
                                         }
                                     
                                     return 'login' ;
                                }

function validate()
         {
          return 1;

         }

        

?>