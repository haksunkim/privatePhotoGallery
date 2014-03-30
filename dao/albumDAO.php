<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/dao/daoBase.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/album.php");
	
	class AlbumDAO extends daoBase {
		public function getAlbumByName($albumname) {
			$conn = self::connect();
			
			$query = "	SELECT	id
								,name
								,dt_added
								,createdby
								,cover
						FROM	album
						WHERE	name	='".$albumname."';";
						
			$resultset = self::selectUncommitted($conn, $query);						
			self::close($conn);
			
			return $resultset;
		}
		
		public function addAlbum($album) {
			if ($album->name != "" && $album->dt_added != "" && $album->createdby != "") {
				$conn = self::connect();
				
				$query = "	INSERT INTO	album
							(name, dt_added, createdby)
							VALUES
							('".$album->name."'"
							.",'".$album->dt_added."'"
							.",'".$album->createdby."'"
							.");";
							
				$resultset = self::insert($conn, $query);
				self::close($conn);
			} else {
				die ("Error: all mandatory fields need to be set.");
			}
		}
		
		public function getAlbums() {
			$conn = self::connect();
			
			$query = "	SELECT	id
								,name
								,dt_added
								,createdby
								,CASE WHEN cover IS NOT NULL AND cover != '' THEN cover
								ELSE (SELECT thumbpath FROM photo WHERE album_id = album.id ORDER BY id LIMIT 1)
								END as cover
						FROM	album as album;";
						
			$resultset = self::selectUncommitted($conn, $query);						
			self::close($conn);
			
			return $resultset;
		}
	}
?>