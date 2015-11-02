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
         {global $fbuser;
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