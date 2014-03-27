<?php
	class User {
		private $userID = '';
		private $passwd = '';
		private $username = '';
		private $role = '';
		
		public function setUserID(string $userID) {
			$this->userID = $userID;
		}
		
		public function getUserID() {
			return $this->userID; 
		}
		
		public function getUsername() {
			return $this->username;
		}
		
		public function getRole() {
			return $this->role;
		}
		
		public function __construct($userID, $username, $role) {
			$this->userID = $userID;
			$this->username = $username;
			$this->role = $role;
		}
	}
?>