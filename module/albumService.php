<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/photo.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/album.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/module/albumService.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/dao/albumDAO.php");
	
	class AlbumService {
		
		public function getPhotosFromImportPath($importpath) {
			$photos = array();
			
			$files = scandir($importpath);
			
			foreach ($files as $file) {
				if (!is_dir($file)) {
					$photo = new Photo(0,0,$file,$importpath."/".$file,"","","","");
					array_push($photos,$photo);				
				}				
			}
			
			return $photos;
		}
		
		public function addAlbum($album) {
			// check if albumname is duplicate or not
			$albumDAO = new AlbumDAO();
			$result = 	array(
							"result"=>"failed"
							,"message"=>"Something went wrong while adding an album."
							,"id"=>0
						);
			
			$chkalbum = $albumDAO->getAlbumByName($album->name);
			if (mysqli_num_rows($chkalbum) != 0) {
				$result["message"] = "The album name is already used. Please try another name.";
			} else {
				$album = new Album(0,$album->name, $album->dt_added, $album->createdby);
				$albumDAO->addAlbum($album);
				
				$albumquery = $albumDAO->getAlbumByName($album->name);
				$newalbum = $albumquery->fetch_row();
				
				$result["id"] = $newalbum[0];
				$result["result"] = "success";
				$result["message"] = "Album is added successfully.";
			}
			
			return $result;
		}
		
		public function getAlbums() {
			$albumDAO = new AlbumDAO();
			$resultset = $albumDAO->getAlbums();
			$albums = array();
			
			while($row = $resultset->fetch_array(MYSQLI_BOTH)) {
				$album = new Album($row["id"],$row["name"],$row["dt_added"],$row["createdby"],$row["cover"]);
				
				array_push($albums,$album);	
			}
			
			return $albums;
		}
	}
?>