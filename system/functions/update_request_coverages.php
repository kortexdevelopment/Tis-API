<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}

	session_start();

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$request_id = $_GET["request_id"];
	
	$params = $_POST["cover_params"];

	$sql = "UPDATE request_coverage SET 
			 liability_cover = ?, liability_ded = ?, cargo_cover = ?, cargo_ded = ?, gral_cover = ?, gral_ded = ?, tractor_cover = ?, tractor_ded = ?, 
			trailer_cover = ?, trailer_ded = ?, non_cover = ?, non_ded = ?, inter_cover = ?, inter_ded = ? 
			WHERE doc_request_id = ?";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("ssssssssssssssi", $params[0], $params[1], $params[2], $params[3], $params[4], $params[5], $params[6], $params[7],
										$params[8], $params[9], $params[10], $params[11], $params[12], $params[13], $request_id);

		if($stmt->execute())
		{
			header("location:/system/document_config.php?client_id=$client_id&request_id=$request_id");
			exit;
		}
		
	}
	
	$stmt->close();
	$db_conn->close();
?>