<?	
	require($_SERVER['DOCUMENT_ROOT']."/include/global/pre_check.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/album.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/photo.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/user.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/module/albumService.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/module/photoService.php");
	require($_SERVER['DOCUMENT_ROOT']."/env/global_env.php");
	
	echo("	<html><head><meta charset='utf-8'/></head><body>");
	
	if (isset($_POST['albumname'])) {
		
		$user = unserialize($_SESSION['user']);
		
		$maxlength = MAX_WIDTH;
		$thumblength = THUMB_WIDTH;
		
		$albumServ = new AlbumService();
		$photoServ = new PhotoService();
		$album = new Album(0,$_POST['albumname'], getdate(), $user->userid);
		$result_addalbum = $albumServ->addAlbum($album);
		
		if ($result_addalbum["result"] == "success" && $result_addalbum["id"] != 0) {
			$album_id = $result_addalbum["id"];			
			
			$photos = $albumServ->getphotosfromimportpath(IMPORT_PATH);
			
			$imagepath = IMAGE_PATH;
			$thumbpath = THUMB_PATH;
			
			if (!file_exists($imagepath)) mkdir($imagepath,0777);
			if (!file_exists($thumbpath)) mkdir($thumbpath,0777);
			
			foreach($photos as $photo) {
				$filepath = $photo->imagepath;
				$filename = $photo->filename;
				list($width,$height) = getimagesize($filepath);
				
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
				$source = imagecreatefromjpeg($filepath);
				
				imagecopyresized($thumb, $source, 0, 0, 0, 0, $thumblength, $thumblength, min($width, $height),min($width, $height));
				imagecopyresized($image, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
				
				imagejpeg($thumb,$thumbpath."/".$filename,100);
				imagejpeg($image,$imagepath."/".$filename,100);
				
				imagedestroy($thumb);
				imagedestroy($image);
				imagedestroy($source);
				
				$photo = new Photo(0,$album_id ,$filename, $imagepath."/".$filename, $thumbpath."/".$filename, "", getdate(), $user->userid);
				$photoServ->addPhoto($photo);
			}
		} else {
			// Failed to add an album
			echo("Failed to add an album");
		}
	} else {
		//albumname is not set
		echo("Albumname is not set");
	}
	echo("</body></html>");
?>