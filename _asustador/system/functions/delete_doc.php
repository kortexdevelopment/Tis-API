<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}
	
	session_start();
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$file_id = $_GET["file_id"];
	$file_name = $_GET["file_name"];
	
	$sql = "DELETE FROM docs WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$file_id);

		if($stmt->execute())
		{
			//Delete file
			unlink($_SERVER["DOCUMENT_ROOT"] . "/system/ready_files/" . $file_name);
			
			header("location:/system/client_docs_stored.php?client_id=$client_id");
			exit;
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>