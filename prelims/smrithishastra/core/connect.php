<?php
$f = fopen(dirname(__FILE__).'/start.txt','r+');
while(!feof($f)) { 
$thedate= fgets($f);
}
fclose($f);

$f = fopen(dirname(__FILE__).'/event.txt','r+');
while(!feof($f)) { 
$event_name= fgets($f);
}
fclose($f);


$f = fopen(dirname(__FILE__).'/admin_data.txt','r+');
while(!feof($f)) { 
$ad= fgets($f);
}
fclose($f);

$dat=explode("~",$ad);

$url=$_SERVER['PHP_SELF'];
$url = ltrim($url,'/');
if($thedate!=256 AND !preg_match('#(.*?)admin(.*?)#is',$url) AND !preg_match('#(.*?)index(.*?)#is',$url) AND !preg_match('#(.*?)verify.php(.*?)#is',$url))
{
echo "
<script type=\"text/javascript\">
window.location=\"core/destroy.php\";
</script>
";
}

$link = mysql_connect("localhost", "bodhi_reverse", "smrithishastra#*12") or die('Database error !');
$db = mysql_select_db('bodhi_smrithishastra', $link) or die('Database error !');


if (get_magic_quotes_gpc()) {
    $process = array(&$_GET, &$_POST, &$_COOKIE, &$_REQUEST);
    while (list($key, $val) = each($process)) {
        foreach ($val as $k => $v) {
            unset($process[$key][$k]);
            if (is_array($v)) {
                $process[$key][stripslashes($k)] = $v;
                $process[] = &$process[$key][stripslashes($k)];
            } else {
                $process[$key][stripslashes($k)] = stripslashes($v);
            }
        }
    }
    unset($process);
}


function filter($data) {
$data = trim(htmlentities(strip_tags($data)));
	
	if (get_magic_quotes_gpc())
		$data = stripslashes($data);
	
	$data = mysql_real_escape_string($data);
	
	return $data;
}

$f = fopen(dirname(__FILE__).'/time.txt','r+');
while(!feof($f)) { 
$thedate= fgets($f);
}
fclose($f);

define('TIME',"<b>".$thedate."</b> min");
define('MAX',$thedate);
define('ADMIN_US',$dat[0]);
define('ADMIN_PAS',$dat[1]);
define('EVENT',$event_name);
?>