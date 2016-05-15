<?php
session_start();
header('Content-type:image/jpeg');
$captcha = $_SESSION['captcha'];
$captcha_size = 40;
$image_width=210;
$image_height = 70;
$image = imagecreate($image_width,$image_height);
imagecolorallocate($image,255,255,255);
$captcha_color= imagecolorallocate($image,0,0,0);
for($x=1;$x<=20;$x++){
$x1=rand(1,100);
$y1=rand(1,100);
$x2=rand(1,100);
$y2=rand(1,100);
imageline($image,$x1,$y1,$x2,$y2,$captcha_color);
}
imagettftext($image,$captcha_size,0,15,50,$captcha_color,'FELIXTI.TTF',$captcha);
imagejpeg($image);
?>