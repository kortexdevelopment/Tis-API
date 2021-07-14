<?php
	
	if(!isset($_GET["cdl"]) || $_GET["cdl"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}
	
	session_start();
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$id = $_GET["cdl"];
		
	$sql = "DELETE FROM client_clients WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$id);

		if($stmt->execute())
		{
			$header = "";
			
			if(isset($_GET["panel"]))
			{
				$header = "location:/system/certificates_panel.php";
			}
			else
			{
				$header = "location:/system/certificates_index.php";
			}
			
			header($header);
			exit;
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>