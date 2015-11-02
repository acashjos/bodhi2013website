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

 if(isset($_REQUEST['error'])) {
         header('Location: index.php'); exit;
     }

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
 
if($session != 0) {
$redr_url = 'index.php'; 
if(isset($_GET['go']))
{
$redr_url = $_GET['go'];
}
setcookie("fb_user",$facebook->getUser(),0,'/','.bodhiofficial.in');
 try{  
$user = $facebook->api('/me');  
}catch (Exception $e){ die('Error connecting to facebook.. Reload this page.'); }

if(!$user )
{
   # There's no active session, let's generate one  
    $login_url = $facebook->getLoginUrl(array( 'scope' => 'publish_stream' ));  
    header("Location: ".$login_url); 
exit;
}
$chumma = random_str(6);
 #checking whether the user logins for the first time
                                     $query = 'select id from deadlock_profile where username=\''.$user['username'].'\'';
                                     $result = mysql_query($query);
                              
                                     if(mysql_num_rows($result) == 0 )
                                         {
                                            #inserting into deadlock profile
                                            $query = 'insert into deadlock_profile(username,current_level,cookie_key,attempts) values (\''.$user['username'].'\'
                                                ,1,\''.$chumma.'\',0)';
mysql_query($query);
                                            #updating number of deadlock users
                                            $query = 'update deadlock_counter set total_users = total_users +1';
                                            mysql_query($query);
                                            $query = 'update deadlock_levels set people_count = people_count+1 where id=1';
mysql_query($query);
                                         }
                                     else
                                         {
                                            $query = 'update deadlock_profile set cookie_key = \''.$chumma.'\' where username=\''.$user['username'].'\'';
                                            $result = mysql_query($query);
                                    
                                         }    
                                         setcookie("deadlock_user" , $user['username']."+".$chumma, time() + 3600*5 );
header("Location: ".$redr_url); 

} else {  
    # There's no active session, let's generate one  
    $login_url = $facebook->getLoginUrl(array( 'scope' => 'publish_stream' ));  
    header("Location: ".$login_url);  
}  