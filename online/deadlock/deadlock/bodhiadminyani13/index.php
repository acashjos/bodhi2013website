<?php
   session_start();
//including the database authentication functions and variables
include_once('./library/db_common.php');

//sanitizing all the get and post variables so that it can be directly inserted into mysql database
  array_walk_recursive($_POST, 'sanitizeVariables'); 
  array_walk_recursive($_GET, 'sanitizeVariables'); 

//connecting to database
$link = connect();

include_once('./library/login.php');

if ( $_SESSION['login']===true) 
          
        { 
            $user = $_SESSION['user'];
            
            if(isset($_GET['q']))
                {   
                    $path = '';
                    $content = '';
                    $active = '';
                    if($_GET['q'] == 'logout')      
                        {   logout(); 
                            echo file_get_contents("./login.html") ; 
                            exit ; 
                        }
						else  if($_GET['q'] == 'clue')      
                        {   $_GET['level']=($_GET['level']?$_GET['level']:1);
                             $path = ' Clues';
							 
							$content =<<<k
							<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=458686460896496";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
k;
							$content .='<div class="fb-comments" data-href="http://'.$_SERVER["SERVER_NAME"].'/bodhiyani/?nowat=level'.$_GET['level'].'" data-colorscheme="dark" data-width="550"></div>';
							
                        }
                    //process requests for picture page    
                    elseif ( $_GET['q'] == 'pics') 
                        {
                            $active = 2 ;
                            if(isset($_GET['sq']))
                                {
                                    if( $_GET['sq'] == 'edit' || $_GET['sq'] == 'edited' )
                                            {    
                                                $path = 'Pictures > Edit';
                                                include_once('./library/image_edit.php');
                                                $content = image_edit();
                                            }
                                    elseif( $_GET['sq'] == 'upload' )
                                            {
                                                $path = 'Pictures > Upload';
                                                include_once('./library/image_upload.php');
                                                $content = image_upload();
                                            }        
                                    else    
                                            {
                                                $path = 'Pictures';
                                                include_once('./library/image_default.php');
                                                $content = image_default();
                                            }
                                 }           
                            else    
                                {
                                    $path = 'Pictures';
                                    include_once('./library/image_default.php');
                                    $content = image_default();
                                }
                        } 

                    else
                        {
                            include_once('./library/dashboard.php');
                            $content = dashboard();
                            $active = 1 ;  
                        }       
                }
            $out = str_replace('{username}', $user, file_get_contents('./index.html') );
            $out = str_replace('{pathfinder}', $path , $out ) ;
            $out = str_replace('"active'.$active.'"', 'active' , $out ) ;
            $out = str_replace('{body-content-replace}', $content , $out ) ;
            echo $out;
        }

elseif ( isset ( $_POST ['login'] ) && $_POST['login'] == 1 )   

        {
            if( login() )  //if its a valid username and password then the cookie and show him admin panel
                {       
                    $page = str_replace('{body-content-text}', 'Succesfully logged in.' , file_get_contents("./index.html") );
                    echo str_replace('{username}', $_POST['user'], $page ) ;
                }
            //in case the username and password is wrong,show him the login page itself    
            else
                {  echo file_get_contents("./login.html") ;     }            
        }       
//in case an un authorised personal gets the page, show him the login page
else

        {    echo file_get_contents("./login.html");         }           

?>