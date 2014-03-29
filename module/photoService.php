<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/photo.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/dao/photoDAO.php");
	
	class photoService {
	
		public function addphoto($photo) {
			$photoDAO = new PhotoDAO();
			$photoDAO->addphoto($photo);
		}
		
		public function getalbumphotos($album_id) {
			$photoDAO = new PhotoDAO();
			$resultset = $photoDAO->getalbumphotos($album_id);
			
			$photos = array();
			
			while($row = $resultset->fetch_array(MYSQLI_BOTH)) {
				$photo = new Photo($row["id"],$row["album_id"],$row["filename"]
				,$row["imagepath"],$row["thumbpath"],$row["caption"]
				,$row["dt_added"],$row["createdby"]);
				
				array_push($photos,$photo);	
			}
			
			return $photos;
		}
	}
?>