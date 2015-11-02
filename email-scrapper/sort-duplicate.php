<?php
$v = (file_get_contents('emails.txt'));
$es = explode(',',$v);
$emails=array();
foreach(preg_split('/\s/', $v) as $token) {
        $email = filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL);
        if ($email !== false && !in_array($email,$emails)) {
            $emails[] = $email;
        }
    }
$h = fopen('email-sort-duplicate.txt','w+');
echo '<h1>Written to file email-sort-duplicate.txt('.count($emails).' emails)</h1>';
asort($emails);
foreach($emails as $k => $v)
{
$v=str_replace('"','',$v);
fputs($h,$v."\n");
echo $v.'<br>';
}