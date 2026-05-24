<?php
session_start();
header('Content-type: image/png');
$text = substr(str_shuffle('ABCDEFGHJKLMNPQRSTUVWXYZ123456789'), 0, 4);
$_SESSION['captcha'] = $text;
$img = imagecreate(120, 40);
imagecolorallocate($img, 255, 255, 255);
$color = imagecolorallocate($img, 0, 0, 0);
imagestring($img, 5, 30, 12, $text, $color);
imagepng($img);
imagedestroy($img);
?>