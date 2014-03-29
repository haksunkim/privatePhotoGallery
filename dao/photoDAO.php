<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/dao/daoBase.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/photo.php");
	
	class PhotoDAO extends DaoBase {
		public function addPhoto($photo) {
			$conn = self::connect();
			
			$query = "	INSERT INTO photo
						(album_id, filename, imagepath, thumbpath, dt_added, createdby)
						VALUES
						(".$photo->album_id
						.",'".$photo->filename."'"
						.",'".$photo->imagepath."'"
						.",'".$photo->thumbpath."'"
						.",'".$photo->dt_added."'"
						.",'".$photo->createdby."'"
						.");";
						
			$resultset = self::insert($conn, $query);						
			self::close($conn);
		}
		
		public function getalbumphotos($album_id) {
			$conn = self::connect();
			
			$query = "	SELECT	id
								,album_id
								,filename
								,imagepath
								,thumbpath
								,dt_added
								,createdby
								,caption
						FROM	photo
						WHERE	album_id=".$album_id.";";
						
			$resultset = self::selectUncommitted($conn, $query);						
			self::close($conn);
			
			return $resultset;
		}
	}
?>