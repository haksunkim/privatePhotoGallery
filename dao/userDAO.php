<?php
	require_once("daoBase.php");
	require_once("./entity/user.php");
	
	class UserDAO extends DaoBase {
		public function checkUserLogin($userID, $passwd) {
			$result = false;
			$conn = self::connect();
			
			$query = "	SELECT	userID
						FROM	user_security
						WHERE	userID	='".$userID."'
						AND		password='".$passwd."';";
						
			$resultset = self::selectUncommitted($conn, $query);						
			self::close($conn);
			
			return $resultset;
		}
		
		public function getUser($userID) {
			$conn = self::connect();
			
			$query = "	SELECT	 u.userid
								,u.username
								,us.role
						FROM	user	u
								INNER JOIN	user_security	us
								ON	u.userid = us.userid
						WHERE	u.userid	=	'".$userID."';";
			$resultset = self::selectUncommitted($conn, $query);
			
			self::close($conn);
			
			return $resultset;
		}
	}
?>