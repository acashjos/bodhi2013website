<?php
//header('Content-Type: image/jpeg');
echo phpinfo();
 $im = @imagecreatefromjpeg($_GET['event'].'.jpg');
imagejpeg($im,null,70);
?>