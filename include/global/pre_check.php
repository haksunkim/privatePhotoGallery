<?php
	session_start();
	
	// check login
	if(!isset($_SESSION['user'])) {
		header("location: login.php");
		
		session_destroy();
		exit();
	}
?>