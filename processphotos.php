<?	
	require("include/global/pre_check.php");
	require_once("entity/organizer.php");
	require($_SERVER['DOCUMENT_ROOT']."/env/global_env.php");
	
	$maxlength = 1024;
	$thumblength = 150;
	
	$albumServ = new AlbumService(); 
	
	$photos = $albumServ->getphotosfromimportpath(IMPORT_PATH);
		
	if (!file_exists($imagefolder)) mkdir($imagefolder,0777);
	if (!file_exists($thumbfolder)) mkdir($thumbfolder,0777);
	
	foreach($album->getPhotos() as $photo) {
		$filePath = $photo->getFilePath();
		$fileName = $photo->getName();
		list($width,$height) = getimagesize($filePath);
		
		$newwidth = 0;
		$newheight = 0;
		
		if ($width > $height) {
			$newwidth = $maxlength;
			$newheight = $maxlength * ($height / $width);
		} else {
			$newwidth = $maxlength * ($width / $height);
			$newheight = $maxlength;
		}
		
		$thumb = imagecreatetruecolor($thumblength, $thumblength);
		$image = imagecreatetruecolor($newwidth, $newheight);
		$source = imagecreatefromjpeg($filePath);
		
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $thumblength, $thumblength, min($width, $height),min($width, $height));
		imagecopyresized($image, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		
		imagejpeg($thumb,$thumbfolder."/thumb_".$fileName,100);
		imagejpeg($image,$imagefolder."/image_".$fileName,100);
		
		imagedestroy($thumb);
		imagedestroy($image);
		imagedestroy($source);
	}
?>