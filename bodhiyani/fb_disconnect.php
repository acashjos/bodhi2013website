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
//including the database authentication functions and variables
include_once('./library/db_common.php');

//sanitizing all the get and post variables so that it can be directly inserted into mysql database
  array_walk_recursive($_POST, 'sanitizeVariables'); 
  array_walk_recursive($_GET, 'sanitizeVariables'); 

//connecting to database
$link = connect();


# We require the library  
require("./library/facebook/facebook.php");  
  
# Creating the facebook object  
$facebook = new Facebook(array(  
    'appId'  => '458686460896496',  
    'secret' => '729ee12c3b74ff62b0502e8c82d23b04',  
    'cookie' => true  
));  

# Let's see if we have an active session 
$session = $facebook->getUser(); 
        setcookie("deadlock_user" , $user['username']."+".$chumma, time() - 3600*5 );
setcookie("fb_user" , $user['username']."+".$chumma, time() - 3600*5 );
 unset($_COOKIE['fb_user']); 
setcookie("fbm_458686460896496" , $user['username']."+".$chumma, time() - 3600*5 );
 unset($_COOKIE['fbm_458686460896496']); 

$facebook->setAccessToken("");
$facebook->destroySession();
header("Location: index.php");
//header("Location: ".$facebook->getLogoutUrl(array("next" => "http://".$_SERVER[HTTP_HOST].$_SERVER[REQUEST_URI])));