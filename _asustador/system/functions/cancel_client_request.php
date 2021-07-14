<?php
	if($_GET["rid"] <= 0)
	{
		header("locations:/system/client_request.php");
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$rid = $_REQUEST["rid"];

	$sql = "UPDATE client_request SET client_request.status = 0 WHERE id = ?";

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i", $rid);

		if($stmt->execute())
		{
			if(!isset($_REQUEST["hst"]))
			{
				header("location:/system/client_request.php");
				exit;
			}
		}
	}

	$stmt->close();

	$db_conn->close();
?>