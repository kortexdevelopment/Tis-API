<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$client_id = $_GET["client_id"];
	$request_id = $_GET["request_id"];

	$sql = "INSERT INTO request_coverage (doc_request_id) VALUES (?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i", $request_id);
		
		if($stmt->execute())
		{
			header("location:/system/document_config.php?client_id=$client_id&request_id=$request_id");
			exit;
		}
	}

	$stmt->close();
	$db_conn->close();
?>