<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$request_id = $_GET["request_id"];
	
	$vehicles = $_POST["vehicles"];
	$include_values = false;
	
	if(isset($_POST["v_value"]) && !empty($_POST["v_value"]))
	{
		$include_values = true;
		$v_values = $_POST["v_value"];
	}
	
	$sql = "INSERT INTO request_vehicles VALUES ";
	
	if( count($vehicles) > 0)
	{
		for($v = 0; $v < count($vehicles) - 1; $v++)
		{
			$sql = $sql . "(". $request_id.",". $vehicles[$v]. ($include_values ? "," . $v_values[$v] : "") . "),";
		}
		
		$sql = $sql . "(". $request_id.",". $vehicles[count($vehicles) - 1] . ($include_values ? "," . $v_values[$v] : "") . ")";
		
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