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
	}
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<html>
	<head>
		<meta charset='utf-8'/>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<link rel="stylesheet" href="styles/style.css">
		<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
		<title><?php echo(WEBPAGE_TITLE);?></title>
	</head>
	<body>
		<form method="POST" action="login.php" class="login">
			<p>
			  <label for="login">아이디:</label>
			  <input type="text" name="userid" id="userid">
			</p>

			<p>
			  <label for="password">패스워드:</label>
			  <input type="password" name="passwd" id="passwd">
			</p>

			<p class="login-submit">
			  <button type="submit" name="btnLogin" id="btnLogin" class="login-button">로그인</button>
			</p>
		</form>
	</body>
</html>