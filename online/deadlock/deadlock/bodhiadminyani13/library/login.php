<?php
define('_username','ironman');
define('_password','itsreallybig');
function login()
         {

             $conn = connect();
             
          if ($_POST['user'] ===_username&& $_POST['pass'] == _password) 
                          {  
                          
$_SESSION['login']=true;			
$_SESSION['user']= ($_POST['user'] );				 return 1 ;
                          }   

             else         { return 0 ; }  


         }

function validate()
         {
                              return 1 ; 

         }

function logout()
        {
           unset(  $_SESSION['user']);
		   $_SESSION['login']=false;
        }

function random_str( $length = 5 )
        {
                $flag = 0;
                if($length == 'cookie')     
                    {   
                        $flag = 1;      
                        $length = 5 ;    
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

?>