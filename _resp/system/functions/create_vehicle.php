<?php
	if($_GET["client_id"] <= 0)
	{
		header("location:/system/functions/logout.php");
	}
	
	session_start();
	
	require_once $_SERVER["DOCUMENT_ROOT"] . "/system/functions/db_config.php";
	
	$client_id = $_GET["client_id"];
	
	$make = trim($_POST["make"]);
	$year = trim($_POST["year"]);
	$gvw = trim($_POST["gvw"]);
	$model = trim($_POST["model"]);
	$vin = trim($_POST["vin"]);
	$p_damage = trim($_POST["p_damage"]);
	$deductible = trim($_POST["deductible"]);
	
	$sql = "INSERT INTO vehicles VALUES (0,?,?,?,?,?,?,?,?,1)";
	
	if($stmt = $db_conn->prepare($sql))
	{
		$stmt->bind_param("isssssss", $client_id, $make, $year, $gvw, $model, $vin, $p_damage, $deductible);

		if($stmt->execute())
		{
			header("location:/system/client_profile.php?client_id=$client_id");
			exit;
		}
	}
	
	$stmt->close();

	$db_conn->close();
?>