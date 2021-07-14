<?php
	session_start();
	
	if(!isset($_SESSION["client_id"]))
	{
		header("location:/system/functions/logout.php");
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_SESSION["client_id"];
	
	$name = trim($_POST["name"]);
	$domain = trim($_POST["domain"]);
	$pass = trim($_POST["pass"]);
	
	$name = $name . $domain;
	
	$sql = "INSERT INTO client_user VALUES (0,?,?,?,1)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("iss", $client_id, $name, $pass);

		if($stmt->execute())
		{
			header("location:/system/client_app_users.php");
			exit;
		}
		else
		{
			header("location:/system/client_app_users.php?error=1");
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>