<?php
/*
captcha.php
*/
session_start();
$text = rand(10000,99999);
$_SESSION["kode_cap"] = $text;
$width = 65;
$height = 25;
$font_size = 14;

$image_p = imagecreate($width,$height);
$white = imagecolorallocate($image_p,0,0,0);
$black = imagecolorallocate($image_p,225,225,225);

imagestring($image_p,$font_size,5,5,$text,$black);
imagejpeg($image_p,null,80);
?>

