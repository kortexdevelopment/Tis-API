<?php
	if($_GET["client_id"] <= 0)
	{
		header("locations:/system/functions/logout.php");
		exit;
	}

	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	$driver_id = $_GET["driver_id"];
	
	$name = trim($_POST["name"]);
	$licence = trim($_POST["licence"]);
	$state = trim($_POST["state"]);
	
	$dob = date("Y-m-d",  strtotime($_POST["dob"]));
	$doh = date("Y-m-d",  strtotime($_POST["doh"]));
	
	$driver_exp = trim($_POST["driver_exp"]);

	$sql = "UPDATE drivers SET name = ?, licence = ?, state = ?, dob = ?, doh = ?, driver_exp = ? WHERE id = ?";

	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("ssssssi", $name, $licence, $state, $dob, $doh, $driver_exp, $driver_id);

		if($stmt->execute())
		{
			header("location:/system/client_drivers.php?client_id=$client_id#list");
			exit;
		}
	}

	$stmt->close();

	$db_conn->close();
?>