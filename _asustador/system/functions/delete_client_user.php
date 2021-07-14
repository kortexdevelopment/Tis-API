<?php
	session_start();

	if(!isset($_SESSION["client_id"]))
	{
		header("locations:/system/functions/logout.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$uid = $_GET["uid"];
	
	
	$sql = "DELETE FROM client_user WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$uid);

		if($stmt->execute())
		{
			header("location:/system/client_app_users.php");
			exit;
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>