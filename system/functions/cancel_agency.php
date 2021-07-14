<?php
	if($_GET["aid"] <= 0)
	{
		header("locations:/system/management/agencies.php");
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$agency = $_GET["aid"];

	$sql = "UPDATE companies SET companies.status = 0 WHERE id = ?";

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i", $agency);

		if($stmt->execute())
		{
			header("location:/system/management/agencies.php");
			exit;
		}
	}

	$stmt->close();

	$db_conn->close();
?>