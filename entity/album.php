<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/entity/photo.php");
	
	class Album {
		public $id = 0;
		public $photos = array();
		public $name = "";
		public $dt_added = "";
		public $createdby = "";
		public $cover = "";
		public $photoCount = 0;
		
		public function __construct($id, $name, $dt_added, $createdby, $cover) {
			$this->id = $id;
			$this->name = $name;
			$this->dt_added = $dt_added;
			$this->createdby = $createdby;
			$this->cover = $cover;
		}
	}
?>