<?php

//including the database authentication functions and variables
include_once('./library/db_common.php');

//sanitizing all the get and post variables so that it can be directly inserted into mysql database
  array_walk_recursive($_POST, 'sanitizeVariables'); 
  array_walk_recursive($_GET, 'sanitizeVariables'); 

//connecting to database
$link = connect();

  // Remember to copy files from the SDK's src/ directory to a
  // directory in your application on the server, such as php-sdk/
require("./library/facebook/facebook.php");  

include_once('./library/login.php');
# Creating the facebook object  
$facebook = new Facebook(array(  
    'appId'  => '458686460896496',  
    'secret' => '729ee12c3b74ff62b0502e8c82d23b04',  
    'cookie' => true  
));  
  $user_id = $facebook->getUser();

    if($user_id) {

      // We have a user ID, so probably a logged in user.
      // If not, we'll get an exception, which we handle below.
      try {

        $fbuser = $facebook->api('/me','GET');
       // echo "Name: " . $user_profile['name'];
	   define('ADDRESSED',true);		
	   login();
	    $logout_url =$facebook->getLogoutUrl();
      } catch(FacebookApiException $e) {
        // If the user is logged out, you can have a 
        // user ID even though the access token is invalid.
        // In this case, we'll get an exception, so we'll
        // just ask the user to login again here.
       $login_url = $facebook->getLoginUrl(array( 'scope' => 'publish_stream' ));  
        //echo 'Please <a href="' . $login_url . '">login.</a>';
        error_log($e->getType());
        error_log($e->getMessage());
      }   
    } else {

      // No user, print a link for the user to login
      $login_url = $facebook->getLoginUrl(array( 'scope' => 'publish_stream' )); 
     }



  
$_POST['error'] = 0 ;

include_once('./library/general.php');

$query = 'update deadlock_counter set total_hits = total_hits+1';
$result = mysql_query($query);
check($result);
 //var_dump(ADDRESSED===true);exit();
if ( ADDRESSED===true) 
          
        {
            $user = $fbuser['username'];
            $page = file_get_contents('./index.html');
			 $page = str_replace('fb_disconnect.php',  $logout_url , $page);
            if(isset($_GET['q']))
                {   
                    //process requests for leaderboard page    
                   if ( $_GET['q'] == 'leaderboard') 
                        {
                            $page = str_replace('{submit}', '', $page);
                            include_once('./library/leaderboard.php');
                            $page = leaderboard( $page );   
                        }

                    elseif ( $_GET['q'] == 'rules') 
                        {
                            $page = str_replace('{submit}', '', $page);
                            include_once('./library/rules.php');
                            $page = rules( $page );   
                        } 

                    elseif ( $_GET['q'] == 'submit' )    
                        {
                            include_once('./library/default.php');
                            include_once('./library/submit.php');
                            $page = submit_level( $page, $fbuser['username']);   
                        }

                    else
                        {
                            include_once('./library/default.php');
                            $page = str_replace('{image_replace}', image_v(), $page);
                            $page = str_replace('{submit}', submit_form(), $page);
							
                            $page = defaultt( $page, $fbuser['username']);
                        }       
                }
            else
                {
                    include_once('./library/default.php');
                   
                    $page = defaultt( $page, $fbuser['username']); 
                 $page = str_replace('{image_replace}', image_v(), $page);
                    $page = str_replace('{submit}', submit_form(), $page);
					}   
                 $page = str_replace('{fbcomment}','', $page);
                    
            $page = str_replace('{user}', $fbuser['name'], $page );
            $page = str_replace('{refresh_time}', '', $page ); 
            echo $page;
        }

/*elseif ( isset ( $_POST ['login'] ) && $_POST['login'] == 1 )   

        {
            $body = login();
            if( $body=='login' ) //if its a valid username and password then the cookie and show him admin panel
                {       
                    echo 'You will be redirected shortly.. Else please refresh the page.
                            <meta http-equiv="refresh" content="0">' ;
                }
          
            //in case the username and password is wrong,show him the login page itself    
            else
                {  $lognpg=file_get_contents("./login.html");
				
				echo str_replace('{message}', $body,str_replace('{fbloginurl}', $login_url ,$lognpg )  ) ;     }            
        }       
*/
//in case an un authorised personal gets the page, show him the login page
else

        {    $lognpg=file_get_contents("./login.html");
				
				echo str_replace('{message}', $body,str_replace('{fbloginurl}', $login_url ,$lognpg )  ) ;       }           

?>