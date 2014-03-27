<?php
	class Photo {
		private $name = "";
		private $filePath = "";
		private $comments = array();
		
		public function __construct($name, $filePath) {
			$this->name = $name;
			$this->filePath = $filePath;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getFilePath() {
			return $this->filePath;
		}
	}
?>