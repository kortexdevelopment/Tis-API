<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}
	
	session_start();
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$driver_id = $_GET["driver_id"];
	
	$sql = "DELETE FROM drivers WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$driver_id);

		if($stmt->execute())
		{
			header("location:/system/client_drivers.php?client_id=$client_id#list");
			exit;
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>