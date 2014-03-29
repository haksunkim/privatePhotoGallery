<?php
	class Photo {
		public $id = 0;
		public $album_id = 0;
		public $filename = "";
		public $imagepath = "";
		public $thumbpath = "";
		public $caption = "";
		public $dt_added = "";
		public $createdby = "";
		
		public $comments = array();
		
		public function __construct($id, $album_id, $filename, $imagepath, $thumbpath, $caption, $dt_added, $createdby) {
			$this->id = $id;
			$this->album_id = $album_id;
			$this->filename = $filename;
			$this->imagepath = $imagepath;
			$this->thumbpath = $thumbpath;
			$this->caption = $caption;
			$this->dt_added = $dt_added;
			$this->createdby = $createdby;
		}
	}
?>