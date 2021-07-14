<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$request_id = $_GET["request_id"];
	
	$drivers = $_POST["drivers"];
	
	$sql = "INSERT INTO request_drivers VALUES ";
	
	if( count($drivers) > 0)
	{
		for($v = 0; $v < count($drivers) - 1; $v++)
		{
			$sql = $sql . "(". $request_id.",". $drivers[$v]."),";
		}
		
		$sql = $sql . "(". $request_id.",". $drivers[count($drivers) - 1].")";
		
		if($stmt = $db_conn->prepare($sql))
		{
			if($stmt->execute())
			{
				header("location:/system/document_config.php?client_id=$client_id&request_id=$request_id");
				exit;
			}
		}
	}
	else
	{
		header("location:/system/document_config.php?client_id=$client_id&request_id=$request_id");
		exit;
	}		
	
	$stmt->close();

	$db_conn->close();
?>