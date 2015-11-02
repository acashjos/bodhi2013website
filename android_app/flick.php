<?php
$url = 'http://api.flickr.com/services/rest/?method=flickr.photos.search&api_key=19531c2ac442b7c1acf247a4aa97bb98&user_id=101886785@N04';
$xml = simplexml_load_file($url);

foreach($xml->photos->photo as $k=>$v)
{
//$d=imagecreatefromjpeg('http://farm'.$v["farm"].'.static.flickr.com/'.$v["server"].'/' .$v["id"]. '_'.$v["secret"].'_q.jpg');
$ch = curl_init('http://farm'.$v["farm"].'.static.flickr.com/'.$v["server"].'/' .$v["id"]. '_'.$v["secret"].'_c.jpg');
$fp = fopen('imgs/'.$v["id"].'.jpg', 'wb+');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
$d=curl_exec($ch);
curl_close($ch);
fputs($fp,$d);
fclose($fp);
}