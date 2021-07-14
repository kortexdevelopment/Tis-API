<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}
	
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$request_id = $_GET["request_id"];
	$vehicle_id = $_GET["vehicle_id"];
	
	$sql = "DELETE FROM request_vehicles WHERE doc_request_id = ? AND vehicles_id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("ii", $request_id, $vehicle_id);

		if($stmt->execute())
		{
			header("location:/system/document_config.php?client_id=$client_id&request_id=$request_id");
			exit;
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>