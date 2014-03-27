<?php
	//Start session
	ob_start();
	session_start();
	
	require("entity/user.php");
	require_once("module/userService.php");
	
	if (isset($_POST["userid"]) && isset($_POST["passwd"]) && isset($_POST["btnLogin"])) {
		$userServ = new UserService();
		echo(hash("sha512",$_POST["passwd"]));
		$loginResult = $userServ->checkUserLogin($_POST["userid"],hash("sha512",$_POST["passwd"]));
		
		if ($loginResult) {
			$user = $userServ->getUser($_POST["userid"]);
			
			$_SESSION['user'] = serialize($user);
			
			header("location: index.php");
			exit();
		}
		session_destroy();	
		/*
		$auth_users = json_decode(file_get_contents("/home/familyphoto/users.json"))->user;
		
		var_dump($auth_users[1]);
		
		foreach($auth_users as $auth_user) {
			if (   $_POST["userid"] == $auth_user->userid 
				&& $_POST["passwd"] == $auth_user->passwd ) {
				$user = new User();
				$user->setUserID($_POST["userid"]);
				$_SESSION['user'] = serialize($user);
				
				header("location: index.php");
				exit();
			}
		}
		*/
	}
?>
<html>
	<body>
		<form method="POST" action="login.php">
			<table>
				<tr>
					<td>
						아이디: 
					</td>
					<td>
						<input type="text" name="userid" id="userid"/>
					</td>
				</tr>
				<tr>
					<td>
						패스워드: 
					</td>
					<td>
						<input type="password" name="passwd" id="passwd"/>
					</td>
				</tr>
				<tr>
					<td colspan="2">
						<input type="submit" name="btnLogin" id="btnLogin" value="로그인"/>
						<a href="register.php">가입하기</a>
					</td>
				</tr>
			</table>
		</form>
	</body>
</html>