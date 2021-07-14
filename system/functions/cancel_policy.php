<?php
	if($_GET["cid"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$cid = $_GET["cid"];
	$pid = $_GET["pid"];

	$sql = "UPDATE policies SET status = 0 WHERE id = ?";

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("i", $pid);

		if($stmt->execute())
		{
			header("location:/system/policies_menu.php?cid=$cid");
			exit;
		}
	}

	$stmt->close();

	$db_conn->close();
?>