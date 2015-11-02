<?php
function limit_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]);
      }
      return $text;
    }
echo '<style>body{background:black;color:white;}</style>';
$dir = opendir($_SERVER['DOCUMENT_ROOT'].'/events/');
while (($file = readdir($dir)) !== false) {
if(is_dir($_SERVER['DOCUMENT_ROOT'].'/events/'.$file)){
$dir2 = opendir($_SERVER['DOCUMENT_ROOT'].'/events/'.$file."/");
    while (($file2 = readdir($dir2)) !== false) {
    $par = explode('.',$file2);
if($par[1]=="txt"){
$re =  file_get_contents($_SERVER['DOCUMENT_ROOT'].'/events/'.$file."/".$file2)."<br>";

preg_match('/##(.*)$/m',$re,$title); 
echo '<h1>'.strtoupper($title[1]).'</h1>';
$re=preg_replace('/##.*$/m','',$re);
 $re=/*utf8_decode*/(str_replace( array("\n","\r",PHP_EOL),'<br>',$re));
$re=preg_replace('/(<br>)+/m','<br>',$re);
//preg_match_all('/^#([^\n\r]+)([^#]*)$/sm',$re,$t2);
preg_match_all('/#([^<]+)<\/?br>([^#]*)/sm',$re,$t2);
$oup=array();
foreach($t2[1] as $e=>$t)
{
$oup[trim(strtolower(preg_replace('/[^a-z0-9]/i',' ',$t)))]=$t2[2][$e] ;
}

$des=$oup['description'];
unset($oup['description']);
$title=explode('/',$_GET['event']);

echo '<div style="font-size:18px;">'.$des.'</div>';
foreach($oup as $k=>$v)
{
echo '<h2>'.strtoupper($k).'</h2>';
echo $v;
}


}
} 
}
        }