<?php
	$image = imagecreatefromjpeg("/home/familyphoto/gallery/Yoonbin - 1st Birthdays/image/image_DSC_0001.JPG");
	
	header("Content-type: image/jpeg");
	imagejpeg($image);
	
	imagedestroy($image);
?>