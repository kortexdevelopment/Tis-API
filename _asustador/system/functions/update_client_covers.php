<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}

	session_start();

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$cover_id = $_GET["cover_id"];
	
	$liab_v = $_POST["liab_v"];
	$liab_d = $_POST["liab_d"];
	
	$cargo_v = $_POST["cargo_v"];
	$cargo_d = $_POST["cargo_d"];
	
	$gral_v = $_POST["gral_v"];
	$gral_d = $_POST["gral_d"];

	$sql = "UPDATE client_covers SET liab_v = ?, liab_d = ?, cargo_v = ?, cargo_d = ?, gral_v = ?, gral_d = ? WHERE id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("ddddddi", $liab_v, $liab_d, $cargo_v, $cargo_d, $gral_v, $gral_d, $cover_id);

		if($stmt->execute())
		{
			header("location:/system/client_covers.php?client_id=$client_id");
			exit;
		}
		
	}
	
	$stmt->close();
	$db_conn->close();
?>