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
setcookie("bodhiyani_admin",$facebook->getUser(),0,'/','.bodhiofficial.in');
 try{  
$user = $facebook->api('/me');
$_POST['user']=$user['username'];  
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
                            
                                     
                                    
                                         setcookie("deadlock_admin" , $user['username']."+".$chumma, time() + 3600*5 );
header("Location: ".$redr_url); 

} else {  
    # There's no active session, let's generate one  
    $login_url = $facebook->getLoginUrl(array( 'scope' => 'publish_stream' ));  
    header("Location: ".$login_url);  
}  