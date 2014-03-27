<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/photo.php");
	
	class Album {
		private $photos = array();
		private $name = "";
		private $folderPath = "";
		private $cover = "";
		private $photoCount = 0;
		
		public function __construct($name, $folderPath) {
			$this->name = $name;
			$this->folderPath = $folderPath;
			
			$files = scandir($this->folderPath);
			
			$this->photoCount = count($files) - 2;
		}
		
		public function setPhotos() {
			$files = scandir($this->folderPath);
			
			foreach ($files as $file) {
				if ($file !== "." && $file !== ".." && $file !== "image" && $file !== "thumb") {
					$photo = new Photo($file,$this->folderPath."/".$file);
					array_push($this->photos,$photo);				
				}				
			}
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getFolderPath() {
			return $this->folderPath;
		}
		
		public function getPhotoCount() {
			return $this->photoCount;
		}
		
		public function getPhotos() {
			return $this->photos;
		}
	}
?>