<?php
	require_once('./dao/userDAO.php');
	require_once("./entity/user.php");
	
	class UserService {
		
		public function checkUserLogin($userID, $passwd) {
			
			$userDAO = new UserDAO();
			$resultset = $userDAO->checkUserLogin($userID, $passwd);
			
			if (mysqli_num_rows($resultset) == 1) return true;
			else return false;
		}
		
		public function getUser($userID) {
			$userDAO = new UserDAO();
			
			$resultset = $userDAO->getUser($userID);
			
			if (mysqli_num_rows($resultset) == 1) {
				$userRow = $resultset->fetch_row();
				$user = new User($userRow[0],$userRow[1],$userRow[2]);
			} else exit();
			
			return $user;
		}
	}
?>