<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";

	$client_id = $_GET["client_id"];
	$company_id = $_GET["company_id"];

	$sql = "INSERT INTO doc_request VALUES (0,?,?,0,?)";

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("iis", $client_id, $company_id, date("Y-m-d"));

		if($stmt->execute())
		{
			$id = $db_conn->insert_id;
			header("location:/system/functions/create_request_covers.php?client_id=$client_id&request_id=$id");
			exit;
		}
	}

	$stmt->close();
	$db_conn->close();
?>