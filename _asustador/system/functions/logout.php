<?php
	session_start();
	
	$head = isset($_SESSION["client_app"]) ? "/system/client_login.php" : "/_index.php";

	$_SESSION = array();
	
	session_destroy();
	
	header("location: " . $head);
	
	exit;
?>