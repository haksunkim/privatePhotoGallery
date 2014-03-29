<?php
	class User {
		public $userid = '';
		private $passwd = '';
		public $username = '';
		public $role = '';
		
		public function __construct($userID, $username, $role) {
			$this->userid = $userID;
			$this->username = $username;
			$this->role = $role;
		}
	}
?>