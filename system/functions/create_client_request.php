<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}
    
    session_start();

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
    $today = date("Y-m-d");
    
	$sql = "INSERT INTO client_request VALUES (0,?,?,1)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("is", $client_id, $today);

		if($stmt->execute())
		{
            $id = $db_conn->insert_id;
            $_SESSION["request_id"] = $id;

			header("location:/system/client_request_create.php?client_id=$client_id");
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>