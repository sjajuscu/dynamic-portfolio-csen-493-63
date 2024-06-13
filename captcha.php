<?php 
	session_start(); 
	$text = rand(10000,99999); 
	$_SESSION["vercode"] = $text; 
	$height = 55; 
	$width = 90;   
	$image_p = imagecreate($width, $height); 
	$black = imagecolorallocate($image_p, 144, 169, 189); 
	$white = imagecolorallocate($image_p, 255, 255, 255); 
	$font_size = 20; 
	imagestring($image_p, $font_size, 20,20, $text, $white); 
	imagejpeg($image_p, null, 80); 
?>


