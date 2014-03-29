<?php
	require_once($_SERVER['DOCUMENT_ROOT']."/env/dao_env.php");
	
	abstract class DaoBase {
		protected function connect() {
			$conn = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME) or die("Error " . mysqli_error($conn));
			
			return $conn;
		}
		
		protected function close($conn) {
			mysqli_close($conn) or die("Error ".mysqli_error($conn));
		}
		
		protected function selectUncommitted($conn, $query) {
			$conn->query("SET SESSION TRANSACTION ISOLATION LEVEL READ UNCOMMITTED;") or die("Error in the consult.." . mysqli_error($conn));
			$resultset = $conn->query($query) or die("Error in the consult.." . mysqli_error($conn));
			$conn->query("SET SESSION TRANSACTION ISOLATION LEVEL REPEATABLE READ;") or die("Error in the consult.." . mysqli_error($conn));
			
			return $resultset;
		}
		
		protected function insert($conn, $query) {
			mysqli_query($conn, $query) or die ("Error: ".mysqli_error($conn));
		}
	}
?>