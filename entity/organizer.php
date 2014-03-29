<?php
	require_once("./entity/album.php");
	
	class Organizer {
		private $albums = array();
		
		public function getAlbums($directory) {
			$dirs = scandir($directory);
			
			// loop the directory
			foreach ($dirs as $dir) {
				if ($dir !== "." && $dir !== "..") {
					$album = new Album($dir,$directory."/".$dir);
					
					array_push($this->albums,$album);
				}
			}
			
			return $this->albums;
		}
	}
?>