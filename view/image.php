<?php
	require($_SERVER['DOCUMENT_ROOT']."/include/global/pre_check.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/env/global_env.php");
	
	if (isset($_GET["path"])) {
		$imagepath = $_GET["path"];
	} else {
		$imagepath = $_SERVER['DOCUMENT_ROOT']."/images/notfound.jpg";
	}
	
	if (isset($_GET["type"])) {
		if ($_GET["type"] == "thumb") {
			// Display thumb image
			list($width,$height) = getimagesize($imagepath);
			
			$image = imagecreatetruecolor(THUMB_WIDTH, THUMB_WIDTH);
			$source = imagecreatefromjpeg($imagepath);
			
			imagecopyresized($image, $source, 0, 0, 0, 0, THUMB_WIDTH, THUMB_WIDTH, min($width, $height),min($width, $height));
			
			imagedestroy($source);
		} else {
			// TODO: Display normal image
			$image = imagecreatefromjpeg($imagepath);
		}
	} else {
		// Display original image
		$image = imagecreatefromjpeg($imagepath);
	}
	
	
	header("Content-type: image/jpeg");
	imagejpeg($image);
	
	imagedestroy($image);
?>