<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}
	
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$request= $_GET["delete"];
	
	$sql = "DELETE FROM doc_request WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i", $request);

		if($stmt->execute())
		{
			header("location:/system/client_docs.php?client_id=$client_id");
			exit;
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>