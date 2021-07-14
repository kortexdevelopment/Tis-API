<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}
	
	session_start();
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$vehicle_id = $_GET["vehicle_id"];
	
	$sql = "DELETE FROM vehicles WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$vehicle_id);

		if($stmt->execute())
		{
			header("location:/system/client_profile.php?client_id=$client_id");
			exit;
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>