<?php
	
	if ($_SERVER['REQUEST_METHOD'] != 'POST') 
	{
		header("location: /_index.php");
		exit;
	}
	
	session_start();
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$id = $_SESSION["client_id"];
	$name = $_POST["name"];
	$location = $_POST["location"];
	
	$final_loc = $location[0] . "::" . $location[1] . "::" . $location[2] . "::" .$location[3];
	
	$sql = "INSERT INTO client_clients VALUES (0,?,?,?)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("iss", $id, $name, $final_loc);

		if($stmt->execute())
		{
			$cid = $db_conn->insert_id;
			if(!isset($_SESSION["client_app"]))
			{
				header("location:/system/certificates_panel.php?cid=$cid");	
			}
			else
			{
				header("location:/system/certificates_index.php");	
			}
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>