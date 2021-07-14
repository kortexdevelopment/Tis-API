<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$cover = $_GET["coverage_id"];

	$sql = "DELETE FROM covered_vehicles WHERE coverages_id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i",$cover);

		if($stmt->execute())
		{
			
			$sql = "DELETE FROM coverages WHERE id = ?";
			
			if($stmt = $db_conn->prepare($sql))
			{
				$stmt->bind_param("i",$cover);

				if($stmt->execute())
				{
					header("location:/system/client_profile.php?client_id=$client_id");
					exit;
				}
			}
		}
	}
	
	$stmt->close();
	
	$db_conn->close();
?>