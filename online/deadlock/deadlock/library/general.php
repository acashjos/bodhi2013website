<?php



function create_image( $random_string)
                        {
                             $im = imagecreate(60, 40)or die("Cannot Initialize new GD image stream");    
                             $background_color = imagecolorallocate($im, 0, 0, 0);  // black
                             $white = imagecolorallocate($im, 255, 255, 255);     
                           
                             imagestring($im, 5 , 8, 10, $random_string , $white);
                             imagepng($im,"image.png");
                             imagedestroy($im);
                         }



?>