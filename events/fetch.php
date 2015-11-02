<?php
$r=fopen($_GET['event'].'.txt','r');
$re= fread($r,10e3);
preg_match('/##(.*)$/m',$re,$title);
$re=preg_replace('/##.*$/m','',$re);
 $re=/*utf8_decode*/(str_replace( array("\n","\r",PHP_EOL),'<br>',$re));
$re=preg_replace('/(<br>)+/m','<br>',$re);
//preg_match_all('/^#([^\n\r]+)([^#]*)$/sm',$re,$t2);
preg_match_all('/#([^<]+)<\/?br>([^#]*)/sm',$re,$t2);
$oup=array();
foreach($t2[1] as $e=>$t)
{
$oup[trim(strtolower(preg_replace('/[^a-z0-9]/i',' ',$t)))]=$t2[2][$e] ;

//echo trim(strtolower(preg_replace('/[^a-z0-9]/i',' ',$t)))." - ". $t2[2][$e].'<br>';
}
//var_dump($title);
$des=$oup['description'];
unset($oup['description']);
echo json_encode(array('title'=>$title[1],'desc'=>$des,'data'=>$oup));
?>